<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\BlogCategory;
use App\Models\BuyerInquiry;
use App\Models\Buyers;
use App\Models\CarAds;
use App\Models\CarMakes;
use App\Models\CarModels;
use App\Models\City;
use App\Models\Domain;
use App\Models\Inquiries;
use App\Models\InquiryUsage;
use App\Models\ShopGallery;
use App\Models\ShopHours;
use App\Models\ShopMakes;
use App\Models\ShopParts;
use App\Models\ShopProfile;
use App\Models\SpareParts;
use App\Models\Suppliers;
use App\Models\Years;
use App\Models\Faq;
use App\Models\PartMeta;
use App\Models\SeoTitle;
use App\Models\SeoTamplate;

use Illuminate\Support\Facades\Cache;
use App\Models\Shops;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\InquiryService;

use function Ramsey\Uuid\v1;

class FrontendController extends Controller
{
    protected $inquiryService;

    public function __construct(InquiryService $inquiryService)
    {
        $this->inquiryService = $inquiryService;
    }

public function index(Request $request)
{
    $host = $request->getHost();

    $cacheKey = 'frontend_index_' . $host;
    $cacheMinutes = 60; // 1 hour

    // Cache only static data
    $data = Cache::remember($cacheKey, $cacheMinutes * 60, function () use ($host) {
        $Domains = Domain::all();
        $currentDomain = $Domains->first(function($domain) use ($host) {
            return $domain->domain_url == $host;
        });

        $domain_id = $currentDomain ? $currentDomain->id : null;

        $getFAQS = Faq::where('domain_id', $domain_id)->get();
        $carMakes = CarMakes::whereNotNull('logo')->take(60)->get();
        $domain = Domain::first();
        $models = CarModels::all();
        $makes = CarMakes::all();
        $years = Years::orderBy('year', 'desc')->get();
        $parts = SpareParts::all();
        $carAds = CarAds::where('is_approved', true)->latest()->get();
        $randomParts = SpareParts::withCount('ads')->orderBy('ads_count', 'desc')->take(5)->get();
        $randomMakes = CarMakes::limit(8)->get();
        $sParts = SpareParts::take(60)->get();
        $cities = City::all();

        return compact(
            'carMakes', 'domain', 'makes', 'models', 'years', 'parts',
            'carAds', 'randomParts', 'randomMakes', 'sParts', 'cities', 'getFAQS'
        );
    });

    // Pagination OUTSIDE cache → fresh per page
    $data['ads'] = Ads::where('is_approved', true)
        ->where('domain', $host)
        ->latest()
        ->paginate(8);

    // Return view with cache-friendly headers
    return response()
        ->view('Frontend.index', $data)
        ->header('Cache-Control', 'public, max-age=3600');
}


 
    public function getModelsByMake($makeId)
    {
        $models = CarModels::where('car_make_id', $makeId)->get();
        return response()->json($models);
    }

    public function sendInquiry(Request $request)
    {
        $request->validate([
            'car_make_id' => 'nullable',
            'car_model_id' => 'nullable',
            'year_id' => 'nullable',
            'parts' => 'required|array',
            'parts.*' => 'exists:spare_parts,id',
            'condition' => 'nullable',
            'is_send' => 'boolean'
        ]);

        $buyerInquiry = BuyerInquiry::create([
            'car_make_id' => $request->car_make_id,
            'car_model_id' => $request->car_model_id,
            'year_id' => $request->year_id,
            'buyer_id' => null, // This will be updated later
            'condition' => $request->condition,
            'is_send' => true
        ]);

        // Attach selected parts
        $buyerInquiry->partsList()->attach($request->parts);

        return redirect()->route('buyer.contacts', ['buyerInquiry' => $buyerInquiry->id]);
    }
public function sendProductInquiry(Request $request)
{
    $request->validate([
        'ad_id' => 'required|integer',
        'supplier_id' => 'required|integer',
    ]);

    InquiryUsage::create([
        'ad_id' => $request->ad_id,
        'supplier_id' => $request->supplier_id,
        'ip' => $request->ip(),
    ]);

    return response()->json(['success' => true]);
}

    public function buyerPage(BuyerInquiry $buyerInquiry)
    {
        return view('Frontend.buyer', compact('buyerInquiry'));
    }

