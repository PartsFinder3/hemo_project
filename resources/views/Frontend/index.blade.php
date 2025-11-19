@extends('Frontend.layout.main')
@section('main-section')
    <div class="hero-section">
        <div class="hero-text">
            <h1>Find Your Perfect Parts</h1>
            <p>Your one-stop solution for all your automotive needs.</p>
        </div>

        <div class="search-card">
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
                                <label for="does_not_matter">Doesn't matter</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="find-btn" id="find-btn" disabled>Find My Part</button>
            </form>
        </div>
    </div>

    </main>
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
                        <img src="{{ asset($make->logo) }}" alt="{{ $make->name }}">
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

                    @if (is_array($images) && isset($images[0]))
                        <img src="{{ asset('' . $images[0]) }}" alt="Product">
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
                <div class="part-card">
                    @if ($p->image)
                    {{$p->image}}
                        <img src="{{ asset($p->image) }}" alt="{{ $p->name }}">
                    @else
                        <img src="{{ asset('Frontend/assets/quote.png') }}" alt="{{ $p->name }}" />
                    @endif
                    <a style="text-decoration: none; color: black;"
                        href="{{ route('part.ads', ['partName' => Str::slug($p->name), 'id' => $p->id]) }}">
                        {{ $p->name }}
                    </a>
                </div>
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
                <img src="{{ asset('storage/' . $domain->map_img) }}" alt="Map" />
            @endif
        </div>
    </section>
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
    .card {
    display: flex;
    flex-direction: column;
    border: 1px solid #ddd;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
}

/* IMAGE BOX FIXED */
.card .image-box {
    width: 100%;
    height: 200px; /* Fixed height */
    overflow: hidden;
    border-bottom: 1px solid #eee;
}

.card .image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Image box mein hi rahegi */
}

/* CARD BODY */
.card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 12px;
}

/* TITLE BOX FIXED HEIGHT */
.card-title {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* max 2 lines only */
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-size: 16px;
    font-weight: 600;
    min-height: 42px; /* height fix so design stable */
    margin-bottom: 10px;
}

/* PRICE & META */
.price {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 8px;
}

.meta {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
    flex: 1;
}

/* BUTTONS ALWAYS BOTTOM */
.buttons {
    display: flex;
    gap: 10px;
}

</style>
@endsection
