<?php $__env->startSection('main-section'); ?>
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <section class="section">

            <!-- Profile Section -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-12">
                            <div class="mb-3">
                                <?php if(isset($profile) && $profile->cover): ?>
                                    <img style="width: 100%" src="<?php echo e(asset('storage/' . $profile->cover)); ?>"
                                        class="img-fluid rounded" alt="">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('assets/compiled/jpg/Head.png')); ?>" class="img-fluid rounded"
                                        alt="">
                                <?php endif; ?>
                            </div>

                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <h3 class="card-title d-flex align-items-center">
                                    <span class="me-2" style="width:50px;">
                                        <?php if(isset($profile) && $profile->profile_image): ?>
                                            <img src="<?php echo e(asset('storage/' . $profile->profile_image)); ?>"
                                                class="img-fluid rounded-circle" alt="">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/compiled/jpg/2.jpg')); ?>"
                                                class="img-fluid rounded-circle" alt="">
                                        <?php endif; ?>
                                    </span>
                                    <?php echo e($shop->name); ?>

                                </h3>
                                <div class="d-flex gap-2 align-items-center">
                                    <a href="<?php echo e(route('shops.profile.create', $shop->id)); ?>"
                                        class="btn btn-primary btn-sm">Edit Profile</a>
                                    <a href="<?php echo e(route('supplier.profile.edit', $shop->supplier->id)); ?>"
                                        class="btn btn-secondary btn-sm">Change Password & WhatsApp</a>
                                    <?php if($shop->supplier->is_verified): ?>
                                        <span class="badge bg-warning text-dark">Verified</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <h5 class="mb-1"><?php echo e($shop->supplier->name); ?></h5>
                            <p class="text-muted mb-2">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                <?php echo e(($profile->address ?? '') . ' ' . ($shop->supplier->city->name ?? '')); ?>

                            </p>


                            <?php if(isset($profile) && $profile->description): ?>
                                <h6>About</h6>
                                <p class="text-muted"><?php echo e($profile->description); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="mt-3">
                        <a href="https://wa.me/<?php echo e($shop->supplier->whatsapp); ?>" target="_blank"
                            class="btn btn-success btn-sm">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="tel:<?php echo e($shop->supplier->whatsapp); ?>" class="btn btn-info btn-sm">
                            <i class="bi bi-telephone"></i> Call Now
                        </a>

                    </div>

                    
                </div>
            </div>

            <!-- Deals in Parts -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="mb-0">Deals in Parts</h5>
                        <div class="d-flex align-items-center gap-2">
                            <?php if($shop->supplier->is_verified): ?>
                                <span class="badge bg-success-subtle text-success">
                                    <i class="bi bi-check-circle"></i> Verified by Business
                                </span>
                            <?php endif; ?>
                            <span>
                                <a href="<?php echo e(route('shops.parts.create', $shop->id)); ?>" class="btn btn-primary">Add
                                    Parts</a>
                            </span>
                        </div>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">
                      <?php if($shopParts && $shopParts->part): ?>
                        <div class="col">
                            <div class="p-2 border rounded text-center"><?php echo e($shopParts->part->name); ?></div>
                        </div>
                    <?php endif; ?>

                    </div>
                </div>
            </div>

            <!-- Deals in Cars -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="mb-0">Deals in Cars</h5>
                        <div class="d-flex align-items-center gap-2">
                            <?php if($shop->supplier->is_verified): ?>
                                <span class="badge bg-success-subtle text-success">
                                    <i class="bi bi-check-circle"></i> Verified by Business
                                </span>
                            <?php endif; ?>
                            <span>
                                <a href="<?php echo e(route('shops.makes.create', $shop->id)); ?>" class="btn btn-primary">Add
                                    Makes</a>
                            </span>
                        </div>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-2">
                        <?php $__currentLoopData = $shopMakes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col">
                                <div class="p-2 border rounded text-center"><?php echo e($make->make->name); ?></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- Location & Hours -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="fw-bold mb-4">📍 Location & Hours</h5>
                        <span>
                            
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="text-muted mb-2">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                <?php echo e(($profile->address ?? '') . ' ' . ($shop->supplier->city->name ?? '')); ?>

                            </p>

                        </div>
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span class="fw-semibold">Mon</span>
                                <span><?php echo e($shopHours->monday ?? 'OFF'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span class="fw-semibold">Tue</span>
                                <span><?php echo e($shopHours->tuesday ?? 'OFF'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span class="fw-semibold">Wed</span>
                                <span><?php echo e($shopHours->wednesday ?? 'OFF'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span class="fw-semibold">Thu</span>
                                <span><?php echo e($shopHours->thursday ?? 'OFF'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span class="fw-semibold">Fri</span>
                                <span class="text"><?php echo e($shopHours->friday ?? 'OFF'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span class="fw-semibold">Sat</span>
                                <span class="text"><?php echo e($shopHours->saturday ?? 'OFF'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span class="fw-semibold">Sun</span>
                                <span><?php echo e($shopHours->sunday ?? 'OFF'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Car Ads -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Spare Parts Ads</h5>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                        <div class="col">
                            <?php if($shopAds->count() > 0): ?>
                                <?php $__currentLoopData = $shopAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card h-90 shadow-sm border-0 rounded-3">
                                        <?php
                                            $images = json_decode($ad->images, true);
                                        ?>

                                        <?php if(is_array($images) && isset($images[0])): ?>
                                            <img src="<?php echo e(asset('storage/' . $images[0])); ?>"
                                                class="card-img-top img-fluid" alt="Product">
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h6 class="fw-semibold"><?php echo e($ad->title); ?></h6>
                                            <h5 class="text-danger fw-bold">AED <?php echo e($ad->price); ?></h5>
                                            <ul class="list-unstyled small">
                                                <li><b>Availability:</b> <span class="text-success">In Stock</span></li>
                                                <li><b>Condition:</b> <?php echo e($ad->condition); ?></li>
                                                <li><b>Delivery:</b> Ask Supplier</li>
                                                <li><b>Warranty:</b> Ask Supplier</li>
                                            </ul>
                                            <div class="d-flex gap-2">
                                                
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <!-- More ads as needed -->
                    </div>
                </div>
            </div>
            <!-- Car Ads -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Car Ads</h5>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                        <div class="col">
                            <?php if($shopCarAds->count() > 0): ?>
                                <?php $__currentLoopData = $shopCarAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card h-90 shadow-sm border-0 rounded-3">
                                        <?php
                                            $images = json_decode($ad->images, true);
                                        ?>
                                        <?php if(is_array($images) && isset($images[0])): ?>
                                            <img src="<?php echo e(asset('storage/' . $images[0])); ?>"
                                                class="card-img-top img-fluid" alt="Product">
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h6 class="fw-semibold"><?php echo e($ad->title); ?></h6>
                                            <h5 class="text-danger fw-bold">AED <?php echo e($ad->price); ?></h5>
                                            <ul class="list-unstyled small">
                                                <li><b>Availability:</b> <span class="text-success">In Stock</span></li>
                                                <li><b>Condition:</b> <?php echo e($ad->condition); ?></li>
                                                <li><b>Delivery:</b> Ask Supplier</li>
                                                <li><b>Warranty:</b> Ask Supplier</li>
                                            </ul>
                                            <div class="d-flex gap-2">
                                                
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <!-- More ads as needed -->
                    </div>
                </div>
            </div>

            <!-- Gallery -->
            <div class="card shadow-sm border-0 rounded-3 mt-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Our Gallery</h5>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <?php $__currentLoopData = $shopGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-6 col-md-4 col-lg-3">
                                <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" class="img-fluid rounded"
                                    alt="">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/adminPanel/shop/view.blade.php ENDPATH**/ ?>