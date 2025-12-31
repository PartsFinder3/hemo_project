<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\CarAds;
use App\Models\CarMakes;
use App\Models\CarModels;
use App\Models\CarVarients;
use App\Models\EngineSize;
use App\Models\Fuel;
use App\Models\SpareParts;
use App\Models\Years;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class AdController extends Controller
{
    public function index($id)
    {
        $shop = Auth::guard('supplier')->user()->shop;
        $ad = Ads::where('shop_id', $shop->id)->latest()->get()->map(function ($item) {
            $item->ad_type = 'ad';
            return $item;
        });
      dd($shop->id);
        $car = CarAds::where('shop_id', $shop->id)->latest()->get()->map(function ($item) {
            $item->ad_type = 'car';
            return $item;
        });

        $ads = $ad->merge($car)->sortByDesc('created_at');
       
        return view('supplierPanel.ads.show', compact('ads'));
    }


    public function activeads($id)
    {
        $shop = Auth::guard('supplier')->user()->shop;
        $ad = Ads::where('is_active', 1)->where('shop_id', $shop->id)->latest()->get()->map(function ($item) {
            $item->ad_type = 'ad';
            return $item;
        });

        $car = CarAds::where('is_active', 1)->where('shop_id', $shop->id)->latest()->get()->map(function ($item) {
            $item->ad_type = 'car';
            return $item;
        });

        $ads = $ad->merge($car)->sortByDesc('created_at'); // keep latest order

        return view('supplierPanel.ads.show', compact('ads'));
    }

    public function inactiveads($id)
    {
        $shop = Auth::guard('supplier')->user()->shop;
        $ad = Ads::where('is_active', 0)->where('shop_id', $shop->id)->latest()->get()->map(function ($item) {
            $item->ad_type = 'ad';
            return $item;
        });

        $car = CarAds::where('is_active', 0)->where('shop_id', $shop->id)->latest()->get()->map(function ($item) {
            $item->ad_type = 'car';
            return $item;
        });

        $ads = $ad->merge($car)->sortByDesc('created_at');

        return view('supplierPanel.ads.show', compact('ads'));
    }


    public function approvedads($id)
    {
        $shop = Auth::guard('supplier')->user()->shop;
        $ad = Ads::where('is_approved', 1)->where('shop_id', $shop->id)->latest()->get()->map(function ($item) {
            $item->ad_type = 'ad';
            return $item;
        });

        $car = CarAds::where('is_approved', 1)->where('shop_id', $shop->id)->latest()->get()->map(function ($item) {
            $item->ad_type = 'car';
            return $item;
        });

        $ads = $ad->merge($car)->sortByDesc('created_at');

        return view('supplierPanel.ads.show', compact('ads'));
    }


    public function waitingForApproval($id)
    {
        $shop = Auth::guard('supplier')->user()->shop;
        $ad = Ads::where('is_approved', 0)->where('shop_id', $shop->id)->latest()->get()->map(function ($item) {
            $item->ad_type = 'ad';
            return $item;
        });

        $car = CarAds::where('is_approved', 0)->where('shop_id', $shop->id)->latest()->get()->map(function ($item) {
            $item->ad_type = 'car';
            return $item;
        });

        $ads = $ad->merge($car)->sortByDesc('created_at');

        return view('supplierPanel.ads.show', compact('ads'));
    }


    public function edit($id, $slug)
    {
        $ad = Ads::findOrFail($id);
        $makes = CarMakes::all();
        $models = CarModels::all();
        $years = Years::orderBy('year', 'desc')->get();
        $fuels = Fuel::all();
        $engineSize = EngineSize::all();
        $parts = SpareParts::all();
        return view('supplierPanel.ads.edit', compact('ad', 'makes', 'models', 'years', 'fuels', 'engineSize', 'parts'));
    }

public function update(Request $request, $id, $slug)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'warranty' => 'nullable|string|max:255',
        'delivery' => 'nullable|string|max:255',
        'car_make_id' => 'required|exists:car_makes,id',
        'car_model_id' => 'required|exists:car_models,id',
        'condition' => 'required|string',
        'year_id' => 'required',
        'fuel_id' => 'required',
        'engine_size_id' => 'required',
        'part_id' => 'required|exists:spare_parts,id',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'currency' => 'required|string|in:AED,USD,SAR,PKR,INR,EUR,GBP,CNY,JPY,CAD,AUD,CHF',
    ]);

    $ad = Ads::findOrFail($id);
    $ad->title = $request->input('title');
    $ad->description = $request->input('description');
    $ad->price = $request->input('price');
    $ad->warranty = $request->input('warranty');
    $ad->delivery = $request->input('delivery');
    $ad->car_make_id = $request->input('car_make_id');
    $ad->car_model_id = $request->input('car_model_id');
    $ad->year_id = $request->input('year_id');
    $ad->fuel_id = $request->input('fuel_id');
    $ad->engine_size_id = $request->input('engine_size_id');
    $ad->part_id = $request->input('part_id');
    $ad->condition = $request->input('condition');
    $ad->currency = $request->input('currency');
    $ad->part_number = $request->input('part_number');

    // Keep old images
    $imagePaths = json_decode($ad->images, true) ?? [];

    // Only process new images if user selected any
    if ($request->hasFile('images')) {
        $imagePaths = []; // optional: reset if you want to replace old images completely
        foreach ($request->file('images') as $imageFile) {
            $image_name = uniqid() . '.webp';

            $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $image = $manager->read($imageFile)->toWebp(90);

            $directory = storage_path('app/public/ad_images');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $path = $directory . '/' . $image_name;
            $image->save($path);

            $imagePaths[] = 'storage/ad_images/' . $image_name;
        }
    }

    $ad->images = json_encode($imagePaths);
    $ad->save();

    return redirect()->route('supplier.ads.index', $ad->shop_id)
                     ->with('success', 'Ad updated successfully.');
}


    // public function isActive($id)
    // {
    //     $ad = Ads::findOrFail($id);
    //     $ad->is_active = !$ad->is_active;
    //     $ad->save();

    //     return redirect()->back()->with('success', 'Ad status updated successfully.');
    // }

    // public function isCarActive($id){
    //     $car = CarAds::findOrFail($id);
    //     $car->is_active = !$car->is_active;
    //     $car->save();

    //     return redirect()->back()->with('success', 'Car ad status updated successfully.');
    // }

    public function isActive($type, $id)
    {
        switch ($type) {
            case 'ad':
                $model = Ads::findOrFail($id);
                $message = 'Ad status updated successfully.';
                break;

            case 'car':
                $model = CarAds::findOrFail($id);
                $message = 'Car ad status updated successfully.';
                break;

            default:
                return redirect()->back()->with('error', 'Invalid type provided.');
        }

        $model->is_active = !$model->is_active;
        $model->save();

        return redirect()->back()->with('success', $message);
    }


