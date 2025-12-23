@extends('supplierPanel.layout.main')
@section('main-section')

    <!-- Search Section -->
    <div class="search-section py-4 bg-light">
        <div class="container">
            <!-- Mobile Toggle Button -->
            <div class="d-lg-none mb-3">
                <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse"
                    data-bs-target="#searchFilters" aria-expanded="false">
                    <i class="fas fa-search me-2"></i> Show Filters
                    <i class="fas fa-chevron-down ms-2"></i>
                </button>
            </div>

            <!-- Collapsible Search Form -->
            <div class="collapse show" id="searchFilters">
                <form method="GET" action="{{ route('supplier.panel') }}">
                    <div class="row g-3 mb-3">
                        <!-- Time Range -->
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label d-block d-lg-none">Time Range</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <select class="form-select" name="time_range">
                                    <option value="">All Time</option>
                                    <option value="24h" {{ request('time_range') == '24h' ? 'selected' : '' }}>Last 24
                                        Hours</option>
                                    <option value="7d" {{ request('time_range') == '7d' ? 'selected' : '' }}>Last 7 Days
                                    </option>
                                    <option value="30d" {{ request('time_range') == '30d' ? 'selected' : '' }}>Last 30
                                        Days</option>
                                    <option value="1y" {{ request('time_range') == '1y' ? 'selected' : '' }}>Last Year
                                    </option>
                                    <option value="custom" {{ request('time_range') == 'custom' ? 'selected' : '' }}>Custom
                                        Range</option>
                                </select>
                            </div>
                        </div>

                        <!-- Make -->
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label d-block d-lg-none">Make</label>
                            <select class="form-select" name="make" id="makeSelect">
                                <option value="">Select Make</option>
                                @foreach ($makes as $make)
                                    <option value="{{ $make->id }}"
                                        {{ request('make') == $make->id ? 'selected' : '' }}>{{ $make->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Model -->
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label d-block d-lg-none">Model</label>
                            <select class="form-select" name="model" id="modelSelect">
                                <option value="">Select Model</option>
                                @if (request('make'))
                                    @foreach (\App\Models\CarModels::where('car_make_id', request('make'))->get() as $model)
                                        <option value="{{ $model->id }}"
                                            {{ request('model') == $model->id ? 'selected' : '' }}>{{ $model->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- City -->
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label d-block d-lg-none">City</label>
                            <select class="form-select" name="city">
                                <option value="">All Cities</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ request('city') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Min Year -->
                        <div class="col-lg-1 col-md-6">
                            <label class="form-label d-block d-lg-none">Min Year</label>
                            <select class="form-select" name="min_year">
                                <option value="">Min</option>
                                @for ($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}"
                                        {{ request('min_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Max Year -->
                        <div class="col-lg-1 col-md-6">
                            <label class="form-label d-block d-lg-none">Max Year</label>
                            <select class="form-select" name="max_year">
                                <option value="">Max</option>
                                @for ($year = date('Y'); $year >= 2000; $year--)
                                    <option value="{{ $year }}"
                                        {{ request('max_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- Parts & Action Buttons -->
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-4 col-md-6">
                            <label class="form-label d-block d-lg-none">Parts</label>
                            <input type="text" class="form-control" name="parts" placeholder="Search parts..."
                                value="{{ request('parts') }}">
                        </div>
                        <div class="col-lg-2 d-none d-lg-block">
                            <button type="submit" class="btn btn-primary w-100"><i
                                    class="fas fa-search me-2"></i>Search</button>
                        </div>
                        <div class="col-lg-2 d-none d-lg-block">
                            <a href="{{ route('supplier.panel') }}" class="btn btn-outline-secondary w-100"><i
                                    class="fas fa-times me-2"></i>Clear</a>
                        </div>
                    </div>

                    <!-- Custom Date Range -->
                    <div class="row g-3 mt-3" id="customDateRange"
                        style="display: {{ request('time_range') == 'custom' ? 'flex' : 'none' }};">
                        <div class="col-12">
                            <div class="card border-primary shadow-sm">
                                <div class="card-header bg-primary text-white py-2">
                                    <h6 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Custom Date Range</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label"><i
                                                    class="fas fa-calendar-day text-success me-1"></i>From Date</label>
                                            <input type="date" name="from_date" class="form-control"
                                                value="{{ request('from_date') }}" max="{{ date('Y-m-d') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"><i class="fas fa-calendar-day text-danger me-1"></i>To
                                                Date</label>
                                            <input type="date" name="to_date" class="form-control"
                                                value="{{ request('to_date') }}" max="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Action Buttons -->
                    <div class="row g-3 mt-3 d-lg-none">
                        <div class="col-6"><button type="submit" class="btn btn-primary w-100"><i
                                    class="fas fa-search me-2"></i>Search</button></div>
                        <div class="col-6"><a href="{{ route('supplier.panel') }}"
                                class="btn btn-outline-secondary w-100"><i class="fas fa-times me-2"></i>Clear</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Active Filters -->
    @if (request()->hasAny(['make', 'model', 'parts', 'city', 'min_year', 'max_year', 'time_range', 'from_date', 'to_date']))
        <div class="container mt-3">
            <div class="alert alert-info d-flex flex-wrap justify-content-between align-items-center shadow-sm">
                <div>
                    <strong><i class="fas fa-filter me-2"></i>Active Filters:</strong>
                    @if (request('make'))
                        <span class="badge bg-primary me-1">Make:
                            {{ $makes->find(request('make'))->name ?? 'Unknown' }}</span>
                    @endif
                    @if (request('model'))
                        <span class="badge bg-primary me-1">Model:
                            {{ \App\Models\CarModels::find(request('model'))->name ?? 'Unknown' }}</span>
                    @endif
                    @if (request('parts'))
                        <span class="badge bg-primary me-1">Parts: {{ request('parts') }}</span>
                    @endif
                    @if (request('city'))
                        <span class="badge bg-primary me-1">City:
                            {{ $cities->find(request('city'))->name ?? 'Unknown' }}</span>
                    @endif
                    @if (request('min_year'))
                        <span class="badge bg-success me-1">Min Year: {{ request('min_year') }}</span>
                    @endif
                    @if (request('max_year'))
                        <span class="badge bg-success me-1">Max Year: {{ request('max_year') }}</span>
                    @endif
                    @if (request('time_range'))
                        <span class="badge bg-warning me-1">Time:
                            {{ ucfirst(str_replace('_', ' ', request('time_range'))) }}</span>
                    @endif
                </div>
                <a href="{{ route('supplier.panel') }}" class="btn btn-sm btn-outline-danger"><i
                        class="fas fa-times me-1"></i>Clear All</a>
            </div>
        </div>
    @endif

    <!-- Inquiry Listings -->
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @php $uniqueUsages = $usages->unique('buyer_inquiry_id'); @endphp

        @if ($uniqueUsages->count() > 0)
            <div class="row g-3">
                @foreach ($uniqueUsages as $usage)
                    @php
                        $inquiry = $usage->buyerInquiry;
                        $shopPartIds = Auth::guard('supplier')->user()->shop->parts->pluck('part_id')->toArray();
                        $matchingParts = $inquiry->partsList->whereIn('id', $shopPartIds)->pluck('name')->toArray();
                    @endphp

                    @if (count($matchingParts) > 0)
                        <div class="col-md-12">
                            <div
                                class="card shadow-sm mb-3 {{ $inquiry->inquiryUsages->where('buyer_inquiry_id', $inquiry->id)->first()?->is_open ? 'opacity-50' : '' }}">
                                <div class="card-body d-flex justify-content-between align-items-center">

                                    <!-- Left Content -->
                                    <div>
                                        <h6 class="card-title mb-2">
                                            {{ $inquiry->carMake->name ?? 'Unknown' }}
                                            {{ $inquiry->carModel->name ?? 'Unknown' }}
                                            {{ $inquiry->year->year ?? 'Unknown' }}
                                        </h6>
                                        <p class="text-muted mb-1">
                                            {{ $inquiry->buyer->city->name ?? 'United Arab Emirates' }} |
                                            Ref: PF-{{ str_pad($inquiry->id, 7, '0', STR_PAD_LEFT) }} |
                                            {{ $inquiry->created_at->format('d-M-Y h:i A') }}
                                        </p>
                                        <p class="mb-1"><strong>Parts:</strong> {{ implode(' | ', $matchingParts) }}</p>
                                        <p class="mb-0"><strong>Condition:</strong>
                                            {{ $inquiry->condition ?? 'Unknown' }}</p>
                                    </div>

                                    <!-- Right Action Buttons (Icons Only) -->
                                    <div class="d-flex gap-4 ms-3">
                                        <span class="d-flex align-items-center flex-column text-center">
                                            <a href="tel:{{ $inquiry->buyer->whatsapp ?? '' }}"
                                                class="btn  btn-info rounded-circle">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                            Click To Call
                                        </span>
                                        <span class="d-flex align-items-center flex-column text-center">
                                            <a href="{{ route('supplier.shop.whatsappQuote', $inquiry->id) }}"
                                            target="_blank" class="btn  btn-success rounded-circle">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        Click To WhatsApp
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <p class="text-center text-muted">No inquiries found.</p>
        @endif
    </div>

    @php
        $user = Auth::guard('supplier')->user();
        $has_shop = $user->shop->is_active;
        $shop_id = $user->shop->id;
    @endphp

    <!-- Floating Create Ad Button -->
    @if ($has_shop)
        <a href="{{ route('supplier.ads.index', $shop_id) }}"
            class="position-fixed bottom-0 end-0 m-4 btn btn-danger btn-lg rounded-circle shadow-lg"
            style="width:60px;height:60px;display:flex;align-items:center;justify-content:center;">
            <i class="fas fa-plus"></i>
        </a>
    @endif

@endsection

@push('styles')
    <style>
        /* Modern clean styling */
        .search-section .form-label {
            font-weight: 500;
        }

        .listing-item .card {
            transition: transform 0.2s ease;
        }

        .listing-item .card:hover {
            transform: translateY(-3px);
        }

        .btn-orange {
            background-color: #ff6b00;
            color: #fff;
            border: none;
        }

        .btn-orange:hover {
            background-color: #e65a00;
            color: #fff;
        }

        .btn-red {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-red:hover {
            background-color: #c82333;
            color: #fff;
        }
    </style>
@endpush
