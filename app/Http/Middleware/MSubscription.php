<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoices;
use App\Models\InvoiceSubscriptions;
use App\Models\Inquiries;
use Carbon\Carbon;

class MSubscription
{
    public function handle(Request $request, Closure $next)
    {
        // Supplier login check
        if (!Auth::guard('supplier')->check()) {
            return redirect()->route('supplier.login')->with('error', 'Please login first');
        }

        $supplier = Auth::guard('supplier')->user();

        // Supplier active check
        // if (!$supplier->is_active) {
        //     return redirect()->route('supplier.login.expire')
        //         ->with('error', 'Your subscription has expired.');
        // }

        // Latest invoice
        $invoiceId = Invoices::where('supplier_id', $supplier->id)
                            ->latest()
                            ->value('id');

        if (!$invoiceId) {
            return redirect()->route('supplier.login')->with('error', 'Please subscribe.');
        }

        // Subscription data
        $subscription = InvoiceSubscriptions::where('invoice_id', $invoiceId)->first();

        if (!$subscription) {
            return redirect()->route('supplier.login')
                ->with('error', 'Subscription record not found.');
        }

        $today = Carbon::now();

        // Subscription expiry check
        if ($subscription->end_date && $today->gt($subscription->end_date)) {

            // Expired → inquiries limit = 0
            $Sinvoice = Inquiries::where('supplier_id', $supplier->id)->first();

            if ($Sinvoice) {
                $Sinvoice->inquiries_limit = 0;
                $Sinvoice->save();
            }

            return redirect()->route('supplier.login.expire')
                ->with('error', 'Your subscription has expired.');
        }

        return $next($request);
    }
}
