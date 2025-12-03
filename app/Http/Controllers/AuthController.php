<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
use App\Models\InvoiceSubscriptions;
use App\Models\Invoices;
use App\Models\Inquiries;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function supplierLogin()
    {
        return view('supplierPanel.login.login');
    }

    public function expirePage()
    {
        return view('supplierPanel.login.expire');
    }

public function supplierLoginPost(Request $request)
{
    $credentials = $request->only('whatsapp', 'password');

    if (Auth::attempt($credentials)) {
        $supplier = Auth::user();

        if (!$supplier->is_active) {
            return redirect()->route('supplier.login.expire')
                ->with('error', 'Your subscription has expired. Please renew to continue.');
        }

   
        $invoiceId = Invoices::where('supplier_id', $supplier->id)
                            ->latest()
                            ->value('id');

        if (!$invoiceId) {
            return back()->with('error', 'Please subscribe.');
        }

        // Get subscription for that invoice
        $subscription = InvoiceSubscriptions::where('invoice_id', $invoiceId)->first();

        if (!$subscription) {
            return back()->with('error', 'Subscription record not found.');
        }

        $today = now();

        // Check subscription expiry
        if ($subscription->end_date && $today->gt($subscription->end_date)) {

            // Subscription expired — set inquiries limit to 0
            $Sinvoice = Inquiries::where('supplier_id', $supplier->id)->first();

            if ($Sinvoice) {
                $Sinvoice->inquiries_limit = 0;
                $Sinvoice->save();
            }

            return redirect()->route('supplier.login.expire')
                ->with('error', 'Your subscription has expired.');
        }

        // If subscription is active → allow login
        return redirect()->route('supplier.panel')
            ->with('success', 'Login successful.');
    }

    // Wrong credentials
    return back()->withErrors([
        'whatsapp' => 'The provided credentials do not match our records.',
    ]);
}


    public function supplierLogout(Request $request)
    {
        Auth::guard('supplier')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('supplier.login')->with('success', 'Logged out successfully.');
    }

    public function adminLoginPage()
    {
        return view('adminPanel.auth.admin-login');
    }

    public function adminLoginPost(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required|string|min:6',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        // Attempt login using email or phone
        $credentials = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? ['email' => $login, 'password' => $password]
            : ['phone' => $login, 'password' => $password];

        if (Auth::guard('admins')->attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        return back()->with('error', 'Invalid credentials.')->withInput();
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admins')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
