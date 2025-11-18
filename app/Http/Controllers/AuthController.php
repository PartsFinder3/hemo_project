<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
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

        if (Auth::guard('supplier')->attempt($credentials)) {
            $supplier = Auth::guard('supplier')->user();

            // check expiry
            $today = now();
            if ($supplier->end_date && $today->gt($supplier->end_date)) {
                $supplier->is_active = 0;
                $supplier->inquiries_limit = 0;
                /** @var \App\Models\Supplier $supplier */
                $supplier->save();

                Auth::guard('supplier')->logout();
                return redirect()->route('supplier.login.expire')
                    ->with('error', 'Your subscription has expired. Please renew to continue.');
            }

            if ($supplier->is_active) {
                return redirect()->route('supplier.panel')
                    ->with('success', 'Login successful.');
            } else {
                Auth::guard('supplier')->logout();
                return redirect()->route('supplier.login.expire')
                    ->with('error', 'Your subscription has expired. Please renew to continue.');
            }
        }

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
