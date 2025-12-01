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

                        <!-- Profile Image -->
                        <div class="profile-avatar position-absolute bottom-0 start-0" style="margin-left: 100px; margin-bottom: 20px;">
                            @if ($profile && $profile->profile_image)
                                <img src="{{ asset('storage/' . $profile->profile_image) }}"
                                     class="rounded-circle border border-3 border-white shadow"
                                     alt="Shop Logo"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
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

                @if(!empty($images[0]))
                    <img src="{{ asset($images[0]) }}" class="card-img-top img-fluid" alt="Product">
                @endif

                <div class="card-body">
                    <a href="{{ route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id]) }}"
                        class="card-title">{{ $ad->title }}</a>

                    <div class="price">{{ $ad->currency }} {{ $ad->price }}</div>

                    <div class="meta">
                        Availability: In Stock <br>
                        Condition: {{ $ad->condition ?? 'N/A' }} <br>
                        Delivery: Ask Supplier <br>
                        Warranty: Ask Supplier
                    </div>

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
</div>

<!-- Image Modal -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <img id="modalImage" class="modal-image" src="" alt="">
    </div>
</div>

<!-- Essential JS -->
<script>
    function callSupplier(isActive, whatsapp) {
        if (isActive === '1') {
            window.location.href = `tel:${whatsapp}`;
        } else {
            alert('Supplier is currently inactive');
        }
    }

    function openImageModal(src) {
        document.getElementById('imageModal').style.display = 'block';
        document.getElementById('modalImage').src = src;
    }

    function closeImageModal() {
        document.getElementById('imageModal').style.display = 'none';
    }
</script>
@endsection
