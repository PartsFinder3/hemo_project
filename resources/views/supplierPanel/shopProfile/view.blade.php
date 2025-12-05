@extends('supplierPanel.layout.main')
@section('main-section')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <!-- Profile Card -->
                <div class="card shadow-sm border-0 rounded-3">
                    <!-- Cover Image -->
                    @if ($profile && $profile->cover)
                        <img src="{{ asset('storage/' . $profile->cover) }}" class="card-img-top rounded-top" alt="Cover" style="height: 200px;">
                    @else
                        <img src="{{ asset('assets/compiled/jpg/Head.png') }}" class="card-img-top rounded-top" alt="Cover">
                    @endif
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Shop Image -->
                            <div class="col-md-2 col-3 text-center">
                                @if ($profile && $profile->profile_image)
                                    <img src="{{ asset('storage/' . $profile->profile_image) }}"
                                        class="img-fluid rounded-circle border border-3 border-white shadow"
                                        alt="Shop Logo">
                                @else
                                    <img src="{{ asset('assets/compiled/jpg/2.jpg') }}"
                                        class="img-fluid rounded-circle border border-3 border-white shadow"
                                        alt="Shop Logo">
                                @endif
                            </div>

                            <!-- Shop Info -->
                            <div class="col-md-7 col-9">
                                <h4 class="mb-0">
                                    {{ $shop->name }}
                                    @if ($shop->supplier->is_verified)
                                        <span class="badge bg-warning text-dark">Verified</span>
                                    @endif
                                </h4>
                                <p class="text-muted mb-1">
                                    <i class="bi bi-geo-alt-fill text-danger"></i>
                                    {{ $profile?->address ? $profile->address . ' ' . $shop->supplier->city->name : $shop->supplier->city->name }}

                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-md-3 col-12 text-md-end text-start mt-2 mt-md-0">
                                <a href="{{ route('supplier.shop.profile.create', $shop->id) }}"
                                    class="btn btn-orange btn-sm w-100 w-md-auto">Edit Profile</a>
                            </div>
                        </div>

                        <hr>

                        <!-- About Section -->
                        @if (isset($profile) && $profile->description)
                            <h6>About</h6>
                            <p class="text-muted">{{ $profile->description }}</p>
                        @endif

                        <!-- Contact Buttons -->
                        {{-- <div class="d-flex flex-wrap gap-2 mt-3">
                            <a href="https://wa.me/" target="_blank" class="btn btn-success btn-sm">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                            <a href="tel:" class="btn btn-info btn-sm">
                                <i class="bi bi-telephone"></i> Call Now
                            </a>
                        </div> --}}
                    </div>
                </div>
                {{-- <div class="card shadow-sm border-0 rounded-3 mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                            <h5 class="mb-0">Deals in Parts</h5>
                            <div class="d-flex align-items-center gap-2">
                                @if ($shop->supplier->is_verified)
                                    <span class="badge bg-success-subtle text-success">
                                        <i class="bi bi-check-circle"></i> Verified by Business
                                    </span>
                                @endif --}}
                                {{-- <span>
                                    <a href="{{ route('supplier.shop.profile.parts.create', $shop->id) }}"
                                        class="btn btn-orange">Add
                                        Parts</a>
                                </span> --}}
                            {{-- </div>
                        </div> --}}

                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">
                        {{-- @foreach ($shopParts as $part)
    <div class="col">
        <div class="p-2 border rounded text-center">
            {{ $part->part->name ?? 'Unknown' }}
        </div>
    </div>
@endforeach --}}
                        </div>
                    </div>
                </div>

                <!-- Deals in Cars -->
                {{-- <div class="card shadow-sm border-0 rounded-3 mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                            <h5 class="mb-0">Deals in Cars</h5>
                            <div class="d-flex align-items-center gap-2">
                                @if ($shop->supplier->is_verified)
                                    <span class="badge bg-success-subtle text-success">
                                        <i class="bi bi-check-circle"></i> Verified by Business
                                    </span>
                                @endif
                                {{-- <span>
                                    <a href="" class="btn btn-orange">Add
                                        Makes</a>
                                </span> --}}
                            {{-- </div>
                        </div>

                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-2">
                            @foreach ($shopMakes as $make)
                                <div class="col">
                                    <div class="p-2 border rounded text-center">{{ $make->make->name }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> --}}

                <!-- Location & Hours -->
                <div class="card shadow-sm border-0 rounded-3 mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                            <h5 class="fw-bold mb-4">📍 Location & Hours</h5>
                            <span>
                                <a href="{{ route('supplier.shops.hours.create', $shop->id) }}" class="btn btn-orange">Add
                                    Hours</a>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="text-muted mb-0">{{ $profile?->address ? $profile->address . ' ' . $shop->supplier->city->name : $shop->supplier->city->name }}

                                </p>
                            </div>
                            <div class="col-md-7">
                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <span class="fw-semibold">Mon</span>
                                    <span>{{ $shopHours->monday ?? 'OFF' }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <span class="fw-semibold">Tue</span>
                                    <span>{{ $shopHours->tuesday ?? 'OFF' }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <span class="fw-semibold">Wed</span>
                                    <span>{{ $shopHours->wednesday ?? 'OFF' }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <span class="fw-semibold">Thu</span>
                                    <span>{{ $shopHours->thursday ?? 'OFF' }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <span class="fw-semibold">Fri</span>
                                    <span class="text">{{ $shopHours->friday ?? 'OFF' }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <span class="fw-semibold">Sat</span>
                                    <span class="text">{{ $shopHours->saturday ?? 'OFF' }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <span class="fw-semibold">Sun</span>
                                    <span>{{ $shopHours->sunday ?? 'OFF' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Car Ads -->
<div class="card shadow-sm border-0 rounded-3 mt-4 card-wrapper">
    <div class="card-body">
        <h5 class="fw-bold mb-4">Spare Parts Ads</h5>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 scroll_posint">

            @if ($shopAds->count() > 0)
                @foreach ($shopAds as $ad)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 rounded-3 d-flex flex-column product-card">
                            @php
                                $images = json_decode($ad->images, true);
                            @endphp

                            @if(!empty($images[0]))
                                <div class="product-image-wrapper">
                                    <img src="{{ asset($images[0]) }}" class="card-img-top img-fluid product-image" alt="{{ $ad->title }}">
                                </div>
                            @else
                                <div class="product-image-wrapper bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-semibold product-title mb-2">{{ Str::limit($ad->title, 50) }}</h6>
                                <h5 class="text-danger fw-bold mb-3">AED {{ number_format($ad->price, 2) }}</h5>
                                
                                <ul class="list-unstyled small mb-3 product-details">
                                    <li class="mb-1">
                                        <span class="fw-medium">Availability:</span> 
                                        <span class="text-success ms-1">In Stock</span>
                                    </li>
                                    <li class="mb-1">
                                        <span class="fw-medium">Condition:</span> 
                                        <span class="text-muted ms-1">{{ ucfirst($ad->condition) }}</span>
                                    </li>
                                    <li class="mb-1">
                                        <span class="fw-medium">Delivery:</span> 
                                        <span class="text-muted ms-1">Ask Supplier</span>
                                    </li>
                                    <li class="mb-1">
                                        <span class="fw-medium">Warranty:</span> 
                                        <span class="text-muted ms-1">Ask Supplier</span>
                                    </li>
                                </ul>

                                <a class="btn btn-primary mt-auto edit-btn" 
                                   href="{{ route('shop.ads.edit', [$ad->id, $ad->slug]) }}">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            @else
                <!-- No Ads Found Centered -->
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                        </div>
                        <h5 class="text-muted mb-3">No ads found</h5>
                        <p class="text-muted">Start by creating your first spare parts ad.</p>
                        <a href="{{ route('shop.ads.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Create New Ad
                        </a>
                    </div>
                </div>
            @endif

        </div>
        
        <!-- Pagination Centered - placed outside the row but inside card-body -->
        @if ($shopAds->count() > 0)
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{ $shopAds->appends(['scroll' => 'ads'])->links('pagination::bootstrap-5') }}
                </ul>
            </nav>
        </div>
        @endif
    </div>
</div>

                <!-- Car Ads -->
                <div class="card shadow-sm border-0 rounded-3 mt-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Car Ads</h5>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                            <div class="col">
                                @if ($shopCarAds->count() > 0)
                                    @foreach ($shopCarAds as $ad)
                                        <div class="card h-90 shadow-sm border-0 rounded-3">
                                            @php
                                                $images = json_decode($ad->images, true);
                                            @endphp

                                            @if (is_array($images) && isset($images[0]))
                                                <img src="{{ asset('storage/' . $images[0]) }}"
                                                    class="card-img-top img-fluid" alt="Product">
                                            @endif
                                            <div class="card-body">
                                                <h6 class="fw-semibold">{{ $ad->title }}</h6>
                                                {{-- <h5 class="text-danger fw-bold">AED {{ $ad->price }}</h5> --}}
                                                <ul class="list-unstyled small">
                                                    <li><b>Availability:</b> <span class="text-success">In Stock</span>
                                                    </li>
                                                    <li><b>Condition:</b> {{ $ad->condition }}</li>
                                                    <li><b>Delivery:</b> Ask Supplier</li>
                                                    <li><b>Warranty:</b> Ask Supplier</li>
                                                </ul>
                                                <div class="d-flex gap-2">
                                                    {{-- <a href="#" class="btn btn-outline-success w-80">
                                                <i class="bi bi-whatsapp"></i> Whatsapp
                                            </a>
                                            <a href="#" class="btn btn-outline-primary w-80">
                                                <i class="bi bi-telephone"></i> Call
                                            </a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <!-- More ads as needed -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Our Gallery</h5>
                        <span>
                            <a href="{{ route('supplier.shops.gallery.create', $shop->id) }}" class="btn btn-orange">Add
                                Image</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            @foreach ($shopGallery as $image)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded"
                                        alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (request()->scroll == 'ads')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const element = document.getElementsByClassName("scroll_posint")[0];
    if (element) {
        element.scrollIntoView({ behavior: "smooth" });
    }
});
</script>
@endif

    <style>
        .card-wrapper .card {
    width: 100%; /* card takes full width of its column */
    height: 100%; /* card fills height of column */
    display: flex;
    flex-direction: column;
}

.card-wrapper .card img.card-img-top {
    height: 300px; /* taller image */
    object-fit: cover;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}

.card-wrapper .card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.card-wrapper .card-body h6,
.card-wrapper .card-body h5 {
    /* margin-bottom: 0.5rem; */
}

.card-wrapper .card-body ul li {
    font-size: 0.85rem;
    margin-bottom: 0.3rem;
}

.card-wrapper .card-body .btn {
    width: 100%;
    margin-top: auto;
}

    </style>



<style>
.card-wrapper {
    background: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-wrapper:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.product-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-color: #0d6efd;
}

.product-image-wrapper {
    height: 200px; /* card image height */
    overflow: hidden;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain; /* poora image dikhaye, crop na ho */
    transition: transform 0.5s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}


.product-title {
    color: #2c3e50;
    font-size: 1rem;
    line-height: 1.4;
    min-height: 40px;
}

.product-details li {
    border-bottom: 1px solid #f1f1f1;
    padding-bottom: 8px;
}

.product-details li:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.edit-btn {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    border: none;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
    border-radius: 8px;
}

.edit-btn:hover {
    background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

/* Center pagination */
.pagination {
    justify-content: center;
}

.page-link {
    margin: 0 3px;
    border-radius: 5px !important;
    border: 1px solid #dee2e6;
    color: #0d6efd;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.page-link:hover {
    background-color: #e9ecef;
    border-color: #dee2e6;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .product-image-wrapper {
        height: 180px;
    }
    
    .pagination {
        flex-wrap: wrap;
    }
}
</style>
@endsection
