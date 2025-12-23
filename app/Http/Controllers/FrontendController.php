<?php

namespace App\Http\Controllers;
use OpenAI;
use App\Models\Ads;
use App\Models\BlogCategory;
use App\Models\Blogs;
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
use App\Models\SeoContentMake;
use App\Models\SparePartSeo;

use Illuminate\Support\Facades\Cache;
use App\Models\Shops;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\InquiryService;
use App\Jobs\GenerateSeoContentJob;
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


    $host = preg_replace('/^www\./', '', $request->getHost());

    // ===== DOMAIN RESOLVE =====
    $currentDomain = Domain::where('domain_url', $host)->first();

    $domain_id  = $currentDomain?->id;
    $domain_map = $currentDomain?->map_img ?? 'logo/1759938974_map.webp';

    // ===== NORMAL DATA (NO CACHE) =====
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

    // ===== PAGINATION =====
    $ads = Ads::where('is_approved', true)
        ->where('domain', $host)
        ->latest()
        ->paginate(8);
    
    return view('Frontend.index', compact(
        'carMakes',
        'domain',
        'makes',
        'models',
        'years',
        'parts',
        'carAds',
        'randomParts',
        'randomMakes',
        'sParts',
        'cities',
        'getFAQS',
        'domain_map',
        'ads'
    ));
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
       
        $buyer = Buyers::create([
            'country_code' => $request->country_code,
            'whatsapp' => $request->whatsapp,
            
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
          $content=SparePartSeo::where('part_id',$id)->first();
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
            'meta',
            'content'
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
        $Content=SeoContentMake::where('make_id',$id)->first();
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
            'meta',
            'Content'
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

    public function aboutPage(Request $request)
    {
          $host = $request->getHost();
           $Domains = Domain::all();
           $currentDomain = $Domains->first(function ($domain) use ($host) {
        return $domain->domain_url == $host;
    });

      $domain_id = $currentDomain ? $currentDomain->id : null;
       $domain = Domain::find($domain_id);
        $meta = [
    'title' => " About PartsFinder UAE | Auto Spare Parts Price Comparison Platform",
    'description' => " Learn about PartsFinder UAE, a car spare parts price comparison platform helping buyers find used and new auto spare parts from verified local sellers.",
     'structure_data' => json_encode([
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => "PartsFinder About",
        "url" => url()->current()
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
];

        return view('Frontend.about',compact('meta' , 'domain'));
    }

    public function viewAd($slug, $id)
    {
        $ad = Ads::where('slug', $slug)->first();
      
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

public function blogs(Request $request)
{
    $host = $request->getHost();

    $Domains = Domain::all();
    $currentDomain = $Domains->first(function ($domain) use ($host) {
        return $domain->domain_url == $host;
    });

    $domain_id = $currentDomain ? $currentDomain->id : null;

    $blogs = Blogs::where('domain_id', $domain_id)->latest()->get();
    $categories = BlogCategory::all();

    $meta = [
        'title' => "Auto Spare Parts Blog UAE | Guides, Tips & Updates – PartsFinder",
        'description' => "Read the PartsFinder blog for auto spare parts guides, buying tips, market updates, and helpful information for car owners in UAE.",
        'structure_data' => json_encode([
            "@context" => "https://schema.org",
            "@type" => "WebSite",
            "name" => "PartsFinder Blog",
            "url" => url()->current()
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    ];

    return view('Frontend.blogs.index', compact('blogs', 'currentDomain', 'categories', 'meta'));
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
                $meta = [
    'title' => "Become a Supplier | Sell Used & New Auto Spare Parts in UAE",
    'description' => "Join PartsFinder UAE as a supplier. List used, new, and aftermarket auto spare parts and reach customers across Dubai, Abu Dhabi, and UAE",
     'structure_data' => json_encode([
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => "PartsFinder Become a Supplier",
        "url" => url()->current()
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
];

        return view('Frontend.signup', compact('cities','meta'));
    }

    public function termsAndConditions()
    {
        $meta = [
    'title' => "Terms & Conditions | PartsFinder UAE",
    'description' => "Read the terms and conditions of using PartsFinder UAE. Learn about user responsibilities, platform usage, supplier rules, and service limitations.",
    'structure_data' => json_encode([
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => "PartsFinder Terms & Condition",
        "url" => url()->current()
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
];

        return view('Frontend.blogs.terms' , compact('meta'));
    }
    public function privacyPolicy()
    {
           $meta = [
    'title' => " Privacy Policy | PartsFinder UAE",
    'description' => " View PartsFinder UAE’s privacy policy to understand how we collect, use, and protect your personal data while using our auto spare parts platform.",
    'structure_data' => json_encode([
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => "PartsFinder Privacy Policy",
        "url" => url()->current()
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
];
        return view('Frontend.blogs.privacy', compact('meta'));
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
    $domain = Domain::first();
    $parts = SpareParts::all();
    $makes=CarMakes::all();
    $blogs = $domain->blogs()->latest()->get();
              $meta = [
    'title' => "Search Results | Auto Spare Parts in UAE – PartsFinder",
    'description' => " Browse available used and new auto spare parts in UAE. Compare prices, sellers, and availability easily on PartsFinder search results pages",
    'structure_data' => json_encode([
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => "PartsFinder Search Results",
        "url" => url()->current()
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
];
    return view('Frontend.pages_finder', compact('parts','makes','blogs','meta'));
}
public function generateSeoMake($id)
{
    $make = CarMakes::find($id);
    $brand=$make->name;
    if (!$make) {
        return back()->with('success','Make not found');
    }

    // Check if SEO content already exists for this make
    $existing = SeoContentMake::where('make_id', $id)->first();
    if ($existing) {
        return "SEO content already exists for this make";
    }

    $client = OpenAI::client(config('services.openai.key'));

    $response = $client->chat()->create([
        'model' => 'gpt-4o-mini',
        'messages' => [
            [
                'role' => 'user',
                'content' => "Write SEO-optimized content for an auto spare parts website.

                        Brand: {$brand}
                        Target Country: UAE
                        Content Placement: Bottom of brand/category page
                        Search Intent: Commercial + Informational

                        Content Requirements:
                        - Total length around 500 words
                        - Clear, professional, SEO-focused tone
                        - No hype, no storytelling fluff
                        - No competitor mentions
                        - No call-to-action buttons
                        - Plain text only

                        CONTENT STRUCTURE:

                        1. Buy Quality Used Spare Parts for {$brand}
                        Write an engaging but factual introduction focused on:
                        - Buying second-hand / used spare parts
                        - Affordability and availability in UAE
                        - Compatibility and reliability
                        Naturally include keywords like:
                        used {$brand} spare parts, {$brand} parts for sale in UAE, second hand auto parts UAE

                        2. Overview of {$brand}
                        Provide a short brand background:
                        - Brand origin and history
                        - Reputation for reliability and performance
                        - Why {$brand} vehicles are popular in the UAE
                        Keep it factual and concise.

                        3. Common {$brand} Spare Parts Available
                        Explain commonly replaced auto parts such as:
                        - Engine parts
                        - Gearbox / transmission
                        - Suspension components
                        - Electrical and body parts
                        Use bullet points if helpful.
                        Keep it generic and scalable.

                        4. What to Do If {$brand} Parts Fail
                        Explain:
                        - Why parts fail over time
                        - Importance of replacing faulty parts promptly
                        - Why used spare parts are a cost-effective option

                        5. How to Identify a Faulty {$brand} Part
                        Describe:
                        - Dashboard warning signs
                        - Performance issues
                        - Basic diagnosis awareness (no technical depth)

                        6. How Replacement Works
                        Explain the replacement process in a simple way:
                        - Finding the correct part
                        - Ensuring fitment
                        - Installation through garages or workshops
                        Avoid promotional language.

                        SEO ADD-ON SECTIONS:

                        7. Targeted Keywords
                        Provide a short list of 8–12 SEO keywords relevant to this brand and UAE market.

                        8. Common Buyer Questions
                        List 5–6 common user questions such as:
                        - Are used {$brand} spare parts reliable?
                        - How long do second-hand auto parts last?
                        - Can I find genuine used {$brand} parts in UAE?
                        - Are used spare parts compatible with all {$brand} models?

                        SEO RULES:
                        - Naturally include primary keyword in first 100 words and conclusion
                        - No keyword stuffing
                        - Short paragraphs
                        - Skimmable layout
                        - Written for SEO and user clarity

                        Output only the content. Do not explain the steps.
"
            ]
        ],
    ]);

    SeoContentMake::updateOrCreate(
        ['make_id' => $make->id],
        ['seo_content_make' => $response->choices[0]->message->content]
    );

    return back()->with('success','SEO content generated successfully for {$make->name}');
}




public function generateSeoPart($id)
{
    $part = SpareParts::find($id);

    if (!$part) {
        return back()->with('error','make not found');
    }

    // Check if SEO content already exists for this make
    $existing = SeoContentMake::where('make_id', $id)->first();
    if ($existing) {
        return   back()->with('error','SEO content already exists for this make');
    }

    $client = OpenAI::client(config('services.openai.key'));

    $response = $client->chat()->create([
        'model' => 'gpt-4o-mini',
        'messages' => [
            [
                'role' => 'user',
                'content' => "Write SEO-optimized content for an auto parts website.

Brand: {$part->name}

Purpose:
This content will be placed at the bottom of a category or {$part->name} page to improve SEO and topical relevance.

Target Audience:
Users searching to buy or research auto parts related to this {$part->name}.

Content Structure:
1. About the {$part->name}
   - Brief, factual overview
   - Focus on reliability, compatibility, and {$part->name} relevance in the auto parts industry

2. Common Parts Available
   - Mention commonly searched and purchased parts
   - Keep it generic and adaptable (no model-specific claims unless obvious)
   - Use bullet points where appropriate

3. Why Buy From Us
   - Emphasize product quality, fitment accuracy, availability, and customer trust
   - No exaggerated marketing or promotional language

SEO Requirements:
- 450–500 words total
- Clear, professional, and informative tone
- Naturally optimized for search engines
- Avoid keyword stuffing
- No competitor mentions
- No storytelling or fluff
- No calls to action like “Buy Now” or “Order Today”
- please give me the data in <h1> and <p> form ok 
Formatting:
- Plain text
- Short paragraphs
- No emojis
- No markdown"
            ]
        ],
    ]);

    SparePartSeo::updateOrCreate(
        ['make_id' => $part->id],
        ['seo_content_make' => $response->choices[0]->message->content]
    );

    return   back()->with('success',"SEO content generated successfully for {$part->name}");         
}










 function generateSeoSuccess(){
    return view('adminPanel.seo_success');
 }
}