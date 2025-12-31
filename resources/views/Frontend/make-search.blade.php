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

                <div class="image-container">
                    @if (is_array($images) && isset($images[0]))
                        <img src="{{ asset('' . $images[0]) }}" alt="{{ $ad->title }}" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                    @else
                        <img src="{{ asset('images/placeholder.jpg') }}" alt="No Image">
                    @endif
                </div>
                
                <div class="card-body">
                    <a href="{{ route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id]) }}" class="card-title">{{ $ad->title }}</a>
                    <div class="price">AED {{ number_format($ad->price) }}</div>
                    <div class="meta">
                        <div class="meta-item"><strong>Condition:</strong> {{ $ad->condition }}</div>
                        <div class="meta-item"><strong>Availability:</strong> In Stock</div>
                        <div class="meta-item"><strong>Delivery:</strong> Ask Supplier</div>
                        <div class="meta-item"><strong>Warranty:</strong> Ask Supplier</div>
                    </div>
                    
                    <div class="buttons">
                        <a href="javascript:void(0)" class="btn whatsapp"
                            onclick="contactSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}', '{{ $ad->title }}')">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </a>

                        <a href="javascript:void(0)" class="btn call"
                            onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">
                            <i class="fa-solid fa-phone"></i>Click to Call
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination" id="pagination1"></div>
</section>

<section class="carMakes" id="carMakes">
    <div class="section-text">
        <h3>TOP MAKES</h3>
        <h2>Browse By Brands</h2>
    </div>

    <div class="brands">
        @foreach ($carMakes as $m)
            <a href="{{ route('make.ads', ['slug' => $m->slug, 'id' => $m->id]) }}" class="make">
                @if($m->logo)
                    <div class="make-image-container">
                        <img src="{{ asset('storage/' . $m->logo) }}" alt="{{ $m->name }}" onerror="this.src='{{ asset('images/brand-placeholder.png') }}'">
                    </div>
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


@if(isset($Content->seo_content_make) && $Content->seo_content_make)
<section class="seo_content">
     <hr style="
    border: none;
    border-top: 4px solid #FF7100;
    opacity: 1;
    margin: 30px 0;
