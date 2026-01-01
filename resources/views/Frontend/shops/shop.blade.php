@extends('Frontend.layout.main')
@section('main-section')
<style>
/* ============ MAIN LAYOUT STYLES ============ */
.image_box {
    width: 83%;
    height: 240px;
    margin: 20px auto; 
    margin-top: 50px !important;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.cover_system {
    width: 83%;
    height: 150px;
    margin: 20px auto;
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 20px;
}

.profile_photo {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border: 4px solid white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    flex-shrink: 0;
}

.information-contanier {
    width: 300px;
    height: 100%;
    display: flex;
    flex-direction: column;
    margin-left: 20px !important;
}

.information-contanier {
    margin-top: 20px;
    margin-bottom: 20px !important;
    height: 240px;
}

.shop_name h3 {
    font-size: 1.8rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.inqueries {
    width: auto;
    padding: 10px;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.stat-item {
    background: #f8f9fa;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    color: #555;
    display: flex;
    align-items: center;
    gap: 5px;
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
    border-radius: 8px;
    transition: transform 0.3s, background-color 0.3s;
}

.icons:hover {
    transform: scale(1.1);
}

.icons img {
    width: 24px;
    height: 24px;
}

.button_sides {
    width: 300px;
    height: 100%;
    margin-left: 350px;
    display: flex;
    align-items: center;
}

.buttons {
    display: flex;
    flex-direction: row;
    gap: 15px;
    margin-top: 60px;
}

.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 140px;
    height: 45px;
    background-color: white;
    color: black;
    text-decoration: none;
    border-radius: 8px;
   
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 0.95rem;
}

.btn:hover {
    background-color: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,123,255,0.2);
}

.btn img {
    width: 20px;
    height: 20px;
}



/* ============ PRODUCTS SECTION ============ */
.products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    width: 83%;
    margin: 30px auto;
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
    height: 180px;
    overflow: hidden;
    background: #f8f9fa;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 10px;
    background-color: white;
}

.product-body {
    padding: 1.2rem;
    display: flex;
    flex-direction: column;
    height: 290px; /* Set a fixed height for all cards */
    justify-content: space-between; /* Push buttons to bottom */
}

.product-title {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    text-decoration: none;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Show max 2 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 0.5rem;
}
.product-title:hover {
    color: #fd7e14;
}

.product-meta {
    font-size: 0.85rem;
    color: #666;
    line-height: 1.4;
    overflow: hidden;
    flex-grow: 1; /* take remaining space if needed */
}
.product-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.7rem;
    width: 100%;
}

.btn-product {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0.8rem 0;
    text-decoration: none !important;
    border-radius: 6px;
    font-weight: bold;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}





/* ============ OPENING HOURS CARD ============ */
.info-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin: 30px auto;
    padding: 1.5rem;
    width: 83%;
    margin-top: 7% !important;
}

.section-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    gap: 10px;
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

/* ============ GALLERY SECTION ============ */
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
    transition: transform 0.3s ease;
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
    margin-left: 50px;
    font-size: 1.8rem;
}

.mb-3 {
    margin-bottom: 1rem !important;
    margin-left: 50px;
}

/* ============ IMAGE MODAL ============ */
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
    z-index: 1001;
}

