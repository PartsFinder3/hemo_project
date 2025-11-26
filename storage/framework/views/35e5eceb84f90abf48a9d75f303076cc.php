<?php $__env->startSection('main-section'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php if(session('success')): ?>
    <script>
        swal("Success!", "<?php echo e(session('success')); ?>", "success");
    </script>
<?php endif; ?>

<?php if(session('error')): ?>
    <script>
        swal("Error!", "<?php echo e(session('error')); ?>", "error");
    </script>
<?php endif; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <?php
                    $shop_id = Auth::guard('supplier')->user()->shop->id;
                ?>
                <!-- Top Navigation -->
                <div class="row mb-4">
                    <!-- Links -->
                    <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-wrap align-items-center">
                        <a class="text-decoration-none me-3 fw-semibold"
                            href="<?php echo e(route('supplier.ads.index', $shop_id)); ?>">All
                            Ads</a>
                        <a class="text-decoration-none me-3 fw-semibold"
                            href="<?php echo e(route('supplier.ads.active', $shop_id)); ?>">Active
                            Ads</a>
                        <a class="text-decoration-none me-3 fw-semibold"
                            href="<?php echo e(route('supplier.ads.inactive', $shop_id)); ?>">Inactive
                            Ads</a>
                        <a class="text-decoration-none me-3 fw-semibold"
                            href="<?php echo e(route('supplier.ads.approved', $shop_id)); ?>">Approved Ads</a>
                        <a class="text-decoration-none fw-semibold" href="<?php echo e(route('shop.ads.waiting', $shop_id)); ?>">Waiting
                            for
                            Approval</a>
                    </div>

                    <!-- Buttons -->
                    <div class="col-12 col-md-4 d-flex justify-content-md-end flex-wrap gap-2">
                        <a class="btn btn-orange" href="<?php echo e(route('shop.supplier.ads.create')); ?>">
                            <i class="bi bi-plus-circle me-1"></i> Create New Ad
                        </a>
                        <a class="btn btn-red" href="<?php echo e(route('shop.supplier.ads.createCar')); ?>">
                            <i class="bi bi-car-front me-1"></i> Car Breaking Ad
                        </a>
                    </div>
                </div>



                <!-- Ads Listing -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body">

                        <?php $__empty_1 = true; $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="row py-3 border-bottom align-items-center">

                                <!-- Ad Info -->
                                <div class="col-md-10">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h5 class="mb-1 fw-semibold"><?php echo e($ad->title); ?></h5>
                                        <?php if($ad->is_approved == '1'): ?>
                                            <span class="badge bg-success">Approved</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        <?php endif; ?>
                                    </div>
                                    <h6 class="text-danger fw-bold mb-2">AED <?php echo e(number_format($ad->price, 2)); ?></h6>
                                    <p class="text-muted small mb-0"><?php echo e($ad->description); ?></p>
                                </div>

                                <!-- Dropdown Menu -->
                                <div class="col-md-2 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button"
                                            id="dropdownMenuButton<?php echo e($ad->id); ?>" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="dropdownMenuButton<?php echo e($ad->id); ?>">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('shop.ads.edit', [$ad->id, $ad->slug])); ?>">
                                                    <i class="bi bi-pencil-square me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('supplier.ads.toggleActive', ['type' => $ad->ad_type, 'id' => $ad->id])); ?>">
                                                    <?php if($ad->is_active): ?>
                                                        <i class="bi bi-eye-slash me-2"></i>Deactivate
                                                    <?php else: ?>
                                                        <i class="bi bi-eye me-2"></i>Activate
                                                    <?php endif; ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger"
                                                    href="<?php echo e(route('supplier.ads.delete', ['type' => $ad->ad_type, 'id' => $ad->id])); ?>">
                                                    <i class="bi bi-trash me-2"></i>Delete
                                                </a>

                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-center text-muted my-4">No ads found.</p>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('supplierPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/supplierPanel/ads/show.blade.php ENDPATH**/ ?>