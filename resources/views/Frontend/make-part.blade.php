@extends('Frontend.layout.main')
@section('main-section')




@include('Frontend.hero_section', [
  'part' => '<span class="hiliter">' . $part->name . '</span> Parts for Sale in UAE'
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

    <!-- Locations -->
    <section class="locations-section">
        <div class="section-text">
            <h2>{{ $part->name }} for Cars, Vans, SUVs Anywhere in the UAE</h2>

        </div>
        <div class="locations-grid">

            @foreach ($domain->cities as $city)
                <a href="{{ route('city.ads', ['slug' => $city->slug, 'id' => $city->id]) }}" class="location-card"><i
                        class="fa-solid fa-location-dot"></i> {{ $city->name }}</a>
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
const burgerMenu = document.getElementById("burger-menu");
const navMenu = document.getElementById("nav-menu");

if (burgerMenu && navMenu) {
    burgerMenu.addEventListener("click", function () {
        burgerMenu.classList.toggle("active");
        navMenu.classList.toggle("active");
    });

    // Close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll(".nav-menu a");
    navLinks.forEach((link) => {
        link.addEventListener("click", () => {
            burgerMenu.classList.remove("active");
            navMenu.classList.remove("active");
        });
    });

    // Close mobile menu when clicking outside
    document.addEventListener("click", function (event) {
        if (
            !burgerMenu.contains(event.target) &&
            !navMenu.contains(event.target)
        ) {
            burgerMenu.classList.remove("active");
            navMenu.classList.remove("active");
        }
    });

    // Close mobile menu on window resize
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            burgerMenu.classList.remove("active");
            navMenu.classList.remove("active");
        }
    });
}
</script>
@endsection
