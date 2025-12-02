@extends('Frontend.layout.main')
@section('main-section')
<style>
.image_box {
    width:83%;
    height: 240px;
    margin: 20px auto; 
    margin-top: 50px !important;
    background-size: cover;        /* image پورے box میں fit ہو جائے */
    background-position: center;   /* image center سے show ہو */
    background-repeat: no-repeat;  /* image repeat نہ ہو */
}
.cover_system{
    width: 83%;
    height: 150px;
     margin: 20px auto; 
    /* background-color: red; */
    display: flex;
    flex-direction: row;
}
.profile_photo{
    width: 150px;
    height: 150px;
    
    border-radius: 50%;
        background-size: cover;        /* image پورے box میں fit ہو جائے */
    background-position: center;   /* image center سے show ہو */
    background-repeat: no-repeat; 
}
.information-contanier{
   width: auto;
   height: 100%;

   display: flex;
   flex-direction: column;
   margin-left: 20px !important;
}
.inqueries{
    padding: 10px;

}
.information-contanier {
    margin-top: 20px;
}

.icons_media {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.icons {
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
   border-radius: 5px;
    transition: transform 0.3s;
}

.icons img {
    width: 24px;  /* icon size */
    height: 24px;
}

.icons:hover {
    transform: scale(1.1);
}
.button_sides{
    width: 300px;
    height: 100%;

    margin-left: 350px;
}
.buttons {
    display: flex;
    flex-direction: row;
    gap: 10px; 
    margin-top: 60px;
    
}

.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px; 
    width: 120px;
    height: 40px;
    background-color: white;
    color: black;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background-color: #e0e0e0;
}

.btn img {
    width: 20px;
    height: 20px;
}
.btn.whatsapp {
     border:1px solid #007bff;  /* WhatsApp green */
    background-color: white;
    color: black;
}

.btn.call {
   border:1px solid #007bff; /* Blue color for call */
      background-color: white;
      color: black;
}
</style>
 <div class="image_box"  style="background-image: url('{{ $profile && $profile->cover ? asset('storage/'. $profile->cover) : asset('assets/compiled/jpg/Head.png') }}');">

 </div>
 <div class="cover_system">
    <div class="profile_photo"   style="background-image: url('{{ $profile && $profile->profile_image ? asset('storage/' . $profile->profile_image) : asset('assets/compiled/jpg/default-avatar.png') }}');">
    </div>
    <div class="information-contanier">
          <div class="shop_name">
            <h3>{{ $shop->name ?? 'Shop Name Here' }}</h3>
          </div>
          <div class="inqueries">
           <span class="stat-item">📦 {{$totalAds}} Items Listed</span>
            <span class="stat-item">💬 {{$inquiryCount}} Enquiries</span>
          </div>
    <div class="icons_media">
                    <!-- Facebook -->
            <div class="icons"  style="background-color: #4267B2">
                <a href="https://www.facebook.com/yourpage" target="_blank">
                    <img src="https://platform-cdn.sharethis.com/img/facebook.svg" alt="Facebook">
                </a>
            </div>
                        <!-- X / Twitter -->
            <div class="icons" style="background-color: black">
                <a href="https://twitter.com/yourprofile" target="_blank">
                    <img src="https://platform-cdn.sharethis.com/img/twitter.svg" alt="X / Twitter">
                </a>
            </div>
                    <!-- LinkedIn -->
               <div class="icons"  style="background-color: #0077b5">
                <a href="https://www.linkedin.com/in/yourprofile" target="_blank">
                    <img src="https://platform-cdn.sharethis.com/img/linkedin.svg" alt="LinkedIn">
                </a>
               </div>
                <!-- WhatsApp -->
               <div class="icons" style="background-color:#25d366 ">
                <a href="https://wa.me/yourphonenumber" target="_blank">
                    <img src="https://platform-cdn.sharethis.com/img/whatsapp.svg" alt="WhatsApp">
                </a> 
            </div>
        </div>


    </div>
    <div class="button_sides">
<div class="buttons">
    <a href="https://wa.me/yourphonenumber" target="_blank" class="btn whatsapp">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
        Whatsapp
    </a>
    <a href="tel:yourphonenumber" class="btn call">
        <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call">
        Call
    </a>
