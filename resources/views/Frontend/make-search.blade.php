@extends('Frontend.layout.main')
@section('main-section')

@include('Frontend.hero_section', [
    'part' => '<span class="hiliter">' . $make->name . '</span> Parts for Sale in UAE',
    'image' => 'storage/'.$make->logo
])
    </main>
     <section class="ad-cards">
        <div class="section-text">
            <h3>{{ $make->name }} ADS</h3>
            <h2>Find the Best Deals For You</h2>
        </div>
        <div class="filters">
            <a href="#" class="active">All</a>
            @foreach ($randomParts as $p)
                <a href="#">{{ $p->name }}</a>
            @endforeach
        </div>

        <div class="grid" id="productGrid1">
            <!-- Example Card -->
            @foreach ($ads as $ad)
                <div class="card">
                    @php
                        $images = json_decode($ad->images, true);
                    @endphp

                    @if (is_array($images) && isset($images[0]))
                        <img src="{{ asset('' . $images[0]) }}" alt="Product">
                    @endif
                    <div class="card-body">
                        <a href="{{ route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id]) }}" class="card-title">{{ $ad->title }}</a>
                        <div class="price">AED {{ $ad->price }}</div>
                        <div class="meta">
                            Availability: In Stock <br>
                            Condition: {{ $ad->condition }} <br>
                            Delivery: Ask Supplier <br>
                            Warranty: Ask Supplier
                        </div>
                        @php
                            $ad->shop->supplier->whatsapp;
                        @endphp
                        <div class="buttons">
                            <a href="javascript:void(0)" class="btn whatsapp"
                                onclick="contactSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}', '{{ $ad->title }}')">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                            </a>

                            <a href="javascript:void(0)" class="btn call"
                                onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">
                                <i class="fa-solid fa-phone"></i> Click to Call
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination" id="pagination1"></div>
    </section>
    <section class="carMakes">
        <div class="section-text">
            <h3>TOP MAKES</h3>
            <h2>Browse By Brands</h2>
        </div>

        <div class="brands">
            @foreach ($carMakes as $m)
               <a href="{{ route('make.ads', ['slug' => $m->slug, 'id' => $m->id]) }}" class="make">
                    @if($m->logo)
                        <img src="{{ asset('storage/' . $m->logo) }}" alt="{{ $m->name }}">
                  
                    @endif
                    <h4>{{ strtoupper($m->name) }}</h4>
                </a>
            @endforeach
        </div>
    </section>

   

        <section class="ad-cards">
        <div class="section-text">
            <h3>{{$make->name}} CAR ADS</h3>
            <h2>Our Sellers are Currently Breaking These Cars for Spare Parts</h2>
        </div>
        <div class="filters">
            <a href="#" class="active">All</a>
            @foreach ($randomMakes as $m)
                <a href="{{ route('make.ads', ['slug' => $m->slug, 'id' => $m->id]) }}">{{ $m->name }}</a>
            @endforeach
        </div>

        <div class="grid" id="productGrid2">
            <!-- Example Card -->
            @foreach ($carAds as $ad)
                <div class="card">
                    @php
                        $images = json_decode($ad->images, true);
                    @endphp

                    @if (is_array($images) && isset($images[0]))
                        <img src="{{ asset('' . $images[0]) }}" alt="Product">
                    @endif
                    <div class="card-body">
                        <a href="" class="card-title">{{ $ad->title }}</a>
                        {{-- <div class="price">AED {{ $ad->price }}</div> --}}
                        <div class="meta">
                            Availability: In Stock <br>
                            {{-- Condition: {{ $ad->condition }} <br> --}}
                            Delivery: Ask Supplier <br>
                            Warranty: Ask Supplier
                        </div>
                        @php
                            $ad->shop->supplier->whatsapp;
                        @endphp
                        <div class="buttons">
                            <a href="javascript:void(0)" class="btn whatsapp"
                                onclick="contactSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}', '{{ $ad->title }}')">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                            </a>

                            <a href="javascript:void(0)" class="btn call"
                                onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">
                                <i class="fa-solid fa-phone"></i> Click to Call
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach


            <!-- Repeat similar cards... -->
        </div>

        <div class="pagination" id="pagination2"></div>
    </section>

    <!-- Locations -->
<section class="abd-locations-section">
    <div class="abd-locations-header">
        <h2>Auto Parts for Cars, Vans, SUVs Anywhere in the UAE</h2>
    </div>
    <div class="abd-locations-grid">
        @if(optional($domain)->cities)
            @foreach ($domain->cities as $city)
                <a href="{{ route('city.ads', ['slug' => $city->slug, 'id' => $city->id]) }}" class="abd-location-card">
                    <i class="fa-solid fa-location-dot abd-location-icon"></i>
                    <span class="abd-location-name">{{ $city->name }}</span>
                </a>
            @endforeach
        @endif
    </div>
</section>

@include('Frontend.layout.company')

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

    <style>
        .card {
   width: 100%;
    padding: 0; /* remove all padding */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    height: 470px;
}

