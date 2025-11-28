@extends('Frontend.layout.main')
@section('main-section')
    <div class="hero-section d-flex justify-content-center align-items-center flex-column">
        <div class="container-fluid py-0">
            <div class="row justify-content-center">
                <div class="col-12">
                   <div class="pc-card">

                        <!-- Cover + Overlay -->
                        <div class="pc-cover-section position-relative">
                          
                            <img src="{{ $profile && $profile->cover ? asset('storage/'. $profile->cover) : asset('assets/compiled/jpg/Head.png') }}"
                                class="pc-cover-image w-100" alt="Cover">

                            <div class="pc-cover-overlay position-absolute top-0 start-0 w-100 h-100"></div>

                            <!-- Profile Image + Social Icons -->
<div class="profile-avatar position-absolute bottom-0 start-0" style="margin-left: 100px; margin-bottom: 20px;">
    @if ($profile && $profile->profile_image)
        <img src="{{ asset('storage/' . $profile->profile_image) }}"
            class="rounded-circle border border-3 border-white shadow"
            alt="Shop Logo"
            style="width: 150px; height: 150px; object-fit: cover;">
    @endif
</div>

                        </div>
                        </div>

                        <!-- Content Section -->
                        <div class="pc-profile-content text-center mt-5 pt-4">
                            <h1 class="pc-shop-name fw-bold">
                                {{ $shop->name ?? 'Shop Name Here' }}
                                @if ($shop->supplier?->is_verified)
                                    <span class="pc-verified-badge"><i class="fas fa-check-circle"></i> Verified</span>
                                @endif
                            </h1>

                            <div class="pc-shop-stats mt-2">
                                <span class="pc-stat-item">📦 {{$totalAds}} Items Listed</span>
                                <span class="pc-stat-item">💬 {{$inquiryCount}} Enquiries</span>
                            </div>

                            <div class="pc-contact-buttons mt-3 d-flex justify-content-center gap-2">
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $shop->supplier->whatsapp) }}" target="_blank" class="pc-btn pc-btn-success btn-sm">
                                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                </a>
                                <a href="tel:{{ $shop->supplier->whatsapp }}" class="pc-btn pc-btn-warning btn-sm">
                                    <i class="fas fa-phone me-1"></i> Call
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@if($shopHours)
<div class="info-card">
    <div class="section-title">Opening Hours</div>
    <div class="hours-grid">
        @php
            $hours = [
                'Monday' => $shopHours->monday,
                'Tuesday' => $shopHours->tuesday,
                'Wednesday' => $shopHours->wednesday,
                'Thursday' => $shopHours->thursday,
                'Friday' => $shopHours->friday,
                'Saturday' => $shopHours->saturday,
                'Sunday' => $shopHours->sunday,
            ];
        @endphp

        @foreach($hours as $day => $time)
            <div class="day-row">
                <span class="day">{{ $day }}</span>
                <span class="time">{{ $time }}</span>
            </div>
        @endforeach
    </div>
</div>
@endif

        <div class="grid" id="productGrid2">
