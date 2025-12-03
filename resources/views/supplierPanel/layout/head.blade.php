<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - Supplier Dashboard</title>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- Favicons --}}
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">

    {{-- Fonts / Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    {{-- Vendor CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/flatpickr.css') }}">

    <style>
        .btn-transparent {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        .btn-orange {
            background-color: #e95426;
            color: white;
        }

        .btn-orange:hover {
            background-color: #d86a3f;
            color: white;
        }

        .btn-red {
            background: #dc3545;
            color: white;
        }

        .btn-red:hover {
            background: #c82333;
            color: white;
        }

        /* Gradient button for modern look */
        .btn-gradient-primary {
            background: linear-gradient(90deg, #c82333 0%, #d86a3f 100%);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-gradient-primary:hover {
            background: linear-gradient(90deg, #d86a3f 0%, #c82333 100%);
            color: white;
        }

        .bg-gradient-primary {
            background: linear-gradient(90deg, #c82333 0%, #d86a3f 100%) !important;
        }
    </style>
    <style>
        .header-top {
            background-color: #f8f9fa;
            font-size: 0.85rem;
            padding: 5px 0;
        }

        .search-section {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 0;
        }

        .listing-item {
            border: 1px solid #dee2e6;
            margin-bottom: 10px;
            padding: 15px;
            background-color: #fff;
        }

        .listing-header {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .vehicle-title {
            color: #e95426;
            font-weight: bold;
            text-decoration: none;
            font-size: 1.1rem;
        }

        .vehicle-title:hover {
            color: #e95426;
            text-decoration: underline;
        }

        .part-description {
            color: #333;
            margin: 5px 0;
            font-weight: 500;
        }

        .part-condition {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .contact-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            align-items: center;
        }

        .contact-btn {
            padding: 8px 15px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            transition: all 0.3s;
        }

        .btn-email {
            background-color: #e9ecef;
            color: #495057;
        }

        .btn-call {
            background-color: #6f42c1;
            color: white;
        }

        .btn-whatsapp {
            background-color: #25d366;
            color: white;
        }

        .contact-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-btn {
            background-color: #e95426;
            border-color: #e95426;
        }

        .search-btn:hover {
            background-color: #e8681a;
            border-color: #e8681a;
        }

        .create-ad-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #dc3545;
            color: white;
            border-radius: 50px;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .create-ad-btn:hover {
            background-color: #c82333;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .reload-btn {
            position: fixed;
            bottom: 80px;
            right: 20px;
            background-color: #28a745;
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .reload-btn:hover {
            background-color: #218838;
            color: white;
            transform: rotate(180deg);
        }

        .form-select,
        .form-control {
            font-size: 0.9rem;
        }
    </style>
    {{-- Add bottom padding to body content to account for fixed bottom nav --}}
    <style>
        @media (max-width: 991.98px) {
            body {
                padding-bottom: 70px;
            }

            .bottom-nav-active {
                color: #0d6efd !important;
            }
        }
    </style>

    <script>
        // Update both clocks
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: true,
                hour: 'numeric',
                minute: '2-digit',
                second: '2-digit'
            });

            // Update desktop clock
            const desktopClock = document.getElementById('liveClockDesktop');
            if (desktopClock) {
                desktopClock.textContent = timeString;
            }

            // Update mobile clock
            // const mobileClock = document.getElementById('liveClock');
            // if (mobileClock) {
            //     mobileClock.textContent = timeString;
            // }
        }

        // Initialize clock
        updateClock();
        setInterval(updateClock, 1000);

        // Close mobile profile menu when clicking outside
        document.addEventListener('click', function(event) {
            const profileMenu = document.getElementById('mobileProfileMenu');
            const profileToggle = event.target.closest('[data-bs-target="#mobileProfileMenu"]');

            if (!profileToggle && !profileMenu.contains(event.target)) {
                const bsCollapse = bootstrap.Collapse.getInstance(profileMenu);
                if (bsCollapse && profileMenu.classList.contains('show')) {
                    bsCollapse.hide();
                }
            }
        });
    </script>
</head>
<body>
    
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
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-2 shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" style="max-width: 100px" href="#">
                {{-- <img style="width: 50%; height: 100%" src="{{ asset('storage/' . $domain->logo) }}" alt="Logo"> --}}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="navbar-nav ms-auto d-flex align-items-center w-100 justify-content-end">

                    <div class="nav-item me-4 d-none d-lg-block">
                        <span id="liveClock" class="text-dark fw-medium fs-6"></span>
                    </div>

                    @php
                        use Carbon\Carbon;
                        use App\Models\InvoiceSubscriptions;
                      use App\Models\Invoices;
                        $daysLeft = 0;
                        $user = Auth::guard('supplier')->user();
                        if ($user) {
                                  // Get latest invoice
        $invoiceId = Invoices::where('supplier_id', $user->id)
                            ->latest()
                            ->value('id');
            $subscription = InvoiceSubscriptions::where('invoice_id', $invoiceId)->first();
                            if ($subscription && $subscription->end_date) {
                                $end = Carbon::parse($subscription->end_date)->endOfDay();
                                $today = now()->startOfDay();
                                $daysLeft = $today->diffInDays($end, false);
                                if ($daysLeft < 0) {
                                    $daysLeft = 0;
                                }
                            }
                        }
                    @endphp
                    <div class="nav-item me-4">
                        <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                            <i class="fas fa-calendar-check me-1"></i>
                            {{ $daysLeft === 0 ? 'Last day' : $daysLeft . ' days left' }}
                        </span>
                    </div>

                    <div class="nav-item me-4">
                        <a href="{{ route('supplier.panel') }}" class="nav-link text-dark fw-semibold px-3 py-2">
                            <i class="fas fa-inbox me-1"></i>
                            Enquiries
                        </a>
                    </div>

                    @php
                        $has_shop = $user->shop->is_active ?? false;
                        $shop_id = $user->shop->id ?? null;
                    @endphp
                    <div class="nav-item me-4">
                        @if ($has_shop)
                            <a href="{{ route('supplier.ads.index', $shop_id) }}"
                                class="nav-link text-dark fw-semibold px-3 py-2">
                                <i class="fas fa-bullhorn me-1"></i>
                                Ads
                            </a>
                        @else
                            <span class="nav-link text-muted fw-semibold px-3 py-2">
                                <i class="fas fa-bullhorn me-1"></i>
                                Ads
                            </span>
                        @endif
                    </div>

                    <div class="nav-item me-4">
                        <a href="{{ route('supplier.courier.services') }}"
                            class="nav-link text-dark fw-semibold px-3 py-2">
                            <i class="fa-solid fa-truck"></i> Courier
                        </a>
                    </div>

                    @if ($has_shop)
                        <div class="nav-item me-4">
                            <a class="nav-link text-dark fw-semibold px-3 py-2"
                                href="{{ route('supplier.shop.profile', $shop_id) }}">
                                <i class="fas fa-store me-1"></i>
                                Shop
                            </a>
                        </div>
                    @endif

                    <div class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-dark px-3 py-2" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2 fs-5"></i>
                            <span class="fw-semibold">{{ $user->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <a href="{{ route('supplier.buyer.invoices.index') }}" class="dropdown-item py-2">
                                    <i class="fas fa-file-invoice me-2"></i>
                                    Invoices
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item py-2"
                                    href="{{ route('supplier.password.update', $user->id) }}">
                                    <i class="fas fa-cog me-2"></i>
                                    Change Password
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="nav-item">
                        <form action="{{ route('supplier.logout') }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit"
                                class="btn btn-outline-danger btn-sm d-flex align-items-center px-3 py-2">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    <!-- Bottom Navigation for Mobile -->
    <nav class="navbar navbar-light bg-white border-top fixed-bottom d-lg-none shadow-sm">
        <div class="container d-flex justify-content-around py-2">
            <a href="{{ route('supplier.panel') }}"
                class="nav-link text-center {{ request()->routeIs('supplier.panel') ? 'bottom-nav-active' : '' }}">
                <i class="fas fa-inbox d-block fs-5"></i>
                <small>Enquiries</small>
            </a>

            <a href="{{ $has_shop ? route('supplier.ads.index', $shop_id) : '#' }}"
                class="nav-link text-center {{ request()->routeIs('supplier.ads.index') ? 'bottom-nav-active' : '' }} {{ !$has_shop ? 'disabled text-muted' : '' }}">
                <i class="fas fa-bullhorn d-block fs-5"></i>
                <small>My Ads</small>
            </a>

            @if ($has_shop)
                <a href="{{ route('supplier.shop.profile', $shop_id) }}"
                    class="nav-link text-center {{ request()->routeIs('supplier.shop.profile') ? 'bottom-nav-active' : '' }}">
                    <i class="fas fa-store d-block fs-5"></i>
                    <small>Shop</small>
                </a>
            @endif

            <a href="{{ route('supplier.buyer.invoices.index') }}"
                class="nav-link text-center {{ request()->routeIs('supplier.buyer.invoices.index') ? 'bottom-nav-active' : '' }}">
                <i class="fas fa-file-invoice d-block fs-5"></i>
                <small>Invoices</small>
            </a>

            <a href="{{ route('supplier.password.update', $user->id) }}"
                class="nav-link text-center {{ request()->routeIs('supplier.password.update') ? 'bottom-nav-active' : '' }}">
                <i class="fas fa-cog d-block fs-5"></i>
                <small>Settings</small>
            </a>
            <a href="{{ route('supplier.courier.services') }}"
                class="nav-link text-center {{ request()->routeIs('supplier.courier.services') ? 'bottom-nav-active' : '' }}">
                <i class="fa-solid fa-truck d-block fs-5"></i>
                <small>Courier</small>
            </a>
        </div>
    </nav>
