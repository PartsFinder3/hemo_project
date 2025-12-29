@extends('Frontend.layout.main')
@section('main-section')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    body, main, header, nav, .hero-section, .hero-section_p {
    background-image: none !important;
    background: none !important;
}




/* Responsive */
@media (max-width: 768px) {
    .secound_hero_section {
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .part_finder_card,
    .hero_image_section {
        width: 100%;
    }

    .hero_image_section {
        height: 250px;
    }
}


       #productGrid1 {
    width: 80%;
    max-width: 1400px;   /* optional but recommended */
    margin: 0 auto;      /* CENTER */
    
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
}

#productGrid1 .card {
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
    display: block;
}


#productGrid1 .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    border-color: #aaa;
}

/* Card image */
#productGrid1 .card img {
    width: 100%;
    height: 150px;
    object-fit: contain;
    background-color: white;
    padding: 5px;
}


#productGrid1 .card-body {
    padding: 10px; /* optional, only inner spacing */
}

/* Card title */
#productGrid1 .card-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
    line-height: 1.2em;
    height: 3.6em; /* limit to 2 lines */
    overflow: hidden;
}

/* Price */
#productGrid1 .price {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Meta info */
#productGrid1 .meta {
    font-size: 14px;
    margin-bottom: 10px;
    line-height: 1.4;
}

/* Buttons */
#productGrid1 .buttons {
    display: flex;
    gap: 10px;
}

#productGrid1 .buttons a {
    flex: 1;
    text-align: center;
    padding: 10px;
    border-radius: 6px;
    font-weight: bold;
    text-decoration: none;
    color: #fff;

}


#productGrid1 .buttons a.call {
    background: var(--accent-color);
    padding: 10px;       /* same as WhatsApp button */
    height: auto;        /* remove fixed 30px */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;  /* same as WhatsApp */
    font-weight: bold;
    color: #fff;
}
@media (max-width: 1024px) {
    #productGrid1 {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    #productGrid1 {
        grid-template-columns: 1fr;
    }
}
/* ======= Responsive 992px (Tablet + Mobile Large) ======= */
@media (max-width: 992px) {

    .hero-section_p {
        height: auto;
        padding: 30px 20px;
    }

    .hero_section_text h1 {
        font-size: 2.5rem !important;
        padding: 0 20px;
    }

    .secound_hero_section {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 30px;
        padding: 0 20px;
        height: auto;
    }

    .part_finder_card {
        width: 100%;
        margin-top: 0;
        margin-left: 0;
        display: flex;
        justify-content: center;
    }

    .car {
        width: 100%;
        max-width: 420px;
    }

    .hero_image_section {
        width: 100%;
        margin-top: 20px;
        margin-right: 0;
        text-align: center;
    }

    .hero_image_section img {
        width: 90%;
        height: auto;
        max-width: 380px;
    }
}

/* ======= Responsive 768px (Mobile) ======= */
@media (max-width: 768px) {

    .hero_section_text h1 {
        font-size: 2rem !important;
        line-height: 1.2;
    }

    .car {
        padding: 15px;
        border-radius: 15px;
    }

    .hero_image_section img {
        max-width: 300px;
        margin-top: 10px;
    }

    .find-btn {
        font-size: 16px;
        height: 45px;
    }
}

/* ======= Responsive 480px (Small Mobile) ======= */

.buttons a.whatsapp,
.buttons a.call {
    flex: 1;                    /* equal width */
    text-align: center;
    padding: 10px;              /* same padding */
    height: 50px;               /* fixed height */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    font-weight: bold;
    color: #fff;
    text-decoration: none;
    transition: 0.3s ease;
}

/* Separate colors */
.buttons a.whatsapp {
    background: #198754;
}

.buttons a.call {
    background: var(--accent-color);
}

.step-icon {
    width: 200px !important;
    height: 200px !important;
    margin: 0 auto 20px auto;
}

.step-icon img {
    width: 200px;
    height: 200px;
    object-fit: contain;
}
</style>
@include('Frontend.hero_section', [
   'part' => '<span class="hiliter">' . $city->name . '</span> Parts for Sale in UAE',
   'image' => 'https://partsfinder.ae/storage/profile_images/hero_section_image_1.png'
])

    </main>

