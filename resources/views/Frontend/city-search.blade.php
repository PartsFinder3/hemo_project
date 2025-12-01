@extends('Frontend.layout.main')
@section('main-section')


@include('Frontend.hero_section', [
   'part' => '<span class="hiliter">' . $city->name . '</span> Parts for Sale in UAE',
   'image' => 'https://partsfinder.ae/storage/profile_images/hero_section_image_1.png'
])

    </main>

    <section class="carMakes">
        <div class="section-text">
            <h3>TOP MAKES</h3>
            <h2>Browse By Brands</h2>
        </div>

        <div class="brands">
            @foreach ($carMakes as $m)
                <a href="{{ route('makes.show', $m->id) }}" class="make">
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
            <h3>{{ $city->name }} ADS</h3>
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

                @if(!empty($images[0]))
                    <img src="{{ asset($images[0]) }}" class="card-img-top img-fluid" alt="Product">
                @endif
                
                <div class="card-body">
                    <a href="{{ route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id]) }}"
                        class="card-title">{{ $ad->title }}</a>
                    <div class="price">{{ $ad->currency }} {{ $ad->price }}</div>
                    <div class="meta">
                        Availability: In Stock <br>
                        Condition: {{ $ad->condition }} <br>
                        Delivery: Ask Supplier <br>
                        Warranty: Ask Supplier
                    </div>
                    
                    <div class="buttons">
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $ad->shop->supplier->whatsapp) }}?text={{ urlencode('Hello, I am interested in your ad: ' . $ad->title) }}"
                            target="_blank"
                            class="btn btn-sm btn-success w-100 my-1">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
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

        <section class="ad-cards">
        <div class="section-text">
            <h3>{{$city->name}} CAR ADS</h3>
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
                        <img src="{{ asset('storage/' . $images[0]) }}" alt="Product">
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
    <section class="locations-section">
        <div class="section-text">
            <h2>Auto Parts for Cars, Vans, SUVs Anywhere in the {{$city->name}}</h2>

        </div>
        <div class="locations-grid">

            @foreach ($domain->cities as $city)
                <a href="{{route('city.ads',['slug' => $city->slug, 'id' => $city->id])}}" class="location-card"><i class="fa-solid fa-location-dot"></i> {{ $city->name }}</a>
            @endforeach
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
<script>
    // باقی functions...

    function setupPagination(gridId, paginationId, perPage = 8) {
        const products = document.querySelectorAll(`#${gridId} .card`);
        const totalPages = Math.ceil(products.length / perPage);
        const pagination = document.getElementById(paginationId);

        if (!pagination || products.length === 0) return;

        function showPage(page) {
            // Hide all products
            products.forEach(product => {
                product.style.display = "none";
            });
            
            // Show products for current page
            const startIndex = (page - 1) * perPage;
            const endIndex = startIndex + perPage;
            
            for (let i = startIndex; i < endIndex && i < products.length; i++) {
                if (products[i]) {
                    products[i].style.display = "block";
                }
            }
            
            // Update active button
            pagination.querySelectorAll("button").forEach((btn, i) => {
                btn.classList.toggle("active", i + 1 === page);
            });
        }

        function createPaginationButtons() {
            pagination.innerHTML = "";

            // Previous button
            const prevBtn = document.createElement("button");
            prevBtn.innerHTML = "&laquo;";
            prevBtn.className = "prev";
            prevBtn.addEventListener("click", () => {
                const current = parseInt(pagination.querySelector("button.active")?.innerText);
                if (current > 1) showPage(current - 1);
            });
            pagination.appendChild(prevBtn);

            // Number buttons
            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement("button");
                btn.innerText = i;
                btn.addEventListener("click", () => showPage(i));
                pagination.appendChild(btn);
            }

            // Next button
            const nextBtn = document.createElement("button");
            nextBtn.innerHTML = "&raquo;";
            nextBtn.className = "next";
            nextBtn.addEventListener("click", () => {
                const current = parseInt(pagination.querySelector("button.active")?.innerText);
                if (current < totalPages) showPage(current + 1);
            });
            pagination.appendChild(nextBtn);
        }

        createPaginationButtons();
        showPage(1);
    }

    // DOM loaded pe dono sections ke liye pagination setup karo
    document.addEventListener("DOMContentLoaded", () => {
        setupPagination("productGrid1", "pagination1", 8);
        setupPagination("productGrid2", "pagination2", 8);
    });

    // باقی functions...
</script>


<style>
    .pagination {
    display: flex;
    justify-content: center;
    margin-top: 30px;
    gap: 8px;
    flex-wrap: wrap;
}

.pagination button {
    padding: 8px 14px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
}

.pagination button:hover {
    background: var(--accent-color);
    color: white;
    border-color: var(--accent-color);
}

.pagination button.active {
    background: var(--accent-color);
    color: white;
    border-color: var(--accent-color);
}

.pagination button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
    <style>
        .search-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    width: 450px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: -50px;
}
.form-group {
    margin-bottom: 10px;
    opacity: 1;
    transform: translateY(0);
    transition: all 0.4s ease;
}

.dropdown {
    width: 100%;
    padding: 15px;
    border: 2px solid #e1e5e9;
    border-radius: 10px;
    font-size: 13px;
    background-color: white;
    cursor: pointer;
    transition: 0.3s;
    font-family: 'Montserrat', sans-serif;
}
.part-tag {
    background: var(--accent-color);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
    animation: slideIn 0.3s ease;
}
 .condition-section {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 10px;
    border: 2px solid #e1e5e9;
    margin-top: -10px;
}
#condition-group {
    display: block;
}

.radio-group {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 20px; 
    margin-top: 5px; 
}

.radio-option {
    display: flex;
    align-items: center;
    gap: 5px; 
}
.card {
    width: 300px;
    height: 450px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin: 10px;
    transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
     padding: 10px !important;
}

.card:hover {
    transform: translateY(-5px); /* slight lift on hover */
    box-shadow: 0 4px 12px rgba(0,0,0,0.2); /* stronger shadow */
    border-color: #aaa; /* subtle border change on hover */
}

.card img {
    width: 100%;
    height: 150px;
    object-fit: contain !important; /* full image dikhayega */
    background-color: #f7f7f7; /* optional clean background */
    padding: 5px; /* thoda gap for clean look */
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

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-section {
        padding: 30px 5%;
        gap: 30px;
    }

    .dropdown {
        font-size: 14px;
        padding: 8px 10px;
    }
}
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 30px;
    gap: 8px;
    flex-wrap: wrap;
}

.pagination button {
    padding: 8px 14px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
}

.pagination button:hover {
    background: var(--accent-color);
    color: white;
    border-color: var(--accent-color);
}

.pagination button.active {
    background: var(--accent-color);
    color: white;
    border-color: var(--accent-color);
}

.pagination button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
 </style>
@endsection