.card:hover {
    transform: translateY(-5px); /* slight lift on hover */
    box-shadow: 0 4px 12px rgba(0,0,0,0.2); /* stronger shadow */
    border-color: #aaa; /* subtle border change on hover */
}

.card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.card-body {
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex-grow: 1;
}

.card-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
    line-height: 1.2em;
    height: 3.6em;
    overflow: hidden;
}

.price {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

.meta {
    font-size: 14px;
    margin-bottom: 10px;
    line-height: 1.4;
}

.btn.whatsapp {
    background: var(--whatsapp-btn);
}
.part-card {
    width: 250px;            /* fix width */
    height: 180px;           /* fix height */
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 10px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    gap: 10px;
    overflow: hidden;
    background: #fff;
    transition: 0.3s ease;
}

/* Hover effect */
.part-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-color: #ccc;
}

/* Fix image size */
.part-card img {
    width: 80px; 
    height: 80px;
    object-fit: contain;     /* Image stays inside nicely */
}

/* Text styling */
.part-card-text {
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    color: black;
    margin-top: 5px;
}
.make {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    width: 150px;           /* fixed width */
    height: 115px;          /* fixed height */
    margin: 10px;
    text-decoration: none;
    color: black;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
    background: #fff;
}

.make:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-color: #ccc;
}

.make img {
    width: 90%;            /* fixed image width */
    height: 60px;           /* fixed image height */
    object-fit: contain;     /* keep logo proportions */
    margin-bottom: 8px;
}

.make h4 {
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    margin: 0;
    line-height: 1.2em;
    height: 2.4em;          /* max 2 lines */
    overflow: hidden;
}
.hero-section {
    display: flex;
    flex-direction: column;
    align-items: center; /* center hero text horizontally */
    padding: 50px 10%;
    gap: 50px;
}

.hero-text {
    text-align: center;
}

.search-card {
    align-self: flex-start; /* align form to left */
    width: 100%;
    max-width: 500px; /* limit form width */
}

 #make {
        font-weight: bold;      /* makes selected value bold */
        padding: 8px 12px;
        font-size: 16px;
    }

    #make option {
        font-weight: bold;      /* makes dropdown options bold */
    }

    /* Optional: make the select box look nicer */
    #make {
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        color: #333;
        width: 100%;
        max-width: 100%;
    }



    .dropdown {
    font-weight: bold;       /* selected value bold */
    font-size: 16px;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    background-color: #fff;
    cursor: pointer;
    width: 100%;
}

/* Make all options bold */
.dropdown option {
    font-weight: bold;
}

/* Focus state for dropdowns */
.dropdown:focus {
    outline: none;
    border-color: #6a11cb;  /* matches gradient theme */
    box-shadow: 0 0 6px rgba(106,17,203,0.3);
}

/* Ensure parts dropdown shows when enabled */
#parts-dropdown:enabled {
    background-color: #fff;
    cursor: pointer;
}

/* Radio buttons bold text */
.radio-option label {
    font-weight: bold;
    cursor: pointer;
}

/* Hero section adjustments */
.hero-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 50px 10%;
    gap: 50px;
}

/* Align search card to left under hero text */
.search-card {
    align-self: flex-start;
    max-width: 500px;
    width: 100%;
}

/* Buttons bold */
.find-btn, .btn {
    font-weight: bold;
}
/* ===== Locations Section ===== */
.abd-locations-section {
    padding: 40px 20px;
    background-color: #f9f9f9;
    text-align: center;
}

.abd-locations-header h2 {
    font-size: 28px;
    color: #333;
    margin-bottom: 30px;
    font-weight: 600;
}

/* Fixed Grid and Card Size */
.abd-locations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 200px)); /* fixed width */
    gap: 20px;
    justify-content: center;
    background-color: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.abd-location-card {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 200px;  /* fixed width */
    height: 60px;  /* fixed height */
    background-color: #f4f4f4;
    padding: 10px;
    border-radius: 10px;
    color: #ff6a00;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.abd-location-card:hover {
    background-color: #ff6a00;
    color: #fff;
    transform: translateY(-3px);
}

.abd-location-icon {
    font-size: 18px;
}

.abd-location-name {
    font-size: 16px;
    white-space: nowrap;
}

/* ===== Responsive ===== */
@media (max-width: 768px) {
    .abd-locations-header h2 {
        font-size: 24px;
    }
    .abd-locations-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 150px));
    }
    .abd-location-card {
        width: 150px;
        height: 50px;
        font-size: 14px;
    }
    .abd-location-icon {
        font-size: 16px;
    }
}
@media (max-width: 480px) {
    .abd-locations-section {
        padding: 20px 10px;
    }
    .abd-locations-header h2 {
        font-size: 20px;
    }
    .abd-locations-grid {
        grid-template-columns: repeat(auto-fit, minmax(120px, 120px));
        gap: 15px;
        padding: 15px;
    }
    .abd-location-card {
        width: 120px;
        height: 45px;
        font-size: 13px;
    }
}
    </style>
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

@endsection
