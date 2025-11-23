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
.hero-section_p {
    width: 100%;
    height: 630px;
    display: flex;
    flex-direction: column;
        background-image: url('https://www.thepartfinder.ae/assets/theme/pf-main/images/banner-bg.jpg');
}
.hero_section_text {
    width: 100%;
    font-size: 4rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 20px;
    background: none;           /* gradient remove */
    -webkit-background-clip: unset;  /* gradient clip remove */
    -webkit-text-fill-color: black;  /* solid black text */
    color: black;               /* fallback color */
}

.secound_hero_section {
    width: 100%;
    height: calc(100% - 80px); /* adjust hero text height */
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 0 50px;
}

.part_finder_card {
    width: 50%;
    display: flex;
    justify-content: flex-start; /* card left align */
    margin-top: -70px;
    margin-left: 10%;
    
}

.car {
    width: 400px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.hero_image_section {
    width: 50%;
    height: 100%;
    background-size: cover;
    background-position: center;
    margin-right: 10%;
    margin-top: 60px;

}
.hero_image_section img {
    width: 500px;          
    height: 400px;        
    object-fit: cover;   
}
.find-btn {
    width: 100%;
    background: linear-gradient(135deg, var(--accent-color), #ff9500);
    color: var(--primary-color);
    padding: 10px;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    height: 50px;
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
.dropdown {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    max-height: 150px; /* تقریباً 5-6 options */
    overflow-y: auto;  /* scroll show کرے گا جب زیادہ options ہوں */
}
.select2-results__options {
    max-height: 180px !important;  /* 5–6 items */
    overflow-y: auto !important;
}
#productGrid1 {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 cards per row */
    gap: 15px; /* space between cards */
 
   
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

#productGrid1 .buttons a.whatsapp {
    background: #25D366;
}

#productGrid1 .buttons a.call {
    background: #0b5ed7;
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
@media (max-width: 480px) {

    .hero_section_text h1 {
        font-size: 1.6rem !important;
    }

    .car {
        max-width: 330px;
    }

    .hero_image_section img {
        max-width: 260px;
    }

    .dropdown {
        font-size: 14px;
        padding: 7px;
    }
}

</style>
<div class="hero-section_p">
    <div class="hero_section_text">
        <h1>Find Your Perfect Parts</h1>
    </div>

    <div class="secound_hero_section">
        <div class="part_finder_card">
            <div class="car">
                <div class="card-header">
                    <div class="free-text">100% FREE</div>
                    <div class="search-title">Search Your Part Here</div>
                </div>
                <form action="{{ route('buyer.inquiry.send') }}" method="post">
                    @csrf
                    <div class="form-group" id="make-group">
                        <select class="dropdown" id="make" name="car_make_id">
                            <option disabled selected value="">Select Your Make</option>
                            @foreach ($makes as $make)
                                <option value="{{ $make->id }}">{{ $make->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="model-group">
                        <select class="dropdown" id="model" name="car_model_id">
                            <option value="">Select Your Model</option>
                        </select>
                    </div>

                    <div class="form-group" id="year-group">
                        <select class="dropdown" id="year" name="year_id">
                            <option value="">Select Your Model Year</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}">{{ $year->year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group hidden" id="parts-group">
                        <select id="parts-dropdown" class="dropdown" disabled>
                            <option disabled selected value="">Select a part to add</option>
                            @foreach ($parts as $part)
                                <option value="{{ $part->id }}">{{ $part->name }}</option>
                            @endforeach
                        </select>
                        <div id="parts-tags" class="parts-tags"></div>
                    </div>

                    <div class="form-group hidden" id="condition-group">
                        <div class="condition-section">
                            <div class="condition-title">Condition Required ?</div>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="used" name="condition" value="used" />
                                    <label for="used">Used</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="new" name="condition" value="new" checked />
                                    <label for="new">New</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="doesnt-matter" name="condition" value="does_not_matter" />
                                    <label for="doesnt-matter">Doesn't matter</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="find-btn" id="find-btn" disabled>Find My Part</button>
                </form>
            </div>
        </div>

        <div class="hero_image_section">
            <img src="https://partsfinder.ae/storage/profile_images/hero_section_image_1.png" alt="">
        </div>
    </div>
</div>



    </main>
     <section class="map">
        <div class="map-text">
            <ul>
                <li>Save Time, Save Money</li>
                <li>Search 10,000+ Auto Parts in One Go</li>
                <li>Check Prices & Stock of Top Part Suppliers</li>
                <li>Car, Van, and SUV Parts Fitted & Delivered</li>
                <li>Genuine, Aftermarket, Used & New Parts</li>
            </ul>
        </div>
        <div class="map-img">
            @if($domain && $domain->map_img)
          
                <img src="{{ asset( $domain->map_img) }}" alt="Map" />
            @endif
        </div>
    </section>
    <!-- How It Works -->
    <section class="how-it-works-section">
        <div class="how-text">
            <h2>How It Works</h2>
            <p>
                We partner with the UAE’s top spare parts suppliers to ensure you get the service you deserve.
            </p>
        </div>

        <div class="steps">
            <div class="step">
                <div class="step-icon">
                    <img src="{{ asset('Frontend/assets/1.png') }}" alt="Step 1" />
                </div>
                <div class="step-text">
                    <h3>Enter Your Part Requirement</h3>
                    <p>
                        Select your car and specify the spare parts you need.
                        We will search our suppliers’ inventory to find the best matches for your request.
                    </p>
                </div>
            </div>

            <div class="step">
                <div class="step-icon">
                    <img src="{{ asset('Frontend/assets/2.png') }}" alt="Step 2" />
                </div>
                <div class="step-text">
                    <h3>Receive Price Quotes on WhatsApp</h3>
                    <p>
                        Provide your contact, and we’ll send quotes from trusted and vetted spare parts sellers.
                        Compare prices and select the seller that suits your needs best.
                    </p>
                </div>
            </div>

            <div class="step">
                <div class="step-icon">
                    <img src="{{ asset('Frontend/assets/3.png') }}" alt="Step 3" />
                </div>
                <div class="step-text">
                    <h3>Sit Back and Relax</h3>
                    <p>
                        Check your WhatsApp for received quotes.
                        Confirm your order with the selected supplier and choose whether you want delivery, fitting, or
                        pickup yourself.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="carMakes">
        <div class="section-text">
            <h3>TOP MAKES</h3>
            <h2>Browse By Brands</h2>
        </div>

        <div class="brands">
            @foreach ($carMakes as $make)
                <a href="{{ route('make.ads', ['slug' => $make->slug, 'id' => $make->id]) }}" class="make">
                    @if($make->logo)
               
                      <img src="{{ asset('storage/' . $make->logo) }}" alt="{{ $make->name }}">
                      

                    @endif
                    <h4>{{ strtoupper($make->name) }}</h4>
                </a>
            @endforeach
        </div>
    </section>

    <section class="ad-cards">
        <div class="section-text">
            <h3>TOP ADS</h3>
            <h2>Find the Best Deals For You</h2>
        </div>
        <div class="filters">
            <a href="#" class="active">All</a>
            @foreach ($randomParts as $part)
                <a href="{{ route('part.ads', ['partName' => Str::slug($part->name), 'id' => $part->id]) }}">
                    {{ $part->name }}
                </a>
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
                                 <a href="https://wa.me/{{ preg_replace('/\D/', '', $ad->shop->supplier->whatsapp) }}" target="_blank"
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

            {{-- <div class="card">
                <img src="assets/ad (2).jpg" alt="Product">
                <div class="card-body">
                    <a href="" class="card-title">Mercedes Cla200 2019 Window Switch Panel</a>
                    <div class="price">AED 100</div>
                    <div class="meta">
                        Availability: In Stock <br>
                        Condition: Used <br>
                        Delivery: Ask Supplier <br>
                        Warranty: Ask Supplier
                    </div>
                    <div class="buttons">
                        <a href="#" class="btn whatsapp">WhatsApp</a>
                        <a href="#" class="btn call">Click to Call</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="assets/ad (2).jpg" alt="Product">
                <div class="card-body">
                    <a href="" class="card-title">Mercedes Cla200 2019 Window Switch Panel</a>
                    <div class="price">AED 100</div>
                    <div class="meta">
                        Availability: In Stock <br>
                        Condition: Used <br>
                        Delivery: Ask Supplier <br>
                        Warranty: Ask Supplier
                    </div>
                    <div class="buttons">
                        <a href="#" class="btn whatsapp">WhatsApp</a>
                        <a href="#" class="btn call">Click to Call</a>
                    </div>
                </div>
            </div> --}}

            <!-- Repeat similar cards... -->
        </div>

        <div class="pagination" id="pagination1"></div>
    </section>
    <section class="spareParts">
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
        </div>
    </section>
    <section class="ad-cards">
        <div class="section-text">
            <h3>TOP CAR ADS</h3>
            <h2>Our Sellers are Currently Breaking These Cars for Spare Parts</h2>
        </div>
        <div class="filters">
            <a href="#" class="active">All</a>
            @foreach ($randomMakes as $make)
                <a href="{{ route('make.ads', ['slug' => $make->slug, 'id' => $make->id]) }}">{{ $make->name }}</a>
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
                        <a href="{{ route('view.car.ad', ['slug' => $ad->slug, 'id' => $ad->id]) }}"
                            class="card-title">{{ $ad->title }}</a>
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

    <!-- Map -->
   
    <!-- Locations -->
    <section class="locations-section">
        <div class="section-text">
            <h2>Auto Parts for Cars, Vans, SUVs Anywhere in the UAE</h2>

        </div>
        <div class="locations-grid">
            @if($domain && $domain->cities)
                @foreach ($domain->cities as $city)
                    <a href="{{ route('city.ads', ['slug' => $city->slug, 'id' => $city->id]) }}" class="location-card"><i
                            class="fa-solid fa-location-dot"></i> {{ $city->name }}</a>
                @endforeach
            @endif
        </div>
    </section>

    @include('Frontend.layout.company')
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

 </style>


     <script>
     

        function callSupplier(isActive, number) {
            if (isActive == 1) {
                window.location.href = `tel:${number}`;
            } else {
                // Supplier inactive → stay on same page
                window.location.reload();
            }
        }

        function setupPagination(gridId, paginationId, perPage = 6) {
    const products = document.querySelectorAll(`#${gridId} .card`);
    const totalPages = Math.ceil(products.length / perPage);
    const pagination = document.getElementById(paginationId);

    function showPage(page) {
        products.forEach((product, i) => {
            product.style.display =
                i >= (page - 1) * perPage && i < page * perPage
                    ? "block"
                    : "none";
        });
        pagination.querySelectorAll("button").forEach((btn, i) => {
            btn.classList.toggle("active", i + 1 === page);
        });
    }

    pagination.innerHTML = ""; // clear old buttons

    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement("button");
        btn.innerText = i;
        btn.addEventListener("click", () => showPage(i));
        pagination.appendChild(btn);
    }

    if (totalPages > 0) {
        showPage(1);
    }
}

// Call for both sections

document.addEventListener("DOMContentLoaded", () => {
    setupPagination("productGrid1", "pagination1", 8);
    setupPagination("productGrid2", "pagination2", 8);
});
    function contactSupplier(isActive, whatsapp, title) {
            if (isActive === '1') {
                const message = encodeURIComponent(`Hello, I'm interested in: ${title}`);
                const cleanWhatsapp = whatsapp.replace(/\D/g, '');
                window.open(`https://wa.me/${cleanWhatsapp}?text=${message}`, '_blank');
            } else {
                alert('Supplier is currently inactive');
            }
        }
</script>

@endsection