@if($shopAds && $shopAds->count())
    @foreach($shopAds as $ad)
                <div class="card">
                    @php
                        $images = json_decode($ad->images, true);
                    @endphp

                    @if (is_array($images) && isset($images[0]))
                        <img src="{{ asset($images[0]) }}" alt="Product">
                    @endif
                    <div class="card-body">
                       <a href="{{ route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id]) }}"
                            class="card-title">{{ $ad->title }}</a>
                        {{-- <div class="price">AED {{ $ad->price }}</div> --}}
                        <div class="meta">
                            Availability: In Stock <br>
                            {{-- Condition: {{ $ad->condition }} <br> --}}
                            Delivery: Ask Supplier <br>
                            Warranty: Ask Supplier
                        </div>
                        @php
                            $ad->shop->supplier->whatsapp;
                        @endphp
                   <div class="buttons">
                   
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $ad->shop->supplier->whatsapp) }}?text={{ urlencode('Hello, I am interested in your ad: ' . $ad->title) }}"
                                target="_blank"
                                class="btn btn-sm btn-success w-100 my-1">
                                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                </a>
                            <a href="javascript:void(0)" class="btn call"
                                onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">
                                <i class="fa-solid fa-phone"></i> Click to Call
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
     @endif

            <!-- Repeat similar cards... -->
        </div>

    <!-- Image Modal -->
    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <img id="modalImage" class="modal-image" src="" alt="">
        </div>
    </div>

    <style>
        /* Enhanced responsive profile card styles */
            body, main, header, nav, .hero-section, .hero-section_p {
            background-image: none !important;
            background: none !important;
        }
        .profile-card {
            background: var(--primary-color);
            border-radius: 0;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            margin-bottom: 0;
            width: 100%;
            margin-left: 0;
            margin-right: 0;
        }

        .header-section {
            position: relative;
            height: 200px;
            background: #000;
        }

        .header-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        .profile-avatar {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--accent-color);
            color: #fff;
            font-size: 2rem;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 4px solid var(--primary-color);
            z-index: 10;
        }

        .profile-content {
            margin-top: 60px;
            padding: 1.5rem;
            text-align: center;
        }

        .shop-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--secondary-color);
            line-height: 1.3;
            margin-bottom: 0.5rem;
        }

        .badge {
            background: var(--accent-color);
            color: #fff;
            font-size: 0.8rem;
            margin-left: 8px;
            padding: 4px 8px;
            border-radius: 12px;
            display: inline-block;
        }

        .shop-stats {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 1rem 0;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            font-size: 0.9rem;
            color: var(--tertiary-color);
            white-space: nowrap;
        }

        .about-section {
            margin: 1.5rem 0;
            text-align: left;
        }

        .about-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
        }

        .about-text {
            font-size: 0.9rem;
            color: var(--tertiary-color);
            line-height: 1.6;
        }

        .contact-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 1.2rem;
            margin-bottom: 2rem;
        }

        .contact-btn {
            flex: 1;
            min-width: 140px;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 8px;
            color: #fff;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            border: none;
        }

        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        .whatsapp-btn {
            background: var(--whatsapp-btn) !important;
        }

        .whatsapp-btn:hover {
            background: #239954 !important;
        }

        .call-btn {
            background: var(--accent-color) !important;
        }

        .call-btn:hover {
            background: #e66a00 !important;
        }

        /* Info Cards */
        .info-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            text-align: left;
        }

        .card-header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: black !important;
            margin: 0;
        }

        .verified-badge {
            background: #d1edff;
            color: #0066cc;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Parts and Makes Grid */
        .parts-grid, .makes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 0.8rem;
        }

        .part-item, .make-item {
            padding: 0.8rem;
            background: #f8f9fa;
            border-radius: 8px;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--secondary-color);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .part-item:hover, .make-item:hover {
            background: var(--accent-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Location Content */
        .location-content {
            display: grid;
            gap: 1.5rem;
        }

        .address-text {
            color: var(--tertiary-color);
            font-size: 1rem;
            margin: 0;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .hours-grid {
            display: grid;
            gap: 0.5rem;
        }

        .day-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem;
            border-bottom: 1px solid #e9ecef;
        }

        .day-row:last-child {
            border-bottom: none;
        }

        .day {
            font-weight: 600;
            color: var(--secondary-color);
            min-width: 50px;
        }

        .time {
            color: var(--tertiary-color);
            font-size: 0.9rem;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 0.8rem;
        }

        .gallery-item {
            aspect-ratio: 1;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Image Modal */
        .image-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            position: relative;
            margin: auto;
            display: block;
            width: 90%;
            max-width: 800px;
            height: 90%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-image {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 35px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Product Sections */
        .ad-cards {
            padding: 2rem 1.5rem;
            background: var(--primary-color);
        }

        .section-text {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-text h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .product-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-body {
            padding: 1.2rem;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--secondary-color);
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            line-height: 1.4;
        }

        .product-title:hover {
            color: var(--accent-color);
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .product-meta {
            margin-bottom: 1.2rem;
        }

        .meta-item {
            font-size: 0.85rem;
            color: var(--tertiary-color);
            margin-bottom: 0.3rem;
        }

        .product-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-product {
            flex: 1;
            padding: 0.6rem 1rem;
            border: none;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-product.whatsapp {
            background: var(--whatsapp-btn);
            color: white;
        }

        .btn-product.whatsapp:hover {
            background: #239954;
        }

        .btn-product.call {
            background: var(--accent-color);
            color: white;
        }

        .btn-product.call:hover {
            background: #e66a00;
        }

        .pagination {
            text-align: center;
            margin-top: 2rem;
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .profile-card {
                border-radius: 0;
                margin: 0;
            }

            .header-section {
                height: 150px;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 1.5rem;
                bottom: -40px;
            }

            .profile-content {
                margin-top: 50px;
                padding: 1rem;
            }

            .shop-name {
                font-size: 1.2rem;
            }

            .badge {
                display: block;
                margin: 8px auto 0;
                width: fit-content;
            }

            .shop-stats {
                gap: 15px;
                margin: 0.8rem 0;
            }

            .stat-item {
                font-size: 0.8rem;
            }

            .contact-buttons {
                flex-direction: column;
                gap: 8px;
            }

            .contact-btn {
                min-width: auto;
                width: 100%;
                padding: 10px;
                font-size: 0.85rem;
            }

            .about-text {
                font-size: 0.85rem;
            }

            .info-card {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .section-title {
                font-size: 1rem;
            }

            .parts-grid, .makes-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 0.5rem;
            }

            .part-item, .make-item {
                padding: 0.6rem;
                font-size: 0.8rem;
            }

            .location-content {
                gap: 1rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
                gap: 0.5rem;
            }

            .ad-cards {
                padding: 1.5rem 1rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .product-image {
                height: 180px;
            }

            .section-text h3 {
                font-size: 1.3rem;
            }

            .product-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {
            .shop-name {
                font-size: 1.3rem;
            }

            .contact-buttons {
                max-width: 400px;
                margin-left: auto;
                margin-right: auto;
            }

            .profile-content {
                padding: 1.2rem;
            }

            .parts-grid, .makes-grid {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        @media (min-width: 769px) {
            .location-content {
                grid-template-columns: 1fr 2fr;
                align-items: start;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            }
        }

        @media (min-width: 993px) {
            .shop-name {
                font-size: 1.6rem;
            }

            .contact-btn {
                font-size: 1rem;
                padding: 14px 20px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            }
        }

        /* Fix for profile image responsiveness */
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Full width container */
        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        /* Ripple effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }

        .contact-btn {
            position: relative;
            overflow: hidden;
        }
        .pc-card {
    position: relative;
    width: 100%;
    max-width: 800px;
    margin: 0 auto 50px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    background: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.pc-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

/* Cover Section */
.pc-cover-section {
    position: relative;
    height: 280px;
    overflow: hidden;
}

.pc-cover-image {
    object-fit: cover;
    height: 100%;
    width: 100%;
    transition: transform 0.5s ease;
}

.pc-card:hover .pc-cover-image {
    transform: scale(1.05);
}

.pc-cover-overlay {
    background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.4) 100%);
}

/* Profile Top Section */
.pc-profile-top {
    position: absolute;
    bottom: -60px;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
}

.pc-profile-avatar {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.pc-card:hover .pc-profile-avatar {
    border-color: var(--accent-color);
    transform: scale(1.05);
}

/* Social Icons */
.pc-social-icons {
    margin-top: 15px;
    display: flex;
    justify-content: center;
    gap: 10px;
}

.pc-social-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    color: #fff;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.2);
}

.pc-facebook { background: linear-gradient(135deg, #3b5998, #8b9dc3); }
.pc-tiktok { background: linear-gradient(135deg, #000000, #69c9d0); }
.pc-twitter { background: linear-gradient(135deg, #1da1f2, #aab8c2); }

.pc-social-icon:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    border-color: rgba(255,255,255,0.5);
}

/* Profile Content */
.pc-profile-content {
    padding: 70px 30px 30px;
    text-align: center;
    background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
}

.pc-shop-name {
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--secondary-color);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
}

.pc-verified-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: #fff;
    padding: 6px 15px;
    font-size: 0.85rem;
    font-weight: 600;
    border-radius: 20px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    transition: all 0.3s ease;
}

.pc-verified-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(40, 167, 69, 0.4);
}

.pc-verified-badge i {
    font-size: 0.9rem;
}

/* Shop Stats */
.pc-shop-stats {
    margin: 20px 0;
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.pc-stat-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 1rem;
    color: black;
    font-weight: 500;
    padding: 8px 16px;
    background: rgba(255,255,255,0.8);
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    font-weight: bold;
}

.pc-stat-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    background: #fff;
}

/* Contact Buttons */
.pc-contact-buttons {
    margin-top: 25px;
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

.pc-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    font-size: 0.95rem;
    font-weight: 600;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.pc-btn-success {
    background: linear-gradient(135deg, #25d366, #128c7e);
    color: white;
}

.pc-btn-warning {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    color: white;
}

.pc-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    text-decoration: none;
    color: white;
}

.pc-btn-success:hover {
    background: linear-gradient(135deg, #128c7e, #25d366);
}

.pc-btn-warning:hover {
    background: linear-gradient(135deg, #fd7e14, #ffc107);
}

/* Responsive Design */
@media (max-width: 768px) {
    .pc-card {
        max-width: 95%;
        margin: 0 auto 30px;
        border-radius: 15px;
    }
    
    .pc-cover-section {
        height: 220px;
    }
    
    .pc-profile-avatar {
        width: 100px;
        height: 100px;
    }
    
    .pc-profile-top {
        bottom: -50px;
    }
    
    .pc-profile-content {
        padding: 60px 20px 25px;
    }
    
    .pc-shop-name {
        font-size: 1.8rem;
        flex-direction: column;
        gap: 8px;
    }
    
    .pc-shop-stats {
        gap: 15px;
    }
    
    .pc-stat-item {
        font-size: 0.9rem;
        padding: 6px 12px;
    }
    
    .pc-contact-buttons {
        gap: 10px;
    }
    
    .pc-btn {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .pc-cover-section {
        height: 180px;
    }
    
    .pc-profile-avatar {
        width: 80px;
        height: 80px;
        border-width: 3px;
    }
    
    .pc-shop-name {
        font-size: 1.5rem;
    }
    
    .pc-social-icon {
        width: 35px;
        height: 35px;
    }
    
    .pc-contact-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .pc-btn {
        width: 200px;
        justify-content: center;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.pc-card {
    animation: fadeInUp 0.6s ease-out;
}





#productGrid1 {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 cards per row */
    gap: 15px; /* space between cards */
 
   
}

#productGrid1 .card {
    width: 100%;
    padding: 0; /* remove all padding */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    height: 470px;
}


#productGrid1 .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    border-color: #aaa;
}

/* Card image */
#productGrid1 .card img {
    width: 100%;
    height: 150px;
    object-fit: contain;
    background-color: white;
    padding: 5px;
}


#productGrid1 .card-body {
    padding: 10px; /* optional, only inner spacing */
}

/* Card title */
#productGrid1 .card-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
    line-height: 1.2em;
    height: 3.6em; /* limit to 2 lines */
    overflow: hidden;
}

/* Price */
#productGrid1 .price {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Meta info */
#productGrid1 .meta {
    font-size: 14px;
    margin-bottom: 10px;
    line-height: 1.4;
}

/* Buttons */
#productGrid1 .buttons {
    display: flex;
    gap: 10px;
}

#productGrid1 .buttons a {
    flex: 1;
    text-align: center;
    padding: 10px;
    border-radius: 6px;
    font-weight: bold;
    text-decoration: none;
    color: #fff;

}



#productGrid1 .buttons a.call {
    background: var(--accent-color);
    padding: 10px;       /* same as WhatsApp button */
    height: auto;        /* remove fixed 30px */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;  /* same as WhatsApp */
    font-weight: bold;
    color: #fff;
}
@media (max-width: 1024px) {
    #productGrid1 {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    #productGrid1 {
        grid-template-columns: 1fr;
    }
}
/* ======= Responsive 992px (Tablet + Mobile Large) ======= */
@media (max-width: 992px) {

    .hero-section_p {
        height: auto;
        padding: 30px 20px;
    }

    .hero_section_text h1 {
        font-size: 2.5rem !important;
        padding: 0 20px;
    }

    .secound_hero_section {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 30px;
        padding: 0 20px;
        height: auto;
    }

    .part_finder_card {
        width: 100%;
        margin-top: 0;
        margin-left: 0;
        display: flex;
        justify-content: center;
    }

    .car {
        width: 100%;
        max-width: 420px;
    }

    .hero_image_section {
        width: 100%;
        margin-top: 20px;
        margin-right: 0;
        text-align: center;
    }

    .hero_image_section img {
        width: 90%;
        height: auto;
        max-width: 380px;
    }
}

/* ======= Responsive 768px (Mobile) ======= */
@media (max-width: 768px) {

    .hero_section_text h1 {
        font-size: 2rem !important;
        line-height: 1.2;
    }

    .car {
        padding: 15px;
        border-radius: 15px;
    }

    .hero_image_section img {
        max-width: 300px;
        margin-top: 10px;
    }

    .find-btn {
        font-size: 16px;
        height: 45px;
    }
}

/* ======= Responsive 480px (Small Mobile) ======= */

.buttons a.whatsapp,
.buttons a.call {
    flex: 1;                    /* equal width */
    text-align: center;
    padding: 10px;              /* same padding */
    height: 50px;               /* fixed height */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    font-weight: bold;
    color: #fff;
    text-decoration: none;
    transition: 0.3s ease;
}

/* Separate colors */
.buttons a.whatsapp {
    background: #198754;
}

.buttons a.call {
    background: var(--accent-color);
}

.step-icon {
    width: 200px !important;
    height: 200px !important;
    margin: 0 auto 20px auto;
}

.step-icon img {
    width: 200px;
    height: 200px;
    object-fit: contain;
}
    </style>

    <!-- JS -->
    <script>
        function contactSupplier(isActive, whatsapp, title) {
            if (isActive === '1') {
                const message = encodeURIComponent(`Hello, I'm interested in: ${title}`);
                const cleanWhatsapp = whatsapp.replace(/\D/g, '');
                window.open(`https://wa.me/${cleanWhatsapp}?text=${message}`, '_blank');
            } else {
                alert('Supplier is currently inactive');
            }
        }

        function callSupplier(isActive, whatsapp) {
            if (isActive === '1') {
                window.location.href = `tel:${whatsapp}`;
            } else {
                alert('Supplier is currently inactive');
            }
        }

        function openWhatsApp() {
            window.open("https://wa.me/923001234567", "_blank");
        }

        function makeCall() {
            window.location.href = "tel:+923001234567";
        }

        function openFacebook() {
            window.open("https://facebook.com", "_blank");
        }

        function openTwitter() {
            window.open("https://twitter.com", "_blank");
        }

        function openLinkedIn() {
            window.open("https://linkedin.com", "_blank");
        }

        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modal.style.display = 'block';
            modalImg.src = src;
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.style.display = 'none';
        }

        // Add smooth scroll behavior and ripple effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add click ripple effect to buttons
            document.querySelectorAll('.contact-btn, .btn-product').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    this.appendChild(ripple);

                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                    ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Smooth scroll for internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeImageModal();
                }
            });
        });
    </script>
@endsection
