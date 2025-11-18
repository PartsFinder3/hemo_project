<?php

namespace App\Http\Controllers;

use App\Models\BuyerInquiry;
use App\Models\Buyers;
use App\Models\CarMakes;
use App\Models\Inquiries;
use App\Models\InquiryUsage;
use App\Models\SpareParts;
use App\Models\Suppliers;
use App\Models\Years;
use App\Models\CarModels;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index(){
        $makes = CarMakes::all();
        $models = CarModels::all();
        $years = Years::all();
        $parts = SpareParts::all();
        return view('adminPanel.test', compact('makes', 'models', 'years', 'parts'));
    }

// public function sendInquiry(Request $request)
// {
//     $request->validate([
//         'car_make_id' => 'nullable',
//         'car_model_id' => 'nullable',
//         'year_id' => 'nullable',
//         'buyer_id' => 'nullable',
//         'parts' => 'required|array',
//         'parts.*' => 'exists:spare_parts,id',
//         'condition' => 'nullable',
//     ]);

//     $buyerInquiry = new BuyerInquiry();
//     $buyerInquiry->car_make_id = $request->car_make_id;
//     $buyerInquiry->car_model_id = $request->car_model_id;
//     $buyerInquiry->year_id = $request->year_id;
//     // $buyerInquiry->parts = $request->parts ? json_decode($request->parts, true) : [];
//     $buyerInquiry->condition = $request->condition;
//     $buyerInquiry->buyer_id = null;
//     $buyerInquiry->save();

//     $buyerInquiry->partsList()->attach($request->parts);

//     return redirect()->route('buyer.whatsapp.page', ['buyerInquiry' => $buyerInquiry->id]);
// }

public function sendInquiry(Request $request)
{
    $request->validate([
        'car_make_id' => 'nullable',
        'car_model_id' => 'nullable',
        'year_id' => 'nullable',
        'buyer_id' => 'nullable',
        'parts' => 'required|array',
        'parts.*' => 'exists:spare_parts,id',
        'condition' => 'nullable',
        'is_send' => 'boolean'
    ]);

    $buyerInquiry = BuyerInquiry::create([
        'car_make_id' => $request->car_make_id,
        'car_model_id' => $request->car_model_id,
        'year_id'     => $request->year_id,
        'buyer_id'    => null,
        'condition'   => $request->condition,
        'is_send'    => true
    ]);

    $buyerInquiry->partsList()->attach($request->parts);

    return redirect()->route('buyer.whatsapp.page', ['buyerInquiry' => $buyerInquiry->id]);
}

public function buyerWhatsappPage(BuyerInquiry $buyerInquiry)
{
    return view('adminPanel.wa', compact('buyerInquiry'));
}

public function getBuyerWhatsApp(Request $request, BuyerInquiry $buyerInquiry)
{
    $request->validate([
        'country_code' => 'required',
        'whatsapp' => 'required|string|max:255',
        'country' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
    ]);

    $buyer = new Buyers();
    $buyer->country_code = $request->country_code;
    $buyer->whatsapp = $request->whatsapp;
    $buyer->country = $request->country;
    $buyer->city = $request->city;
    $buyer->save();

    $buyerInquiry->buyer_id = $buyer->id;
    $buyerInquiry->save();

    $this->dispatchInquiryToSuppliers($buyerInquiry);

    return redirect()->route('buyers.index')->with('success', 'Inquiry submitted successfully! We will contact you soon.');
}

private function dispatchInquiryToSuppliers(BuyerInquiry $inquiry)
{
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
}



}
