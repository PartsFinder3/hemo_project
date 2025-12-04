<?php

namespace App\Http\Controllers;

use App\Models\BuyerInvoices;
use App\Models\Buyers;
use App\Models\Invoices;
use App\Models\Shops;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function create($id)
    {
        $supplier = Suppliers::find($id);
        return view('adminPanel.invoice.create', compact('supplier'));
    }


    public function storeInvoice(Request $request)
    {
        $invoice = Invoices::create([
            'supplier_id'    => $request->supplier_id,
            'invoice_number' => 'INV-' . time(),
            'payment_date'   => $request->payment_date,
            'remarks'        => $request->remarks,
            'total_amount'   => $request->total_amount,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($request->subscriptions as $sub) {
            $invoice->subscriptions()->create([
                'type'       => $sub['type'],
                'amount'     => $sub['amount'],
                'start_date' => $sub['start_date'],  // <-- required
                'end_date'   => $sub['end_date'],    // <-- agar required ho
            ]);
        }

        // Generate PDF
        $pdf = PDF::loadView('adminPanel.invoice.pdf', compact('invoice'));
        $fileName = 'invoices/' . $invoice->invoice_number . '.pdf';
        Storage::disk('public')->put($fileName, $pdf->output());

        // Save PDF path
        $invoice->update([
            'pdf_path' => $fileName
        ]);

        return redirect()
            ->back()
            ->with('success', 'Invoice created successfully!')
            ->with('pdf_path', asset('storage/' . $fileName));
    }

    public function createBuyerInvoice(){
        // $buyer = Buyers::find($id);
        return view('supplierPanel.invoices.create');
    }

public function storeBuyerInvoice(Request $request)
{
    // $buyer = Buyers::find($id);
    $supplier = Auth::guard('supplier')->user();
    $shop_id = $supplier->shop->id;

    $invoice = BuyerInvoices::create([
        'shop_id'       => $shop_id,
        'buyer_name'    => $request->buyer_name,
        'buyer_phone'   => $request->buyer_phone,
        'buyer_address' => $request->buyer_address,
        'invoice_number'=> 'BINV-' . time(),
        'invoice_date'  => $request->invoice_date,
        'total_amount'  => $request->total_amount,
    ]);

    foreach ($request->items as $sub) {
        $invoice->items()->create($sub);
    }

    $buyerWhatsapp = $buyer->whatsapp ?? 'N/A';
    $buyerCountryCode = $buyer->country_code ?? '';
    $buyerContact = $buyerCountryCode . $buyerWhatsapp;

    // Generate PDF
    $pdf = PDF::loadView('supplierPanel.invoices.pdf', compact('invoice', 'buyerContact'));
    $fileName = 'invoices/' . $invoice->invoice_number . '.pdf';
    Storage::disk('public')->put($fileName, $pdf->output());

    $invoice->update(['pdf_path' => $fileName]);

    return redirect()
        ->back()
        ->with('success', 'Invoice created successfully!')
        ->with('pdf_path', asset('storage/' . $fileName));
}
  function update_parts($id){

   $shop=Shops::find($id);
       return redirect()->route('shops.view', $shop->id);

  }
}
