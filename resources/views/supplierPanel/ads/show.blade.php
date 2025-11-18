@extends('supplierPanel.layout.main')

@section('main-section')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                @php
                    $shop_id = Auth::guard('supplier')->user()->shop->id;
                @endphp
                <!-- Top Navigation -->
                <div class="row mb-4">
                    <!-- Links -->
                    <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-wrap align-items-center">
                        <a class="text-decoration-none me-3 fw-semibold"
                            href="{{ route('supplier.ads.index', $shop_id) }}">All
                            Ads</a>
                        <a class="text-decoration-none me-3 fw-semibold"
                            href="{{ route('supplier.ads.active', $shop_id) }}">Active
                            Ads</a>
                        <a class="text-decoration-none me-3 fw-semibold"
                            href="{{ route('supplier.ads.inactive', $shop_id) }}">Inactive
                            Ads</a>
                        <a class="text-decoration-none me-3 fw-semibold"
                            href="{{ route('supplier.ads.approved', $shop_id) }}">Approved Ads</a>
                        <a class="text-decoration-none fw-semibold" href="{{ route('shop.ads.waiting', $shop_id) }}">Waiting
                            for
                            Approval</a>
                    </div>

                    <!-- Buttons -->
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
                            <div class="row py-3 border-bottom align-items-center">

                                <!-- Ad Info -->
                                <div class="col-md-10">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h5 class="mb-1 fw-semibold">{{ $ad->title }}</h5>
                                        @if ($ad->is_approved == '1')
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </div>
                                    <h6 class="text-danger fw-bold mb-2">AED {{ number_format($ad->price, 2) }}</h6>
                                    <p class="text-muted small mb-0">{{ $ad->description }}</p>
                                </div>

                                <!-- Dropdown Menu -->
                                <div class="col-md-2 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button"
                                            id="dropdownMenuButton{{ $ad->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="dropdownMenuButton{{ $ad->id }}">
                                            <li>
                                                {{-- <a class="dropdown-item"
                                                    href="{{ route('shop.ads.edit', [$ad->id, $ad->slug]) }}">
                                                    <i class="bi bi-pencil-square me-2"></i>Edit
                                                </a> --}}
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('supplier.ads.toggleActive', ['type' => $ad->ad_type, 'id' => $ad->id]) }}">
                                                    @if ($ad->is_active)
                                                        <i class="bi bi-eye-slash me-2"></i>Deactivate
                                                    @else
                                                        <i class="bi bi-eye me-2"></i>Activate
                                                    @endif
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger"
                                                    href="{{ route('supplier.ads.delete', ['type' => $ad->ad_type, 'id' => $ad->id]) }}">
                                                    <i class="bi bi-trash me-2"></i>Delete
                                                </a>

                                            </li>
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
