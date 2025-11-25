@extends('Frontend.layout.main')
@section('main-section')
<div class="hero-section">
        <div class="hero-text d-flex justify-content-center align-items-center flex-column">
            <h1 style="text-align: center">{{$ad->title}}</h1>
            <p>You Can View Part Details Below.</p>
            <!-- 2) Double chevron -->
            <span class="scroll-bounce" aria-hidden="true">

                <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 7l6 6 6-6M6 13l6 6 6-6" />
                </svg>
            </span>
            <style>
                .scroll-bounce {
                    display: inline-block;
                    animation: bounce 1.4s infinite;
                }

                @keyframes bounce {

                    0%,
                    20%,
                    50%,
                    80%,
                    100% {
                        transform: translateY(0);
                    }

                    40% {
                        transform: translateY(6px);
                    }

                    60% {
                        transform: translateY(3px);
                    }
                }
            </style>

        </div>

    </div>
    </main>
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
                                <img src="{{ asset('storage/' . $image) }}" class="d-block w-100"
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
                {{-- <p class="text-muted">Condition: <strong>
                        @if ($ad->condition == 'new')
                            New
                        @elseif ($ad->condition == 'used')
                            Used
                        @endif
                    </strong></p> --}}
                @php
                    $location = $ad->shop->supplier->city->name ?? 'Unknown';
                    $contact = $ad->shop->supplier->whatsapp;
                    $make = $ad->carMake->name ?? 'Unknown';
                    $model = $ad->carModel->name ?? 'Unknown';
                    $year = $ad->year->year ?? 'Unknown';
                    $shopName = $ad->shop->name ?? 'Unknown';
                @endphp
                <p class="text-muted">Supplier Location: <strong>{{ $location }}</strong></p>
                {{-- <p class="price">AED: {{ $ad->price }}</p> --}}

                <div class="d-flex gap-2 my-3">
                    <a href="javascript:void(0)" class="btn whatsapp"
                        onclick="contactSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}', '{{ $ad->title }}')">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>

                    <a href="javascript:void(0)" class="btn call"
                        onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">
                        <i class="fa-solid fa-phone"></i> Click to Call
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
    </script>
    <script>          
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
