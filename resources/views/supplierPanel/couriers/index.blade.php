@extends('supplierPanel.layout.main')
@section('main-section')
    <header class="mb-4">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="container-fluid" style="overflow: hidden">
        <div class="row mb-4">
            <div class="col-12 col-md-12 d-flex flex-column justify-content-center align-items-center">
                <h2 class="fw-bold">Account Settings</h2>
                <p class="text-muted">Manage your Courier Services here.</p>
            </div>
        </div>

        {{-- Alerts --}}
        <div class="row mb-3">
            <div class="col-12 col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>

        {{-- Update Password --}}
        <div class="row justify-content-center p-3">
            <div class="col-12 col-md-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-gradient-primary text-white text-center py-3">
                        <h5 class="mb-0 fw-bold">Courier Companies Listed on Our Platform</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="accordion" id="accordionExample">
                            @foreach ($couriers as $courier)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        {{ $courier->name }}
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>Contact Number: {{ $courier->phone }}</li>
                                            <li>Delivery Areas: {{ $courier->countries }}</li>
                                            <li>Address: {{ $courier->address }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>

    </style>
@endsection
