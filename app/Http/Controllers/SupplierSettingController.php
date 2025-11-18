<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Models\City;
use Illuminate\Http\Request;

class SupplierSettingController extends Controller
{
    public function index($id)
    {
        $supplier = Suppliers::findOrFail($id);
        $cities = City::all();
        return view('adminPanel.supplierUpdates.password', compact('supplier', 'cities'));
    }


    public function editProfile($id)
    {
        $supplier = Suppliers::findOrFail($id);
        $cities = City::all();
        return view('adminPanel.supplierUpdates.password', compact('supplier', 'cities'));
    }
    public function updatePassword(Request $request, $id)
    {
        $supplier = Suppliers::findOrFail($id);

        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Update password directly
        $supplier->password = bcrypt($request->new_password);
        $supplier->save();

        return redirect()->route('shops.view', $supplier->shop->id)
            ->with('success', 'Password updated successfully.');
    }


    public function updateProfile(Request $request, $id)
    {
        $supplier = Suppliers::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'whatsapp' => 'required|string|max:20|unique:suppliers,whatsapp,' . $supplier->id, // fixed field
            'city_id' => 'required|exists:cities,id',
        ]);

        $supplier->name = $request->name;
        $supplier->business_name = $request->business_name;
        $supplier->email = $request->email;
        $supplier->whatsapp = $request->whatsapp;
        $supplier->city_id = $request->city_id;
        $supplier->save();

        return redirect()->route('shops.view', $supplier->shop->id)->with('success', 'Profile updated successfully.');
    }

    public function editPassword($id)
    {
        $supplier = Suppliers::findOrFail($id);
        return view('supplierPanel.password.update', compact('supplier'));
    }

    public function updatePasswordSupplier(Request $request, $id)
    {
        $supplier = Suppliers::findOrFail($id);

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!password_verify($request->current_password, $supplier->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $supplier->password = bcrypt($request->new_password);
        $supplier->save();

        return redirect()->back()
            ->with('success', 'Password updated successfully.');
    }
}