<div id="ads"></div>
  <!-- FIRST ADS SECTION - Part Ads -->

<div class="grid" id="productGrid1">
    @foreach ($ads as $ad)
        <div class="card">
            @php
                $images = json_decode($ad->images, true);
            @endphp

            @if (is_array($images) && isset($images[0]))
                <img src="{{ asset($images[0]) }}" alt="Product">
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

<!-- Pagination OUTSIDE the grid -->
<div style="display: flex; justify-content: center; margin-top: 20px;">
    {{ $ads->fragment('ads')->links('pagination::bootstrap-5') }}
</div>

    <section class="carMakes" id="carMakes">
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
               <div class="col-12 d-flex justify-content-center mt-4">
    {{ $carMakes->fragment('carMakes')->links('pagination::bootstrap-5') }}
</div>
        </div>
    </section>
 <section class="spareParts" id="spareParts">
        <h2>Popular Car Spare Parts in UAE</h2>
        <div class="popular-part-container">
            @foreach ($sParts as $p)
             <a style="text-decoration: none; color: black; width:250px; margin-left:30px; "
                        href="{{ route('part.ads', ['partName' => Str::slug($p->name), 'id' => $p->id]) }}">
                <div class="part-card">
                    @if ($p->image)
                        
                      <img src="{{ asset('storage/' . $p->image) }}" alt="Spare Part" >
                    @else
                        <img src="{{ asset('Frontend/assets/quote.png') }}" alt="{{ $p->name }}" />
                    @endif
                   
                        {{ $p->name }}
                   
                </div>
                 </a>
            @endforeach
              <div style="display: flex; justify-content: center; margin-top: 20px; width:100%;">
    {{ $sParts->fragment('spareParts')->links('pagination::bootstrap-5') }}
</div>
        </div>
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

<section class="abd-locations-section">
    <div class="abd-locations-header">
        <h2>Auto Parts for Cars, Vans, SUVs Anywhere in the {{$city->name}}</h2>
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
@if(isset($Content) && $Content->content)
<section class="seo_content">
     <hr style="
    border: none;
    border-top: 4px solid #FF7100;
    opacity: 1;
    margin: 30px 0;
">
    {!! $Content->content !!}
    <hr style="
    border: none;
    border-top: 4px solid #FF7100;
    opacity: 1;
    margin: 30px 0;
