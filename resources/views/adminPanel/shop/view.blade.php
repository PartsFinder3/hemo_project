@extends('adminPanel.layout.main')
@section('main-section')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <section class="section">

            <!-- Profile Section -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-12">
                            <div class="mb-3">
                                @if (isset($profile) && $profile->cover)
                               
                                    <img style="width: 100%" src="{{ asset( 'storage/'.$profile->cover) }}"
                                        class="img-fluid rounded" alt="">
                                @else
                                    <img src="{{ asset('assets/compiled/jpg/Head.png') }}" class="img-fluid rounded"
                                        alt="">
                                @endif
                            </div>

                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <h3 class="card-title d-flex align-items-center">
                                    <span class="me-2" style="width:50px;">
                                        @if (isset($profile) && $profile->profile_image)
                                            <img src="{{ asset('storage/' . $profile->profile_image) }}"
                                                class="img-fluid rounded-circle" alt="">
                                        @else
                                            <img src="{{ asset('assets/compiled/jpg/2.jpg') }}"
                                                class="img-fluid rounded-circle" alt="">
                                        @endif
                                    </span>
                                    {{ $shop->name }}
                                </h3>
                                <div class="d-flex gap-2 align-items-center">
                                    <a href="{{ route('shops.profile.create', $shop->id) }}"
                                        class="btn btn-primary btn-sm">Edit Profile</a>
                                    <a href="{{ route('supplier.profile.edit', $shop->supplier->id) }}"
                                        class="btn btn-secondary btn-sm">Change Password & WhatsApp</a>
                                    @if ($shop->supplier->is_verified)
                                        <span class="badge bg-warning text-dark">Verified</span>
                                    @endif
                                </div>
                            </div>

                            <h5 class="mb-1">{{ $shop->supplier->name }}</h5>
                            <p class="text-muted mb-2">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                {{ ($profile->address ?? '') . ' ' . ($shop->supplier->city->name ?? '') }}
                            </p>


                            @if (isset($profile) && $profile->description)
                                <h6>About</h6>
                                <p class="text-muted">{{ $profile->description }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="mt-3">
                        <a href="https://wa.me/{{ $shop->supplier->whatsapp }}" target="_blank"
                            class="btn btn-success btn-sm">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="tel:{{ $shop->supplier->whatsapp }}" class="btn btn-info btn-sm">
                            <i class="bi bi-telephone"></i> Call Now
                        </a>

                    </div>

                    {{-- <!-- Social Media -->
                    <div class="d-flex align-items-center mt-3 flex-wrap">
                        <small class="text-muted me-3">Connect with us:</small>
                        <a href="#" class="text-primary me-3"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-danger me-3"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-info me-3"><i class="bi bi-linkedin fs-5"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-tiktok fs-5"></i></a>
                    </div> --}}
                </div>
            </div>

            <!-- Deals in Parts -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="mb-0">Deals in Parts</h5>
                        <div class="d-flex align-items-center gap-2">
                            @if ($shop->supplier->is_verified)
                                <span class="badge bg-success-subtle text-success">
                                    <i class="bi bi-check-circle"></i> Verified by Business
                                </span>
                            @endif
                            <span>
                                <a href="{{ route('shops.parts.create', $shop->id) }}" class="btn btn-primary">Add
                                    Parts</a>
                            </span>
                        </div>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">
                      @if($shopParts && $shopParts->part)
                        <div class="col">
                            <div class="p-2 border rounded text-center">{{ $shopParts->part->name }}</div>
                        </div>
                    @endif

                    </div>
                </div>
            </div>

            <!-- Deals in Cars -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="mb-0">Deals in Cars</h5>
                        <div class="d-flex align-items-center gap-2">
                            @if ($shop->supplier->is_verified)
                                <span class="badge bg-success-subtle text-success">
                                    <i class="bi bi-check-circle"></i> Verified by Business
                                </span>
                            @endif
                            <span>
                                <a href="{{ route('shops.makes.create', $shop->id) }}" class="btn btn-primary">Add
                                    Makes</a>
                            </span>
                        </div>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-2">
                        @foreach ($shopMakes as $make)
                            <div class="col">
                                <div class="p-2 border rounded text-center">{{ $make->make->name }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Location & Hours -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="fw-bold mb-4">📍 Location & Hours</h5>
                        <span>
                            {{-- <a href="{{ route('shops.hours.create', $shop->id) }}" class="btn btn-primary">Add Hours</a> --}}
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="text-muted mb-2">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                {{ ($profile->address ?? '') . ' ' . ($shop->supplier->city->name ?? '') }}
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
<div class="card shadow-sm border-0 rounded-3 mt-4">
    <div class="card-body">
        <h5 class="fw-bold mb-4">Spare Parts Ads</h5>
        <div class="d-flex flex-wrap gap-3">
            @foreach ($shopAds as $ad)
                @php
                    $images = json_decode($ad->images, true);
                @endphp
                <div class="card h-100 shadow-sm border-0 rounded-3" style="width: 250px; margin-left: 40px;">
                    @if (is_array($images) && isset($images[0]))
                        <img src="{{ asset($images[0]) }}" class="card-img-top img-fluid" alt="Product">
                    @endif
                    <div class="card-body">
                        <h6 class="fw-semibold">{{ $ad->title }}</h6>
                        <h5 class="text-danger fw-bold">AED {{ $ad->price }}</h5>
                        <ul class="list-unstyled small">
                            <li><b>Availability:</b> <span class="text-success">In Stock</span></li>
                            <li><b>Condition:</b> {{ $ad->condition }}</li>
                            <li><b>Delivery:</b> Ask Supplier</li>
                            <li><b>Warranty:</b> Ask Supplier</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
            <!-- Car Ads -->
        

            <!-- Gallery -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Our Gallery</h5>
                        {{-- <a href="{{ route('shops.gallery.create', $shop->id) }}" class="btn btn-primary">Add Images</a> --}}
                    </div>
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

        </section>
    </div>
@endsection