</div>

    </div>
 </div>

    
  
</div>


        <!-- Opening Hours Card -->
        @if($shopHours)
        <div class="info-card mt-4">
            <div class="section-title">Opening Hours</div>
            <div class="hours-grid">
                @php
                    $hours = [
                        'Monday' => $shopHours->monday,
                        'Tuesday' => $shopHours->tuesday,
                        'Wednesday' => $shopHours->wednesday,
                        'Thursday' => $shopHours->thursday,
                        'Friday' => $shopHours->friday,
                        'Saturday' => $shopHours->saturday,
                        'Sunday' => $shopHours->sunday,
                    ];
                @endphp

                @foreach($hours as $day => $time)
                    <div class="day-row">
                        <span class="day">{{ $day }}</span>
                        <span class="time">{{ $time }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Products Grid -->
        <div class="products-grid mt-4" id="productGrid1">
            @if($shopAds && $shopAds->count())
                @foreach($shopAds as $ad)
                    <div class="card product-card">
                        @php
                            $images = json_decode($ad->images, true);
                        @endphp

                        @if (is_array($images) && isset($images[0]))
                            <div class="product-image">
                                <img src="{{ asset($images[0]) }}" alt="Product">
                            </div>
                        @endif
                        
                        <div class="product-body">
                            <a href="{{ route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id]) }}"
                                class="product-title">{{ $ad->title }}</a>
                            
                            <div class="product-meta">
                                Availability: In Stock <br>
                                Delivery: Ask Supplier <br>
                                Warranty: Ask Supplier
                            </div>
                            
                            <div class="product-buttons">
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $ad->shop->supplier->whatsapp) }}?text={{ urlencode('Hello, I am interested in your ad: ' . $ad->title) }}"
                                   target="_blank"
                                   class="btn-product whatsapp">
                                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                </a>

                                <a href="javascript:void(0)"
                                   class="btn-product call"
                                   onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">
                                    <i class="fa-solid fa-phone me-1"></i> Click to Call
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div id="pagination1" class="pagination d-flex justify-content-center mt-3"></div>
    </div>

    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <img id="modalImage" class="modal-image" src="" alt="">
        </div>
    </div>
    <h2 class="mt-4 mb-3" style="margin-left: 50px;">Gallery</h2>
        @if(isset($shopGallery) && count($shopGallery))
        <div class="info-card mt-4">
            <div class="section-title">Shop Gallery</div>

            <div class="gallery-grid">
                @foreach($shopGallery as $item)
                    <div class="gallery-item">
                        <img src="{{ asset('storage/'.$item->image_path) }}" alt="Gallery Image" onclick="openImageModal('{{ asset($item->image_path) }}')">
                    </div>
                @endforeach
            </div>
        </div>
        @endif

    <style>
        /* Reset backgrounds */
     
