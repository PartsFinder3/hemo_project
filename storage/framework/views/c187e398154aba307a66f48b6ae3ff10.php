<?php $__env->startSection('main-section'); ?>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <!-- Profile Card -->
                <div class="card shadow-sm border-0 rounded-3">
                    <!-- Cover Image -->
                    <?php if($profile && $profile->cover): ?>
                        <img src="<?php echo e(asset('storage/' . $profile->cover)); ?>" class="card-img-top rounded-top" alt="Cover">
                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/compiled/jpg/Head.png')); ?>" class="card-img-top rounded-top" alt="Cover">
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Shop Image -->
                            <div class="col-md-2 col-3 text-center">
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

                            <!-- Shop Info -->
                            <div class="col-md-7 col-9">
                                <h4 class="mb-0">
                                    <?php echo e($shop->name); ?>

                                    <?php if($shop->supplier->is_verified): ?>
                                        <span class="badge bg-warning text-dark">Verified</span>
                                    <?php endif; ?>
                                </h4>
                                <p class="text-muted mb-1">
                                    <i class="bi bi-geo-alt-fill text-danger"></i>
                                    <?php echo e($profile?->address ? $profile->address . ' ' . $shop->supplier->city->name : $shop->supplier->city->name); ?>


                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-md-3 col-12 text-md-end text-start mt-2 mt-md-0">
                                <a href="<?php echo e(route('supplier.shop.profile.create', $shop->id)); ?>"
                                    class="btn btn-orange btn-sm w-100 w-md-auto">Edit Profile</a>
                            </div>
                        </div>

                        <hr>

                        <!-- About Section -->
                        <?php if(isset($profile) && $profile->description): ?>
                            <h6>About</h6>
                            <p class="text-muted"><?php echo e($profile->description); ?></p>
                        <?php endif; ?>

                        <!-- Contact Buttons -->
                        
                    </div>
                </div>
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
                                
                            </div>
                        </div>

                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2">
                        <?php $__currentLoopData = $shopParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col">
        <div class="p-2 border rounded text-center">
            <?php echo e($part->part->name ?? 'Unknown'); ?>

        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <a href="<?php echo e(route('supplier.shops.hours.create', $shop->id)); ?>" class="btn btn-orange">Add
                                    Hours</a>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <p class="text-muted mb-0"><?php echo e($profile?->address ? $profile->address . ' ' . $shop->supplier->city->name : $shop->supplier->city->name); ?>


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

                                       <?php if(!empty($images[0])): ?>
    <img src="<?php echo e(asset('storage/ad_images/' . basename($images[0]))); ?>" 
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
                                                
                                                <ul class="list-unstyled small">
                                                    <li><b>Availability:</b> <span class="text-success">In Stock</span>
                                                    </li>
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Our Gallery</h5>
                        <span>
                            <a href="<?php echo e(route('supplier.shops.gallery.create', $shop->id)); ?>" class="btn btn-orange">Add
                                Image</a>
                        </span>
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
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('supplierPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/supplierPanel/shopProfile/view.blade.php ENDPATH**/ ?>