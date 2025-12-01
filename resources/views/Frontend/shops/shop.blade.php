@extends('Frontend.layout.main')
@section('main-section')

<div class="hero-section">
    <div class="pc-card">

        <!-- Cover Section -->
        <div class="pc-cover-section">
            <img src="{{ $profile && $profile->cover ? asset('storage/'. $profile->cover) : asset('assets/compiled/jpg/Head.png') }}"
                 class="pc-cover-image" alt="Cover">
            <div class="pc-cover-overlay"></div>

            <!-- Profile Avatar -->
            <div class="pc-profile-top">
                @if ($profile && $profile->profile_image)
                    <img src="{{ asset('storage/' . $profile->profile_image) }}"
                         class="pc-profile-avatar" alt="Shop Logo">
                @endif
            </div>
        </div>

        <!-- Profile Content -->
        <div class="pc-profile-content">
            <h1 class="pc-shop-name">
                {{ $shop->name ?? 'Shop Name Here' }}
                @if ($shop->supplier?->is_verified)
                    <span class="pc-verified-badge"><i class="fas fa-check-circle"></i> Verified</span>
                @endif
            </h1>

            <div class="pc-shop-stats">
                <span class="pc-stat-item">📦 {{$totalAds}} Items Listed</span>
                <span class="pc-stat-item">💬 {{$inquiryCount}} Enquiries</span>
            </div>

            <div class="pc-contact-buttons">
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

<style>
    /* Hero / Profile Card */
    .hero-section { padding: 2rem 0; }
    .pc-card { max-width: 900px; margin: 0 auto 3rem; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .pc-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.15); }
    .pc-cover-section { position: relative; height: 300px; overflow: hidden; }
    .pc-cover-image { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .pc-cover-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.2), rgba(0,0,0,0.4)); }
    .pc-profile-top { position: absolute; bottom: -60px; left: 50%; transform: translateX(-50%); }
    .pc-profile-avatar { width: 130px; height: 130px; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 8px 25px rgba(0,0,0,0.15); }

    .pc-profile-content { text-align: center; padding: 80px 30px 30px; background: #fff; }
    .pc-shop-name { font-size: 2rem; font-weight: 700; color: #333; display: flex; justify-content: center; align-items: center; gap: 10px; flex-wrap: wrap; }
    .pc-verified-badge { display: inline-flex; align-items: center; gap: 5px; background: #28a745; color: #fff; padding: 6px 15px; font-size: 0.85rem; border-radius: 20px; box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3); }
    .pc-shop-stats { margin: 20px 0; display: flex; justify-content: center; gap: 25px; flex-wrap: wrap; }
    .pc-stat-item { background: rgba(255,255,255,0.8); padding: 8px 16px; border-radius: 12px; font-weight: bold; color: #333; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .pc-contact-buttons { display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; margin-top: 15px; }
    .pc-btn { padding: 12px 25px; border-radius: 12px; font-weight: 600; color: #fff; text-decoration: none; transition: 0.3s ease; display: flex; align-items: center; gap: 8px; }
    .pc-btn-success { background: #25d366; }
    .pc-btn-warning { background: #ff7700; }
    .pc-btn:hover { opacity: 0.9; }

    /* Info Card */
    .info-card { background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 2rem; }
    .section-title { font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem; }
    .hours-grid { display: grid; gap: 0.5rem; }
    .day-row { display: flex; justify-content: space-between; padding: 0.5rem 1rem; background: #f8f9fa; border-radius: 6px; }

    /* Product Cards Grid */
    .products-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin: 2rem 0; }
    .product-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: flex; flex-direction: column; transition: 0.3s; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
    .product-image { width: 100%; height: 200px; overflow: hidden; cursor: pointer; }
    .product-image img { width: 100%; height: 100%; object-fit: cover; transition: 0.3s; }
    .product-card:hover .product-image img { transform: scale(1.05); }
    .product-body { padding: 1rem; display: flex; flex-direction: column; gap: 0.5rem; flex: 1; }
    .product-title { font-weight: 600; color: #333; font-size: 1.1rem; text-decoration: none; }
    .product-title:hover { color: #198754; }
    .product-meta { font-size: 0.9rem; color: #666; display: flex; flex-direction: column; gap: 3px; margin-bottom: 1rem; }
    .product-buttons { display: flex; gap: 10px; margin-top: auto; }
    .btn-product { flex: 1; text-align: center; padding: 10px; border-radius: 8px; font-weight: 600; color: #fff; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 5px; transition: 0.3s; }
    .btn-product.whatsapp { background: #198754; }
    .btn-product.call { background: #ff7700; }
    .btn-product:hover { opacity: 0.9; }

    /* Modal */
    .image-modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9); display: flex; align-items: center; justify-content: center; }
    .modal-content { position: relative; max-width: 90%; max-height: 90%; }
    .modal-image { max-width: 100%; max-height: 100%; border-radius: 8px; }
    .modal-close { position: absolute; top: 20px; right: 30px; font-size: 35px; font-weight: bold; color: white; cursor: pointer; }

    /* Responsive */
    @media (max-width: 768px) {
        .pc-cover-section { height: 220px; }
        .pc-profile-avatar { width: 100px; height: 100px; }
        .pc-shop-name { font-size: 1.8rem; }
        .products-grid { grid-template-columns: 1fr; gap: 15px; }
    }
</style>

@endsection