public function delete($type, $id)
{
    if ($type === 'ad') {
        $ad = Ads::findOrFail($id);
    } elseif ($type === 'car') {
        $ad = CarAds::findOrFail($id);
    } else {
        abort(404, 'Invalid ad type');
    }

    $shopId = $ad->shop_id;
    $ad->delete();

    return redirect()->route('supplier.ads.index', $shopId)
        ->with('success', 'Ad deleted successfully.');
}


public function create()
{
    $makes = CarMakes::orderBy('name', 'asc')->get(); // Alphabetical
    $models = CarModels::orderBy('name', 'asc')->get(); // Alphabetical
    $years = Years::orderBy('year', 'desc')->get(); // Year descending
    $fuels = Fuel::orderBy('type', 'asc')->get(); // Alphabetical
    $engineSize = EngineSize::orderBy('size', 'asc')->get(); // Alphabetical
    $parts = SpareParts::orderBy('name', 'asc')->get(); // Alphabetical

    $supplier = Auth::guard('supplier')->user();
    if ((int)$supplier->is_active === 1) {
        return view('supplierPanel.ads.createAd', compact('makes', 'models', 'years', 'fuels', 'engineSize', 'parts'));
    } else {
        return back()->with('error', 'Please Resubscription now');
    }
}

    

    public function getModels($make_id)
    {
        $models = CarModels::where('car_make_id', $make_id)->get();
        return response()->json($models);
    }

    public function getVariants($model_id)
    {
        $variants = CarVarients::where('car_model_id', $model_id)->get();

        $fuels = Fuel::whereIn('id', $variants->pluck('fuel_id'))->get();
        $engineSizes = EngineSize::whereIn('id', $variants->pluck('engine_size_id'))->get();

        return response()->json([
            'fuels' => $fuels,
            'engineSizes' => $engineSizes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'warranty' => 'nullable|string|max:255',
            'delivery' => 'nullable|string|max:255',
            'car_make_id' => 'required|exists:car_makes,id',
            'car_model_id' => 'required|exists:car_models,id',
            'condition' => 'required|string',
            'year_id' => 'required',
            'fuel_id' => 'nullable',
            'engine_size_id' => 'nullable',
            'part_id' => 'required|exists:spare_parts,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'currency' => 'required|string|in:AED,USD,SAR,PKR,INR,EUR,GBP,CNY,JPY,CAD,AUD,CHF',
             'domain' => 'required|string|max:255',
            
        ]);

        $supplier = Auth::guard('supplier')->user();
        $shop_id = $supplier->shop->id;

        $ad = new Ads();
        $ad->title = $request->input('title');

        $base_slug = Str::slug($ad->title);
        $unique_slug = $base_slug;
        $slug_counter = 1;
$host = preg_replace('/^www\./', '', $request->getHost());
        while (Ads::where('slug', $unique_slug)->exists()) {
            $unique_slug = $base_slug . '-' . $slug_counter;
            $slug_counter++;
        }
        $ad->slug = $unique_slug;
        $ad->description = $request->input('description');
        $ad->price = $request->input('price');
        $ad->warranty = $request->input('warranty');
        $ad->delivery = $request->input('delivery');
        $ad->car_make_id = $request->input('car_make_id');
        $ad->car_model_id = $request->input('car_model_id');
        $ad->year_id = $request->input('year_id');
        $ad->fuel_id = $request->input('fuel_id');
        $ad->engine_size_id = $request->input('engine_size_id');
        $ad->part_id = $request->input('part_id');
        $ad->condition = $request->input('condition');
        $ad->shop_id = $shop_id;
        $ad->currency = $request->input('currency');
        $ad->part_number = $request->input('part_number');
        $ad->domain = $host;

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $image_name = uniqid() . '.webp';

                $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                $image = $manager->read($imageFile)->toWebp(90);

                $directory = storage_path('app/public/ad_images');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                $path = $directory . '/' . $image_name;
                $image->save($path);

                $imagePaths[] = 'storage/ad_images/' . $image_name;
            }
        }

        $ad->images = json_encode($imagePaths);
        $ad->save();

        return redirect()->route('supplier.ads.index', $ad->shop_id)->with('success', 'Ad created successfully.');
    }

    public function createCar()
    {
        $makes = CarMakes::all();
        $models = CarModels::all();
        $years = Years::orderBy('year', 'desc')->get();
        $fuels = Fuel::all();
        $engineSizes = EngineSize::all();
        return view('supplierPanel.carBreaking.create', compact('makes', 'models', 'years', 'fuels', 'engineSizes'));
    }
