@extends('Frontend.layout.main')
@section('main-section')

<div class="hero-section">
    <div class="pc-card">

        <!-- Cover Section -->
        <div class="pc-cover-section position-relative">
            <img src="{{ $profile && $profile->cover ? asset('storage/'. $profile->cover) : asset('assets/compiled/jpg/Head.png') }}"
                 class="pc-cover-image" alt="Cover">

            <!-- Profile Avatar (overlapping) -->
            <div class="pc-profile-top">
                @if ($profile && $profile->profile_image)
                    <img src="{{ asset('storage/' . $profile->profile_image) }}"
                         class="pc-profile-avatar" alt="Shop Logo">
                @else
                    <img src="{{ asset('assets/compiled/jpg/default-avatar.png') }}"
                         class="pc-profile-avatar" alt="Default Logo">
                @endif
            </div>
        </div>

        <!-- Profile Content -->
        <div class="pc-profile-content text-center mt-5">
            <h1 class="pc-shop-name">
                {{ $shop->name ?? 'Shop Name Here' }}
                @if ($shop->supplier?->is_verified)
                    <span class="pc-verified-badge"><i class="fas fa-check-circle"></i> Verified</span>
                @endif
            </h1>

            <div class="pc-shop-stats mt-2">
                <span class="pc-stat-item">📦 {{$totalAds}} Items Listed</span>
                <span class="pc-stat-item">💬 {{$inquiryCount}} Enquiries</span>
            </div>

            <div class="pc-contact-buttons mt-3">
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $shop->supplier->whatsapp) }}" target="_blank" class="pc-btn pc-btn-success">
                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                </a>
                <a href="tel:{{ $shop->supplier->whatsapp }}" class="pc-btn pc-btn-warning">
                    <i class="fas fa-phone me-1"></i> Call
                </a>
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

<!-- Product Cards -->
<div class="products-grid">
    @foreach($shopAds as $ad)
        @php $images = json_decode($ad->images, true); @endphp
        <div class="product-card">
            @if(is_array($images) && isset($images[0]))
                <div class="product-image" onclick="openImageModal('{{ asset($images[0]) }}')">
                    <img src="{{ asset($images[0]) }}" alt="{{ $ad->title }}">
                </div>
            @endif

            <div class="product-body">
                <a href="{{ route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id]) }}" class="product-title">
                    {{ $ad->title }}
                </a>

                <div class="product-meta">
                    <div class="meta-item">Availability: In Stock</div>
                    <div class="meta-item">Delivery: Ask Supplier</div>
                    <div class="meta-item">Warranty: Ask Supplier</div>
                </div>

                <div class="product-buttons">
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $ad->shop->supplier->whatsapp) }}?text={{ urlencode('Hello, I am interested in your ad: ' . $ad->title) }}" 
                       target="_blank" class="btn-product whatsapp">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="javascript:void(0)" class="btn-product call" onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">
                        <i class="fas fa-phone"></i> Call
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Image Modal -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <img id="modalImage" class="modal-image" src="" alt="">
    </div>
</div>

<!-- Refined CSS -->
<style>
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin: 2rem 0;
    }
    .product-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .product-image {
        width: 100%;
        height: 200px;
        overflow: hidden;
        cursor: pointer;
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
        padding: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        flex: 1;
    }
    .product-title {
        font-weight: 600;
        color: #333;
        font-size: 1.1rem;
        text-decoration: none;
    }
    .product-title:hover {
        color: var(--accent-color);
    }
    .product-meta {
        font-size: 0.9rem;
        color: #666;
    }
    .product-buttons {
        display: flex;
        gap: 10px;
        margin-top: auto;
    }
    .btn-product {
        flex: 1;
        text-align: center;
        padding: 10px;
        border-radius: 8px;
        font-weight: 600;
        color: #fff;
        text-decoration: none;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
    .btn-product.whatsapp { background: #198754; }
    .btn-product.call { background: #ff7700; }
    .btn-product:hover { opacity: 0.9; }
    .pc-cover-section {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.pc-cover-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.pc-profile-top {
    position: absolute;
    bottom: -50px; /* overlaps the cover */
    left: 50%;
    transform: translateX(-50%);
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 5px solid #fff;
    background: #fff;
}

.pc-profile-avatar {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.pc-profile-content {
    margin-top: 60px; /* leave space for overlapping avatar */
}

</style>


@endsection
