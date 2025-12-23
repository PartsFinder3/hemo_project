<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\BuyerInquiry;
use App\Models\CarAds;
use App\Models\CarMakes;
use App\Models\Inquiries;
use App\Models\InquiryUsage;
use App\Models\ShopGallery;
use App\Models\ShopHours;
use App\Models\ShopMakes;
use App\Models\ShopParts;
use App\Models\ShopProfile;
use App\Models\Shops;
use App\Models\SpareParts;
use App\Models\Suppliers;
use Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class ShopController extends Controller
{
    public function view($id)
    {
        // $countInquiries = InquiryUsage::where('shop_id', $id)->count();
        $shop = Shops::findOrFail($id);
        $profile = ShopProfile::where('shop_id', $shop->id)->first();
         $shopParts = ShopParts::where('shop_id', $shop->id)->get();
        $shopMakes = ShopMakes::where('shop_id', $shop->id)->get();
        $shopHours = ShopHours::where('shop_id', $shop->id)->first();
        $shopGallery = ShopGallery::where('shop_id', $shop->id)->get();
        $shopAds = Ads::where('shop_id', $shop->id)->get();
        $shopCarAds = CarAds::where('shop_id', $shop->id)->get();
      

        return view('adminPanel.shop.view', compact('shop', 'profile', 'shopParts', 'shopMakes', 'shopHours', 'shopGallery', 'shopAds', 'shopCarAds'));
    }

    public function create($id)
    {
        $supplier = Suppliers::findOrFail($id);

        // if ($supplier->has_shop) {
        //     return redirect()->route('shops.view', $supplier->shop->id)
        //         ->with('info', 'Shop already exists.');
        // }

        $shop = new Shops();
        $shop->supplier_id = $supplier->id;
        $shop->name = $supplier->business_name;
        $shop->save();

        return redirect()->route('shops.view', $shop->id)
            ->with('success', 'Shop created successfully.');
    }

    public function toogleShop($id)
    {
        $shop = Shops::where('supplier_id', $id)->first();

        if ($shop) {
            $shop->is_active = !$shop->is_active;
            $shop->save();
        }

        return redirect()->back()->with('success', 'Shop status toggled successfully.');
    }

    public function createProfile($id)
    {
        $shop = Shops::findOrFail($id);
        $profile = ShopProfile::where('shop_id', $shop->id)->first();
        return view('adminPanel.shopProfile.create', compact('shop', 'profile'));
    }

  public function storeProfile(Request $request, $id)
{
    // ✅ Validation
    $request->validate([
        'description' => 'nullable|string',
        'address' => 'nullable|string',
        'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // ✅ Get Shop
    $shop = Shops::findOrFail($id);

    // ✅ Get or create ShopProfile
    $profile = ShopProfile::firstOrNew(['shop_id' => $shop->id]);

    // ✅ Update text fields
    $profile->description = $request->description;
    $profile->address = $request->address;

    // ✅ Handle Cover Image
    if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
        $file = $request->file('cover');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $directory = storage_path('app/public/covers');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Move file as-is
        $file->move($directory, $fileName);

        $profile->cover = 'covers/' . $fileName;
    }

    // ✅ Handle Profile Image
    if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
        $file = $request->file('profile_image');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $directory = storage_path('app/public/profile_images');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $file->move($directory, $fileName);

        $profile->profile_image = 'profile_images/' . $fileName;
    }

    // ✅ Save profile
    $profile->save();

    // ✅ Redirect back with success
    return redirect()->back()->with('success', 'Shop profile updated successfully.');
}

    public function createParts($id)
    {
        $shop = Shops::findOrFail($id);
        $parts = SpareParts::all();
        return view('adminPanel.shopParts.create', compact('shop', 'parts'));
    }

    public function storeParts(Request $request, $id)
    {
        $request->validate([
            'part_id'   => 'required|array',
            'part_id.*' => 'exists:spare_parts,id',
        ]);

        $shop = Shops::findOrFail($id);

        foreach ($request->input('part_id') as $partId) {
            ShopParts::updateOrCreate(
                ['shop_id' => $shop->id, 'part_id' => $partId],
                []
            );
        }

        return redirect()->route('shops.parts.create', $shop->id)
            ->with('success', 'Spare parts added successfully.');
    }


    public function createMakes($id)
    {
        $shop = Shops::findOrFail($id);
        $makes = CarMakes::all();
        return view('adminPanel.shopMakes.create', compact('shop', 'makes'));
    }

    public function storeMakes(Request $request, $id)
    {
        $request->validate([
            'make_id' => 'required|array',
            'make_id.*' => 'exists:car_makes,id',
        ]);

        $shop = Shops::findOrFail($id);

        foreach ($request->make_id as $makeId) {
            ShopMakes::create([
                'shop_id' => $shop->id,
                'make_id' => $makeId,
            ]);
        }

        return redirect()->back()
            ->with('success', 'Car makes added successfully.');
    }


    public function createHours($id)
    {
        $shop = Shops::findOrFail($id);
        return view('adminPanel.shopHours.create', compact('shop'));
    }

    public function storeHours(Request $request, $id)
    {
        $request->validate([
            'monday' => 'nullable|string',
            'tuesday' => 'nullable|string',
            'wednesday' => 'nullable|string',
            'thursday' => 'nullable|string',
            'friday' => 'nullable|string',
            'saturday' => 'nullable|string',
            'sunday' => 'nullable|string',
        ]);

        $shop = Shops::findOrFail($id);

        $shopHours = ShopHours::where('shop_id', $shop->id)->first();
        if (!$shopHours) {
            $shopHours = new ShopHours();
            $shopHours->shop_id = $shop->id;
        }
        $shopHours->monday = $request->input('monday');
        $shopHours->tuesday = $request->input('tuesday');
        $shopHours->wednesday = $request->input('wednesday');
        $shopHours->thursday = $request->input('thursday');
        $shopHours->friday = $request->input('friday');
        $shopHours->saturday = $request->input('saturday');
        $shopHours->sunday = $request->input('sunday');
        $shopHours->save();

        // if (Auth::guard('supplier')->check()) {
        //     return redirect()->route('supplier.shop.profile', $shop->id)
        //         ->with('success', 'Shop hours added successfully.');
        // }

        return redirect()->back()
            ->with('success', 'Shop hours created successfully.');
    }

    public function createGallery($id)
    {
        $shop = Shops::findOrFail($id);
        return view('adminPanel.shopGallery.create', compact('shop'));
    }


    public function storeGallery(Request $request, $id)
    {
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = Shops::findOrFail($id);

        $gallery = new ShopGallery();
        $gallery->shop_id = $shop->id;

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $image_name = time() . '_gallery.webp';

            // v3 Image Manager with GD driver
            $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());

            // Read, resize & convert to webp
            $img = $manager->read($image)->resize(800, 600)->toWebp(90);

            // Ensure directory exists
            $directory = storage_path('app/public/shop_gallery');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            // Save image
            $path = $directory . '/' . $image_name;
            $img->save($path);

            // Save relative path in DB
            $gallery->image_path = 'shop_gallery/' . $image_name;
        }

        $gallery->save();

        // if (Auth::guard('supplier')->check()) {
        //     return redirect()->route('supplier.shop.profile', $shop->id)
        //         ->with('success', 'Spare part added successfully.');
        // }

        return redirect()->back()
            ->with('success', 'Image uploaded successfully.');
    }

    public function whatsAppQuote($id)
    {
        $buyerInquiry = BuyerInquiry::findOrFail($id);
       dd($buyerInquiry);
        // Sirf wohi inquiryUsage update karo jo is buyerInquiry se linked hai
        $buyerInquiry->inquiryUsages()
            ->where('buyer_inquiry_id', $buyerInquiry->id)
            ->update(['is_open' => true]);
    
        return view('supplierPanel.whatsappQuote.show', compact('buyerInquiry'));
    }
}