public function storeCar(Request $request)
{
    // Debug: Log the request data
    \Log::info('StoreCar Request Data:', $request->all());

    // Validation with better error messages
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'car_make_id' => 'required|exists:car_makes,id',
        'car_model_id' => 'required|exists:car_models,id',
        'year_id' => 'required|exists:years,id', // Updated table name
        'fuel_id' => 'nullable|exists:fuel,id', // Updated table name
        'vin_number' => 'nullable|string|max:255',
        'trade_license_number' => 'nullable|string|max:255',
        'engine_size_id' => 'nullable|exists:engine_size,id', // Updated table name
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
    ], [
        'car_make_id.required' => 'Please select a car make.',
        'car_make_id.exists' => 'Selected car make is invalid.',
        'car_model_id.required' => 'Please select a car model.',
        'car_model_id.exists' => 'Selected car model is invalid.',
        'year_id.required' => 'Please select a year.',
        'year_id.exists' => 'Selected year is invalid.',
        'fuel_id.required' => 'Please select a fuel type.',
        'fuel_id.exists' => 'Selected fuel type is invalid.',
        'engine_size_id.required' => 'Please select an engine size.',
        'engine_size_id.exists' => 'Selected engine size is invalid.',
        'title.required' => 'Title is required.',
        'images.*.image' => 'All uploaded files must be images.',
        'images.*.max' => 'Each image must not exceed 2MB.',
    ]);

    try {
        $supplier = Auth::guard('supplier')->user();

        // Check if supplier has a shop
        if (!$supplier->shop) {
            return redirect()->back()->with('error', 'You must have a shop to create ads.');
        }

        $shop_id = $supplier->shop->id;

        // Create new CarAds instance
        $ad = new CarAds();
        $ad->title = $request->input('title');

        // Generate unique slug
        $base_slug = Str::slug($ad->title);
        $unique_slug = $base_slug;
        $slug_counter = 1;

        while (CarAds::where('slug', $unique_slug)->exists()) {
            $unique_slug = $base_slug . '-' . $slug_counter;
            $slug_counter++;
        }

        $ad->slug = $unique_slug;
        $ad->description = $request->input('description');
        $ad->car_make_id = $request->input('car_make_id');
        $ad->car_model_id = $request->input('car_model_id');
        $ad->year_id = $request->input('year_id');
        $ad->fuel_id = $request->input('fuel_id');
        $ad->engine_size_id = $request->input('engine_size_id');
        $ad->vin_number = $request->input('vin_number');
        $ad->trade_license_number = $request->input('trade_license_number');
        $ad->shop_id = $shop_id;

        // Handle image uploads
        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                if ($imageFile->isValid()) {
                    try {
                        $image_name = uniqid() . '.webp';

                        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                        $image = $manager->read($imageFile)->toWebp(90);

                        $directory = storage_path('app/public/ad_images');
                        if (!File::exists($directory)) {
                            File::makeDirectory($directory, 0755, true);
                        }

                        $path = $directory . '/' . $image_name;
                        $image->save($path);

                        $imagePaths[] = 'storage/ad_images/' . $image_name;
                    } catch (\Exception $e) {
                        \Log::error('Image processing failed: ' . $e->getMessage());
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'Failed to process one or more images. Please try again.');
                    }
                }
            }
        }

        $ad->images = json_encode($imagePaths);

        // Save the ad
        $ad->save();

        \Log::info('CarAd created successfully with ID: ' . $ad->id);

        return redirect()->route('supplier.ads.index', $ad->shop_id)
            ->with('success', 'Car breaking ad created successfully.');

    } catch (\Exception $e) {
        \Log::error('StoreCar Error: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());

        return redirect()->back()
            ->withInput()
            ->with('error', 'An error occurred while creating the ad. Please try again.');
    }
}
}
