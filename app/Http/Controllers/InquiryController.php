<?php

namespace App\Http\Controllers;

use App\Models\BuyerInquiry;
use App\Models\Inquiries;
use App\Models\InquiryUsage;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;

class InquiryController extends Controller
{
    public function create($supplierId)
    {
        return view('adminPanel.subscriptions.create', compact('supplierId'));
    }

    public function store(Request $request, $supplierId)
    {
        $request->validate([
            'inquiries_limit' => 'nullable|integer|min:1',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $inquiry = new \App\Models\Inquiries();
        $inquiry->supplier_id = $supplierId;
        $inquiry->start_date = now()->toDateString();
        $inquiry->end_date = $request->input('end_date', now()->addDays(30)->toDateString());
        $inquiry->inquiries_limit = $request->input('inquiries_limit', null);
        $inquiry->used_inquiries = 0;
        $inquiry->save();

        return redirect()->route('suppliers.show')->with('success', 'Inquiry created successfully.');
    }

    public function index()
    {
        $inquiries = BuyerInquiry::latest()->get();
        return view('adminPanel.enquiries.show', compact('inquiries'));
    }

    public function sendinquiryWhatsApp($id)
    {
        $inquiry = BuyerInquiry::find($id);
        if (!$inquiry) {
            return redirect()->back()->with('error', 'Inquiry not found.');
        }
        $suppliers = Suppliers::where('is_active', 1)->get();
        $waQuote = route('supplier.shop.whatsappQuote', ['id' => $id]);
        return view('adminPanel.enquiries.activeSuppliers', compact('inquiry', 'suppliers', 'waQuote'));
    }

    public function sendInquiry($id)
    {
        $inquiry = BuyerInquiry::find($id);
        if (!$inquiry) {
            return redirect()->back()->with('error', 'Inquiry not found.');
        }

        $inquiry->is_send = true;
        $inquiry->save();

        $suppliers = Suppliers::where('is_active', 1)->get();
        foreach ($suppliers as $supplier) {
            $supplier_inquiry = Inquiries::where('supplier_id', $supplier->id)->first();

            InquiryUsage::create([
                'buyer_inquiry_id' => $inquiry->id,
                'supplier_id' => $supplier->id,
            ]);

            if ($supplier_inquiry) {
                if (!is_null($supplier_inquiry->inquiries_limit)) {
                    if ($supplier_inquiry->inquiries_limit > 0) {
                        $supplier_inquiry->inquiries_limit -= 1;
                        $supplier_inquiry->used_inquiries += 1;
                        if ($supplier_inquiry->inquiries_limit == 0) {
                            $supplier_inquiry->is_active = 0;
                        }
                        $supplier_inquiry->save();
                    }
                }

                if ($supplier_inquiry->start_date && $supplier_inquiry->end_date) {
                    $today = now();
                    if ($today->lt($supplier_inquiry->start_date) || $today->gt($supplier_inquiry->end_date)) {
                        $supplier->is_active = 0;
                        $supplier->save();
                    }
                }
            }
        }
        return redirect()->back()->with('success', 'Inquiry sent successfully.');
    }
    public function sendAll($id)
    {
        try {
            $this->sendInquiryToSuppliers($id);
            return back()->with('success', 'Inquiry sent to all active suppliers!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed: ' . $e->getMessage());
        }
    }

    private function sendInquiryToSuppliers($inquiryId)
    {
        $inquiry = BuyerInquiry::find($inquiryId);
        $suppliers = Suppliers::where('is_active', 'active')->get();

        $fakeMode = env('WHATSAPP_FAKE', true);

        foreach ($suppliers as $supplier) {
            $message = "Inquiry: {$inquiry->title}\nDescription: {$inquiry->description}\nFor Supplier: {$supplier->name}";

            if ($fakeMode) {
                \Log::info("FAKE WhatsApp message to {$supplier->phone}: " . $message);
            } else {
                $accessToken = env('WHATSAPP_ACCESS_TOKEN');
                $phoneId = env('WHATSAPP_PHONE_ID');

                $url = "https://graph.facebook.com/v20.0/{$phoneId}/messages";

                $data = [
                    "messaging_product" => "whatsapp",
                    "to" => $supplier->phone,
                    "type" => "template",
                    "template" => [
                        "name" => "buyer_inquiry", 
                        "language" => ["code" => "en"],
                        "components" => [[
                            "type" => "body",
                            "parameters" => [
                                ["type" => "text", "text" => $inquiry->title],
                                ["type" => "text", "text" => $inquiry->description],
                            ]
                        ]]
                    ]
                ];

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Authorization: Bearer $accessToken",
                    "Content-Type: application/json"
                ]);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);
                curl_close($ch);

                \Log::info("REAL WhatsApp sent to {$supplier->phone}: " . $response);
            }
        }
    }
}
