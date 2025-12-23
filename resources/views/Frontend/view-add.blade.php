@extends('Frontend.layout.main')
@section('main-section')

    <style>
        body, main, header, nav, .hero-section, .hero-section_p {
            background-image: none !important;
            background: none !important;
        }
        
        .product-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }
        
        .price {
            font-size: 28px;
            font-weight: 700;
            color: #e00;
            margin: 15px 0;
        }
        
        .btn.whatsapp {
            background-color: #25D366;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .btn.whatsapp:hover {
            background-color: #128C7E;
            color: white;
        }
        
        .btn.call {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .btn.call:hover {
            background-color: #0056b3;
            color: white;
        }
        
        .spec-table table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .spec-table th {
            background-color: #f8f9fa;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        
        .spec-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .spec-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
            #productCarousel .carousel-inner img {
                width: 100%;
                height: 300px; /* ← sirf yeh rakho */
                object-fit: contain;
                background-color: white;
            }
        
        .carousel-control-prev, .carousel-control-next {
            background-color: rgba(0,0,0,0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .carousel-control-prev {
            left: 10px;
        }
        
        .carousel-control-next {
            right: 10px;
        }
        
        @media (max-width: 768px) {
            .product-title {
                font-size: 20px;
            }
            
            .price {
                font-size: 24px;
            }
            
            .btn.whatsapp, .btn.call {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
        .fa-whatsapp:before{
            font-size: 50px;
                padding-right: 40px;
            color: green
        }
        .fa-phone:before{
            font-size: 44px;
        
            color: #e00;
        }
        .buttons_ct{
            float: right;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row g-4">
            <!-- Left: Carousel -->
            <div class="col-md-6">
                                @php
                            // Check if $ad exists and has images
                            $images = null;
                            if(!empty($ad) && !empty($ad->images)){
                                $images = is_string($ad->images) ? json_decode($ad->images, true) : $ad->images;
                            }
                        @endphp


                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset($image) }}" class="d-block w-100"
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
                <h1 class="product-title">{{ $ad->title }} {{$ad->part_number}}</h1>
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
                <p class="text-muted">Warranty: {{ $ad->warranty }}</strong></p>
                <p class="price"> {{ $ad->currency }}: {{ $ad->price }}</p>
              
                
                 <div class="d-flex gap-4 my-4 buttons_ct">

<div class="text-center">
<a href="https://wa.me/{{ preg_replace('/\D/', '', $ad->shop->supplier->whatsapp) }}?text={{ urlencode('Hello, I am interested in your ad: ' . $ad->title) }}"
   target="_blank"
   class="round-btn">
    <i class="fa-brands fa-whatsapp"></i>
</a>
</div>
    <div class="text-center">
        <a href="javascript:void(0)" class="round-btn call-btn"
            onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">
            <i class="fa-solid fa-phone"></i>
        </a>
       
    </div>

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
                    <tr>
                        <td>Description</td>
                       <td>{{ $ad->description }}</td>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
   function contactSupplier(isActive, number, title) {
    if (isActive == 1) {

        // WhatsApp number clean → remove spaces, dashes, +, etc.
        number = number.replace(/\D/g, '');

        let message = encodeURIComponent("Hello, I'm interested in your ad: " + title);
        let isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

        let url = isMobile
            ? `https://wa.me/${number}?text=${message}`
            : `https://web.whatsapp.com/send?phone=${number}&text=${message}`;

        window.open(url, "_blank");
    } else {
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

        // Mobile Menu Functionality


    </script>
@endsection