<?php $__env->startSection('main-section'); ?>
<div class="hero-section"> 
         <div class="hero-text d-flex justify-content-center align-items-center flex-column">
            <h1 style="text-align: center"><?php echo e($ad->title); ?></h1>
            <p>You Can View Part Details Below.</p>
            <!-- 2) Double chevron -->
            <span class="scroll-bounce" aria-hidden="true">

                <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 7l6 6 6-6M6 13l6 6 6-6" />
                </svg>
            </span>
            <style>
                .scroll-bounce {
                    display: inline-block;
                    animation: bounce 1.4s infinite;
                }

                @keyframes bounce {

                    0%,
                    20%,
                    50%,
                    80%,
                    100% {
                        transform: translateY(0);
                    }

                    40% {
                        transform: translateY(6px);
                    }

                    60% {
                        transform: translateY(3px);
                    }
                }
            </style>

        </div> 

    </div>
    </main>
    <div class="container my-5">
        <div class="row g-4">
            <!-- Left: Carousel -->
            <div class="col-md-6">
                <?php
                    $images = is_string($ad->images) ? json_decode($ad->images, true) : $ad->images;
                ?>

                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                                <img src="<?php echo e(asset('storage/' . $image)); ?>" class="d-block w-100"
                                    alt="Car Image <?php echo e($key + 1); ?>">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <h3 class="product-title"><?php echo e($ad->title); ?></h3>
                <p class="text-muted">Condition: <strong>
                        <?php if($ad->condition == 'new'): ?>
                            New
                        <?php elseif($ad->condition == 'used'): ?>
                            Used
                        <?php endif; ?>
                    </strong></p>
                <?php
                    $location = $ad->shop->supplier->city->name ?? 'Unknown';
                    $contact = $ad->shop->supplier->whatsapp;
                    $make = $ad->carMake->name ?? 'Unknown';
                    $model = $ad->carModel->name ?? 'Unknown';
                    $year = $ad->year->year ?? 'Unknown';
                    $shopName = $ad->shop->name ?? 'Unknown';
                ?>
                <p class="text-muted">Supplier Location: <strong><?php echo e($location); ?></strong></p>
                <p class="price">AED: <?php echo e($ad->price); ?></p>

                <div class="d-flex gap-2 my-3">
                    <a href="javascript:void(0)" class="btn whatsapp"
                        onclick="contactSupplier('<?php echo e($ad->shop->supplier->is_active); ?>', '<?php echo e($ad->shop->supplier->whatsapp); ?>', '<?php echo e($ad->title); ?>')">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>

                    <a href="javascript:void(0)" class="btn call"
                        onclick="callSupplier('<?php echo e($ad->shop->supplier->is_active); ?>', '<?php echo e($ad->shop->supplier->whatsapp); ?>')">
                        <i class="fa-solid fa-phone"></i> Click to Call
                    </a>
                </div>

                
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
                        <td><?php echo e($make); ?></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><?php echo e($model); ?></td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td><?php echo e($year); ?></td>
                    </tr>
                    
                    <tr>
                        <td>Parts Supplier</td>
                        <td><?php echo e($shopName); ?></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Frontend.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\hemo_project\resources\views/Frontend/view-add.blade.php ENDPATH**/ ?>