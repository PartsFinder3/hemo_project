@extends('Frontend.layout.main')
@section('main-section')

@include('Frontend.hero_section', [
    'part' => '<span class="hiliter">' . $make->name . '</span> Parts for Sale in UAE',
    'image' => 'storage/'.$make->logo
])

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

<!-- Locations Section -->
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
            window.location.reload();
        }
    }

    function callSupplier(isActive, number) {
        if (isActive == 1) {
            window.location.href = `tel:${number}`;
        } else {
            window.location.reload();
        }
    }
</script>

<style>
    /* Card Styles */
    .card {
        width: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        height: 470px;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        border-color: #aaa;
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        flex-shrink: 0;
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
        color: #333;
        text-decoration: none;
    }
    
    .card-title:hover {
        color: #ff6a00;
    }

    .price {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .meta {
        font-size: 14px;
        line-height: 1.4;
        flex-grow: 1;
        color: #666;
    }

    /* Button Styles */
    .buttons {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    
    .btn {
        flex: 1;
        padding: 8px 12px;
        border-radius: 4px;
        text-align: center;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
    
    .btn.whatsapp {
        background: #25D366;
        color: white;
        border: none;
    }
    
    .btn.whatsapp:hover {
        background: #1da851;
    }
    
    .btn.call {
        background: #007bff;
        color: white;
        border: none;
    }
    
    .btn.call:hover {
        background: #0056b3;
    }

    /* Filters */
    .filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
        padding: 15px 0;
    }
    
    .filters a {
        padding: 8px 16px;
        border: 1px solid #ddd;
        border-radius: 20px;
        text-decoration: none;
        color: #666;
        transition: all 0.3s ease;
    }
    
    .filters a.active,
    .filters a:hover {
        background: #ff6a00;
        color: white;
        border-color: #ff6a00;
    }

    /* Grid Layout */
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    /* Makes/Brands Section */
    .carMakes {
        padding: 40px 20px;
        background: #f9f9f9;
        margin: 40px 0;
    }
    
    .section-text {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .section-text h3 {
        color: #666;
        font-size: 16px;
        margin-bottom: 5px;
    }
    
    .section-text h2 {
        color: #333;
        font-size: 28px;
        margin-top: 0;
    }
    
    .brands {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .make {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        width: 150px;
        height: 115px;
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
        width: 90%;
        height: 60px;
        object-fit: contain;
        margin-bottom: 8px;
    }
    
    .make h4 {
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        margin: 0;
        line-height: 1.2em;
        height: 2.4em;
        overflow: hidden;
    }

    /* Locations Section */
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
    
    .abd-locations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 200px));
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

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 30px;
        padding: 20px 0;
    }
    
    .pagination a {
        padding: 8px 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
    }
    
    .pagination a:hover,
    .pagination a.active {
        background: #ff6a00;
        color: white;
        border-color: #ff6a00;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }
        
        .card {
            height: auto;
            min-height: 450px;
        }
        
        .buttons {
            flex-direction: column;
        }
        
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
        
        .make {
            width: 120px;
            height: 100px;
        }
        
        .make img {
            height: 50px;
        }
        
        .make h4 {
            font-size: 12px;
        }
    }
    
    @media (max-width: 480px) {
        .grid {
            grid-template-columns: 1fr;
        }
        
        .card {
            height: auto;
            min-height: 400px;
        }
        
        .section-text h2 {
            font-size: 24px;
        }
        
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
        
        .filters {
            justify-content: center;
        }
        
        .filters a {
            font-size: 14px;
            padding: 6px 12px;
        }
    }
</style>

@endsection