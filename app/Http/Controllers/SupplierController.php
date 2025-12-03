<?php

namespace App\Http\Controllers;

use App\Models\BuyerInquiry;
use App\Models\CarMakes;
use App\Models\CarModels;
use App\Models\City;
use App\Models\InquiryUsage;
use App\Models\Requests;
use App\Models\ShopParts;
use App\Models\Suppliers;
use App\Models\Years;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
        use App\Models\Domain; 
use App\Models\Inquiries;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
{
    public function requestPage()
    {
        $cities = City::all();
        return view('Frontend.signup', compact('cities'));
    }

    public function createRequest(Request $request)
    {
        $request->validate([
            'city_id'       => 'required|exists:cities,id',
            'name'          => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'country_code'  => 'required|string|max:10',
            'phone'         => 'required|string|max:20',
        ]);

        $cleanPhone = preg_replace('/[\s\-\(\)\+]/', '', $request->phone);
        $cleanCode  = preg_replace('/[\s\-\(\)\+]/', '', $request->country_code);

        $whatsapp = '+' . $cleanCode . $cleanPhone; // always add +


        // Check duplicate after cleaning
        if (Requests::where('whatsapp', $whatsapp)->exists()) {
            return back()->withErrors(['error' => 'This WhatsApp number is already taken.'])->withInput();
        }

        // Create new request
        $newRequest = new Requests();
        $newRequest->city_id       = $request->city_id;
        $newRequest->name          = $request->name;
        $newRequest->business_name = $request->business_name;
        $newRequest->email         = $request->email;
        $newRequest->whatsapp      = $whatsapp;
        $newRequest->save();
      
        return redirect()->route('frontend.index')->with('success', 'Your Request has submmited successfully, Our team will contact you soon!!');
    }



    public function showRequests()
    {
        $domain = Domain::first();
        $requests = Requests::all();
        return view('adminPanel.SupplierRequests.show', compact('requests','domain'));
    }

    public function acceptRequest($id)
    {
        $request = Requests::findOrFail($id);
        $request->status = 'approved';
        $request->save();
        $id = $request->id;
        return $this->createSupplier($id);
    }

    public function createSupplier($id)
    {
        $request = Requests::findOrFail($id);
        $supplier = new Suppliers();

        //Existing Supplier Check
        $existingSupplier = Suppliers::where('request_id', $request->id)->first();
        if ($existingSupplier) {
            return redirect()->back()->with('error', 'Supplier already exists.');
        }

        $supplier->request_id     = $request->id;
        $supplier->city_id        = $request->city_id;
        $supplier->name           = $request->name;
        $supplier->business_name  = $request->business_name;
        $supplier->email          = $request->email;
        $supplier->whatsapp       = $request->whatsapp;
        $supplier->is_active      = true;

        $lastSeven = substr($request->whatsapp, -7);

        $supplier->password = Hash::make($lastSeven);

        $supplier->save();
        $base=new User;
        $base->name=$request->name;
        $base->email=$request->email;
        $base->password= Hash::make($lastSeven);
        $base->id_active=1;
        $base->save();
        return redirect()->route('suppliers.show')->with('success', 'Supplier created successfully.');
    }

    public function showSuppliers()
    {
        $domain = Domain::first();
        $suppliers = Suppliers::with(['latestSubscription'])->latest()->get();
        
        return view('adminPanel.suppliers.show', compact('suppliers','domain'));
    }


    public function rejectRequest($id)
    {
        $request = Requests::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return redirect()->back()->with('success', 'Request rejected successfully.');
    }

public function showSupplierPanel(Request $request)
{
    $supplier = Auth::guard('supplier')->user();
    if(!$supplier){
        return redirect()->route('supplier.login')->with('error','please login');
    }
    // If supplier account is not active, block inquiries
    if (!$supplier->is_active) {
        return view('supplierPanel.index', [
            'usages' => collect(),
            'shopPartIds' => [],
            'makes' => CarMakes::all(),
            'years' => Years::all(),
            'cities' => City::all(),
            'message' => null,
        ]);
    }

    if (!$supplier->shop) {
        return back()->with('error', 'Your shop is not created');
    }

    $shopPartIds = ShopParts::where('shop_id', $supplier->shop->id)
        ->pluck('part_id')
        ->toArray();

    // ✅ Correct check for zero inquiries_limit
    $hasInquiries = Inquiries::where('supplier_id', $supplier->id)
        ->where('inquiries_limit', '>', 0)
        ->exists();

    if (!$hasInquiries) {
       
        // If no inquiries left, show message and **do not fetch usages**
        return view('supplierPanel.index', [
            'usages' => collect(), // empty collection
            'shopPartIds' => $shopPartIds,
            'makes' => CarMakes::all(),
            'years' => Years::all(),
            'cities' => City::all(),
            'message' => 'Please resubscribe',
        ]);
    }
  
    // Only fetch usages if inquiries exist
    $usages = InquiryUsage::with(['buyerInquiry.carMake', 'buyerInquiry.carModel', 'buyerInquiry.year', 'buyerInquiry.buyer'])
        ->where('supplier_id', $supplier->id)
        ->whereHas('buyerInquiry.partsList', function ($q) use ($shopPartIds) {
            $q->whereIn('spare_parts.id', $shopPartIds);
        })
        ->whereHas('buyerInquiry', function ($q) use ($request) {
            if ($request->filled('make')) {
                $q->where('car_make_id', $request->make);
            }
            if ($request->filled('model')) {
                $q->where('car_model_id', $request->model);
            }
            if ($request->filled('min_year')) {
                $q->whereHas('year', function ($yearQuery) use ($request) {
                    $yearQuery->where('year', '>=', $request->min_year);
                });
            }
            if ($request->filled('max_year')) {
                $q->whereHas('year', function ($yearQuery) use ($request) {
                    $yearQuery->where('year', '<=', $request->max_year);
                });
            }
            if ($request->filled('city')) {
                $q->where('city_id', $request->city);
            }
            if ($request->filled('parts')) {
                $q->where(function ($partsQuery) use ($request) {
                    $partsQuery->where('parts', 'like', '%' . $request->parts . '%')
                        ->orWhereJsonContains('parts', $request->parts);
                });
            }
            if ($request->filled('time_range')) {
                if ($request->time_range === '24h') {
                    $q->where('created_at', '>=', now()->subDay());
                } elseif ($request->time_range === '7d') {
                    $q->where('created_at', '>=', now()->subDays(7));
                } elseif ($request->time_range === '30d') {
                    $q->where('created_at', '>=', now()->subDays(30));
                } elseif ($request->time_range === '1y') {
                    $q->where('created_at', '>=', now()->subYear());
                } elseif ($request->time_range === 'custom' && $request->filled(['from_date', 'to_date'])) {
                    $q->whereBetween('created_at', [
                        Carbon::parse($request->from_date)->startOfDay(),
                        Carbon::parse($request->to_date)->endOfDay()
                    ]);
                }
            }
        })
        ->latest()
        ->get();
    $makes = CarMakes::all();
    $years = Years::all();
    $cities = City::all();
     
    return view('supplierPanel.index', compact('usages', 'shopPartIds', 'makes', 'years', 'cities'))
        ->with('message', null); // No message if everything is fine
}
    public function markInquiryRead($id)
    {
        $inquiryUsage = InquiryUsage::findOrFail($id);
        $inquiryUsage->is_read = true;
        $inquiryUsage->save();

        return redirect()->back();
    }

    public function getModelsByMake($make_id)
    {
        // Log the request for debugging

        try {
            // Check if make exists
            $make = CarMakes::find($make_id);
            if (!$make) {
                return response()->json(['error' => 'Make not found'], 404);
            }


            // Get models - try both possible foreign key names
            $models = CarModels::where('car_make_id', $make_id)
                ->select('id', 'name')
                ->orderBy('name')
                ->get();

            // If no models found with car_make_id, try make_id
            if ($models->isEmpty()) {
                $models = CarModels::where('make_id', $make_id)
                    ->select('id', 'name')
                    ->orderBy('name')
                    ->get();
            }


            return response()->json($models);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
public function activeSupplierToggle($id)
{
    $supplier = Suppliers::findOrFail($id);
    
    $supplier->is_active = !$supplier->is_active;
    
    $supplier->save();

    return redirect()->back();
}

    public function verifiedSupplier($id)
    {
        $supplier = Suppliers::findOrFail($id);
        $supplier->is_verified = !$supplier->is_verified;
        $supplier->save();

        return redirect()->back();
    }
}
