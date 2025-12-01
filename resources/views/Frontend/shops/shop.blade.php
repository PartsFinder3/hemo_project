@extends('Frontend.layout.main')
@section('main-section')
    <div class="shop-profile-page">
        <!-- Hero Cover Section -->
        <div class="cover-hero position-relative">
            <div class="cover-container">
                <!-- Cover Image -->
                <img src="{{ $profile && $profile->cover ? asset('storage/'. $profile->cover) : asset('assets/compiled/jpg/Head.png') }}"
                     class="cover-image" alt="Cover Image">
                
                <!-- Gradient Overlay -->
                <div class="cover-gradient"></div>
                
                <!-- Shop Info Overlay -->
                <div class="shop-info-overlay">
                    <div class="container">
                        <div class="row align-items-end">
                            <!-- Profile Image -->
                            <div class="col-md-3 col-lg-2">
                                <div class="profile-img-container">
                                    @if ($profile && $profile->profile_image)
                                        <img src="{{ asset('storage/' . $profile->profile_image) }}"
                                            class="profile-img"
                                            alt="Shop Logo">
                                    @else
                                        <div class="profile-img-placeholder">
                                            <i class="fas fa-store"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Shop Details -->
                            <div class="col-md-9 col-lg-10">
                                <div class="shop-details">
                                    <div class="d-flex align-items-center flex-wrap gap-3">
                                        <h1 class="shop-title mb-0">{{ $shop->name ?? 'Shop Name Here' }}</h1>
                                        @if ($shop->supplier?->is_verified)
                                            <span class="verified-badge">
                                                <i class="fas fa-check-circle"></i> Verified Supplier
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="shop-meta mt-3">
                                        <div class="meta-stats">
                                            <div class="stat-item">
                                                <i class="fas fa-box-open"></i>
                                                <span>{{ $totalAds ?? 0 }} Products</span>
                                            </div>
                                            <div class="stat-item">
                                                <i class="fas fa-comments"></i>
                                                <span>{{ $inquiryCount ?? 0 }} Enquiries</span>
                                            </div>
                                            <div class="stat-item">
                                                <i class="fas fa-star"></i>
                                                <span>4.8 Rating</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="action-buttons mt-4">
                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $shop->supplier->whatsapp) }}" 
                                           target="_blank" 
                                           class="btn-action btn-whatsapp">
                                            <i class="fab fa-whatsapp"></i>
                                            <span>Chat on WhatsApp</span>
                                        </a>
                                        <a href="tel:{{ $shop->supplier->whatsapp }}" 
                                           class="btn-action btn-call">
                                            <i class="fas fa-phone-alt"></i>
                                            <span>Call Now</span>
                                        </a>
                                        <button class="btn-action btn-save">
                                            <i class="far fa-bookmark"></i>
                                            <span>Save Shop</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container py-5">
            <div class="row">
                <!-- Left Sidebar -->
                <div class="col-lg-4 mb-4">
                    <!-- Shop Information Card -->
                    <div class="info-card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-info-circle me-2"></i>Shop Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Contact Info -->
                            <div class="info-section">
                                <h6 class="section-title">Contact Details</h6>
                                <div class="contact-info">
                                    <div class="contact-item">
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $shop->supplier->whatsapp ?? 'N/A' }}</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>{{ $shop->supplier->whatsapp ?? 'N/A' }}</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $shop->supplier->email ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Opening Hours -->
                            @if($shopHours)
                            <div class="info-section mt-4">
                                <h6 class="section-title">Opening Hours</h6>
                                <div class="hours-list">
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
                                        <div class="hour-item {{ date('l') == $day ? 'today' : '' }}">
                                            <span class="day">{{ $day }}</span>
                                            <span class="time">{{ $time ?? 'Closed' }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Shop Stats -->
                            <div class="info-section mt-4">
                                <h6 class="section-title">Shop Stats</h6>
                                <div class="stats-grid">
                                    <div class="stat-box">
                                        <div class="stat-value">{{ $totalAds ?? 0 }}</div>
                                        <div class="stat-label">Products</div>
                                    </div>
                                    <div class="stat-box">
                                        <div class="stat-value">{{ $inquiryCount ?? 0 }}</div>
                                        <div class="stat-label">Enquiries</div>
                                    </div>
                                    <div class="stat-box">
                                        <div class="stat-value">98%</div>
                                        <div class="stat-label">Response Rate</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Products -->
                <div class="col-lg-8">
                    <!-- Products Header -->
                    <div class="products-header mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="section-title">Available Products</h2>
                                <p class="text-muted mb-0">Browse our collection of quality products</p>
                            </div>
                            <div class="product-count">
                                <span class="badge bg-primary">{{ $totalAds ?? 0 }} items</span>
                            </div>
                        </div>
                        
                        <!-- Filter Options (if needed) -->
                        <div class="filter-options mt-3">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary active">All</button>
                                <button type="button" class="btn btn-outline-primary">Popular</button>
                                <button type="button" class="btn btn-outline-primary">Latest</button>
                                <button type="button" class="btn btn-outline-primary">Low Price</button>
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    @if($shopAds && $shopAds->count())
                        <div class="products-grid">
                            @foreach($shopAds as $ad)
                                <div class="product-card">
                                    <!-- Product Image -->
                                    <div class="product-image">
                                        @php
                                            $images = json_decode($ad->images, true);
                                        @endphp

                                        @if (is_array($images) && isset($images[0]))
                                            <img src="{{ asset($images[0]) }}" 
                                                 alt="{{ $ad->title }}"
                                                 class="img-fluid">
                                        @else
                                            <div class="no-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        
                                        <!-- Quick Actions -->
                                        <div class="quick-actions">
                                            <button class="btn-action btn-quick-view" 
                                                    data-id="{{ $ad->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn-action btn-favorite">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Product Info -->
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a href="{{ route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id]) }}">
                                                {{ $ad->title }}
                                            </a>
                                        </h3>
                                        
                                        <!-- Product Meta -->
                                        <div class="product-meta">
                                            <div class="meta-item">
                                                <i class="fas fa-box"></i>
                                                <span>In Stock</span>
                                            </div>
                                            <div class="meta-item">
                                                <i class="fas fa-shipping-fast"></i>
                                                <span>Delivery Available</span>
                                            </div>
                                            <div class="meta-item">
                                                <i class="fas fa-shield-alt"></i>
                                                <span>Warranty Available</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Price & Actions -->
                                        <div class="product-footer">
                                            @if($ad->price)
                                                <div class="product-price">
                                                    <span class="currency">AED</span>
                                                    <span class="amount">{{ number_format($ad->price, 2) }}</span>
                                                </div>
                                            @endif
                                            
                                            <div class="product-actions">
                                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $ad->shop->supplier->whatsapp) }}?text={{ urlencode('Hello, I am interested in your ad: ' . $ad->title) }}"
                                                   target="_blank"
                                                   class="btn btn-whatsapp-sm">
                                                    <i class="fab fa-whatsapp"></i>
                                                    <span>Inquire</span>
                                                </a>
                                                
                                                <button class="btn btn-details" 
                                                        onclick="window.location='{{ route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id]) }}'">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    <span>Details</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination (if needed) -->
                        <div class="pagination-wrapper mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="empty-state text-center py-5">
                            <div class="empty-icon mb-3">
                                <i class="fas fa-box-open fa-3x text-muted"></i>
                            </div>
                            <h4 class="text-muted">No Products Available</h4>
                            <p class="text-muted">This shop hasn't listed any products yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-light: #dbeafe;
            --secondary-color: #1e293b;
            --accent-color: #f97316;
            --success-color: #10b981;
            --whatsapp-color: #25d366;
            --border-color: #e2e8f0;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
        }

        /* Cover Hero Section */
        .cover-hero {
            margin-bottom: 30px;
            position: relative;
        }

        .cover-container {
            position: relative;
            height: 380px;
            overflow: hidden;
            border-radius: 0 0 var(--radius-lg) var(--radius-lg);
        }

        .cover-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cover-gradient {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
            pointer-events: none;
        }

        .shop-info-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 30px 0;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        }

        /* Profile Image */
        .profile-img-container {
            position: relative;
            margin-top: -80px;
        }

        .profile-img {
            width: 160px;
            height: 160px;
            border-radius: var(--radius-lg);
            object-fit: cover;
            border: 5px solid white;
            box-shadow: var(--shadow-lg);
            background: white;
        }

        .profile-img-placeholder {
            width: 160px;
            height: 160px;
            border-radius: var(--radius-lg);
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            border: 5px solid white;
            box-shadow: var(--shadow-lg);
        }

        /* Shop Details */
        .shop-details {
            padding: 20px 0;
        }

        .shop-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--secondary-color);
            margin: 0;
            line-height: 1.2;
        }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--success-color), #34d399);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: var(--shadow-sm);
        }

        /* Meta Stats */
        .shop-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .meta-stats {
            display: flex;
            gap: 24px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--secondary-color);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .stat-item i {
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 24px;
            border-radius: var(--radius-md);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: var(--shadow-md);
        }

        .btn-whatsapp {
            background: var(--whatsapp-color);
            color: white;
        }

        .btn-call {
            background: var(--accent-color);
            color: white;
        }

        .btn-save {
            background: white;
            color: var(--secondary-color);
            border: 1px solid var(--border-color);
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            text-decoration: none;
            color: white;
        }

        .btn-whatsapp:hover {
            background: #128c7e;
        }

        .btn-call:hover {
            background: #ea580c;
        }

        .btn-save:hover {
            background: var(--primary-light);
            color: var(--primary-color);
        }

        /* Info Card */
        .info-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            overflow: hidden;
            height: 100%;
        }

        .card-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            background: var(--primary-light);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin: 0;
        }

        .card-body {
            padding: 24px;
        }

        .info-section {
            margin-bottom: 24px;
        }

        .info-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Contact Info */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #f8fafc;
            border-radius: var(--radius-sm);
            transition: all 0.2s ease;
        }

        .contact-item:hover {
            background: #f1f5f9;
            transform: translateX(4px);
        }

        .contact-item i {
            color: var(--primary-color);
            width: 20px;
        }

        /* Hours List */
        .hours-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .hour-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background: #f8fafc;
            border-radius: var(--radius-sm);
            transition: all 0.2s ease;
        }

        .hour-item.today {
            background: #fffbeb;
            border-left: 4px solid var(--accent-color);
        }

        .hour-item:hover {
            background: #f1f5f9;
        }

        .day {
            font-weight: 500;
            color: var(--secondary-color);
        }

        .time {
            font-weight: 600;
            color: var(--accent-color);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .stat-box {
            text-align: center;
            padding: 16px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            transition: all 0.2s ease;
        }

        .stat-box:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #64748b;
            margin-top: 4px;
        }

        /* Products Section */
        .products-header {
            padding: 24px;
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--secondary-color);
            margin-bottom: 8px;
        }

        .filter-options .btn {
            padding: 8px 16px;
            font-size: 0.9rem;
            border-radius: var(--radius-sm);
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
            }
        }

        /* Product Card */
        .product-card {
            background: white;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-color);
        }

        .product-image {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: #f8fafc;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 48px;
        }

        /* Quick Actions */
        .quick-actions {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
        }

        .product-card:hover .quick-actions {
            opacity: 1;
            transform: translateX(0);
        }

        .btn-quick-view {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.9);
            border: none;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
        }

        .btn-quick-view:hover {
            background: white;
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .btn-favorite {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.9);
            border: none;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
        }

        .btn-favorite:hover {
            background: white;
            color: #ef4444;
            transform: scale(1.1);
        }

        /* Product Info */
        .product-info {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 12px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-title a {
            color: inherit;
            text-decoration: none;
        }

        .product-title a:hover {
            color: var(--primary-color);
        }

        /* Product Meta */
        .product-meta {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: #64748b;
        }

        .meta-item i {
            color: var(--success-color);
            width: 16px;
        }

        /* Product Footer */
        .product-footer {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .product-price {
            display: flex;
            align-items: baseline;
            gap: 4px;
            margin-bottom: 16px;
        }

        .currency {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
        }

        .amount {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--accent-color);
        }

        .product-actions {
            display: flex;
            gap: 8px;
        }

        .btn-whatsapp-sm {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            background: var(--whatsapp-color);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-whatsapp-sm:hover {
            background: #128c7e;
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .btn-details {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            background: white;
            color: var(--secondary-color);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-details:hover {
            background: var(--primary-light);
            color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-1px);
        }

        /* Pagination */
        .pagination-wrapper {
            background: white;
            padding: 20px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .page-link {
            padding: 10px 16px;
            border: 1px solid var(--border-color);
            color: var(--secondary-color);
            font-weight: 500;
            border-radius: var(--radius-sm) !important;
            margin: 0 4px;
        }

        .page-link:hover {
            background: var(--primary-light);
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        /* Empty State */
        .empty-state {
            background: white;
            border-radius: var(--radius-lg);
            padding: 60px 20px;
            box-shadow: var(--shadow-sm);
            border: 2px dashed var(--border-color);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .cover-container {
                height: 320px;
            }
            
            .profile-img-container {
                margin-top: -60px;
                text-align: center;
            }
            
            .profile-img, .profile-img-placeholder {
                width: 120px;
                height: 120px;
            }
            
            .shop-title {
                font-size: 2rem;
            }
            
            .meta-stats {
                flex-direction: column;
                gap: 12px;
            }
            
            .action-buttons {
                justify-content: center;
            }
            
            .shop-info-overlay {
                padding: 20px 0;
            }
        }

        @media (max-width: 768px) {
            .cover-container {
                height: 280px;
                border-radius: 0;
            }
            
            .shop-info-overlay {
                border-radius: 0;
            }
            
            .shop-title {
                font-size: 1.75rem;
                text-align: center;
                margin-top: 10px;
            }
            
            .verified-badge {
                margin: 10px auto;
                display: inline-flex;
            }
            
            .shop-meta {
                justify-content: center;
            }
            
            .shop-details {
                text-align: center;
            }
            
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }
            
            .product-image {
                height: 180px;
            }
            
            .filter-options .btn-group {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
            }
            
            .filter-options .btn {
                flex: 1;
                min-width: 120px;
            }
        }

        @media (max-width: 576px) {
            .cover-container {
                height: 240px;
            }
            
            .profile-img, .profile-img-placeholder {
                width: 100px;
                height: 100px;
            }
            
            .shop-title {
                font-size: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .btn-action {
                width: 100%;
                justify-content: center;
            }
            
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .stat-box {
                padding: 12px;
            }
            
            .stat-value {
                font-size: 1.2rem;
            }
            
            .product-actions {
                flex-direction: column;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Loading States */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    <script>
        // Quick View Function
        function quickView(productId) {
            // Implement quick view functionality
            console.log('Quick view for product:', productId);
        }

        // Toggle Favorite
        function toggleFavorite(button) {
            const icon = button.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                button.style.color = '#ef4444';
                showToast('Added to favorites');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                button.style.color = '';
                showToast('Removed from favorites');
            }
        }

        // Save Shop
        function saveShop() {
            const button = event.currentTarget;
            const icon = button.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                button.style.color = '#f59e0b';
                showToast('Shop saved successfully');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                button.style.color = '';
                showToast('Shop removed from saved');
            }
        }

        // Show Toast Notification
        function showToast(message) {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.textContent = message;
            toast.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: var(--secondary-color);
                color: white;
                padding: 12px 24px;
                border-radius: var(--radius-md);
                box-shadow: var(--shadow-lg);
                z-index: 9999;
                animation: slideIn 0.3s ease-out;
            `;
            
            document.body.appendChild(toast);
            
            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Add animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners
            document.querySelectorAll('.btn-favorite').forEach(btn => {
                btn.addEventListener('click', () => toggleFavorite(btn));
            });
            
            document.querySelector('.btn-save')?.addEventListener('click', saveShop);
            
            // Add scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            // Observe product cards
            document.querySelectorAll('.product-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });
            
            // Add keyframe animations
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideIn {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                
                @keyframes slideOut {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endsection