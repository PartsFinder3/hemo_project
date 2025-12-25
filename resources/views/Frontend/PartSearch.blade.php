@extends('Frontend.layout.main')

@section('main-section')



@include('Frontend.hero_section', [
    'part' => '<span class="hiliter">' . $part->name . '</span> Parts for Sale in UAE',
    'image' => 'storage/'.$part->image,
])

    </main>

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
<section class="seo_content">
    @if(!empty($content))
        {!! $content->content !!}
    @endif
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
.part-card {
    width: 200px;
    height: 150px;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 8px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    gap: 0px;
    overflow: hidden;
    background: #fff;
    transition: 0.3s ease;
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
    margin-top: 2em;
    margin-bottom: 0.75em;
    color: #1a202c;
}

.seo_content h1 {
    font-size: 2.25rem;
  
 
}

.seo_content h2 {
    font-size: 1.875rem;
  
   
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
    margin-bottom: 1.5rem;
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

/* Horizontal Rule */
.seo_content hr {
    border: none;
    height: 1px;
    background: linear-gradient(90deg, transparent, #cbd5e0, transparent);
    margin: 3rem 0;
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
</style>

@endsection
