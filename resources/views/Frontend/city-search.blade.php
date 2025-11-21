@extends('Frontend.layout.main')
@section('main-section')
<style>
 
    .hero-section_p{
       width: 100%;
       height: auto;
       display: flex;
       flex-direction: column
    }
   .hero_section_text{
     width: 100%;
     height: 7%;
    font-size: 4rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-align: center;
    font-weight: bolder;
   }
   .secound_hero_section{
    widows: 100%;
    height: 88%;
   
    display: flex;
    flex-direction: row;   
}
   .part_finder_card{
     width: 50%;
     height: 100%;
     
   }
   .search-title{
      padding-bottom: 10px;
   }
   .car{
    width: 400px !important;
   
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    width: 450px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-left: 140px;

   }


   .free-text {
    background: var(--accent-color);
    color: var(--primary-color);
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    display: inline-block;
    margin-top: -15px;
    
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
    transition: 0.3s;
    /* margin-top: 10px; */
    height: 50px !important;
    font-family: 'Montserrat', sans-serif;
}
</style>
 <div class="hero-section_p">
         <div class="hero_section_text">
              <h1>Showing Results for {{ $city->name }}.</h1>
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
                        <option value="{{ $make->id }}">    {{ $make->name }}</option>
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

 

     
    </div>
</div>

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

                    @if (is_array($images) && isset($images[0]))
                        <img src="{{ asset('' . $images[0]) }}" alt="Product">
                    @endif
                    <div class="card-body">
                        <a href="" class="card-title">{{ $ad->title }}</a>
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
@endsection
