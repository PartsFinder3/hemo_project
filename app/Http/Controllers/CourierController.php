<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index(){
        $couriers = \App\Models\Courier::all();
        return view('adminPanel.couriers.index', compact('couriers'));
    }

    public function store(Request $request){
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'countries' => 'nullable|string|max:255',
        ]);

        // Create a new courier
        \App\Models\Courier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'countries' => $request->countries,
        ]);

        return redirect()->route('admin.couriers.index')->with('success', 'Courier added successfully.');
    }

    public function edit($id){
        $courier = \App\Models\Courier::findOrFail($id);
        return view('adminPanel.couriers.edit', compact('courier'));
    }

    public function update(Request $request, $id){
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'countries' => 'nullable|string|max:255',
        ]);

        // Find the courier and update its details
        $courier = \App\Models\Courier::findOrFail($id);
        $courier->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'countries' => $request->countries,
        ]);

        return redirect()->route('admin.couriers.index')->with('success', 'Courier updated successfully.');
    }

    public function destroy($id){
        $courier = \App\Models\Courier::findOrFail($id);
        $courier->delete();
        return redirect()->route('admin.couriers.index')->with('success', 'Courier deleted successfully.');
    }

    public function courierServices()
    {
        $couriers = \App\Models\Courier::all();
        return view('supplierPanel.couriers.index', compact('couriers'));
    }

}
