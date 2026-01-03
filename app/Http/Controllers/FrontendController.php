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
use App\Models\CityContent;
use App\Models\SparePartSeo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Shops;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\InquiryService;
use App\Jobs\GenerateSeoContentJob;
use function Ramsey\Uuid\v1;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
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
    
    $currentDomain = Domain::where('domain_url', $host)->first();
 
    $domain_id  = $currentDomain?->id;
    $domain_map = $currentDomain?->map_img ?? 'logo/1759938974_map.webp';
        $carMakesPage = $request->input('makes_page', 1);
    $sPartsPage = $request->input('parts_page', 1);
    $adsPage = $request->input('ads_page', 1);
    // ===== NORMAL DATA (NO CACHE) =====
    $getFAQS = Faq::where('domain_id', $domain_id)->get();
 $carMakes = CarMakes::whereNotNull('logo')
        ->whereHas('seoContent')
        ->paginate(52, ['*'], 'makes_page', $carMakesPage);
    $domain = $currentDomain;
    $models = CarModels::all();
    $makes = CarMakes::all();
    $years = Years::orderBy('year', 'desc')->get();
    $parts = SpareParts::all();
    $carAds = CarAds::where('is_approved', true)->latest()->get();
    $randomParts = SpareParts::withCount('ads')->orderBy('ads_count', 'desc')->take(5)->get();
    $randomMakes = CarMakes::limit(8)->get();
    $sParts = SpareParts::with('seo')
        ->whereNotNull('image')
        ->paginate(60, ['*'], 'parts_page', $sPartsPage);

    $cities = City::where('domain_id',$domain_id)->get();
   
 $ads = Ads::withoutGlobalScopes()
    ->where('is_approved', true)
    ->where('domain', $host)
    ->latest() // created_at DESC
    ->paginate(8, ['*'], 'ads_page', $adsPage);

    $meta['title']="Auto Spare Parts in UAE | Used, New & Aftermarket Car Parts – PartsFinder";
    $meta['description']=" Find used, new, and aftermarket auto spare parts in UAE. Compare prices from trusted sellers across Dubai, Sharjah, Abu Dhabi, and more with PartsFinder";
  $meta['structure_data'] = <<<JSON
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "https://{$host}/#organization",
      "name": "PartsFinder UAE",
      "url": "https://{$host}/",
      "logo": {
        "@type": "ImageObject",
        "url": "https://{$host}/storage/logo/1766031053.webp"
      },
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+971502566002",
        "contactType": "customer service",
        "areaServed": "AE",
        "availableLanguage": ["English", "Arabic"]
      },
      "sameAs": [
   "https://www.facebook.com/partsfinderuae/",
        "https://medium.com/@partsfinder",
        "https://www.pinterest.com/partsfinderae/",
        "https://www.reddit.com/user/Aggressive_Sea4965/",
"https://www.linkedin.com/in/parts-finder-uae/",
"https://x.com/partsfinderae1"

      ]
    },
    {
      "@type": "AutomotiveBusiness",
      "@id": "https://{$host}/#localbusiness",
      "name": "PartsFinder UAE",
      "url": "https://{$host}/",
      "logo": "https://{$host}/storage/logo/1766031053.webp",
      "telephone": "+971502566002",
      "priceRange": "$$",
      "areaServed": {
        "@type": "Country",
        "name": "United Arab Emirates"
      },
      "address": {
        "@type": "PostalAddress",
        "addressCountry": "AE"
      },
      "sameAs": [
    "https://www.facebook.com/partsfinderuae/",
        "https://medium.com/@partsfinder",
        "https://www.pinterest.com/partsfinderae/",
        "https://www.reddit.com/user/Aggressive_Sea4965/",
"https://www.linkedin.com/in/parts-finder-uae/",
"https://x.com/partsfinderae1"

      ],
      "parentOrganization": {
        "@id": "https://{$host}/#organization"
      }
    },
    {
      "@type": "WebSite",
      "@id": "https://{$host}/#website",
      "url": "https://{$host}/",
      "name": "PartsFinder UAE",
      "publisher": {
        "@id": "https://{$host}/#organization"
      },
      "inLanguage": "en"
    },
    {
      "@type": "WebPage",
      "@id": "https://{$host}/#webpage",
      "url": "https://{$host}/",
      "name": "PartsFinder UAE – Auto Spare Parts Sourcing Platform",
      "description": "PartsFinder UAE helps drivers and workshops source auto spare parts from verified sellers across all UAE emirates.",
      "publisher": {
        "@id": "https://{$host}/#organization"
      },
      "isPartOf": {
        "@id": "https://{$host}/#website"
      },
      "inLanguage": "en"
    },
    {
      "@type": "FAQPage",
      "@id": "https://{$host}/#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How does PartsFinder help me locate car spare parts?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "PartsFinder connects you with multiple UAE-based spare parts suppliers through a single request, allowing you to compare availability, pricing, and delivery options."
          }
        },
        {
          "@type": "Question",
          "name": "Is there any cost to submit a spare parts request?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "No, submitting a spare parts request on PartsFinder is completely free. You only pay if you decide to buy from a seller."
          }
        },
        {
          "@type": "Question",
          "name": "Which vehicle components can I source through your platform?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "You can source mechanical, electrical, interior, exterior, and performance-related auto parts, depending on seller availability."
          }
        },
        {
          "@type": "Question",
          "name": "Can I compare offers before making a decision?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, you may receive multiple offers from different sellers, helping you compare prices, conditions, and warranty options."
          }
        },
        {
          "@type": "Question",
          "name": "Does PartsFinder operate as an online auto parts store?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "No, PartsFinder is a sourcing platform that connects buyers with independent spare parts sellers across the UAE."
          }
        },
        {
          "@type": "Question",
          "name": "Will sellers contact me directly after I submit a request?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, sellers may contact you directly using the details you provide, solely to respond to your parts request."
          }
        },
        {
          "@type": "Question",
          "name": "Are genuine and OEM parts available?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, sellers may offer genuine, OEM, or aftermarket parts so you can choose according to your requirements and budget."
          }
        },
        {
          "@type": "Question",
          "name": "Can I request parts for older or imported vehicles?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, PartsFinder supports requests for older, imported, and rare vehicle models, subject to seller inventory."
          }
        },
        {
          "@type": "Question",
          "name": "How quickly can I receive responses from sellers?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Many users receive responses within hours, depending on the part type and vehicle details."
          }
        },
        {
          "@type": "Question",
          "name": "Is PartsFinder available across the UAE?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, PartsFinder supports spare parts sourcing across all UAE emirates, including major cities and surrounding areas."
          }
        },
        {
          "@type": "Question",
          "name": "Do I have to commit to a purchase after submitting a request?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "No, there is no obligation to purchase. You remain in full control of whether or not to proceed with any offer."
          }
        }
      ]
    }
  ]
}
JSON;
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
        'ads',
        'meta'
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
       $domain = $request->getHost();   // live domain get karega
       $domain = preg_replace('/^www\./', '', $domain); // www remove
      
        $buyer = Buyers::create([
            'country_code' => $request->country_code,
            'whatsapp' => $request->whatsapp,
            'domain'       => $domain,
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
           $sPartsPage = $request->input('parts_page', 1);
    $carMakesPage = $request->input('makes_page', 1);
    $adsPage = $request->input('ads_page', 1);
    $sParts = SpareParts::with('seo')
        ->whereNotNull('image')  
        ->paginate(60, ['*'], 'parts_page', $sPartsPage);
         $carMakes = CarMakes::paginate(48, ['*'], 'makes_page', $carMakesPage);
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
      
        $models = CarModels::all();
        $makes = CarMakes::all();
        $years = Years::orderBy('year', 'desc')->get();
        $parts = SpareParts::all();
        $randomParts = SpareParts::withCount('ads')
            ->orderBy('ads_count', 'desc')
            ->take(5)
            ->get();
               $host = $request->getHost();
    $currentDomain = Domain::where('domain_url', $host)->first();
    $domain_id = $currentDomain?->id;
        $cities = City::where('domain_id',$domain_id)->get();
        
        return view('Frontend.PartSearch', compact(
            'part',
            'meta',
            
            'makes',
            'models',
            'years',
            'parts',
            'ads',
            'randomParts',
            'cities',
            'getFAQS',
            'meta',
            'content',
            'sParts',
            'carMakes'
        ));
    }

    public function adByMakes(Request $request , $slug, $id)
    {
         $sPartsPage = $request->input('parts_page', 1);
    $adsPage = $request->input('ads_page', 1);
    $carMakesPage = $request->input('makes_page', 1);
        $make = CarMakes::where('id', $id)->where('slug', $slug)->firstOrFail();
        $seoTitle_t = SeoTitle::find($make->tamp_title_id);
        $meta['title'] = $seoTitle_t 
            ? str_replace('{brand}', $make->name, $seoTitle_t->tittle) 
            : null;

        $seoTemplate_d = SeoTamplate::find($make->tamp_id);
        $meta['description'] = $seoTemplate_d 
            ? str_replace('{brand}', $make->name, $seoTemplate_d->description) 
            : null;
      
   $sParts = SpareParts::with('seo')
        ->whereNotNull('image')  
        ->paginate(60, ['*'], 'parts_page', $sPartsPage);
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
               $host = $request->getHost();
    $currentDomain = Domain::where('domain_url', $host)->first();
    $domain_id = $currentDomain?->id; 
              
        $getFAQS=Faq::where('domain_id',$domain_id)->get();
    $carMakes = CarMakes::whereNotNull('logo')
        ->whereHas('seoContent')
        ->paginate(52, ['*'], 'makes_page', $carMakesPage);

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
         
        $cities =City::where('domain_id',$domain_id)->get();;
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
            
            'getFAQS',
            'meta',
            'Content',
            'sParts'
        ));
    }

    public function adByCity(Request $request , $slug, $id)
    {
              $host = preg_replace('/^www\./', '', $request->getHost());
    
    $currentDomain = Domain::where('domain_url', $host)->first();
 
    $country  = $currentDomain->name;
         $sPartsPage = $request->input('parts_page', 1);
    $carMakesPage = $request->input('makes_page', 1);
    $adsPage = $request->input('ads_page', 1);
        $city = City::where('id', $id)->where('slug', $slug)->firstOrFail();
         $sParts = SpareParts::with('seo')
        ->whereNotNull('image')
        ->paginate(60, ['*'], 'parts_page', $sPartsPage);
     $seoTitle_t = SeoTitle::find($city->tamp_title_id);

            $meta['title'] = $seoTitle_t
                ? str_replace(
                    ['{City}', '{Country}'],
                    [$city->name, $country],
                    $seoTitle_t->tittle
                )
                : null;

            $seoTemplate_d = SeoTamplate::find($city->tamp_id);

            $meta['description'] = $seoTemplate_d
                ? str_replace(
                    ['{City}', '{Country}'],
                    [$city->name, $country],
                    $seoTemplate_d->description
                )
                : null;
      $meta['structure_data'] = <<<JSON
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebPage",
      "@id": "https://$host/{$city->slug}/#webpage",
      "url": "https://$host/cities/show/ads/{$city->slug}/{$city->id}",
      "name": "Auto Spare Parts in {$city->name}, {$country} | PartsFinder",
      "description": "{$meta['description']}",
      "isPartOf": {
        "@type": "WebSite",
        "@id": "$host/#website"
      }
    },
    {
      "@type": "Service",
      "@id": "https://$host/{$city->slug}/#service",
      "name": "Auto Spare Parts in {$city->name}",
      "description": "Platform for finding used, genuine, and aftermarket auto spare parts in {$city->name}, {$country}.",
      "provider": {
        "@type": "Organization",
        "@id": "https://$host/#organization"
      },
      "areaServed": {
        "@type": "City",
        "name": "{$city->name}",
        "containedInPlace": {
          "@type": "Country",
          "name": "{$country}"
        }
      }
    },
    {
      "@type": "Place",
      "@id": "https://$host/{$city->slug}/#place",
      "name": "{$city->name}",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "{$city->name}",
        "addressCountry": "{$country}"
      }
    },
    {
      "@type": "CollectionPage",
      "name": "{$city->name}",
      "image": "https://$host/storage/{$city->logo}",
      "description": "{$meta['description']}",
      "brand": {
        "@type": "Brand",
        "name": "{$city->name}"
      },
      "offers": {
        "@type": "Offer",
        "url": "https://$host/cities/show/ads/{$city->name}/{$city->id}",
        "priceCurrency": "AED",
        "price": "On Demand",
        "availability": "https://schema.org/InStock"
      }
    }
  ]
}
JSON;

    $ads = Ads::whereHas('shop.supplier', function ($query) use ($city) {
            $query->where('city_id', $city->id)
                  ->where('is_approved', true);
        })
        ->latest()
        ->paginate(8, ['*'], 'ads_page', $adsPage);
    $host = $request->getHost();
    $currentDomain = Domain::where('domain_url', $host)->first();
    $domain_id = $currentDomain?->id;
        $getFAQS=Faq::where('domain_id',$domain_id)->get();
        $carAds = CarAds::whereHas('shop.supplier', function ($query) use ($city) {
            $query->where('city_id', $city->id)
                ->where('is_approved', true)
            ;
        })->latest()->get();
    
          $carMakes = CarMakes::whereNotNull('logo')
        ->whereHas('seoContent')
        ->paginate(52, ['*'], 'makes_page', $carMakesPage);
        $models = CarModels::all();
        $makes = CarMakes::all();
        $years = Years::orderBy('year', 'desc')->get();
        $parts = SpareParts::all();

        $randomParts = SpareParts::withCount('ads')
            ->orderBy('ads_count', 'desc')
            ->take(5)
            ->get();
           
        $cities = City::where('domain_id',$domain_id)->get();
        $randomMakes = CarMakes::limit(8)->get();
        $ContentOther=CityContent::where('city_id',$id)->first();
       $Content = str_replace(
            'partsfinder.ae', // text to replace
            $host,            // replacement variable
            $ContentOther->content // original content
        );
    
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
            'getFAQS',
            'sParts',
            'Content',
            'meta'
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
    $host = str_replace('www.', '', $request->getHost());

    $currentDomain = Domain::where('domain_url', $host)->first();

    $domain_id = $currentDomain?->id;

    $blogs = Blogs::where('domain_id', $domain_id)->latest()->get();
    $categories = BlogCategory::all();

    return view('Frontend.blogs.index', compact(
        'blogs',
        'currentDomain',
        'categories'
    ));
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
   $keys = [
        env('OPENAI_KEY1'),
        env('OPENAI_KEY2'),
        env('OPENAI_KEY3'),
        env('OPENAI_KEY4'),
        env('OPENAI_KEY5')
    ];
      $key = $keys[array_rand($keys)];
     $client = OpenAI::client($key);

    $response = $client->chat()->create([
        'model' => 'gpt-4o-mini',
        'messages' => [
            [
                'role' => 'user',
                'content' => "
  Write SEO-optimized content for an auto spare parts brand page on partsfinder.ae.
Variable
Brand: {$brand}


Content Placement
 Bottom section of a brand or category page
Search Intent
 Commercial + Informational
Writing Guidelines
Length: 450–550 words


Tone: Professional and informative


Language: Very simple English, written for non-native speakers


Style: Natural and human-like, must not sound AI-generated, do not use tough and bad words, make it simple. 


No hype, no promotional or sales language


No competitor names or comparisons


No call-to-action buttons


Output must be plain text only


Use short paragraphs and clear headings


Do not follow a fixed or repeated structure


Headings should vary naturally based on the brand and topic flow


Use proper HTML tags with spacing:


Headings: <h2>


Paragraphs: <p>


SEO & Formatting Rules
Use the phrase “used  {$brand} spare parts” naturally within the first 100 words


Include related keywords organically:


auto spare parts in UAE


used spare parts in UAE


genuine and aftermarket spare parts in UAE


Avoid keyword stuffing


Keep content helpful, practical, and easy to read


Highlight main keywords and the site name using <strong> tags inside paragraphs


Include the site name partsfinder.ae in every output in bold <strong> wordings.


Do not change keyword wording or intent


Content Focus Areas
Used and second-hand  {$brand} auto spare parts


Availability and affordability in the UAE


{brand} reliability and market presence


Common replacement parts for  {$brand} vehicles


Ownership and maintenance considerations


Practical guidance for buyers and vehicle owners


Headings and structure may be shuffled or adjusted naturally


Output Rules
Output only the final content


Do not explain the process


Do not add notes, comments, or formatting explanations






"
            ]
        ],
    ]);

    SeoContentMake::updateOrCreate(
        ['make_id' => $make->id],
        ['seo_content_make' => $response->choices[0]->message->content]
    );

    return back()->with('success', "SEO content generated successfully for {$make->name}");

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
   $keys = [
        env('OPENAI_KEY1'),
        env('OPENAI_KEY2'),
        env('OPENAI_KEY3'),
        env('OPENAI_KEY4'),
        env('OPENAI_KEY5')
    ];
      $key = $keys[array_rand($keys)];
     $client = OpenAI::client($key);
    $brand=$part->name;
    $response = $client->chat()->create([
        'model' => 'gpt-4o-mini',
        'messages' => [
            [
                'role' => 'user',
                'content' => "
   Write SEO-optimized content for an auto spare parts brand page on partsfinder.ae.
Variable
Brand: {$brand}


Content Placement
 Bottom section of a brand or category page
Search Intent
 Commercial + Informational
Writing Guidelines
Length: 450–550 words


Tone: Professional and informative


Language: Very simple English, written for non-native speakers


Style: Natural and human-like, must not sound AI-generated, do not use tough and bad words, make it simple. 


No hype, no promotional or sales language


No competitor names or comparisons


No call-to-action buttons


Output must be plain text only


Use short paragraphs and clear headings


Do not follow a fixed or repeated structure


Headings should vary naturally based on the brand and topic flow


Use proper HTML tags with spacing:


Headings: <h2>


Paragraphs: <p>


SEO & Formatting Rules
Use the phrase “used  {$brand} spare parts” naturally within the first 100 words


Include related keywords organically:


auto spare parts in UAE


used spare parts in UAE


genuine and aftermarket spare parts in UAE


Avoid keyword stuffing


Keep content helpful, practical, and easy to read


Highlight main keywords and the site name using <strong> tags inside paragraphs


Include the site name partsfinder.ae in every output in bold <strong> wordings.


Do not change keyword wording or intent


Content Focus Areas
Used and second-hand  {$brand} auto spare parts


Availability and affordability in the UAE


{brand} reliability and market presence


Common replacement parts for  {$brand} vehicles


Ownership and maintenance considerations


Practical guidance for buyers and vehicle owners


Headings and structure may be shuffled or adjusted naturally


Output Rules
Output only the final content


Do not explain the process


Do not add notes, comments, or formatting explanations





                        "
            ]
        ],
    ]);

    SparePartSeo::updateOrCreate(
        ['part_id' => $part->id],
        ['content' => $response->choices[0]->message->content]
    );

    return back()->with('success', "SEO content generated successfully for {$part->name}");
      
}










 function generateSeoSuccess(){
    return view('adminPanel.seo_success');
 }







 public function getModels($make_id)
{
    $models=CarModels::where('car_make_id', $make_id)->get();
 
    return response()->json($models);
}

      function United_analytic($domain){
          
           $thisdomain=$domain;
        $todayData = Buyers::where('domain', $domain)
                ->whereDate('created_at', Carbon::today())
                ->count();

            // ===== Yesterday =====
            $yesterdayData = Buyers::where('domain', $domain)
                ->whereDate('created_at', Carbon::yesterday())
                ->count();

            // ===== Last 7 Days =====
            $lastWeekData = Buyers::where('domain', $domain)
                ->whereDate('created_at', '>=', Carbon::today()->subDays(6))
                ->count();
    $previousWeekData = Buyers::where('domain', $domain)
            ->whereDate('created_at', '>=', Carbon::today()->subDays(13))
            ->whereDate('created_at', '<=', Carbon::today()->subDays(7))
            ->count();
            // ===== Last 3 Months =====
            $last3MonthsData = Buyers::where('domain', $domain)
                ->whereDate('created_at', '>=', Carbon::today()->subMonths(3))
                ->count();
           if ($previousWeekData == 0) {
        $percentDifferenceWeek = $lastWeekData > 0 ? 100 : 0;
    } else {
        $percentDifferenceWeek = round((($lastWeekData - $previousWeekData) / $previousWeekData) * 100, 1);
    }
       
       
       // ===== Percentage Difference Today vs Yesterday =====
if ($yesterdayData == 0) {
    $percentDifferencetoday = $todayData > 0 ? 100 : 0;
} else {
    $percentDifferencetoday = round((($todayData - $yesterdayData) / $yesterdayData) * 100, 1);
}
        return view('Analytics.united',compact('todayData','yesterdayData','last3MonthsData','lastWeekData','percentDifferencetoday','percentDifferenceWeek','thisdomain'));
      }


