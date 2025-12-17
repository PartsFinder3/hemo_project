<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CarMakeController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarVariantController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyDataController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\EngineController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PartCategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScriptController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopProfile;
use App\Http\Controllers\ShopProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\SparePartsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SupplierSettingController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\FAsController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\MSubscription;
// use Illuminate\Support\Facades\Artisan;
// use Illuminate\Support\Facades\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('/adminPanel.index');
// });

// Route::get('/', function () {
//     return view('adminPanel.index');
// });

// <----------------------------- Admin Auth ----------------------------->

Route::get('/admin/login', [AuthController::class, 'adminLoginPage'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLoginPost'])->name('admin.login.post');

Route::middleware(['auth:admins'])->group(function () {
//<---------------------- Admin Dashboard ------------------------------>
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/ads', [AdminController::class, 'showAds'])->name('admin.ads');
Route::get('/admin/car-ads', [AdminController::class, 'showCarAds'])->name('admin.carAds');
Route::post('/admin/ads/approve/{id}', [AdminController::class, 'approveAd'])->name('admin.ads.approve');
Route::post('/admin/car-ads/approve/{id}', [AdminController::class, 'approveCarAd'])->name('admin.carAds.approve');
Route::get('/admin/admins', [AdminController::class, 'viewAdmins'])->name('admin.admins');
Route::post('/admin/admins/add', [AdminController::class, 'addAdmin'])->name('admin.admins.add');
Route::get('/admin/admins/edit/{id}', [AdminController::class, 'editAdmin'])->name('admin.admins.edit');
Route::post('/admin/admins/edit/{id}', [AdminController::class, 'updateAdmin'])->name('admin.admins.update');
Route::post('/admin/admins/delete/{id}', [AdminController::class, 'deleteAdmin'])->name('admin.admins.delete');
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');


// <----------------------------- DomainController ------------------------>
Route::get('/domain', [DomainController::class, 'index'])->name('domain.show');
Route::post('domain/create', [DomainController::class, 'create'])->name('domain.create');
Route::get('domain/delete/{id}', [DomainController::class, 'delete'])->name('domain.delete');
Route::get('domain/edit/{id}', [DomainController::class, 'update'])->name('domain.update');
Route::post('domain/edit/{id}', [DomainController::class, 'edit'])->name('domain.edit');
// <----------------------------- FAQS ------------------------>

Route::get('add/Faqs/{id}', [FAsController::class, 'data'])->name('addFAQs.faqs');
Route::prefix('admin')->group(function () {

Route::post('/faqs', [FAsController::class, 'store_faqs'])->name('faqs.store_faqs'); // Add via AJAX
Route::delete('/faq/{id}', [FAsController::class, 'destroy_fas'])->name('faq.delete');

Route::get('/admin/faqs/{id}/edit', [FAsController::class, 'edit_faqs'])->name('faqs.edit');
Route::post('/faqs/{id}', [FAsController::class, 'update_faqs'])->name('faqs.update');
});

// <--------------------------- CityController --------------------------->
Route::get('/city', [CityController::class, 'index'])->name('city.show');
Route::post('city/create', [CityController::class, 'create'])->name('city.create');
Route::get('city/delete/{id}', [CityController::class, 'delete'])->name('city.delete');
Route::get('city/status/change/{id}', [CityController::class, 'activetoogle'])->name('city.active');

//<------------------------- CarMakes -------------------------------->
Route::get('/makes', [CarMakeController::class, 'index'])->name('makes.show');
Route::post('makes/create', [CarMakeController::class, 'create'])->name('makes.create');
Route::get('makes/delete/{id}', [CarMakeController::class, 'delete'])->name('makes.delete');
Route::get('makes/edit/{id}', [CarMakeController::class, 'update'])->name('makes.update');
Route::post('makes/edit/{id}', [CarMakeController::class, 'edit'])->name('makes.edit');

// <----------------------- Years --------------------------------------->
Route::get('/years', [YearController::class, 'index'])->name('years.show');
Route::post('years/create', [YearController::class, 'create'])->name('years.create');
Route::get('years/delete/{id}', [YearController::class, 'delete'])->name('years.delete');
Route::get('/years/search', [YearController::class, 'search'])->name('years.search');
//<---------------------------- Fuel ---------------------------------->
Route::get('/fuel', [FuelController::class, 'index'])->name('fuel.show');
Route::post('fuel/create', [FuelController::class, 'create'])->name('fuel.create');
Route::get('fuel/delete/{id}', [FuelController::class, 'delete'])->name('fuel.delete');

//<---------------------------- EngineSize ------------------------->
Route::get('/engine', [EngineController::class, 'index'])->name('engine.show');
Route::get('/engine-sizes/search', [EngineController::class, 'search'])->name('engine.search');
Route::post('/engine/create', [EngineController::class, 'create'])->name('engine.create');
Route::get('engine/delete/{id}', [EngineController::class, 'delete'])->name('engine.delete');


//<----------------------------- CarModels ------------------------->
Route::get('/car-models', [CarModelController::class, 'index'])->name('model.show');
Route::post('/car-models/create', [CarModelController::class, 'create'])->name('model.create');
Route::get('/car-models/delete/{id}', [CarModelController::class, 'delete'])->name('model.delete');
Route::get('car-models/edit/{id}', [CarModelController::class, 'edit'])->name('model.edit');
Route::post('/car-models/edit/{id}', [CarModelController::class, 'update'])->name('model.update');


//<----------------------------- CarVarients ------------------------->
Route::get('/varients/{id}', [CarVariantController::class, 'index'])->name('varient.show');
Route::get('/varients/create/{id}', [CarVariantController::class, 'showCreatePage'])->name('varient.store');
Route::post('/varients/create/{id}', [CarVariantController::class, 'create'])->name('varient.create');
Route::get('/variants/{id}/edit', [CarVariantController::class, 'edit'])->name('varient.edit');
Route::post('/variants/{id}/update', [CarVariantController::class, 'update'])->name('varient.update');
Route::get('/varient/{id}', [CarVariantController::class, 'delete'])->name('varient.delete');

//<-------------------------------- Category-Spare-Parts ----------------------->
Route::get('/parts-category', [PartCategoryController::class, 'index'])->name('category.show');
Route::post('/part-category/create', [PartCategoryController::class, 'create'])->name('category.create');
Route::get('/part-category/{id}', [PartCategoryController::class, 'delete'])->name('category.delete');
Route::get('/categories/search', [PartCategoryController::class, 'search'])->name('category.search');
//<-------------------------------- Spare-Parts----------------------------->
Route::prefix('spare-parts')->group(function () {
    Route::get('/', [SparePartsController::class, 'index'])->name('spareparts.show');
    Route::post('/store', [SparePartsController::class, 'store'])->name('spareparts.store');
    Route::get('/edit/{id}', [SparePartsController::class, 'edit'])->name('spareparts.edit');
    Route::post('/update/{id}', [SparePartsController::class, 'update'])->name('spareparts.update');
    Route::get('/delete/{id}', [SparePartsController::class, 'destroy'])->name('spareparts.destroy');
});

//<------------------------------ Blogs ------------------------------------->
Route::get('/admin/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/admin/blogs/category', [BlogController::class, 'showCategory'])->name('blogs.category');
Route::post('/admin/blogs/category/create', [BlogController::class, 'createCategory'])->name('blog.category.create');
Route::get('/admin/blogs/category/delete/{id}', [BlogController::class, 'deleteCategory'])->name('blog.category.delete');
Route::get('/admin/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/admin/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/admin/blogs/edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');
Route::post('/admin/blogs/update/{id}', [BlogController::class, 'update'])->name('blogs.update');
Route::get('/admin/blogs/delete/{id}', [BlogController::class, 'destroy'])->name('blogs.delete');
Route::get('/admin/blogs/show/{id}', [BlogController::class, 'show'])->name('blogs.show');


//<--------------------------------- Supplier --------------------------------->
Route::get('/supplier-signup', [SupplierController::class, 'requestPage'])->name('supplier.signup');
Route::get('/supplier-requests', [SupplierController::class, 'showRequests'])->name('supplier.requests');
Route::post('/supplier-requests/approve/{id}', [SupplierController::class, 'acceptRequest'])->name('supplier.approve');
Route::get('/supplier-requests/reject/{id}', [SupplierController::class, 'rejectRequest'])->name('supplier.reject');
Route::get('/suppliers', [SupplierController::class, 'showSuppliers'])->name('suppliers.show');
Route::post('/suppliers/search', [SupplierController::class, 'showSupplierssearch'])->name('suppliers.search');
Route::get('/suppliers/active-toggle/{id}', [SupplierController::class, 'activeSupplierToggle'])->name('suppliers.active.toggle');
Route::get('/suppliers/verified-toggle/{id}', [SupplierController::class, 'verifiedSupplier'])->name('suppliers.verified.toggle');

Route::get('/suppliers/profile/edit/{id}', [SupplierSettingController::class, 'editProfile'])->name('supplier.profile.edit');
Route::post('/suppliers/password/update/{id}', [SupplierSettingController::class, 'updatePassword'])->name('supplier.password.update.post');
Route::post('/suppliers/profile/update/{id}', [SupplierSettingController::class, 'updateProfile'])->name('supplier.profile.update');


//<------------------------- Payments ----------------------------------->
Route::get('/payments/create/{id}', [PaymentController::class, 'createPage'])->name('payment.create.show');
Route::post('/payments/create/{id}', [PaymentController::class, 'create'])->name('payment.create');
Route::get('/supplier/subscription/{id}', [PaymentController::class, 'index'])->name('payment.index');


// <-------------------------------- Inquiries --------------------------------->
Route::get('/inquiries/create/{supplierId}', [InquiryController::class, 'create'])->name('inquiries.create');
Route::post('/inquiries/create/{supplierId}', [InquiryController::class, 'store'])->name('inquiries.store');
Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
Route::get('/inquiries/send-whatsapp/{id}', [InquiryController::class, 'sendinquiryWhatsApp'])->name('inquiries.send.whatsapp');
Route::post('/inquiries/send/{id}', [InquiryController::class, 'sendInquiry'])->name('inquiries.send');
Route::post('/inquiries/{id}/send-all', [InquiryController::class, 'sendAll'])->name('inquiries.sendAll');

//----------------------------- Shops ----------------------------->
Route::any('/shops/create/{id}', [ShopController::class, 'create'])->name('shops.create');
Route::get('/shops/view/{id}', [ShopController::class, 'view'])->name('shops.view');
Route::get('/shops/profile/create/{id}', [ShopController::class, 'createProfile'])->name('shops.profile.create');
Route::post('admin/shops/profile/store/{id}', [ShopController::class, 'storeProfile'])->name('admin.shops.profile.store');
Route::get('/shops/parts/create/{id}', [ShopController::class, 'createParts'])->name('shops.parts.create');
Route::post('/shops/parts/store/{id}', [ShopController::class, 'storeParts'])->name('shops.parts.store');
Route::get('/shops/makes/create/{id}', [ShopController::class, 'createMakes'])->name('shops.makes.create');
Route::post('/shops/makes/store/{id}', [ShopController::class, 'storeMakes'])->name('shops.makes.store');
Route::post('/shops/hours/store/{id}', [ShopController::class, 'storeHours'])->name('shops.hours.store');
Route::get('supplier/shops/gallery/create/{id}', [ShopProfileController::class, 'createGallery'])->name('supplier.shops.gallery.create');
Route::post('/shops/gallery/store/{id}', [ShopController::class, 'storeGallery'])->name('shops.gallery.store');
Route::get('/shops/toggle/{id}', [ShopController::class, 'toogleShop'])->name('shops.toggle');


//<---------------------- Buyers ----------------------------->
// Route::get('/buyers', [BuyerController::class, 'index'])->name('buyers.index');
// // Route::post('/buyers/inquiry/send', [BuyerController::class, 'sendInquiry'])->name('buyer.inquiry.send');
// // Route::get('/buyers/whatsapp/{buyerInquiry}', [BuyerController::class, 'buyerWhatsappPage'])->name('buyer.whatsapp.page');
// // Route::post('/buyers/whatsapp/{buyerInquiry}', [BuyerController::class, 'getBuyerWhatsApp'])->name('buyer.whatsapp.get');

//<------------------------------ Invoice ------------------------------>
Route::get('/invoices/create/{id}', [InvoiceController::class, 'create'])->name('invoices.create');
Route::post('/invoices/store', [InvoiceController::class, 'storeInvoice'])->name('invoices.store');
Route::get('/update/parts/{id}', [InvoiceController::class, 'update_parts'])->name('update.parts');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.pdf');

//Company Data
Route::get('/company/about', [CompanyDataController::class, 'index'])->name('company.about');
Route::post('/company/about/store', [CompanyDataController::class, 'store'])->name('company.about.store');
Route::get('/company/about/edit/{id}', [CompanyDataController::class, 'edit'])->name('company.about.edit');
Route::post('/company/about/edit/{id}', [CompanyDataController::class, 'update'])->name('company.about.update');
Route::post('/company/about/delete/{id}', [CompanyDataController::class, 'destroy'])->name('company.about.delete');

//Site Scripts
Route::get('/admin/scripts', [ScriptController::class, 'index'])->name('admin.scripts.index');
Route::post('/admin/scripts/store', [ScriptController::class, 'store'])->name('admin.scripts.store');
Route::get('/admin/scripts/edit/{id}', [ScriptController::class, 'edit'])->name('admin.scripts.edit');
Route::post('/admin/scripts/edit/{id}', [ScriptController::class, 'update'])->name('admin.scripts.update');
Route::post('/admin/scripts/delete/{id}', [ScriptController::class, 'destroy'])->name('admin.scripts.delete');

Route::get('/admin/scripts/ad', [ScriptController::class, 'adunit'])->name('admin.scripts.adunit');
Route::post('/admin/scripts/ad/store', [ScriptController::class, 'adunitstore'])->name('admin.scripts.adunit.store');
Route::get('/admin/scripts/ad/edit/{id}', [ScriptController::class, 'adunitedit'])->name('admin.scripts.adunit.edit');
Route::post('/admin/scripts/ad/edit/{id}', [ScriptController::class, 'adunitupdate'])->name('admin.scripts.adunit.update');
Route::post('/admin/scripts/ad/delete/{id}', [ScriptController::class, 'adunitdestroy'])->name('admin.scripts.adunit.delete');

// Courier Routes
Route::get('/admin/couriers', [App\Http\Controllers\CourierController::class, 'index'])->name('admin.couriers.index');
Route::post('/admin/couriers/store', [App\Http\Controllers\CourierController::class, 'store'])->name('admin.couriers.store');
Route::post('/admin/couriers/delete/{id}', [App\Http\Controllers\CourierController::class, 'destroy'])->name('admin.couriers.delete');
Route::get('/admin/couriers/edit/{id}', [App\Http\Controllers\CourierController::class, 'edit'])->name('admin.couriers.edit');
Route::post('/admin/couriers/update/{id}', [App\Http\Controllers\CourierController::class, 'update'])->name('admin.couriers.update');

// Meta Tags
Route::get('/admin/meta-tags', [ScriptController::class, 'metatags'])->name('admin.meta.tags');
Route::post('/admin/meta-tags/store', [ScriptController::class, 'metatagsstore'])->name('admin.meta.tags.store');
// Route::get('/admin/meta-tags/edit/{id}', [ScriptController::class, 'metatagedit'])->name('admin.meta.tags.edit');
// Route::post('/admin/meta-tags/edit/{id}', [ScriptController::class, 'metatagsupdate'])->name('admin.meta.tags.update');
Route::post('/admin/meta-tags/delete/{id}', [ScriptController::class, 'metatagsdestroy'])->name('admin.meta.tags.delete');
//Parts Meta
Route::get('/admin/parts/meta/{id}',[ScriptController::class,'partsMeta'])->name('admin.parts.meta');
Route::post('/admin/parts/meta/store/{id}',[ScriptController::class,'storePartsMeta'])->name('admin.parts.meta.store');
Route::get('/admin/parts/meta/edit/{id}',[ScriptController::class,'editPartsMeta'])->name('admin.parts.meta.edit');
Route::post('/admin/parts/meta/edit/{id}',[ScriptController::class,'updatePartsMeta'])->name('admin.parts.meta.update');
Route::post('/admin/parts/meta/delete/{id}',[ScriptController::class,'destroyPartsMeta'])->name('admin.parts.meta.delete');

// Site Map

});
Route::get('/sitemap.xml', [SiteMapController::class, 'index'])->name('sitemap.xml');
//Supplier-Panel
Route::middleware('subscription')->group(function () {
    Route::get('/supplier-panel', [SupplierController::class, 'showSupplierPanel'])->name('supplier.panel');
    Route::get('/supplier/get-models/{make_id}', [SupplierController::class, 'getModelsByMake'])->name('get.models');
    Route::get('/shop/ads/{id}/mark-inquiry-read', [SupplierController::class, 'markInquiryRead'])->name('supplier.ads.markInquiryRead');
    Route::post('/supplier/logout', [AuthController::class, 'supplierLogout'])->name('supplier.logout');
Route::get('supplier/shops/hours/update/{id}', [ShopProfileController::class, 'createHours'])->name('supplier.shops.hours.update');

    // Ads
    Route::get('/ads/get-models/{make_id}', [AdController::class, 'getModels']);
    Route::get('/get-variants/{model_id}', [AdController::class, 'getVariants']);
    Route::post('/shop/ads/store', [AdController::class, 'store'])->name('supplier.ads.store');
    Route::get('/shop/ads/active/{id}', [AdController::class, 'activeads'])->name('supplier.ads.active');
    Route::get('/shop/ads/inactive/{id}', [AdController::class, 'inactiveads'])->name('supplier.ads.inactive');
    Route::get('/shop/ads/approved/{id}', [AdController::class, 'approvedads'])->name('supplier.ads.approved');
    Route::get('/shop/ads/waiting/{id}', [AdController::class, 'waitingForApproval'])->name('shop.ads.waiting');
    Route::get('/shop/ads/{id}/{slug}/edit', [AdController::class, 'edit'])->name('shop.ads.edit');
    Route::post('/shop/ads/{id}/{slug}/edit', [AdController::class, 'update'])->name('supplier.ads.update');
    Route::get('/ads/toggle/{type}/{id}', [AdController::class, 'isActive'])
        ->name('supplier.ads.toggleActive');
    // Route::get('/shop/ads/delete/{id}', [AdController::class, 'delete'])->name('supplier.ads.delete');
    Route::get('/ads/delete/{type}/{id}', [AdController::class, 'delete'])
     ->name('supplier.ads.delete');
    Route::post('/shop/ads/store-car', [AdController::class, 'storeCar'])->name('supplier.ads.storeCar');
    Route::get('/shop/ads/{id}/toggle-car-active', [AdController::class, 'isCarActive'])->name('supplier.ads.toggleCarActive');
    // Ads
    Route::get('/shop/ads/create', [AdController::class, 'create'])->name('shop.supplier.ads.create');
    Route::get('/shop/ads/create-car', [AdController::class, 'createCar'])->name('shop.supplier.ads.createCar');

    Route::post('/shop/ads/store', [AdController::class, 'store'])->name('shop.supplier.ads.store');
    Route::post('/shop/ads/store-car', [AdController::class, 'storeCar'])->name('shop.supplier.ads.storeCar');

    Route::get('/shop/ads/{id}', [AdController::class, 'index'])->name('supplier.ads.index');


    // Shop Profile
    Route::get('/shop/profile/{id}', [ShopProfileController::class, 'index'])->name('supplier.shop.profile');
    Route::get('/shop/profile/create/{id}', [ShopProfileController::class, 'createProfile'])->name('supplier.shop.profile.create');
    Route::post('supplier/shops/profile/store/{id}', [ShopController::class, 'storeProfile'])->name('supplier.shops.profile.store');
    Route::get('/shop/profile/parts/create/{id}', [ShopProfileController::class, 'createParts'])->name('supplier.shop.profile.parts.create');
    // Route::post('/shops/parts/store/{id}', [ShopController::class, 'storeParts'])->name('shops.parts.store');
    // Route::post('/shops/makes/store/{id}', [ShopController::class, 'storeMakes'])->name('shops.makes.store');
    Route::post('/shops/hours/store/{id}', [ShopController::class, 'storeHours'])->name('shops.hours.store');
    Route::post('/shops/gallery/store/{id}', [ShopController::class, 'storeGallery'])->name('shops.gallery.store');

    //WhatsApp Quote
    Route::get('/shop/whatsapp-quote/{id}', [ShopController::class, 'whatsAppQuote'])->name('supplier.shop.whatsappQuote');

    //Buyer Invoices
    Route::get('/shop/buyer-invoices', [InvoiceController::class, 'createBuyerInvoice'])->name('supplier.buyer.invoices.index');
    // Route::get('/shop/buyer-invoices/create/{id}', [InvoiceController::class, 'create'])->name('supplier.buyer.invoices.create');
    Route::post('/shop/buyer-invoices/store', [InvoiceController::class, 'storeBuyerInvoice'])->name('supplier.buyer.invoices.store');

    //UpdatePassword
    Route::get('/shop/password/update/{id}', [SupplierSettingController::class, 'editPassword'])->name('supplier.password.update');
    Route::post('/shop/password/update/{id}', [SupplierSettingController::class, 'updatePasswordSupplier'])->name('supplier.password.edit');
    //Courier Services Page
    Route::get('/shop/courier-services', [CourierController::class, 'courierServices'])->name('supplier.courier.services');
});

// <--------------------------------- Supplier Login ------------------------------->
Route::get('/supplier-login', [AuthController::class, 'supplierLogin'])->name('supplier.login');
Route::post('/supplier/login', [AuthController::class, 'supplierLoginPost'])->name('supplier.login.post');
Route::get('/supplier/login/expire', [AuthController::class, 'expirePage'])->name('supplier.login.expire');


// <------------------------------- Frontend ------------------------------------->
Route::get('/',[FrontendController::class,'index'])->name('frontend.index');
Route::get('/get-models/{makeId}', [FrontendController::class, 'getModelsByMake']);
// Inquiries Send
Route::post('/buyers/inquiry/send', [FrontendController::class, 'sendInquiry'])->name('buyer.inquiry.send');

Route::get('/buyer/contacts/{buyerInquiry}',[FrontendController::class,'buyerPage'])->name('buyer.contacts');
Route::post('/buyers/whatsapp/{buyerInquiry}', [FrontendController::class, 'getBuyerWhatsApp'])->name('buyer.whatsapp.get');

// Show Results
Route::get('/show/ads/{partName}/{id}',[FrontendController::class,'adByPart'])->name('part.ads');
Route::get('/makes/show/ads/{slug}/{id}',[FrontendController::class,'adByMakes'])->name('make.ads');
Route::get('cities/show/ads/{slug}/{id}',[FrontendController::class,'adByCity'])->name('city.ads');

//Shops
Route::get('/view/shops',[FrontendController::class,'viewShops'])->name('view.shops');
//About Page
Route::get('/about-us',[FrontendController::class,'aboutPage'])->name('about.page');
//View Ad
Route::get('/view-ad/{slug}/{id}',[FrontendController::class,'viewAd'])->name('view.ad');
//View Car Ad
Route::get('/view-car-ad/{slug}/{id}',[FrontendController::class,'viewCarAd'])->name('view.car.ad');
// View Shop
Route::get('/view-shop/{id}',[FrontendController::class,'viewShop'])->name('view.shop');
// Blogs
Route::get('/blogs',[FrontendController::class,'blogs'])->name('frontend.blogs');
// Single Blog
Route::get('/blog/{slug}/{id}',[FrontendController::class,'blogView'])->name('frontend.blog.view');
// View Blogs by Category
Route::get('/blogs/category/{id}',[FrontendController::class,'viewBlogByCategory'])->name('frontend.blogs.category');
// Signup Page
Route::get('/signup',[FrontendController::class,'signupPage'])->name('frontend.signup');
Route::post('/supplier-signup', [SupplierController::class, 'createRequest'])->name('supplier.create');
// Terms and Conditions
Route::get('/terms-and-conditions', [FrontendController::class, 'termsAndConditions'])->name('frontend.terms');
// Privacy Policy
Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('frontend.privacy');
// Make Part
Route::get('/make-part/{id}',[FrontendController::class,'makePart'])->name('frontend.make.part');

Route::get('/search-makes', [FrontendController::class, 'searchMakes']);
Route::get('/search-models', [FrontendController::class, 'searchModels']);
Route::get('/search-years', [FrontendController::class, 'searchYears']);
Route::get('/search-parts', [FrontendController::class, 'searchParts']);


// <------------------------------- Frontend ------------------------------------->


Route::get('SeoDashboard', [SeoController::class, 'index'])->name('SEO.dashboard');
Route::post('SeoTamplateAdd', [SeoController::class, 'store'])->name('tamplate.add');
Route::get('SeoTamplateUpdate/{id}', [SeoController::class, 'update'])->name('tamplate.edit');
Route::post('SeoTamplateUpdateTamp/{id}', [SeoController::class, 'updateTamp'])->name('seo.update');
Route::delete('/tamplate/{id}', [SeoController::class, 'destroy'])->name('tamplate.destroy');
Route::post('/assign_tamp_parts/{id}', [SeoController::class, 'assign_tamp_parts'])->name('tamplate.assign_tamp_parts');
Route::get('/assign_tamp_make/{id}', [SeoController::class, 'assign_tamp_make'])->name('makes.seo');
Route::post('/assign_tamp_make_post/{id}', [SeoController::class, 'assign_tamp_make_post'])->name('makes.seo.post');
Route::get('SeoTitles', [SeoController::class, 'SeoTitles'])->name('SEO.SeoTitles');
Route::post('SeotitleAdd', [SeoController::class, 'store_title'])->name('tamplate.tittle.add');
Route::delete('/tamplate/title/{id}', [SeoController::class, 'destroy_title'])->name('tamplate.tittle.destroy');
Route::get('SeoTamplateUpdate_title/{id}', [SeoController::class, 'update_title'])->name('tamplate.title.edit');
Route::post('SeoTamplateUpdatetitleupdate/{id}', [SeoController::class, 'updatetitle'])->name('seo.update.title');

Route::get('/assign_tamp_model/{id}', [SeoController::class, 'assign_tamp_model'])->name('model.seo');
Route::post('/assign_tamp_model_post/{id}', [SeoController::class, 'assign_tamp_model_post'])->name('model.seo.post');

Route::get('/Found/pages/',[FrontendController::class,'found_pages'])->name('found_pages.index');

Route::get('/generate-seo', [FrontendController::class, 'generateSeo'])->name('generate.seo');
