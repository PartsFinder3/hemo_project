<?php

namespace App\Http\Controllers;

// use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ads;
use App\Models\CarAds;
use App\Models\CarMakes;
use App\Models\Inquiries;
use App\Models\InquiryUsage;
use App\Models\ShopGallery;
use App\Models\ShopHours;
use App\Models\ShopMakes;
use App\Models\ShopParts;
use App\Models\Shops;
use App\Models\SpareParts;
use App\Models\Suppliers;
use App\Models\ShopProfile;

class ShopProfileController extends Controller
{
    public function index($id)
    {
        $shop = Shops::find($id);
        if (!$shop) {
            abort(404, 'Shop not found.');
        }
        $profile = ShopProfile::where('shop_id', $shop->id)->first();
        $shopParts = ShopParts::with('part')->where('shop_id', $shop->id)->get();
    
        $shopMakes = ShopMakes::where('shop_id', $shop->id)->get();
        $shopHours = ShopHours::where('shop_id', $shop->id)->first();
        $shopGallery = ShopGallery::where('shop_id', $shop->id)->get();
       $shopAds = Ads::where('shop_id', $shop->id)->paginate(30);
        $shopCarAds = CarAds::where('shop_id', $shop->id)->get();
        return view('supplierPanel.shopProfile.view', compact('shop', 'profile', 'shopParts', 'shopMakes', 'shopHours', 'shopGallery', 'shopAds', 'shopCarAds'));
    }

    public function createProfile($id)
    {
        $shop = Shops::findOrFail($id);
        $profile = ShopProfile::where('shop_id', $shop->id)->first();

        return view('supplierPanel.shopProfile.createProfile', compact('shop', 'profile'));
    }

    public function createParts($id)
    {
        $shop = Shops::findOrFail($id);
        $parts = SpareParts::all();

        return view('supplierPanel.shopProfile.createParts', compact('shop', 'parts'));
    }

    public function createMakes($id)
    {
        $shop = Shops::findOrFail($id);
        $makes = CarMakes::all();

        return view('supplierPanel.shopProfile.createMakes', compact('shop', 'makes'));
    }

    public function createHours($id)
    {
        
        $shop = Shops::findOrFail($id);
        
        $hours = ShopHours::where('shop_id', $shop->id)->first();
        return view('supplierPanel.shopProfile.createHours', compact('shop', 'hours'));
    }

    public function createGallery($id)
    {
        $shop = Shops::findOrFail($id);
        return view('supplierPanel.shopProfile.createGallery', compact('shop'));
    }
}