/* ============ PAGINATION ============ */
.pagination {
    display: flex;
    gap: 8px;
    margin-top: 30px;
    flex-wrap: wrap;
    justify-content: center;
    width: 83%;
    margin: 30px auto;
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

/* ============ RESPONSIVE STYLES ============ */

/* Tablet (768px - 991px) */
@media (max-width: 991px) {
    .image_box,
    .cover_system,
    .products-grid,
    .info-card,
    .pagination {
        width: 90%;
    }
    
    .cover_system {
        height: auto;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px 0;
    }
    
    .profile_photo {
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }
    
    .information-contanier {
        margin-left: 0 !important;
        margin-top: 15px;
        align-items: center;
        width: 100%;
    }
    
    .button_sides {
        margin-left: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    
    .buttons {
        margin-top: 20px;
        justify-content: center;
    }
    
    .products-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 15px;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    h2 {
        margin-left: 30px;
    }
    
    .mb-3 {
        margin-left: 30px;
    }
}

/* Mobile (576px - 767px) */
@media (max-width: 767px) {
    .image_box {
        width: 95%;
        height: 180px;
        margin-top: 30px !important;
    }
    
    .cover_system {
        width: 95%;
        padding: 15px 0;
    }
    
    .profile_photo {
        width: 100px;
        height: 100px;
    }
    
    .shop_name h3 {
        font-size: 1.5rem;
    }
    
    .inqueries {
        padding: 8px;
        font-size: 0.9rem;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .button_sides {
        margin-top: 15px;
    }
    
    .buttons {
        width: 100%;
        justify-content: center;
        gap: 8px;
    }
    
    .btn {
        width: 110px;
        height: 38px;
        font-size: 0.9rem;
    }
    
    .products-grid {
        grid-template-columns: 1fr !important;
        gap: 15px;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }
    
    .gallery-item {
        height: 150px;
    }
    
    .info-card {
        margin: 15px auto;
        padding: 1rem;
        width: 95%;
    }
    
    h2 {
        margin-left: 20px;
        font-size: 1.5rem;
    }
    
    .mb-3 {
        margin-left: 20px;
    }
    
    .product-image {
        height: 160px;
    }
    
    .product-title {
        font-size: 0.95rem;
        min-height: 2.8em;
    }
    
    .product-meta {
        font-size: 0.8rem;
    }
    
    .btn-product {
        padding: 0.7rem 0;
        font-size: 0.9rem;
    }
    
    .pagination {
        gap: 5px;
        margin: 15px auto;
        width: 95%;
    }
    
    .pagination button {
        padding: 6px 12px;
        min-width: 35px;
        font-size: 0.9rem;
    }
}

/* Small Mobile (375px - 575px) */
@media (max-width: 575px) {
    .image_box {
        width: 98%;
        height: 150px;
        margin-top: 20px !important;
    }
    
    .cover_system {
        width: 98%;
        margin: 10px auto;
    }
    
    .profile_photo {
        width: 80px;
        height: 80px;
    }
    
    .shop_name h3 {
        font-size: 1.3rem;
        margin-bottom: 5px;
    }
    
    .inqueries {
        font-size: 0.85rem;
        padding: 5px;
        flex-direction: column;
        gap: 5px;
    }
    
    .stat-item {
        display: block;
        margin: 3px 0;
    }
    
    .icons_media {
        gap: 8px;
        margin-top: 8px;
    }
    
    .icons {
        width: 35px;
        height: 35px;
    }
    
    .icons img {
        width: 20px;
        height: 20px;
    }
    
    .buttons {
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }
    
    .btn {
        width: 180px;
        height: 40px;
    }
    
    .gallery-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .gallery-item {
        height: 180px;
    }
    
    h2 {
        margin-left: 15px;
        font-size: 1.3rem;
    }
    
    .mb-3 {
        margin-left: 15px;
    }
    
    .product-image {
        height: 140px;
    }
    
    .product-body {
        padding: 1rem;
    }
    
    .day-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .day {
        min-width: auto;
    }
    
    .modal-content {
        width: 95%;
        height: 80%;
    }
    
    .modal-close {
        top: 10px;
        right: 20px;
        font-size: 30px;
    }
}

/* Very Small Mobile (below 375px) */
@media (max-width: 374px) {
    .image_box {
        height: 130px;
    }
    
    .profile_photo {
        width: 70px;
        height: 70px;
    }
    
    .shop_name h3 {
        font-size: 1.2rem;
    }
    
    .inqueries {
        font-size: 0.8rem;
    }
    
    .icons {
        width: 30px;
        height: 30px;
    }
    
    .icons img {
        width: 18px;
        height: 18px;
    }
    
    .btn {
        width: 160px;
        height: 38px;
        font-size: 0.85rem;
    }
    
    .products-grid {
        gap: 10px;
    }
    
    .product-card {
        border-radius: 8px;
    }
    
    .product-title {
        font-size: 0.9rem;
    }
    
    .btn-product {
        font-size: 0.85rem;
        padding: 0.6rem 0;
    }
    
    .gallery-item {
        height: 150px;
    }
    
    h2 {
        margin-left: 10px;
        font-size: 1.2rem;
    }
    
    .section-title {
        font-size: 1.1rem;
    }
    
    .pagination button {
        padding: 5px 10px;
        min-width: 30px;
        font-size: 0.85rem;
    }
}

/* Landscape Mode Adjustments */
@media (max-height: 600px) and (orientation: landscape) {
    .image_box {
        height: 120px;
    }
    
    .cover_system {
        height: auto;
        min-height: 120px;
        flex-direction: row;
        align-items: center;
    }
    
    .profile_photo {
        width: 80px;
        height: 80px;
        margin: 0;
    }
    
    .information-contanier {
        margin-left: 15px !important;
        margin-top: 0;
        text-align: left;
        align-items: flex-start;
    }
    
    .button_sides {
        margin-top: 0;
    }
    
    .products-grid {
        grid-template-columns: repeat(3, 1fr) !important;
    }
}

/* Touch Friendly Elements */
@media (hover: none) and (pointer: coarse) {
    .btn,
    .btn-product,
    .pagination button,
    .icons {
        min-height: 44px;
        min-width: 44px;
    }
    
    .product-title,
    .gallery-item {
        touch-action: manipulation;
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

.product-card,
.info-card,
.gallery-item {
    animation: fadeInUp 0.6s ease-out;
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
    <div class="icons" style="background-color: #4267B2">
        <a href="https://www.facebook.com/yourpage" target="_blank" aria-label="Visit our Facebook page">
            <img src="https://platform-cdn.sharethis.com/img/facebook.svg" alt="Facebook Icon">
        </a>
    </div>

    <!-- X / Twitter -->
    <div class="icons" style="background-color: black">
        <a href="https://twitter.com/yourprofile" target="_blank" aria-label="Visit our Twitter profile">
            <img src="https://platform-cdn.sharethis.com/img/twitter.svg" alt="Twitter Icon">
        </a>
    </div>

    <!-- LinkedIn -->
    <div class="icons" style="background-color: #0077b5">
        <a href="https://www.linkedin.com/in/yourprofile" target="_blank" aria-label="Visit our LinkedIn profile">
            <img src="https://platform-cdn.sharethis.com/img/linkedin.svg" alt="LinkedIn Icon">
        </a>
    </div>

    <!-- WhatsApp -->
    <div class="icons" style="background-color:#25d366">
        <a href="https://wa.me/yourphonenumber" target="_blank" aria-label="Chat with us on WhatsApp">
            <img src="https://platform-cdn.sharethis.com/img/whatsapp.svg" alt="WhatsApp Icon">
        </a>
    </div>
</div>


    </div>
    <div class="button_sides">
        <div class="buttons">
            
            <a href="https://wa.me/{{ preg_replace('/\D/', '', $shop->supplier->whatsapp) }}"  target="_blank" class="btn whatsapp">
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
                Whatsapp
            </a>
            <a href="tel:{{ $shop->supplier->whatsapp }}" class="btn call">
                <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call">
                Call
            </a>
        </div>

            </div>
        </div>

    
  
</div>


        <!-- Opening Hours Card -->
        @if($shopHours)
        <div class="info-card mt-4" style="margin-top: 30px;">
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