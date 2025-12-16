@extends('supplierPanel.layout.main')

@section('main-section')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(session('success'))
    <script>
        swal("Success!", "{{ session('success') }}", "success");
    </script>
@endif

@if(session('error'))
    <script>
        swal("Error!", "{{ session('error') }}", "error");
    </script>
@endif

<style>
.ad-item {
    padding: 15px;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: background 0.2s;
}
.ad-item:hover {
    background: #f9f9f9;
}
.ad-image {
    width: 150px;
    height: 100px;
    flex-shrink: 0;
    border-radius: 5px;
    overflow: hidden;
    background: #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ad-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}
.ad-image img:hover {
    transform: scale(1.05);
}
.ad-details {
    flex-grow: 1;
}
.ad-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}
.ad-price {
    color: #d9534f;
    font-weight: bold;
    margin-bottom: 5px;
}
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            @php
                $shop_id = Auth::guard('supplier')->user()->shop->id;
            @endphp

            <!-- Top Navigation -->
            <div class="row mb-4">
                <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-wrap align-items-center">
                    <a class="text-decoration-none me-3 fw-semibold" href="{{ route('supplier.ads.index', $shop_id) }}">All Ads</a>
                    <a class="text-decoration-none me-3 fw-semibold" href="{{ route('supplier.ads.active', $shop_id) }}">Active Ads</a>
                    <a class="text-decoration-none me-3 fw-semibold" href="{{ route('supplier.ads.inactive', $shop_id) }}">Inactive Ads</a>
                    <a class="text-decoration-none me-3 fw-semibold" href="{{ route('supplier.ads.approved', $shop_id) }}">Approved Ads</a>
                    <a class="text-decoration-none fw-semibold" href="{{ route('shop.ads.waiting', $shop_id) }}">Waiting for Approval</a>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-md-end flex-wrap gap-2">
                    <a class="btn btn-orange" href="{{ route('shop.supplier.ads.create') }}">
                        <i class="bi bi-plus-circle me-1"></i> Create New Ad
                    </a>
                    <a class="btn btn-red" href="{{ route('shop.supplier.ads.createCar') }}">
                        <i class="bi bi-car-front me-1"></i> Car Breaking Ad
                    </a>
                </div>
            </div>

            <!-- Ads Listing -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    @forelse ($ads as $ad)
                        @php
                            $images = json_decode($ad->images);
                            $firstImage = $images && count($images) > 0 ? $images[0] : null;
                        @endphp

                        <div class="ad-item row align-items-center">
                            <!-- Image -->
                            <div class="col-md-2 ad-image">
                                @if($firstImage)
                                    <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $ad->title }}">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="col-md-8 ad-details">
                                <div class="ad-title">
                                    <h5 class="fw-semibold mb-0">{{ $ad->title }}</h5>
                                    @if ($ad->is_approved == '1')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </div>
                                <div class="ad-price">AED {{ number_format($ad->price, 2) }}</div>
                                <p class="text-muted small mb-0">{{ Str::limit($ad->description, 100) }}</p>
                            </div>

                            <!-- Actions -->
                            <div class="col-md-2 text-end">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" id="dropdownMenuButton{{ $ad->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $ad->id }}">
                                        <li><a class="dropdown-item" href="{{ route('shop.ads.edit', [$ad->id, $ad->slug]) }}"><i class="bi bi-pencil-square me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="{{ route('supplier.ads.toggleActive', ['type' => $ad->ad_type, 'id' => $ad->id]) }}">
                                            @if ($ad->is_active)
                                                <i class="bi bi-eye-slash me-2"></i>Deactivate
                                            @else
                                                <i class="bi bi-eye me-2"></i>Activate
                                            @endif
                                        </a></li>
                                        <li><a class="dropdown-item text-danger" href="{{ route('supplier.ads.delete', ['type' => $ad->ad_type, 'id' => $ad->id]) }}"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted my-4">No ads found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