public function getQueriesData(Request $request, $domain)
{
    $range = $request->input('range', '3m');

    $labels = [];
    $data = [];

    if ($range == '7d') {
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->format('d M');
            $data[] = Buyers::where('domain', $domain)
                            ->whereDate('created_at', $date)
                            ->count();
        }
    } elseif ($range == '30d') {
        for ($i = 4; $i >= 0; $i--) {
            $start = Carbon::today()->subWeeks($i)->startOfWeek();
            $end = Carbon::today()->subWeeks($i)->endOfWeek();
            $labels[] = $start->format('d M') . ' - ' . $end->format('d M');
            $data[] = Buyers::where('domain', $domain)
                            ->whereBetween('created_at', [$start, $end])
                            ->count();
        }
    } else {
        $monthsCount = 3;
        if ($range == '6m') $monthsCount = 6;
        if ($range == '1y') $monthsCount = 12;

        for ($i = $monthsCount - 1; $i >= 0; $i--) {
            $month = Carbon::today()->subMonths($i);
            $labels[] = $month->format('M Y');
            $data[] = Buyers::where('domain', $domain)
                            ->whereMonth('created_at', $month->month)
                            ->whereYear('created_at', $month->year)
                            ->count();
        }
    }

    return response()->json([
        'labels' => $labels,
        'data' => $data,
    ]);
}
 
  function create_seo__city(Request $request, $id){
      $host = preg_replace('/^www\./', '', $request->getHost());
    
    $currentDomain = Domain::where('domain_url', $host)->first();
      $city=City::find($id);
      
      $country=$currentDomain->name;
    if (!$city) {
        return back()->with('error','make not found');
    }

  
   $keys = [
        env('OPENAI_KEY1'),
        env('OPENAI_KEY2'),
        env('OPENAI_KEY3'),
        env('OPENAI_KEY4'),
        env('OPENAI_KEY5')
    ];
      $key = $keys[array_rand($keys)];
     $client = OpenAI::client($key);
    $brand=$city;
    $response = $client->chat()->create([
        'model' => 'gpt-4o-mini',
        'messages' => [
            [
                'role' => 'user',
                'content' => "
Write SEO-optimized content for an auto spare parts city page on partsfinder.ae.

City: {$city}
Target Country: {$country}
Content Placement: Bottom of brand/category page
Search Intent: Commercial + Informational

Guidelines:
- Around 450–550 words
- Professional, informative tone
- No hype or sales language
- No competitor mentions
- No call-to-action buttons
- Plain text output
- Use clear headings and short paragraphs
- Headings should vary naturally based on the brand
- Do not follow a fixed outline or repeated structure
- Assign proper Headings 2 <h2> and paragraph <p> tags accordingly with spaces on them.
- Put my main keywords and site name in <strong> tag inside <p>
- Also add site name partsfinder.ae in every output. 
- Also use the city name in headings
- Write it clear and easy language, do not make it sound like ai generated content. Use really simple english wordings as you are writing for non-english people.
- Use the city name in multiple headings
- Naturally include “{$city} near me” and “auto spare parts near me in {$city}” in both headings and paragraph content




Content Focus:
- Used and second-hand auto spare parts
- Availability and affordability in {$country}
- Brand reliability and market presence
- Common replacement parts and ownership considerations
- Practical guidance for buyers and vehicle owners
- The upper structure is not always final. Also, you can shuffle and change headings from your side.

SEO Rules:
- Naturally include “used {$city} spare parts” within the first 100 words
- Use related keywords organically (auto spare parts in {$country}, used spare parts in {$country}, genuine and aftermarket spare parts in {$country})
- No keyword stuffing
- Keep content helpful and readable

Output only the final content.
Do not explain the process.


                        "
            ]
        ],
    ]); 
    CityContent::updateOrCreate(
        ['city_id' => $city->id],
        ['content' => $response->choices[0]->message->content]
    );
     return back()->with('success', "SEO content generated successfully for {$city->name}");
      
      
  }


  function Content_information(){
     return view('SupplierMessage');
  }
  function images_resiz(){
    return view('imagesresizePage');
  }
public function images_resiz_post(Request $request)
{
    $request->validate([
        'image_url' => 'required|url'
    ]);

    $url = $request->input('image_url');

    try {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $imageContent = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if(curl_errno($ch)) {
            return back()->with('error', 'Curl error: ' . curl_error($ch));
        }
        curl_close($ch);

        if(!$imageContent || $httpStatus != 200) {
            return back()->with('error', 'Unable to fetch image from URL. HTTP status: '.$httpStatus);
        }

        $img = \Intervention\Image\Facades\Image::make($imageContent);

        $img->resize(800, 800, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $fileName = 'resized_' . time() . '.webp';
        $path = 'public/resized_images/' . $fileName;

        $saved = \Illuminate\Support\Facades\Storage::put($path, $img->encode('webp', 85));

        if(!$saved){
            return back()->with('error', 'Failed to save image. Check storage permissions.');
        }

        $urlPath = \Illuminate\Support\Facades\Storage::url($path);

        return back()->with('success', 'Image resized successfully! <a href="'.$urlPath.'" target="_blank">View Here</a>');

    } catch (\Exception $e) {
        return back()->with('error', 'Exception: '.$e->getMessage());
    }
}


}