.pc-cover-section.cover_image {
    width: 100%;
    height: 200px; /* final height */
    overflow: hidden;
    position: relative;
}
.pc-cover-section.cover_image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
        /* Profile Card Styles */
        .pc-card {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto 30px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            background: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-left: 4%;
        }

        .pc-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        /* Cover Section */
        .pc-cover-section {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .pc-cover-image {
            object-fit: cover;
            height: 100%;
            width: 100%;
            transition: transform 0.5s ease;
        }

        .pc-card:hover .pc-cover-image {
            transform: scale(1.05);
        }

   

        /* Profile Avatar */
        .profile-avatar {
            position: absolute;
            bottom: -75px;
            left: 50px;
        }

        .profile-avatar img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        /* Profile Content */
        .pc-profile-content {
            padding: 90px 30px 30px;
            text-align: center;
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        }

        .pc-shop-name {
            font-size: 2.2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pc-verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
            padding: 6px 15px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 20px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        /* Shop Stats */
        .pc-shop-stats {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .pc-stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
            color: #555;
            font-weight: 500;
            padding: 8px 16px;
            background: rgba(255,255,255,0.8);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* Contact Buttons */
        .pc-contact-buttons {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .pc-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .pc-btn-success {
            background: linear-gradient(135deg, #25d366, #128c7e);
            color: white;
        }

        .pc-btn-warning {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
            color: white;
        }

        .pc-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            text-decoration: none;
            color: white;
        }

        /* Info Card (Opening Hours) */
        .info-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin: 30px auto;
            padding: 1.5rem;
            max-width: 1200px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 1.2rem;
        }

        .hours-grid {
            display: grid;
            gap: 0.5rem;
        }

        .day-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem;
            border-bottom: 1px solid #e9ecef;
        }

        .day-row:last-child {
            border-bottom: none;
        }

        .day {
            font-weight: 600;
            color: #333;
            min-width: 100px;
        }

        .time {
            color: #666;
            font-size: 0.9rem;
        }

        /* Products Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.2rem;
}
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
           
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 180px; /* Fixed height */
            overflow: hidden;
            background: #f8f9fa;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Ensures full image fits without cropping */
            padding: 10px;
            background-color: white;
        }
        
        .product-body {
            padding: 1.2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            line-height: 1.4;
            min-height: 3em; /* Fixed height for title */
            overflow: hidden;
        }

        .product-title:hover {
            color: #fd7e14;
        }
        
        .product-meta {
            margin-bottom: 1.2rem;
            font-size: 0.85rem;
            color: #666;
            line-height: 1.6;
            flex-grow: 1;
        }
        
        .product-buttons {
            display: flex;
            flex-direction: column; /* stack buttons vertically */
            gap: 0.7rem;
            width: 100%;
        }

        .btn-product {
            width: 100%;            /* full width buttons */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.8rem 0;
            text-decoration: none !important;
            border-radius: 6px;
            font-weight: bold;
            color: #fff;
        }

        .btn-product.whatsapp {
            background: #198754;
        }

        .btn-product.whatsapp:hover {
            background: #128c7e;
        }

        .btn-product.call {
            background: #fd7e14;
        }

        .btn-product.call:hover {
            background: #e66a00;
        }

        /* Image Modal */
        .image-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            position: relative;
            margin: auto;
            display: block;
            width: 90%;
            max-width: 800px;
            height: 90%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-image {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 35px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            gap: 8px;
            margin-top: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination button {
            padding: 8px 15px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            min-width: 40px;
        }

        .pagination button:hover {
            background: #f8f9fa;
            border-color: #fd7e14;
            transform: translateY(-2px);
        }

        .pagination button.active {
            background: #fd7e14;
            color: white;
            border-color: #fd7e14;
            box-shadow: 0 2px 8px rgba(253, 126, 20, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .pc-card, .info-card, .products-grid {
                max-width: 95%;
            }
            
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 992px) {
            .pc-cover-section {
                height: 250px;
            }
            
            .profile-avatar {
                left: 30px;
                bottom: -60px;
            }
            
            .profile-avatar img {
                width: 120px;
                height: 120px;
            }
            
            .pc-profile-content {
                padding: 70px 20px 25px;
            }
            
            .pc-shop-name {
                font-size: 1.8rem;
            }
            
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .pc-cover-section {
                height: 200px;
            }
            
            .profile-avatar {
                left: 20px;
                bottom: -50px;
            }
            
            .profile-avatar img {
                width: 100px;
                height: 100px;
            }
            
            .pc-shop-name {
                font-size: 1.6rem;
                flex-direction: column;
                gap: 8px;
            }
            
            .pc-shop-stats {
                gap: 15px;
            }
            
            .pc-stat-item {
                font-size: 0.9rem;
            }
            
            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .pc-card, .info-card {
                border-radius: 15px;
            }
            
            .pc-cover-section {
                height: 180px;
            }
            
            .profile-avatar {
                left: 15px;
                bottom: -40px;
            }
            
            .profile-avatar img {
                width: 80px;
                height: 80px;
                border-width: 3px;
            }
            
            .pc-profile-content {
                padding: 60px 15px 20px;
            }
            
            .pc-shop-name {
                font-size: 1.4rem;
            }
            
            .pc-contact-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .pc-btn {
                width: 200px;
                justify-content: center;
            }
            
            .info-card {
                padding: 1rem;
            }
            
            .pagination {
                gap: 5px;
            }
            
            .pagination button {
                padding: 6px 12px;
                min-width: 35px;
                font-size: 0.9rem;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pc-card {
            animation: fadeInUp 0.6s ease-out;
        }
        .gallery-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-top: 15px;
}

.gallery-item {
    width: 100%;
    height: 180px;
    overflow: hidden;
    border-radius: 10px;
    cursor: pointer;
    background: #f8f9fa;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
    transition: transform .3s ease;
}

.gallery-item:hover {
    transform: scale(1.03);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
h2 {
    font-weight: 700;
    color: #222;
    margin-bottom: 10px;
    font-weight: bold;
    padding-left: 5px;
}
.mb-3{
    margin-bottom: 1rem !important;
    margin-left: 20px;
}
.cover_image {
    width: 100%;
    max-width: 1200px; /* optional, card ke size ke liye */
    height: 200px;
    overflow: hidden;
    background-color: white;
    margin: 0 auto;
    position: relative; /* zarurat hai overlay aur avatar ke liye */
}

.cover_image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
/* Shop Profile Card */
.shop-profile-card {
    position: relative;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto 30px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    background: #fff;
}

/* Cover Section */
.shop-cover-wrapper {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.shop-cover-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.shop-cover-wrapper:hover .shop-cover-image {
    transform: scale(1.05);
}

.shop-cover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.2); /* optional overlay */
}

/* Profile Avatar */
.shop-avatar {
    width: 150px;              /* size adjust karo */
    height: 150px;
    border-radius: 50%;        /* circle shape */
    background-size: cover;    /* image div me fit ho jaye */
    background-position: center; /* center the image */
    border: 4px solid #fff;    /* optional white border */
    box-shadow: 0 8px 25px rgba(0,0,0,0.15); /* optional shadow */
    position: absolute;
    bottom: -75px;
    left: 40px;
}

.shop-avatar img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 4px solid #fff;
    border-radius: 50%;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Content Section */
.shop-profile-content {
    padding: 90px 30px 30px;
    text-align: center;
}

.shop-name {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.shop-verified-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: #fff;
    padding: 5px 12px;
    font-size: 0.85rem;
    border-radius: 20px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.shop-stats {
    margin: 20px 0;
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.stat-item {
    background: rgba(255,255,255,0.8);
    padding: 8px 16px;
    border-radius: 12px;
    font-weight: 500;
    color: #555;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.shop-contact-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

.shop-contact-buttons a {
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-whatsapp {
    background: #25d366;
}

.btn-whatsapp:hover {
    background: #128c7e;
}

.btn-call {
    background: #fd7e14;
}

.btn-call:hover {
    background: #e66a00;
}

/* Responsive */
@media (max-width: 992px) {
    .shop-cover-wrapper {
        height: 200px;
    }

    .shop-avatar img {
        width: 120px;
        height: 120px;
    }

    .shop-name {
        font-size: 1.6rem;
    }
}

@media (max-width: 576px) {
    .shop-cover-wrapper {
        height: 150px;
    }

    .shop-avatar img {
        width: 80px;
        height: 80px;
    }

    .shop-name {
        font-size: 1.4rem;
    }

    .shop-contact-buttons {
        flex-direction: column;
        align-items: center;
    }

    .shop-contact-buttons a {
        width: 150px;
        justify-content: center;
    }
}
.shop-cover-wrapper {
    position: relative;
    width: 100%;
    height: 250px; /* adjust as needed */
    background-size: cover;       /* image div me fit ho jaye */
    background-position: center;  /* center the image */
    background-repeat: no-repeat;
    overflow: hidden;
}

.shop-cover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.2); /* optional overlay */
}



@media (max-width: 992px) {
    .shop-cover-wrapper {
        height: 200px;
    }
    .shop-avatar {
        width: 120px;
        height: 120px;
        bottom: -60px;
        left: 30px;
    }
}

@media (max-width: 768px) {
    .shop-cover-wrapper {
        height: 180px;
    }
    .shop-avatar {
        width: 100px;
        height: 100px;
        bottom: -50px;
        left: 20px;
    }
}

@media (max-width: 576px) {
    .shop-cover-wrapper {
        height: 150px;
    }
    .shop-avatar {
        width: 80px;
        height: 80px;
        bottom: -40px;
        left: 15px;
    }
}

@media (max-width: 350px) {
    .shop-cover-wrapper {
        height: 120px;   /* chhoti screen ke liye */
    }
    .shop-avatar {
        width: 60px;
        height: 60px;
        bottom: -30px;
        left: 10px;
    }
}
    </style>

    <script>
        // Initialize pagination
        function setupPagination(gridId, paginationId, perPage = 12) {
            const grid = document.getElementById(gridId);
            const pagination = document.getElementById(paginationId);

            // Check if elements exist
            if (!grid || !pagination) {
                console.error('Grid or pagination element not found:', {gridId, paginationId});
                return;
            }

            const products = Array.from(grid.querySelectorAll(".product-card"));
            console.log('Found', products.length, 'products');
            
            // If no products, hide pagination
            if (products.length === 0) {
                pagination.style.display = 'none';
                return;
            }

            const totalPages = Math.ceil(products.length / perPage);
            console.log('Total pages:', totalPages);

            // If only one page, hide pagination
            if (totalPages <= 1) {
                pagination.style.display = 'none';
                // Show all products
                products.forEach(product => product.style.display = 'block');
                return;
            }

            // Show pagination
            pagination.style.display = 'flex';

            function showPage(page) {
                console.log('Showing page', page);
                products.forEach((product, index) => {
                    const shouldShow = (index >= (page - 1) * perPage && index < page * perPage);
                    product.style.display = shouldShow ? 'block' : 'none';
                });

                // Update active button
                pagination.querySelectorAll("button").forEach((btn) => {
                    btn.classList.toggle("active", parseInt(btn.dataset.page) === page);
                });
            }

            function createPaginationButtons() {
                pagination.innerHTML = "";

                // Previous button
                const prevBtn = document.createElement("button");
                prevBtn.innerHTML = "&laquo;";
                prevBtn.title = "Previous";
                prevBtn.addEventListener("click", () => {
                    const activeBtn = pagination.querySelector("button.active");
                    const current = activeBtn ? parseInt(activeBtn.dataset.page) : 1;
                    if (current > 1) showPage(current - 1);
                });
                pagination.appendChild(prevBtn);

                // Page buttons
                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement("button");
                    btn.innerText = i;
                    btn.dataset.page = i;
                    btn.addEventListener("click", () => showPage(i));
                    pagination.appendChild(btn);
                }

                // Next button
                const nextBtn = document.createElement("button");
                nextBtn.innerHTML = "&raquo;";
                nextBtn.title = "Next";
                nextBtn.addEventListener("click", () => {
                    const activeBtn = pagination.querySelector("button.active");
                    const current = activeBtn ? parseInt(activeBtn.dataset.page) : 1;
                    if (current < totalPages) showPage(current + 1);
                });
                pagination.appendChild(nextBtn);
            }

            createPaginationButtons();
            showPage(1); // Show first page initially
        }

        // Other functions
        function contactSupplier(isActive, whatsapp, title) {
            if (isActive === '1') {
                const message = encodeURIComponent(`Hello, I'm interested in: ${title}`);
                const cleanWhatsapp = whatsapp.replace(/\D/g, '');
                window.open(`https://wa.me/${cleanWhatsapp}?text=${message}`, '_blank');
            } else {
                alert('Supplier is currently inactive');
            }
        }

        function callSupplier(isActive, whatsapp) {
            if (isActive === '1') {
                window.location.href = `tel:${whatsapp}`;
            } else {
                alert('Supplier is currently inactive');
            }
        }

        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modal.style.display = 'block';
            modalImg.src = src;
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.style.display = 'none';
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, setting up pagination...');
            
            // Setup pagination
            setupPagination('productGrid1', 'pagination1', 12);
            
            // Add ripple effect to buttons
            document.querySelectorAll('.pc-btn, .btn-product').forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    ripple.classList.add('ripple');
                    this.appendChild(ripple);

                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                    ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeImageModal();
                }
            });
            
            // Close modal when clicking outside image
            document.getElementById('imageModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeImageModal();
                }
            });
        });

        // Also try to setup pagination when window loads (as backup)
        window.addEventListener('load', function() {
            console.log('Window loaded, checking pagination...');
            const pagination = document.getElementById('pagination1');
            if (pagination && pagination.innerHTML.trim() === '') {
                console.log('Pagination not initialized, setting up again...');
                setupPagination('productGrid1', 'pagination1', 12);
            }
        });
    </script>

@endsection