    public function getBuyerWhatsApp(Request $request, BuyerInquiry $buyerInquiry)
    {
        $request->validate([
            'country_code' => 'required|string',
            'whatsapp' => 'required|string|min:7|max:15|regex:/^[0-9]+$/',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ], [
            'whatsapp.regex' => 'Phone number must contain only digits.',
            'whatsapp.min' => 'Phone number must be at least 7 digits.',
            'whatsapp.max' => 'Phone number cannot exceed 15 digits.',
            'country_code.required' => 'Please select a country code.',
            'country.required' => 'Please select a country.'
        ]);

        // Create new buyer
        $buyer = Buyers::create([
            'country_code' => $request->country_code,
            'whatsapp' => $request->whatsapp,
            'country' => $request->country,
            'city' => $request->city,
        ]);

        // Update the buyer_inquiry with the buyer_id
        $buyerInquiry->update(['buyer_id' => $buyer->id]);

        // Refresh the model to get the updated data
        $buyerInquiry->refresh();

        // Now dispatch to suppliers
        $this->dispatchInquiryToSuppliers($buyerInquiry);
        // $this->sendInquiryToSuppliers($buyerInquiry->id);
        $this->inquiryService->sendInquiryToSuppliers($buyerInquiry->id);
        return redirect()->route('frontend.index')->with('success', 'Inquiry submitted successfully! We will contact you soon.');
    }

    private function dispatchInquiryToSuppliers(BuyerInquiry $inquiry)
    {
        $suppliers = Suppliers::where('is_active', 1)->get();

        foreach ($suppliers as $supplier) {
            $supplier_inquiry = Inquiries::where('supplier_id', $supplier->id)->first();

            InquiryUsage::create([
                'buyer_inquiry_id' => $inquiry->id,
                'supplier_id' => $supplier->id,
            ]);

            if ($supplier_inquiry) {
                if (!is_null($supplier_inquiry->inquiries_limit)) {
                    if ($supplier_inquiry->inquiries_limit > 0) {
                        $supplier_inquiry->inquiries_limit -= 1;
                        $supplier_inquiry->used_inquiries += 1;
                        if ($supplier_inquiry->inquiries_limit == 0) {
                            $supplier_inquiry->is_active = 0;
                        }
                        $supplier_inquiry->save();
                    }
                }

                if ($supplier_inquiry->start_date && $supplier_inquiry->end_date) {
                    $today = now();
                    if ($today->lt($supplier_inquiry->start_date) || $today->gt($supplier_inquiry->end_date)) {
                        $supplier->is_active = 0;
                        $supplier->save();
                    }
                }
            }
        }
    }

    public function adByPart( Request $request, $partName, $id)
    {
        $part = SpareParts::findOrFail($id);
         $seoTitle_t = SeoTitle::find($part->tamp_title_id);
           $meta['title'] = $seoTitle_t 
            ? str_replace('{brand}', $part->name, $seoTitle_t->tittle) 
            : null;
              
            $seoTemplate_d = SeoTamplate::find($part->tamp_id);
              $meta['description'] = $seoTemplate_d 
              ? str_replace('{brand}', $part->name, $seoTemplate_d->description) 
            : null;
        $meta['structure_data'] = <<<JSON
                {
                    "@context": "https://schema.org",
                    "@type": "Product",
                    "name": "{$part->name}",
                    "image": "https://partsfinder.ae/storage/{$part->image}",
                    "description": "{$meta['description']}",
                    "brand": {
                        "@type": "Brand",
                        "name": "{$part->name}"
                    },
                    "offers": {
                        "@type": "Offer",
                        "url": "https://partsfinder.ae/show/ads/{$part->name}/{$part->id}",
                        "priceCurrency": "AED",
                        "price": "120.00",
                        "availability": "https://schema.org/InStock"
                    }
                }
                JSON;
                
        $ads = Ads::where('part_id', $part->id)->get();
          $host =$request->getHost();
          $Domains=Domain::all();
        $currentDomain = $Domains->first(function($domain) use ($host) {
                return $domain->domain_url == $host;
            });
                            if ($currentDomain) {
                $domain_id = $currentDomain->id;
            } else {
                $domain_id = null; // یا کوئی default value
            }

        $getFAQS=Faq::where('domain_id',$domain_id)->get();
        $carMakes = CarMakes::whereNotNull('logo')
            ->take(24)
            ->get();
        $models = CarModels::all();
        $makes = CarMakes::all();
        $years = Years::orderBy('year', 'desc')->get();
        $parts = SpareParts::all();
        $randomParts = SpareParts::withCount('ads')
            ->orderBy('ads_count', 'desc')
            ->take(5)
            ->get();
        $cities = City::all();
        return view('Frontend.PartSearch', compact(
            'part',
            'meta',
            'carMakes',
            'makes',
            'models',
            'years',
            'parts',
            'ads',
            'randomParts',
            'cities',
            'getFAQS',
            'meta'
        ));
    }

