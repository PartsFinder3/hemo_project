@extends('Frontend.layout.main')
@section('main-section')
<div class="shop-profile-container">
    <!-- Cover Image Section -->
    <div class="shop-cover-section" style="background-image: url('{{ $profile && $profile->cover ? asset('storage/'. $profile->cover) : asset('assets/compiled/jpg/Head.png') }}');">
    </div>
    
    <!-- Shop Profile Card -->
    <div class="shop-profile-card">
        <div class="profile-header">
            <div class="profile-avatar" style="background-image: url('{{ $profile && $profile->profile_image ? asset('storage/' . $profile->profile_image) : asset('assets/compiled/jpg/default-avatar.png') }}');">
            </div>
            <div class="profile-info">
                <h1 class="shop-name">{{ $shop->name ?? 'Shop Name Here' }}</h1>
                <div class="shop-stats">
                    <span class="stat-item">📦 {{$totalAds}} Items Listed</span>
                    <span class="stat-item">💬 {{$inquiryCount}} Enquiries</span>
                </div>
                <div class="social-icons">
                    <a href="https://www.facebook.com/yourpage" target="_blank" class="social-icon facebook" aria-label="Facebook">
                        <img src="https://platform-cdn.sharethis.com/img/facebook.svg" alt="Facebook">
                    </a>
                    <a href="https://twitter.com/yourprofile" target="_blank" class="social-icon twitter" aria-label="Twitter">
                        <img src="https://platform-cdn.sharethis.com/img/twitter.svg" alt="Twitter">
                    </a>
                    <a href="https://www.linkedin.com/in/yourprofile" target="_blank" class="social-icon linkedin" aria-label="LinkedIn">
                        <img src="https://platform-cdn.sharethis.com/img/linkedin.svg" alt="LinkedIn">
                    </a>
                    <a href="https://wa.me/yourphonenumber" target="_blank" class="social-icon whatsapp" aria-label="WhatsApp">
                        <img src="https://platform-cdn.sharethis.com/img/whatsapp.svg" alt="WhatsApp">
                    </a>
                </div>
            </div>
            
            <div class="contact-buttons">
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $shop->supplier->whatsapp) }}" target="_blank" class="btn whatsapp-btn">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
                    WhatsApp
                </a>
                <a href="tel:{{ $shop->supplier->whatsapp }}" class="btn call-btn">
                    <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" alt="Call">
                    Call Now
                </a>
            </div>
        </div>
    </div>
    
    <!-- Opening Hours Section -->
    @if($shopHours)
    <div class="info-section opening-hours">
        <h2><i class="far fa-clock"></i> Opening Hours</h2>
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
    
    <!-- Products Section -->
    <div class="info-section products-section">
        <h2><i class="fas fa-box"></i> Products</h2>
        <div class="products-grid" id="productGrid1">
            @if($shopAds && $shopAds->count())
                @foreach($shopAds as $ad)
                    <div class="product-card">
                        @php
                            $images = json_decode($ad->images, true);
                        @endphp

                        @if (is_array($images) && isset($images[0]))
                            <div class="product-image">
                                <img src="{{ asset($images[0]) }}" alt="{{ $ad->title }}">
                            </div>
                        @endif
                        
                        <div class="product-body">
                            <a href="{{ route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id]) }}"
                                class="product-title">{{ $ad->title }}</a>
                            
                            <div class="product-meta">
                                <span>Availability: In Stock</span>
                                <span>Delivery: Ask Supplier</span>
                                <span>Warranty: Ask Supplier</span>
                            </div>
                            
                            <div class="product-buttons">
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $ad->shop->supplier->whatsapp) }}?text={{ urlencode('Hello, I am interested in your ad: ' . $ad->title) }}"
                                   target="_blank"
                                   class="product-btn whatsapp-btn">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>

                                <a href="javascript:void(0)"
                                   class="product-btn call-btn"
                                   onclick="callSupplier('{{ $ad->shop->supplier->is_active }}', '{{ $ad->shop->supplier->whatsapp }}')">
                                    <i class="fas fa-phone"></i> Call Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-products">
                    <p>No products available at the moment.</p>
                </div>
            @endif
        </div>
        <div id="pagination1" class="pagination"></div>
    </div>
    
    <!-- Gallery Section -->
    @if(isset($shopGallery) && count($shopGallery))
    <div class="info-section gallery-section">
        <h2><i class="fas fa-images"></i> Gallery</h2>
        <div class="gallery-grid">
            @foreach($shopGallery as $item)
                <div class="gallery-item">
                    <img src="{{ asset('storage/'.$item->image_path) }}" alt="Gallery Image" 
                         onclick="openImageModal('{{ asset('storage/'.$item->image_path) }}')">
                </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Image Modal -->
    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <img id="modalImage" class="modal-image" src="" alt="">
        </div>
    </div>
</div>