">
    {!! $Content->seo_content_make !!}
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
#productGrid1 {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
        .spareParts {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    max-width: 90% !important;
    margin-left: 63px !important;
    padding: 30px;
}
    /* Fixed Image Container for Ads */ .footer-section{
            margin-top: 20px !important;
        }
    .image-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
    }
    .part-card {
    width: 250px;
    height: 180px;
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
.part-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px #ff7700;
    border-color: #ff7700;
}
    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: contain; /* Yahan contain use karein takay poori image show ho */
        transition: transform 0.3s ease;
    }
    
    .card:hover .image-container img {
        transform: scale(1.05);
    }
    
    /* Fixed Height Card for Uniformity */
    .card {
        width: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        height: 480px; /* Fixed height for all cards */
        background: white;
        transition: all 0.3s ease;
        height: 520px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      
    }

    .card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    /* Fixed Title Height - Sab cards ka title same height par */
    .card-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.4em;
        height: 2.8em; /* Exactly 2 lines ki height */
        overflow: hidden;
        color: #333;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Maximum 2 lines */
        -webkit-box-orient: vertical;
    }
    
    .card-title:hover {
        color: #ff6a00;
    }

    .price {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 12px;
        color: #ff6a00;
    }

    /* Fixed Meta Information */
    .meta {
        margin-bottom: 15px;
        flex-grow: 1;
    }
    
    .meta-item {
        font-size: 13px;
        line-height: 1.4;
        color: #666;
        margin-bottom: 4px;
        display: flex;
        justify-content: space-between;
    }
    
    .meta-item strong {
        color: #333;
        font-weight: 600;
    }

    /* Fixed Button Height */
    .buttons {
        display: flex;
        gap: 10px;
        margin-top: auto;
    }
    
    .btn {
        flex: 1;
        padding: 10px;
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
        height: 40px; /* Fixed button height */
    }
    
    .btn.whatsapp {
        background: #198754;
        color: white;
        border: none;
    }
    
    .btn.whatsapp:hover {
       
        transform: translateY(-2px);
    }
    
    .btn.call {
        background: #ff7700;
        color: white;
        border: none;
    }
    
    .btn.call:hover {
     
        transform: translateY(-2px);
    }

    /* Filters */
    .filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 20px 0 30px;
        padding: 15px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }
    
    .filters a {
        padding: 8px 16px;
        border: 1px solid #ddd;
        border-radius: 20px;
        text-decoration: none;
        color: #666;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: 500;
    }
    
    .filters a.active,
    .filters a:hover {
        background: #ff6a00;
        color: white;
        border-color: #ff6a00;
    }

    /* Grid Layout - Fixed columns */
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    /* Makes/Brands Section with Fixed Images */
 
    
    .section-text {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .section-text h3 {
        color: #666;
        font-size: 16px;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .section-text h2 {
        color: #333;
        font-size: 32px;
        margin: 0;
        font-weight: 700;
    }
    
    .brands {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
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
    
    .make-image-container {
        width: 100%;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }
    
    .make img {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
    }
    
    .make h4 {
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        margin: 0;
        line-height: 1.3em;
        height: 2.6em; /* Fixed height for brand names */
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        color: #333;
    }

    /* Locations Section */
    .abd-locations-section {
        padding: 50px 20px;
        background-color: #fff;
        text-align: center;
    }
    
    .abd-locations-header h2 {
        font-size: 28px;
        color: #333;
        margin-bottom: 40px;
        font-weight: 600;
        line-height: 1.3;
    }
    
    .abd-locations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 200px));
        gap: 20px;
        justify-content: center;
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
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
        margin-top: 40px;
        padding: 20px 0;
        width: 800px;
        margin: auto;
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

    /* Responsive Styles */
    @media (max-width: 1024px) {
        .grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
        
        .card {
            height: 460px;
        }
        
        .image-container {
            height: 180px;
        }
        
        .buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
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
            width: 140px;
            height: 120px;
        }
        
        .make-image-container {
            height: 60px;
        }
        
        .make h4 {
            font-size: 13px;
        }
    }
    
    @media (max-width: 480px) {
        .grid {
            grid-template-columns: 1fr;
            max-width: 350px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .card {
            height: 500px;
        }
        
        .section-text h2 {
            font-size: 24px;
        }
        
        .abd-locations-section {
            padding: 30px 15px;
        }
        
        .abd-locations-header h2 {
            font-size: 20px;
        }
        
        .abd-locations-grid {
            grid-template-columns: repeat(auto-fit, minmax(120px, 120px));
            gap: 15px;
            padding: 20px;
        }
        
        .abd-location-card {
            width: 120px;
            height: 45px;
            font-size: 13px;
        }
        
        .filters {
            justify-content: center;
            overflow-x: auto;
            padding: 10px 0;
        }
        
        .filters a {
            font-size: 13px;
            padding: 6px 12px;
            white-space: nowrap;
        }
        
        .brands {
            gap: 15px;
        }
        
        .make {
            width: 130px;
            height: 110px;
            padding: 12px;
        }
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
    .pagination .active,
.pagination .page-item.active .page-link {
    background: #ff7700 !important;
    color: white !important;
    border-color: #ff7700 !important;
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
        margin-top: 50px;
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
}

/* Additional SEO-friendly spacing */
.seo_content > *:first-child {
    margin-top: 0 !important;
}

.seo_content > *:last-child {
    margin-bottom: 0 !important;
}
/* Tablet */
@media (max-width: 1024px) {
    #productGrid1 {
        width: 95%;
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile */
@media (max-width: 768px) {
    #productGrid1 {
        width: 100%;
        padding: 0 12px;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    #productGrid1 .card {
        width: 100%;
        height: auto;
    }

    #productGrid1 .card img {
        height: 140px;
        object-fit: cover;
    }
}

/* Small Mobile */
@media (max-width: 480px) {
    #productGrid1 {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    #productGrid1 .buttons {
        flex-direction: column;
    }

    #productGrid1 .buttons a {
        height: 44px;
        font-size: 14px;
    }

        .abd-location-name {
        font-size: 10px !important;
    }
}
@media (max-width: 600px) {
  .spareParts {
   
        margin-left: 0px !important;
        margin: auto !important;
    }
     .pagination {
        width: auto !important;
    }
}
.pagination .active,
.pagination .page-item.active .page-link,
.pagination .disabled .page-link {
    background: #ff7700 !important;
    color: white !important;
    border-color: #ff7700 !important;
}
.hero_image_section {

    top: -2px;
               /* center hatao */
}
</style>

@endsection