    public function adByMakes(Request $request , $slug, $id)
    {
        $make = CarMakes::where('id', $id)->where('slug', $slug)->firstOrFail();
        $seoTitle_t = SeoTitle::find($make->tamp_title_id);
        $meta['title'] = $seoTitle_t 
            ? str_replace('{brand}', $make->name, $seoTitle_t->tittle) 
            : null;

        $seoTemplate_d = SeoTamplate::find($make->tamp_id);
        $meta['description'] = $seoTemplate_d 
            ? str_replace('{brand}', $make->name, $seoTemplate_d->description) 
            : null;

        // Structure data
        $meta['structure_data'] = <<<JSON
        {
            "@context": "https://schema.org",
            "@type": "CollectionPage",
            "name": "{$make->name}",
            "image": "https://partsfinder.ae/storage/{$make->logo}",
            "description": "{$meta['description']}",
            "brand": {
                "@type": "Brand",
                "name": "{$make->name}"
            },
            "offers": {
                "@type": "Offer",
                "url": "https://partsfinder.ae/makes/show/ads/{$make->name}/{$make->id}",
                "priceCurrency": "AED",
                "price": "One Demand",
                "availability": "https://schema.org/InStock"
            }
        }
        JSON;
        
        $ads = Ads::where('car_make_id', $make->id)
            ->where('is_approved', true)
            ->latest()->get();
        $carAds = CarAds::where('car_make_id', $make->id)
            ->where('is_approved', true)
            ->latest()->get();
            $host =$request->getHost();
                $Domains=Domain::all();
                $currentDomain = $Domains->first(function($domain) use ($host) {
                return $domain->domain_url == $host;
            });
              if ($currentDomain) {
                $domain_id = $currentDomain->id;
            } else {
                $domain_id = null; // یا کوئی default value
            }
        $getFAQS=Faq::where('domain_id',$domain_id)->get();
        $carMakes = CarMakes::whereNotNull('logo')
            ->take(60)
            ->get();

        $models = CarModels::all();
        $makes = CarMakes::all();
        $years = Years::orderBy('year', 'desc')->get();
        $parts = SpareParts::all();
        $domain = Domain::with('cities')->first();
        $randomParts = SpareParts::withCount('ads')
            ->orderBy('ads_count', 'desc')
            ->take(5)
            ->get();

        $cities = City::all();
        $randomMakes = CarMakes::limit(8)->get();
        
        return view('Frontend.make-search', compact(
            'make',
            'carMakes',
            'makes',
            'models',
            'years',
            'parts',
            'ads',
            'carAds',
            'randomParts',
            'cities',
            'randomMakes',
            'domain',
            'getFAQS',
            'meta'
        ));
    }

    public function adByCity(Request $request , $slug, $id)
    {
        $city = City::where('id', $id)->where('slug', $slug)->firstOrFail();

         $domain = Domain::with('cities')->first();
        $ads = Ads::whereHas('shop.supplier', function ($query) use ($city) {
            $query->where('city_id', $city->id)
                ->where('is_approved', true)
            ;
        })->latest()->get();
 $host =$request->getHost();
          $Domains=Domain::all();
        $currentDomain = $Domains->first(function($domain) use ($host) {
                return $domain->domain_url == $host;
            });
              if ($currentDomain) {
                $domain_id = $currentDomain->id;
            } else {
                $domain_id = null; // یا کوئی default value
            }
        $getFAQS=Faq::where('domain_id',$domain_id)->get();
        $carAds = CarAds::whereHas('shop.supplier', function ($query) use ($city) {
            $query->where('city_id', $city->id)
                ->where('is_approved', true)
            ;
        })->latest()->get();

        $carMakes = CarMakes::whereNotNull('logo')->take(24)->get();
        $models = CarModels::all();
        $makes = CarMakes::all();
        $years = Years::orderBy('year', 'desc')->get();
        $parts = SpareParts::all();

        $randomParts = SpareParts::withCount('ads')
            ->orderBy('ads_count', 'desc')
            ->take(5)
            ->get();

        $cities = City::all();
        $randomMakes = CarMakes::limit(8)->get();

        return view('Frontend.city-search', compact(
            'city',
            'ads',
            'carAds',
            'carMakes',
            'models',
            'makes',
            'years',
            'parts',
            'randomParts',
            'cities',
            'randomMakes',
            'domain',
            'getFAQS'
        ));
    }

    public function viewShops()
    {
        // $shops = Shops::where('is_active', 1)
        //     ->select('shops.*')
        //     ->selectSub(function ($query) {
        //         $query->from('inquiries')
        //             ->selectRaw('COALESCE(SUM(used_inquires),0)')
        //             ->whereColumn('inquiries.supplier_id', 'shops.supplier_id');
        //     }, 'total_inquiries')
        //     ->orderByDesc('total_inquiries')
        //     ->get();

        $shops = Shops::where('is_active', 1)->get();
      
        return view('Frontend.shops.view', compact('shops'));
    }

    public function aboutPage()
    {
        // $domain = Domain::first();
        return view('Frontend.about');
    }