<style>
/* Base Styles */
.shop-profile-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Cover Section */
.shop-cover-section {
    width: 100%;
    height: 250px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-radius: 12px;
    margin-top: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Shop Profile Card */
.shop-profile-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    margin: -50px auto 30px;
    padding: 70px 20px 20px;
    position: relative;
    max-width: 100%;
}

.profile-header {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: center;
    justify-content: space-between;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
    border: 4px solid white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    position: absolute;
    top: -60px;
    left: 30px;
}

.profile-info {
    flex: 1;
    min-width: 300px;
}

.shop-name {
    font-size: 1.8rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.shop-stats {
    display: flex;
    gap: 20px;
    margin: 15px 0;
    flex-wrap: wrap;
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

.social-icons {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.social-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s;
}

.social-icon:hover {
    transform: translateY(-3px);
}

.social-icon img {
    width: 20px;
    height: 20px;
}

.facebook { background: #4267B2; }
.twitter { background: #000; }
.linkedin { background: #0077b5; }
.whatsapp { background: #25d366; }

.contact-buttons {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
    min-width: 140px;
    justify-content: center;
}

.whatsapp-btn {
    background: #25d366;
    color: white;
}

.whatsapp-btn:hover {
    background: #128c7e;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
}

.call-btn {
    background: #fd7e14;
    color: white;
}

.call-btn:hover {
    background: #e66a00;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(253, 126, 20, 0.3);
}

.btn img {
    width: 20px;
    height: 20px;
}

/* Info Sections */
.info-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 30px;
}

.info-section h2 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Opening Hours */
.hours-grid {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.day-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    border-bottom: 1px solid #eee;
}

.day-row:last-child {
    border-bottom: none;
}

.day {
    font-weight: 600;
    color: #333;
}

.time {
    color: #666;
}

/* Products Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.product-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.product-image {
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: #f8f9fa;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 10px;
}

.product-body {
    padding: 15px;
}

.product-title {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    text-decoration: none;
    display: block;
    margin-bottom: 10px;
    line-height: 1.4;
    min-height: 2.8em;
}

.product-title:hover {
    color: #fd7e14;
}

.product-meta {
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-bottom: 15px;
    font-size: 0.9rem;
    color: #666;
}

.product-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.product-btn {
    padding: 10px;
    border-radius: 6px;
    text-decoration: none;
    text-align: center;
    font-weight: 600;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

/* Gallery */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.gallery-item {
    width: 100%;
    height: 180px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s;
}

.gallery-item:hover {
    transform: scale(1.05);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 30px;
    flex-wrap: wrap;
}

.pagination button {
    padding: 8px 15px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s;
    font-weight: 500;
    min-width: 40px;
}

.pagination button:hover {
    background: #f8f9fa;
    border-color: #fd7e14;
}

.pagination button.active {
    background: #fd7e14;
    color: white;
    border-color: #fd7e14;
}

/* Modal */
.image-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.modal-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
}

.modal-image {
    max-width: 100%;
    max-height: 100%;
    border-radius: 8px;
}

.modal-close {
    position: absolute;
    top: -40px;
    right: 0;
    color: white;
    font-size: 30px;
    cursor: pointer;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.no-products {
    text-align: center;
    padding: 40px;
    color: #666;
    grid-column: 1 / -1;
}

/* Responsive Styles */

/* Tablet (768px - 991px) */
@media (max-width: 991px) {
    .shop-profile-container {
        padding: 0 10px;
    }
    
    .shop-cover-section {
        height: 200px;
    }
    
    .shop-profile-card {
        padding: 60px 15px 15px;
        margin-top: -40px;
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        top: -50px;
        left: 20px;
    }
    
    .profile-header {
        flex-direction: column;
        text-align: center;
    }
    
    .profile-info {
        min-width: auto;
    }
    
    .contact-buttons {
        width: 100%;
        justify-content: center;
    }
    
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .gallery-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Mobile (576px - 767px) */
@media (max-width: 767px) {
    .shop-cover-section {
        height: 180px;
        border-radius: 8px;
    }
    
    .shop-name {
        font-size: 1.5rem;
        margin-top: 10px;
    }
    
    .shop-stats {
        justify-content: center;
        gap: 10px;
    }
    
    .stat-item {
        font-size: 0.85rem;
        padding: 6px 12px;
    }
    
    .contact-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 250px;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    .gallery-item {
        height: 160px;
    }
    
    .info-section {
        padding: 15px;
    }
    
    .info-section h2 {
        font-size: 1.3rem;
    }
}

/* Small Mobile (375px - 575px) */
@media (max-width: 575px) {
    .shop-cover-section {
        height: 150px;
        margin-top: 10px;
    }
    
    .shop-profile-card {
        margin-top: -30px;
        padding: 50px 10px 10px;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        top: -40px;
        left: 15px;
        border-width: 3px;
    }
    
    .shop-name {
        font-size: 1.3rem;
        text-align: center;
    }
    
    .social-icons {
        justify-content: center;
    }
    
    .social-icon {
        width: 35px;
        height: 35px;
    }
    
    .social-icon img {
        width: 18px;
        height: 18px;
    }
    
    .gallery-grid {
        grid-template-columns: 1fr;
    }
    
    .gallery-item {
        height: 200px;
    }
    
    .day-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .time {
        align-self: flex-end;
    }
    
    .pagination button {
        padding: 6px 12px;
        min-width: 35px;
        font-size: 0.9rem;
    }
}

/* Very Small Mobile (below 375px) */
@media (max-width: 374px) {
    .shop-cover-section {
        height: 130px;
    }
    
    .profile-avatar {
        width: 70px;
        height: 70px;
        top: -35px;
        left: 10px;
    }
    
    .shop-name {
        font-size: 1.2rem;
    }
    
    .stat-item {
        font-size: 0.8rem;
        padding: 5px 10px;
    }
    
    .btn {
        padding: 10px;
        font-size: 0.9rem;
    }
    
    .products-grid {
        gap: 10px;
    }
    
    .product-image {
        height: 180px;
    }
    
    .gallery-item {
        height: 180px;
    }
    
    .modal-content {
        max-width: 95%;
        max-height: 80%;
    }
}

/* Landscape Mode */
@media (max-height: 600px) and (orientation: landscape) {
    .shop-cover-section {
        height: 150px;
    }
    
    .shop-profile-card {
        margin-top: -30px;
        padding: 50px 15px 15px;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        top: -40px;
    }
    
    .profile-header {
        flex-direction: row;
    }
    
    .profile-info {
        text-align: left;
    }
}

/* Touch Friendly Elements */
@media (hover: none) and (pointer: coarse) {
    .btn,
    .product-btn,
    .pagination button {
        min-height: 44px;
        min-width: 44px;
    }
    
    .social-icon {
        min-width: 44px;
        min-height: 44px;
    }
    
    .product-card {
        touch-action: manipulation;
    }
}
</style>

<script>
// Pagination Function
function setupPagination(gridId, paginationId, perPage = 8) {
    const grid = document.getElementById(gridId);
    const pagination = document.getElementById(paginationId);

    if (!grid || !pagination) return;

    const products = Array.from(grid.querySelectorAll(".product-card"));
    
    if (products.length === 0) {
        pagination.style.display = 'none';
        return;
    }

    const totalPages = Math.ceil(products.length / perPage);

    if (totalPages <= 1) {
        pagination.style.display = 'none';
        products.forEach(product => product.style.display = 'block');
        return;
    }

    pagination.style.display = 'flex';

    function showPage(page) {
        products.forEach((product, index) => {
            const shouldShow = (index >= (page - 1) * perPage && index < page * perPage);
            product.style.display = shouldShow ? 'block' : 'none';
        });

        pagination.querySelectorAll("button").forEach((btn) => {
            btn.classList.toggle("active", parseInt(btn.dataset.page) === page);
        });
    }

    function createPaginationButtons() {
        pagination.innerHTML = "";

        // Previous button
        if (totalPages > 1) {
            const prevBtn = document.createElement("button");
            prevBtn.innerHTML = "&laquo;";
            prevBtn.title = "Previous";
            prevBtn.addEventListener("click", () => {
                const activeBtn = pagination.querySelector("button.active");
                const current = activeBtn ? parseInt(activeBtn.dataset.page) : 1;
                if (current > 1) showPage(current - 1);
            });
            pagination.appendChild(prevBtn);
        }

        // Page buttons
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.innerText = i;
            btn.dataset.page = i;
            btn.addEventListener("click", () => showPage(i));
            pagination.appendChild(btn);
        }

        // Next button
        if (totalPages > 1) {
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
    }

    createPaginationButtons();
    showPage(1);
}

// Supplier Contact Functions
function callSupplier(isActive, whatsapp) {
    if (isActive === '1') {
        window.location.href = `tel:${whatsapp}`;
    } else {
        alert('Supplier is currently unavailable');
    }
}

// Image Modal Functions
function openImageModal(src) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = 'flex';
    modalImg.src = src;
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}

// Initialize on DOM Load
document.addEventListener('DOMContentLoaded', function() {
    // Setup pagination
    setupPagination('productGrid1', 'pagination1', 8);
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeImageModal();
    });
    
    // Close modal when clicking outside
    document.getElementById('imageModal')?.addEventListener('click', function(e) {
        if (e.target === this || e.target.classList.contains('modal-close')) {
            closeImageModal();
        }
    });
    
    // Touch support for mobile
    document.querySelectorAll('.gallery-item, .product-card').forEach(item => {
        item.addEventListener('touchstart', function() {
            this.style.opacity = '0.9';
        });
        
        item.addEventListener('touchend', function() {
            this.style.opacity = '1';
        });
    });
});

// Fallback initialization
window.addEventListener('load', function() {
    const pagination = document.getElementById('pagination1');
    if (pagination && pagination.innerHTML.trim() === '') {
        setupPagination('productGrid1', 'pagination1', 8);
    }
});
</script>
@endsection