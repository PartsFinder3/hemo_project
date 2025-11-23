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
.supplier-title span {
    float: right;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-left: 8px;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    text-shadow: 0 1px 1px rgba(0,0,0,0.1);
    box-shadow: 0 2px 4px rgba(40, 167, 69, 0.2);
    transition: all 0.3s ease;
}

.supplier-title span::before {
    content: "✓";
    font-weight: bold;
    font-size: 0.7rem;
}

.supplier-title:hover span {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
    background: linear-gradient(135deg, #218838, #1e9e8a);
}

/* Alternative icon version using Font Awesome */
.supplier-title span.verified-badge {
    background: linear-gradient(135deg, #007bff, #6610f2);
}

.supplier-title span.verified-badge::before {
    content: "\f058"; /* Font Awesome check-circle icon */
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 0.7rem;
}

/* For premium suppliers */
.supplier-title span.premium-badge {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
}

.supplier-title span.premium-badge::before {
    content: "⭐";
    font-size: 0.65rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .supplier-title span {
        font-size: 0.7rem;
        padding: 3px 6px;
        margin-left: 6px;
    }
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
                                        @if ($shop->supplier?->is_verified)
                                            <span class="verified-badge">Verified</span>
                                        @endif
                                    </a>
                                     

                                        <div class="feature-badges mb-2">
                                            <span class="badge badge-warranty"><i class="fas fa-shield-alt me-1"></i> Warranty: Ask Supplier</span>
                                            <span class="badge badge-delivery"><i class="fas fa-truck me-1"></i> Delivering: Ask Supplier</span>
                                            <span class="badge badge-city"><i class="fas fa-map-marker-alt me-1"></i> {{ $shop->supplier->city->name ?? 'City Not Available' }}</span>
                                        </div>
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
