@extends('adminPanel.layout.main')
@section('main-section')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3>Approve Car Ads</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm border-0 rounded-3 mt-4">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Spare Parts Ads</h5>

                @if ($carAds->count() > 0)
                <div class="row g-4">
                    @foreach ($carAds as $ad)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm rounded-3 hover-card">
                            @php
                                $images = json_decode($ad->images, true);
                            @endphp

                            @if (is_array($images) && isset($images[0]))
                                <img src="{{ asset('storage/' . $images[0]) }}"
                                     class="card-img-top img-fluid rounded-top"
                                     style="height: 200px; object-fit: cover;"
                                     alt="Product">
                            @else
                                <img src="{{ asset('assets/placeholder.png') }}"
                                     class="card-img-top img-fluid rounded-top"
                                     style="height: 200px; object-fit: cover;"
                                     alt="No Image">
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-semibold mb-2">{{ $ad->title }}</h6>

                                <ul class="list-unstyled small text-muted mb-3">
                                    <li><b>Availability:</b> <span class="text-success">In Stock</span></li>
                                    <li><b>Condition:</b> {{ $ad->condition }}</li>
                                    <li><b>Delivery:</b> Ask Supplier</li>
                                    <li><b>Warranty:</b> Ask Supplier</li>
                                </ul>

                                @if (!$ad->is_approved)
                                    <form action="{{ route('admin.carAds.approve', $ad->id) }}"
                                          method="POST" class="mt-auto">
                                        @csrf
                                        <button type="submit" class="btn btn-success w-100">
                                            Approve
                                        </button>
                                    </form>
                                @else
                                    <span class="badge bg-success mt-auto align-self-start">Approved</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                    <p class="text-muted">No car ads available for approval.</p>
                @endif

            </div>
        </div>
    </section>
</div>

{{-- Extra Styling for Hover Effect --}}
@push('styles')
<style>
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
</style>
@endpush

@endsection
