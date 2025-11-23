<?php $__env->startSection('main-section'); ?>
    <div class="hero-section d-flex justify-content-center align-items-center flex-column">
        <div class="container-fluid py-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="profile-card">
                        <!-- Header -->
                        <div class="header-section position-relative">
                            <!-- Cover Image -->
                            <?php if($profile && $profile->cover): ?>
                                <img src="<?php echo e(asset('storage/' . $profile->cover)); ?>" class="w-100 header-image"
                                    alt="Cover">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/compiled/jpg/Head.png')); ?>" class="w-100 header-image"
                                    alt="Cover">
                            <?php endif; ?>

                            <!-- Overlay (optional dark fade) -->
                            <div class="header-overlay position-absolute top-0 start-0 w-100 h-100"></div>

                            <!-- Profile Image -->
                            <div class="profile-avatar position-absolute start-50 translate-middle-x">
                                <?php if($profile && $profile->profile_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $profile->profile_image)); ?>"
                                        class="img-fluid rounded-circle border border-3 border-white shadow"
                                        alt="Shop Logo">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('assets/compiled/jpg/2.jpg')); ?>"
                                        class="img-fluid rounded-circle border border-3 border-white shadow"
                                        alt="Shop Logo">
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="profile-content">
                            <h1 class="shop-name">
                                <?php echo e($shop->name ?? 'Shop Name Here'); ?>

                                <?php if($shop->supplier->is_verified): ?>
                                    <span class="badge">Verified</span>
                                <?php endif; ?>
                            </h1>

                            <div class="shop-stats">
                                <div class="stat-item">📦 <?php echo e($totalAds); ?> Items Listed</div>
                                <div class="stat-item">💬 <?php echo e($inquiryCount); ?> Enquiries</div>
                            </div>

                            <div class="about-section">
                                <h3 class="about-title">About</h3>
                                <?php if(isset($profile) && $profile->description): ?>
                                    <p class="about-text">
                                        <?php echo e($profile->description); ?>

                                    </p>
                                <?php endif; ?>
                            </div>

                            <div class="contact-buttons">
                                <?php
                                    $contact = $shop->supplier->whatsapp;
                                ?>
                                <a href="https://wa.me/<?php echo e(preg_replace('/\D/', '', $contact)); ?>" target="_blank"
                                    class="btn btn-sm btn-success w-100 my-1 contact-btn whatsapp-btn">
                                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                </a>
                                <a href="tel:<?php echo e($contact); ?>" class="btn btn-sm btn-warning w-100 my-1 contact-btn call-btn">
                                    <i class="fas fa-phone me-1"></i> Call
                                </a>
                            </div>

                            <!-- Deals in Parts -->
                            <div class="info-card">
                                <div class="card-header-section">
                                    <h5 class="section-title_h5"> Deals in Parts</h5>
                                    <?php if($shop->supplier->is_verified): ?>
                                        <span class="verified-badge">
                                            <i class="bi bi-check-circle"></i> Verified
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="parts-grid">
                   
                                </div>
                            </div>

                            <!-- Deals in Cars -->
                            <div class="info-card">
                                <div class="card-header-section">
                                   
                                    <h5 class="section-title_h5" style="color: black !important;">Deals in Cars</h5>
                                    <?php if($shop->supplier->is_verified): ?>
                                        <span class="verified-badge">
                                            <i class="bi bi-check-circle"></i> Verified
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="makes-grid">
                                    <?php $__currentLoopData = $shopMakes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="make-item"><?php echo e($make->make->name); ?></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <!-- Location & Hours -->
                            <div class="info-card">
                                <div class="card-header-section">
                                    <h5 class="section-title">📍 Location & Hours</h5>
                                </div>
                                <div class="location-content">
                                    <div class="address-section">
                                        <p class="address-text">
                                            <?php echo e($profile?->address ? $profile->address . ' ' . $shop->supplier->city->name : $shop->supplier->city->name); ?>

                                        </p>
                                    </div>
                                    <div class="hours-section">
                                        <div class="hours-grid">
                                            <div class="day-row">
                                                <span class="day">Mon</span>
                                                <span class="time"><?php echo e($shopHours->monday ?? 'OFF'); ?></span>
                                            </div>
                                            <div class="day-row">
                                                <span class="day">Tue</span>
                                                <span class="time"><?php echo e($shopHours->tuesday ?? 'OFF'); ?></span>
                                            </div>
                                            <div class="day-row">
                                                <span class="day">Wed</span>
                                                <span class="time"><?php echo e($shopHours->wednesday ?? 'OFF'); ?></span>
                                            </div>
                                            <div class="day-row">
                                                <span class="day">Thu</span>
                                                <span class="time"><?php echo e($shopHours->thursday ?? 'OFF'); ?></span>
                                            </div>
                                            <div class="day-row">
                                                <span class="day">Fri</span>
                                                <span class="time"><?php echo e($shopHours->friday ?? 'OFF'); ?></span>
                                            </div>
                                            <div class="day-row">
                                                <span class="day">Sat</span>
                                                <span class="time"><?php echo e($shopHours->saturday ?? 'OFF'); ?></span>
                                            </div>
                                            <div class="day-row">
                                                <span class="day">Sun</span>
                                                <span class="time"><?php echo e($shopHours->sunday ?? 'OFF'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery -->
                            <div class="info-card">
                                <div class="card-header-section">
                                    <h5 class="section-title">Our Gallery</h5>
                                </div>
                                <div class="gallery-grid">
                                    <?php $__currentLoopData = $shopGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="gallery-item">
                                            <img src="<?php echo e($image->image_path); ?>"
                                                 class="gallery-image" alt="Gallery Image"
                                                 onclick="openImageModal(this.src)">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>

                        <!-- TOP ADS Section -->
                        <section class="ad-cards">
                            <div class="section-text">
                                <h3>TOP ADS</h3>
                            </div>
                            <div class="products-grid" id="productGrid1">
                                <?php $__currentLoopData = $shopAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product-card">
                                        <?php
                                            $images = json_decode($ad->images, true);
                                        ?>

                                        <?php if(is_array($images) && isset($images[0])): ?>
                                            <div class="product-image">
                                                <img src="<?php echo e(asset( $images[0])); ?>" alt="Product">
                                            </div>
                                        <?php endif; ?>
                                        <div class="product-body">
                                            <a href="<?php echo e(route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id])); ?>"
                                                class="product-title"><?php echo e($ad->title); ?></a>
                                            <div class="product-price">AED <?php echo e($ad->price); ?></div>
                                            <div class="product-meta">
                                                <div class="meta-item">Availability: In Stock</div>
                                                <div class="meta-item">Condition: <?php echo e($ad->condition); ?></div>
                                                <div class="meta-item">Delivery: Ask Supplier</div>
                                                <div class="meta-item">Warranty: Ask Supplier</div>
                                            </div>
                                            <div class="product-buttons">
                                                <a href="javascript:void(0)" class="btn-product whatsapp"
                                                    onclick="contactSupplier('<?php echo e($ad->shop->supplier->is_active); ?>', '<?php echo e($ad->shop->supplier->whatsapp); ?>', '<?php echo e($ad->title); ?>')">
                                                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                                </a>
                                                <a href="javascript:void(0)" class="btn-product call"
                                                    onclick="callSupplier('<?php echo e($ad->shop->supplier->is_active); ?>', '<?php echo e($ad->shop->supplier->whatsapp); ?>')">
                                                    <i class="fa-solid fa-phone"></i> Call
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="pagination" id="pagination1"></div>
                        </section>

                        <!-- TOP CAR ADS Section -->
                        <section class="ad-cards">
                            <div class="section-text">
                                <h3>TOP CAR ADS</h3>
                            </div>
                            <div class="products-grid" id="productGrid2">
                                <?php $__currentLoopData = $shopCarAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="product-card">
                                        <?php
                                            $images = json_decode($ad->images, true);
                                        ?>

                                        <?php if(is_array($images) && isset($images[0])): ?>
                                            <div class="product-image">
                                                <img src="<?php echo e(asset('storage/' . $images[0])); ?>" alt="Product">
                                            </div>
                                        <?php endif; ?>
                                        <div class="product-body">
                                            <a href="<?php echo e(route('view.car.ad', ['slug' => $ad->slug, 'id' => $ad->id])); ?>"
                                                class="product-title"><?php echo e($ad->title); ?></a>
                                            <div class="product-meta">
                                                <div class="meta-item">Availability: In Stock</div>
                                                <div class="meta-item">Delivery: Ask Supplier</div>
                                                <div class="meta-item">Warranty: Ask Supplier</div>
                                            </div>
                                            <div class="product-buttons">
                                                <a href="javascript:void(0)" class="btn-product whatsapp"
                                                    onclick="contactSupplier('<?php echo e($ad->shop->supplier->is_active); ?>', '<?php echo e($ad->shop->supplier->whatsapp); ?>', '<?php echo e($ad->title); ?>')">
                                                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                                </a>
                                                <a href="javascript:void(0)" class="btn-product call"
                                                    onclick="callSupplier('<?php echo e($ad->shop->supplier->is_active); ?>', '<?php echo e($ad->shop->supplier->whatsapp); ?>')">
                                                    <i class="fa-solid fa-phone"></i> Call
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="pagination" id="pagination2"></div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <img id="modalImage" class="modal-image" src="" alt="">
        </div>
    </div>

    <style>
        /* Enhanced responsive profile card styles */
            body, main, header, nav, .hero-section, .hero-section_p {
            background-image: none !important;
            background: none !important;
        }
        .profile-card {
            background: var(--primary-color);
            border-radius: 0;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            margin-bottom: 0;
            width: 100%;
            margin-left: 0;
            margin-right: 0;
        }

        .header-section {
            position: relative;
            height: 200px;
            background: #000;
        }

        .header-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        .profile-avatar {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--accent-color);
            color: #fff;
            font-size: 2rem;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 4px solid var(--primary-color);
            z-index: 10;
        }

        .profile-content {
            margin-top: 60px;
            padding: 1.5rem;
            text-align: center;
        }

        .shop-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--secondary-color);
            line-height: 1.3;
            margin-bottom: 0.5rem;
        }

        .badge {
            background: var(--accent-color);
            color: #fff;
            font-size: 0.8rem;
            margin-left: 8px;
            padding: 4px 8px;
            border-radius: 12px;
            display: inline-block;
        }

        .shop-stats {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 1rem 0;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            font-size: 0.9rem;
            color: var(--tertiary-color);
            white-space: nowrap;
        }

        .about-section {
            margin: 1.5rem 0;
            text-align: left;
        }

        .about-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
        }

        .about-text {
            font-size: 0.9rem;
            color: var(--tertiary-color);
            line-height: 1.6;
        }

        .contact-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 1.2rem;
            margin-bottom: 2rem;
        }

        .contact-btn {
            flex: 1;
            min-width: 140px;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 8px;
            color: #fff;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            border: none;
        }

        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        .whatsapp-btn {
            background: var(--whatsapp-btn) !important;
        }

        .whatsapp-btn:hover {
            background: #239954 !important;
        }

        .call-btn {
            background: var(--accent-color) !important;
        }

        .call-btn:hover {
            background: #e66a00 !important;
        }

        /* Info Cards */
        .info-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            text-align: left;
        }

        .card-header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: black !important;
            margin: 0;
        }

        .verified-badge {
            background: #d1edff;
            color: #0066cc;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Parts and Makes Grid */
        .parts-grid, .makes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 0.8rem;
        }

        .part-item, .make-item {
            padding: 0.8rem;
            background: #f8f9fa;
            border-radius: 8px;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--secondary-color);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .part-item:hover, .make-item:hover {
            background: var(--accent-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Location Content */
        .location-content {
            display: grid;
            gap: 1.5rem;
        }

        .address-text {
            color: var(--tertiary-color);
            font-size: 1rem;
            margin: 0;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
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
            color: var(--secondary-color);
            min-width: 50px;
        }

        .time {
            color: var(--tertiary-color);
            font-size: 0.9rem;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 0.8rem;
        }

        .gallery-item {
            aspect-ratio: 1;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        /* Product Sections */
        .ad-cards {
            padding: 2rem 1.5rem;
            background: var(--primary-color);
        }

        .section-text {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-text h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .product-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-body {
            padding: 1.2rem;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--secondary-color);
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            line-height: 1.4;
        }

        .product-title:hover {
            color: var(--accent-color);
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .product-meta {
            margin-bottom: 1.2rem;
        }

        .meta-item {
            font-size: 0.85rem;
            color: var(--tertiary-color);
            margin-bottom: 0.3rem;
        }

        .product-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-product {
            flex: 1;
            padding: 0.6rem 1rem;
            border: none;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-product.whatsapp {
            background: var(--whatsapp-btn);
            color: white;
        }

        .btn-product.whatsapp:hover {
            background: #239954;
        }

        .btn-product.call {
            background: var(--accent-color);
            color: white;
        }

        .btn-product.call:hover {
            background: #e66a00;
        }

        .pagination {
            text-align: center;
            margin-top: 2rem;
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .profile-card {
                border-radius: 0;
                margin: 0;
            }

            .header-section {
                height: 150px;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 1.5rem;
                bottom: -40px;
            }

            .profile-content {
                margin-top: 50px;
                padding: 1rem;
            }

            .shop-name {
                font-size: 1.2rem;
            }

            .badge {
                display: block;
                margin: 8px auto 0;
                width: fit-content;
            }

            .shop-stats {
                gap: 15px;
                margin: 0.8rem 0;
            }

            .stat-item {
                font-size: 0.8rem;
            }

            .contact-buttons {
                flex-direction: column;
                gap: 8px;
            }

            .contact-btn {
                min-width: auto;
                width: 100%;
                padding: 10px;
                font-size: 0.85rem;
            }

            .about-text {
                font-size: 0.85rem;
            }

            .info-card {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .section-title {
                font-size: 1rem;
            }

            .parts-grid, .makes-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 0.5rem;
            }

            .part-item, .make-item {
                padding: 0.6rem;
                font-size: 0.8rem;
            }

            .location-content {
                gap: 1rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
                gap: 0.5rem;
            }

            .ad-cards {
                padding: 1.5rem 1rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .product-image {
                height: 180px;
            }

            .section-text h3 {
                font-size: 1.3rem;
            }

            .product-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {
            .shop-name {
                font-size: 1.3rem;
            }

            .contact-buttons {
                max-width: 400px;
                margin-left: auto;
                margin-right: auto;
            }

            .profile-content {
                padding: 1.2rem;
            }

            .parts-grid, .makes-grid {
                grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        @media (min-width: 769px) {
            .location-content {
                grid-template-columns: 1fr 2fr;
                align-items: start;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            }
        }

        @media (min-width: 993px) {
            .shop-name {
                font-size: 1.6rem;
            }

            .contact-btn {
                font-size: 1rem;
                padding: 14px 20px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            }
        }

        /* Fix for profile image responsiveness */
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Full width container */
        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        /* Ripple effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }

        .contact-btn {
            position: relative;
            overflow: hidden;
        }
    </style>

    <!-- JS -->
    <script>
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

        function openWhatsApp() {
            window.open("https://wa.me/923001234567", "_blank");
        }

        function makeCall() {
            window.location.href = "tel:+923001234567";
        }

        function openFacebook() {
            window.open("https://facebook.com", "_blank");
        }

        function openTwitter() {
            window.open("https://twitter.com", "_blank");
        }

        function openLinkedIn() {
            window.open("https://linkedin.com", "_blank");
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

        // Add smooth scroll behavior and ripple effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add click ripple effect to buttons
            document.querySelectorAll('.contact-btn, .btn-product').forEach(button => {
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

            // Smooth scroll for internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeImageModal();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Frontend.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/Frontend/shops/shop.blade.php ENDPATH**/ ?>