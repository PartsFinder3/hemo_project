@extends('Frontend.layout.main')
<style>
    /* main{
        height: 60vh;
    } */

    #arrow-down {
        font-size: 50px
    }

    .supplier-card {
        background: var(--primary-color);
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .supplier-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .supplier-image {
        width: 120px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }

    .supplier-title {
        color: #007bff;
        font-size: 1.25rem;
        font-weight: 600;
        text-decoration: none;
        margin-bottom: 8px;
        display: block;
    }

    .supplier-title:hover {
        color: var(--accent-color);
        text-decoration: none;
    }

    .supplier-subtitle {
        color: var(--tertiary-color);
        font-size: 0.95rem;
        margin-bottom: 12px;
    }

    .feature-badge {
        background: #e8f5e8;
        color: #28a745;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        margin-bottom: 5px;
        margin-right: 8px;
    }

    .feature-badge i {
        margin-right: 5px;
        font-size: 0.8rem;
    }

    .location-info {
        color: var(--tertiary-color);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .location-info i {
        color: #dc3545;
        margin-right: 5px;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .btn-visit {
        background: var(--accent-color);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-visit:hover {
        background: #e66600;
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .btn-whatsapp {
        background: var(--whatsapp-btn);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-whatsapp:hover {
        background: #239b4e;
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .btn-call {
        background: #007bff;
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-call:hover {
        background: #0056b3;
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .action-buttons i {
        margin-right: 8px;
        font-size: 0.9rem;
    }

    .card-body {
        padding: 20px;
    }

    @media (max-width: 768px) {
        .supplier-image {
            width: 100px;
            height: 80px;
        }

        .supplier-title {
            font-size: 1.1rem;
        }

        .action-buttons {
            flex-direction: row;
            justify-content: space-between;
        }

        .action-buttons a {
            flex: 1;
            margin: 0 2px;
            font-size: 0.8rem;
            padding: 6px 8px;
        }
    }

    @media (max-width: 576px) {
        .card-body {
            padding: 15px;
        }

        .supplier-card {
            margin-bottom: 15px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 6px;
        }
    }

    .container {
        max-width: 1200px;
    }

    h1 {
        color: var(--secondary-color);
        margin-bottom: 30px;
        font-weight: 700;
    }
    body, main, header, nav, .hero-section, .hero-section_p {
    background-image: none !important;
    background: none !important;
}
</style>
@section('main-section')

    <div class="container py-5">
        <h1 class="text-center mb-5 shop-tag">Auto Spare Parts Suppliers</h1>

        <div class="row">
            <!-- Supplier Card -->
            @foreach ($shops as $shop)
                @php
                    $p = $shop->profile;
                    $contact = $shop->supplier->whatsapp;
                @endphp
                <div class="col-12 mb-4">
                    <div class="supplier-card shadow-sm rounded p-3 bg-white h-100">
                        <div class="row align-items-center">

                            <!-- Image -->
                            <div class="col-md-2 col-sm-3 col-4 text-center">
                                <div class="supplier-image-wrapper mb-2">
                                    @if ($p && $p->profile_image)
                                        <img src="{{ asset('storage/' . $p->profile_image) }}" alt="Shop Logo"
                                            class="supplier-image">
                                    @else
                                        <img src="https://via.placeholder.com/120x100/4a90e2/ffffff?text=Auto+Parts"
                                            alt="Default Image" class="supplier-image">
                                    @endif
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="col-md-7 col-sm-6 col-8">
                               <div class="row">
                                <a href="{{ route('view.shop', $shop->id) }}" class="supplier-title fw-bold d-block mb-2">
                                    {{ $shop->name ?? 'Shop Name Here' }}
                                </a>
                             @if ($shop->supplier->is_verified)
                                    <span class="badge">Verified</span>
                                @endif
                               </div>
                                <div class="feature-badge text-muted small mb-1">
                                    <i class="fas fa-check-circle text-success me-1"></i>
                                    Warranty: Ask Supplier
                                </div>

                                <div class="feature-badge text-muted small mb-1">
                                    <i class="fas fa-check-circle text-success me-1"></i>
                                    Delivering: Ask Supplier
                                </div>

                                <div class="location-info text-muted small">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    {{ $shop->supplier->city->name ?? 'City Not Available' }}
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="col-md-3 col-sm-3 col-12 text-md-end mt-3 mt-md-0">
                                <div class="d-flex d-md-block flex-wrap gap-2">
                                    <a href="{{ route('view.shop', $shop->id) }}" class="btn btn-sm btn-orange w-100 my-1">
                                        <i class="fas fa-store me-1"></i> Visit Shop
                                    </a>
                                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $contact) }}" target="_blank"
                                        class="btn btn-sm btn-success w-100 my-1">
                                        <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                    </a>
                                    <a href="tel:{{ $contact }}" class="btn btn-sm btn-warning w-100 my-1">
                                        <i class="fas fa-phone me-1"></i> Call
                                    </a>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection
