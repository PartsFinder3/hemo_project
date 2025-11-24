@extends('Frontend.layout.main')
@section('main-section')

    <style>
        body, main, header, nav, .hero-section, .hero-section_p {
            background-image: none !important;
            background: none !important;
        }
        
        .product-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }
        
        .price {
            font-size: 28px;
            font-weight: 700;
            color: #e00;
            margin: 15px 0;
        }
        
        .btn.whatsapp {
            background-color: #25D366;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .btn.whatsapp:hover {
            background-color: #128C7E;
            color: white;
        }
        
        .btn.call {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .btn.call:hover {
            background-color: #0056b3;
            color: white;
        }
        
        .spec-table table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .spec-table th {
            background-color: #f8f9fa;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        
        .spec-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .spec-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
            #productCarousel .carousel-inner img {
                width: 100%;
                height: 300px; /* ← sirf yeh rakho */
                object-fit: contain;
                background-color: #f7f7f7;
            }
        
        .carousel-control-prev, .carousel-control-next {
            background-color: rgba(0,0,0,0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .carousel-control-prev {
            left: 10px;
        }
        
        .carousel-control-next {
            right: 10px;
        }
        
        @media (max-width: 768px) {
            .product-title {
                font-size: 20px;
            }
            
            .price {
                font-size: 24px;
            }
            
            .btn.whatsapp, .btn.call {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row g-4">
            <!-- Left: Carousel -->
            <div class="col-md-6">
                @php
                    $images = is_string($ad->images) ? json_decode($ad->images, true) : $ad->images;
                @endphp

                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset($image) }}" class="d-block w-100"
                                    alt="Car Image {{ $key + 1 }}">
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

            </div>

            <!-- Right: Details -->
            <div class="col-md-6">
                <h3 class="product-title">{{ $ad->title }}</h3>
                <p class="text-muted">Condition: <strong>
                        @if ($ad->condition == 'new')
                            New
                        @elseif ($ad->condition == 'used')
                            Used
                        @endif
                    </strong></p>
                @php
                    $location = $ad->shop->supplier->city->name ?? 'Unknown';
                    $contact = $ad->shop->supplier->whatsapp;
                    $make = $ad->carMake->name ?? 'Unknown';
                    $model = $ad->carModel->name ?? 'Unknown';
                    $year = $ad->year->year ?? 'Unknown';
                    $shopName = $ad->shop->name ?? 'Unknown';
                @endphp
                <p class="text-muted">Supplier Location: <strong>{{ $location }}</strong></p>
                <p class="price">AED: {{ $ad->price }}</p>

                <div class="d-flex gap-2 my-3">
<a href="javascript:void(0)" class="btn whatsapp"
    onclick="contactSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}', '{{ $ad->title }}')">

    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" viewBox="0 0 24 24">
        <path d="M12.04 2c-5.52 0-10 4.48-10 10 0 1.76.46 3.47 1.34 5L2 22l5.19-1.36c1.45.79 3.08 1.21 4.85 1.21h.01c5.52 0 10-4.48 10-10s-4.48-10-10-10zm5.8 14.48c-.24.68-1.4 1.32-1.93 1.38-.49.05-1.1.07-1.78-.11-.41-.11-.94-.3-1.62-.59-2.84-1.24-4.69-4.15-4.83-4.34-.14-.19-1.15-1.53-1.15-2.92 0-1.39.73-2.07 1-2.36.27-.29.59-.36.79-.36h.57c.18 0 .43-.07.67.51.24.58.82 2.01.9 2.16.07.15.12.32.02.51-.1.19-.15.31-.3.48-.15.17-.31.38-.44.51-.15.15-.31.32-.13.63.18.31.81 1.34 1.74 2.17 1.2 1.07 2.21 1.41 2.52 1.57.31.16.49.13.67-.08.18-.21.77-.9.98-1.21.21-.31.41-.25.68-.15.27.1 1.72.81 2.02.96.3.15.5.22.57.34.07.12.07.71-.17 1.39z"/>
    </svg>

    WhatsApp
</a>

<a href="javascript:void(0)" class="btn call"
    onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">

    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" viewBox="0 0 24 24">
        <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24 11.72 11.72 0 003.67.59 1 1 0 011 1v3.5a1 1 0 01-1 1A17.5 17.5 0 012 6a1 1 0 011-1h3.5a1 1 0 011 1 11.73 11.73 0 00.59 3.67 1 1 0 01-.24 1.01l-2.23 2.11z"/>
    </svg>

    Click to Call
</a>
                </div>

                {{-- <p class="text-success fw-semibold">⭐ 98.9% Positive Feedback</p> --}}
            </div>
        </div>

        <!-- Item Specification Table -->
        <div class="spec-table mt-5">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Item Specification</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Make</td>
                        <td>{{$make}}</td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td>{{$model}}</td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td>{{$year}}</td>
                    </tr>
                    {{-- <tr>
                        <td>Part Category</td>
                        <td>Body Panel</td>
                    </tr> --}}
                    <tr>
                        <td>Parts Supplier</td>
                        <td>{{$shopName}}</td>
                    </tr>
                    {{-- <tr>
                        <td>Ref. No.</td>
                        <td>UAE-381-15983</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function contactSupplier(isActive, number, title) {
            if (isActive == 1) {
                let message = encodeURIComponent("Hello, I'm interested in your ad: " + title);
                let isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

                let url = isMobile ?
                    `https://wa.me/${number}?text=${message}` :
                    `https://web.whatsapp.com/send?phone=${number}&text=${message}`;

                window.open(url, "_blank");
            } else {
                // Supplier inactive → stay on same page
                window.location.reload();
            }
        }

        function callSupplier(isActive, number) {
            if (isActive == 1) {
                window.location.href = `tel:${number}`;
            } else {
                // Supplier inactive → stay on same page
                window.location.reload();
            }
        }

        // Mobile Menu Functionality
const burgerMenu = document.getElementById("burger-menu");
const navMenu = document.getElementById("nav-menu");

if (burgerMenu && navMenu) {
    burgerMenu.addEventListener("click", function () {
        burgerMenu.classList.toggle("active");
        navMenu.classList.toggle("active");
    });

    // Close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll(".nav-menu a");
    navLinks.forEach((link) => {
        link.addEventListener("click", () => {
            burgerMenu.classList.remove("active");
            navMenu.classList.remove("active");
        });
    });

    // Close mobile menu when clicking outside
    document.addEventListener("click", function (event) {
        if (
            !burgerMenu.contains(event.target) &&
            !navMenu.contains(event.target)
        ) {
            burgerMenu.classList.remove("active");
            navMenu.classList.remove("active");
        }
    });

    // Close mobile menu on window resize
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            burgerMenu.classList.remove("active");
            navMenu.classList.remove("active");
        }
    });
}

    </script>
@endsection