">
</section>
@endif

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
        .spareParts {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    max-width: 90% !important;
     margin-left: 63px !important;
    padding: 30px;
}
    .pagination {
    display: flex;
    justify-content: center;
    margin-top: 30px;
    gap: 8px;
    flex-wrap: wrap;
    width: 800px;
    margin: auto;
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

.pagination .active,
.pagination .page-item.active .page-link,
.pagination .disabled .page-link {
    background: #ff7700 !important;
    color: white !important;
    border-color: #ff7700 !important;
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
    box-shadow: 0 4px 12px #ff7700;
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
        justify-content: space-between;
        width: 160px;
        height: 130px; /* Fixed height for brand cards */
        text-decoration: none;
        color: #333;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
    }
    

   .make:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px #ff6a00;
        border-color: #ff6a00;
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
    width: 200px;
    height: 60px;
    background: linear-gradient(to right, #ff6a00 50%, #f4f4f4 50%);
    background-size: 200% 100%;
    background-position: left bottom; /* start from left */
    padding: 10px;
    border-radius: 10px;
    color: #fff; /* text color starts as white for contrast */
    font-weight: 500;
    text-decoration: none;
    transition: all 0.5s ease;
}

.abd-location-card:hover {
    background-position: right bottom; /* slide to right */
    color: #ff6a00; /* text color changes on hover */
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
    .ad-cards {
        padding: 30px 4%;
        margin-top: 68px;
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
        .abd-location-name {
        font-size: 10px !important;
    }
}
   /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 40px;
        padding: 20px 0;
    }
    
    .pagination a {
        padding: 10px 18px;
        border: 1px solid #ff6a00;
        border-radius: 4px;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    
    .pagination a:hover,
    .pagination a.active {
        background: #ff6a00;
        color: white;
        border-color: #ff6a00;
    }
    @media (max-width: 600px) {
  .spareParts {
   
        margin-left: 0px !important;
        margin: auto !important;
    }
}
    .pagination .active,
.pagination .page-item.active .page-link {
    background: #ff7700 !important;
    color: white !important;
    border-color: #ff7700 !important;
}


/* SEO Content Section */
.seo_content {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.8;
    color: #2d3748;
    max-width: 90%;
    font-size: 16px;
    margin: auto;
}

/* Headings */
.seo_content h1,
.seo_content h2,
.seo_content h3,
.seo_content h4,
.seo_content h5,
.seo_content h6 {
    font-weight: 700;
    line-height: 1.3;
    margin-top: 0,5em;
    margin-bottom: 0.10em;
    color: #1a202c;
}

.seo_content h1 {
    border-bottom: none; /* پہلے لائن تھی، اب ختم */
    padding-bottom: 0; /* padding optional */
}

.seo_content h2 {
    border-left: none; /* پہلے لائن تھی، اب ختم */
    padding-left: 0; /* padding optional */
}

.seo_content h3 {
    font-size: 1.5rem;
    color: #2d3748;
}

.seo_content h4 {
    font-size: 1.25rem;
}

.seo_content h5 {
    font-size: 1.125rem;
}

.seo_content h6 {
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Paragraphs */
.seo_content p {
    
    text-align: justify;
}

/* Links */
.seo_content a {
    color: #3182ce;
    text-decoration: none;
    border-bottom: 1px dotted #3182ce;
    transition: all 0.3s ease;
}

.seo_content a:hover {
    color: #2c5282;
    border-bottom: 1px solid #2c5282;
}

/* Lists */
.seo_content ul,
.seo_content ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.seo_content li {
    margin-bottom: 0.75rem;
    position: relative;
}

.seo_content ul li:before {
    content: "•";
    color: #4299e1;
    font-weight: bold;
    position: absolute;
    left: -1rem;
}

/* Images */
.seo_content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Tables */
.seo_content table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.seo_content th {
    background-color: #edf2f7;
    font-weight: 600;
    padding: 1rem;
    text-align: left;
    border-bottom: 2px solid #cbd5e0;
}

.seo_content td {
    padding: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.seo_content tr:hover {
    background-color: #f7fafc;
}

/* Blockquotes */
.seo_content blockquote {
    background: linear-gradient(90deg, #ebf8ff 0%, transparent 100%);
    border-left: 4px solid #4299e1;
    padding: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: #4a5568;
}

/* Code blocks */
.seo_content pre {
    background-color: #1a202c;
    color: #e2e8f0;
    padding: 1.5rem;
    border-radius: 8px;
    overflow-x: auto;
    margin: 2rem 0;
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    font-size: 0.875rem;
}

.seo_content code {
    background-color: #f7fafc;
    color: #e53e3e;
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-family: 'Monaco', 'Menlo', monospace;
    font-size: 0.875rem;
}

.seo_content pre code {
    background: transparent;
    color: inherit;
    padding: 0;
}



/* Strong and Emphasis */
.seo_content strong {
    color: #2d3748;
    font-weight: 700;
}

.seo_content em {
    color: #4a5568;
    font-style: italic;
}

/* Responsive */
@media (max-width: 768px) {
    .seo_content {
        font-size: 15px;
        line-height: 1.7;
    }
    
    .seo_content h1 {
        font-size: 1.75rem;
    }
    
    .seo_content h2 {
        font-size: 1.5rem;
    }
    
    .seo_content h3 {
        font-size: 1.25rem;
    }
    
    .seo_content table {
        display: block;
        overflow-x: auto;
    }
     .pagination {
        width: auto !important;
    }
}

/* Additional SEO-friendly spacing */
.seo_content > *:first-child {
    margin-top: 0 !important;
}

.seo_content > *:last-child {
    margin-bottom: 0 !important;
}
 </style>
@endsection