    public function viewAd($slug, $id)
    {
        $ad = Ads::where('id', $id)->where('slug', $slug)->firstOrFail();
        return view('Frontend.view-add', compact('ad'));
    }

    public function viewCarAd($slug, $id)
    {
        $ad = CarAds::where('id', $id)->where('slug', $slug)->firstOrFail();
        return view('Frontend.view-car-ad', compact('ad'));
    }

    public function viewShop($id)
    {
        $shop = Shops::find($id);
        if (!$shop) {
            abort(404, 'Shop not found.');
        }
        $profile = ShopProfile::where('shop_id', $shop->id)->first();
        $shopParts = ShopParts::where('shop_id', $shop->id)->get();
        $shopMakes = ShopMakes::where('shop_id', $shop->id)->get();
        $shopHours = ShopHours::where('shop_id', $shop->id)->first();
        $shopGallery = ShopGallery::where('shop_id', $shop->id)->get();
       
        $shopAds = Ads::where('shop_id', $shop->id)
            ->where('is_approved', true)
            ->get();
        
       
            $shopCarAds = CarAds::where('shop_id', $shop->id)
            ->where('is_approved', true)
            ->get();
        $inquiryCount = Inquiries::where('supplier_id', $shop->supplier_id)->sum('used_inquiries');
        // $shop->inquiry_count = $inquiryCount;
        $totalAds = $shopAds->count() + $shopCarAds->count();
        return view('Frontend.shops.shop', compact('shop', 'profile', 'shopParts', 'shopMakes', 'shopHours', 'shopGallery', 'shopAds', 'shopCarAds', 'inquiryCount', 'totalAds'));
    }

    public function blogs()
    {
        $domain = Domain::first();
        $blogs = $domain->blogs()->latest()->get();
        $categories = BlogCategory::all();
        return view('Frontend.blogs.index', compact('blogs', 'domain', 'categories'));
    }

    public function blogView($slug, $id)
    {
        $domain = Domain::first();
        $blog = $domain->blogs()->where('id', $id)->where('slug', $slug)->firstOrFail();
        $blog->increment('is_view');
        $categories = BlogCategory::all();
        return view('Frontend.blogs.view', compact('blog', 'domain', 'categories'));
    }

    public function viewBlogByCategory($id)
    {
        $domain = Domain::first();
        $category = BlogCategory::findOrFail($id);
        $blogs = $domain->blogs()->where('category_id', $category->id)->latest()->get();
        $categories = BlogCategory::all();
        return view('Frontend.blogs.index', compact('blogs', 'domain', 'categories'));
    }

    public function signupPage()
    {
        $cities = City::all();
        return view('Frontend.signup', compact('cities'));
    }

    public function termsAndConditions()
    {
        return view('Frontend.blogs.terms');
    }
    public function privacyPolicy()
    {
        return view('Frontend.blogs.privacy');
    }


    public function makePart($id)
    {
        // Current domain from middleware
        $domainId = request()->attributes->get('domain')->id
            ?? \App\Models\Domain::where('domain_url', request()->getHost())->value('id');

        // Fetch part with meta for this domain
        $part = SpareParts::with([
            'partsMeta' => function ($q) use ($domainId) {
                $q->where('domain_id', $domainId);
            }
        ])->findOrFail($id);

        $makes = CarMakes::all();
        $randomParts = SpareParts::withCount('ads')
            ->orderBy('ads_count', 'desc')
            ->take(5)
            ->get();
        $cities = City::all();
        $randomMakes = CarMakes::limit(8)->get();
        $years = Years::orderBy('year', 'desc')->get();
        $parts = SpareParts::all();
        $ads = Ads::where('part_id', $part->id)->get();
        $carAds = CarAds::latest()->get();
        return view('Frontend.make-part', compact('part', 'makes', 'randomParts', 'cities', 'randomMakes','years','parts','ads','carAds'));
    }


public function searchMakes(Request $request)
{
    $search = $request->q;

    $data = CarMakes::where('name', 'LIKE', "%$search%")
        ->select('id', 'name')
        ->get();

    return response()->json($data);
}

public function searchModels(Request $request)
{
    $search = $request->q;
    $make_id = $request->make_id;

    $data = CarModels::where('car_make_id', $make_id)
        ->where('name', 'LIKE', "%$search%")
        ->select('id', 'name')
        ->get();

    return response()->json($data);
}
public function searchYears(Request $request)
{
    $search = $request->q;

    $data = Years::where('year', 'LIKE', "%$search%")
        ->orderByRaw('CAST(year AS UNSIGNED) DESC')
        ->select('id', 'year as text')
        ->get();

    return response()->json($data);
}
public function searchParts(Request $request)
{
    $search = $request->q;

    $parts = SpareParts::when($search, function($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                })
                ->get();

    return response()->json($parts);
}

   function found_pages(){
    return view('Frontend.pages_finder');
   }
}
