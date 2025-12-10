@extends('Frontend.layout.main')

@section('main-section')



@include('Frontend.hero_section', [
    'part' => '<span class="hiliter">' . $part->name . '</span> Parts for Sale in UAE',
    'image' => 'storage/'.$part->image,
])

    </main>
    {{-- <section class="carMakes">
        <div class="section-text">
            <h3>TOP MAKES</h3>
            <h2>Browse By Brands</h2>
        </div>

        <div class="brands">
            @foreach ($carMakes as $make)
                <a href="{{ route('makes.show', $make->id) }}" class="make">
                    <img src="{{ asset('' . $make->logo) }}" alt="{{ $make->name }}">
                    <h4>{{ strtoupper($make->name) }}</h4>
                </a>
            @endforeach
        </div>
    </section> --}}

    <section class="ad-cards">
        <div class="section-text">
            <h3>{{ $part->name }} ADS</h3>
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




/* Responsive */


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
    height: 470px;
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
    width: 100%;
}
#productGrid1 .buttons a.whatsapp {
    background: #198754;
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

@endsection
