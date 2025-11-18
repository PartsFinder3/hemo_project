<?php

namespace App\Http\Controllers;

use App\Models\BuyerInvoices;
use App\Models\InquiryUsage;
use App\Models\Invoices;
use App\Models\Payments;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id)
    {
        $supplier = Suppliers::find($id);
        $inquiryUsages = InquiryUsage::where('supplier_id', $id)->latest()->get();
        $payments = Payments::where('supplier_id', $id)->latest()->get();
        $invoices = Invoices::where('supplier_id', $id)->latest()->get();
        $shopID = optional($supplier->shop)->id;
        $buyerInvoices = BuyerInvoices::where('shop_id', $shopID)->latest()->get();
        return view('adminPanel.payments.show', compact('supplier', 'inquiryUsages', 'payments', 'invoices', 'buyerInvoices'));
    }

    public function createPage($id)
    {
        $supplier = Suppliers::find($id);
        return view('adminPanel.payments.create', compact('supplier'));
    }

    public function create(Request $request, $id)
    {
        $supplier = Suppliers::findOrFail($id);
        $request->validate([
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'remarks' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $payment = new Payments();
        $payment->supplier_id = $supplier->id;
        $payment->amount = $request->amount;
        $payment->payment_date = $request->payment_date;
        $payment->remarks = $request->remarks;
        $payment->method = $request->payment_method;

        if ($request->hasFile('image')) {
            $payment->image = $request->file('image')->store('payments', 'public');
        }

        $payment->save();
        $id = $supplier->id;

        return redirect()->route('inquiries.create', $id)->with('success', 'Payment created successfully.');
    }
}
