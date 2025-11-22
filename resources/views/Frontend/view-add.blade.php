@extends('Frontend.layout.main')
@section('main-section')
<style>
    #productCarousel .carousel-inner img {
    width: 100%;       /* full width of carousel */
    height: auto;      /* maintain aspect ratio */
    object-fit: contain; /* poori image dikhayega, crop nahi hoga */
    background-color: #f7f7f7; /* optional: clean background */
}
   body, main, header, nav, .hero-section, .hero-section_p {
    background-image: none !important;
    background: none !important;
}
</style>
   
    <div class="container my-5">
        <div class="row g-4">
            <!-- Left: Carousel -->
            <div class="col-md-6">
                @php
                    $images = is_string($ad->images) ? json_decode($ad->images, true) : $ad->images;
                @endphp

                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset( $image) }}" class="d-block w-100"
                                    alt="Car Image {{ $key + 1 }}">
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

            </div>

            <!-- Right: Details -->
            <div class="col-md-6">
                <h3 class="product-title">{{ $ad->title }}</h3>
                <p class="text-muted">Condition: <strong>
                        @if ($ad->condition == 'new')
                            New
                        @elseif ($ad->condition == 'used')
                            Used
                        @endif
                    </strong></p>
                @php
                    $location = $ad->shop->supplier->city->name ?? 'Unknown';
                    $contact = $ad->shop->supplier->whatsapp;
                    $make = $ad->carMake->name ?? 'Unknown';
                    $model = $ad->carModel->name ?? 'Unknown';
                    $year = $ad->year->year ?? 'Unknown';
                    $shopName = $ad->shop->name ?? 'Unknown';
                @endphp
                <p class="text-muted">Supplier Location: <strong>{{ $location }}</strong></p>
                <p class="price">AED: {{ $ad->price }}</p>

                <div class="d-flex gap-2 my-3">
                    <a href="javascript:void(0)" class="btn whatsapp"
                        onclick="contactSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}', '{{ $ad->title }}')">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>

                    <a href="javascript:void(0)" class="btn call"
                        onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">
                        <i class="fa-solid fa-phone"></i> Click to Call
                    </a>
                </div>

                {{-- <p class="text-success fw-semibold">⭐ 98.9% Positive Feedback</p> --}}
            </div>
        </div>

        <!-- Item Specification Table -->
        <div class="spec-table mt-5">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Item Specification</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Make</td>
                        <td>{{$make}}</td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td>{{$model}}</td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td>{{$year}}</td>
                    </tr>
                    {{-- <tr>
                        <td>Part Category</td>
                        <td>Body Panel</td>
                    </tr> --}}
                    <tr>
                        <td>Parts Supplier</td>
                        <td>{{$shopName}}</td>
                    </tr>
                    {{-- <tr>
                        <td>Ref. No.</td>
                        <td>UAE-381-15983</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>

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
