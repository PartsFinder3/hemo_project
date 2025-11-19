<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Ads;
use App\Models\BuyerInquiry;
use App\Models\Buyers;
use App\Models\CarAds;
use App\Models\CarMakes;
use App\Models\Requests;
use App\Models\Shops;
use App\Models\SpareParts;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use App\Models\Domain; 
class AdminController extends Controller
{
    public function index()
    {
        $buyerInquiries = BuyerInquiry::count();
        $requests = Requests::where('status', 'pending')->count();
        $ads = Ads::where('is_approved', false)->count();
        $carAds = CarAds::where('is_approved', false)->count();
        $totalParts = SpareParts::count();
        $totalMakes = CarMakes::count();
        $totalSuppliers = Suppliers::where('is_active', true)->count();
        $totalShops = Shops::where('is_active',true)->count();
        $suppliers = Suppliers::latest()->get();
        $domain = Domain::first();
           return view('adminPanel.index', compact(
        'buyerInquiries', 'requests', 'ads', 'carAds', 
        'totalParts', 'totalMakes', 'totalSuppliers', 
        'totalShops', 'suppliers', 'domain'
    ));
       
    }

    public function showAds()
    {
        $domain = Domain::first();

        $shopAds = Ads::where('is_approved', false)->get();
        return view('adminPanel.adApproves.ad', compact('shopAds','domain'));
    }

    public function approveAd(Request $request, $id)
    {
        $ad = Ads::findOrFail($id);
        $ad->is_approved = true;
        $ad->save();

        return redirect()->back()->with('success', 'Ad approved successfully.');
    }

    public function showCarAds()
    {
$domain = Domain::first();

        $carAds = CarAds::where('is_approved', false)->get();
        return view('adminPanel.adApproves.carAd', compact('carAds' , 'domain'));
    }

    public function approveCarAd(Request $request, $id)
    {
        $carAd = CarAds::findOrFail($id);
        $carAd->is_approved = true;
        $carAd->save();

        return redirect()->back()->with('success', 'Car ad approved successfully.');
    }

    public function viewAdmins(){
        $admins = Admins::all();
        return view('adminPanel.admins.index', compact('admins'));
    }

    public function addAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'phone' => 'required|string|max:255|unique:admins',
            'role' => 'required|string|in:admin,editor',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = new Admins();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->role = $request->role;
        $admin->password = bcrypt($request->password);
        $admin->save();

        return redirect()->back()->with('success', 'Admin added successfully.');
    }

    public function editAdmin($id)
    {
        $admin = Admins::findOrFail($id);
        return view('adminPanel.admins.edit', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = Admins::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'phone' => 'required|string|max:255|unique:admins,phone,' . $admin->id,
            'role' => 'required|string|in:admin,editor',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->role = $request->role;

        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Admin updated successfully.');
    }

    public function deleteAdmin(Request $request, $id)
    {
        $admin = Admins::findOrFail($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin deleted successfully.');
    }

}
