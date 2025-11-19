<?php $__env->startSection('main-section'); ?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3>Approve Ads</h3>

                <section class="section">
                    <div class="card shadow-sm border-0 rounded-3 mt-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Spare Parts Ads</h5>

                            <div class="row row-cols-1 row-cols-lg-2 g-4">
                                <?php if($shopAds->count() > 0): ?>
                                    <?php $__currentLoopData = $shopAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col">
                                            <div class="card h-100 shadow border-0 rounded-4 overflow-hidden hover-card">
                                                <?php
                                                    $images = json_decode($ad->images, true);
                                                ?>

                                                <?php if(is_array($images) && isset($images[0])): ?>
                                                    <img src="<?php echo e(asset('storage/' . $images[0])); ?>"
                                                         class="card-img-top img-fluid"
                                                         alt="Product"
                                                         style="height: 220px; object-fit: cover;">
                                                <?php endif; ?>

                                                <div class="card-body">
                                                    <h6 class="fw-semibold text-truncate"><?php echo e($ad->title); ?></h6>
                                                    <h5 class="text-danger fw-bold mb-3">AED <?php echo e($ad->price); ?></h5>

                                                    <ul class="list-unstyled small mb-3">
                                                        <li><b>Availability:</b> <span class="text-success">In Stock</span></li>
                                                        <li><b>Condition:</b> <?php echo e($ad->condition); ?></li>
                                                        <li><b>Delivery:</b> Ask Supplier</li>
                                                        <li><b>Warranty:</b> Ask Supplier</li>
                                                    </ul>

                                                    <?php if(!$ad->is_approved): ?>
                                                        <form action="<?php echo e(route('admin.ads.approve', $ad->id)); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <button type="submit" class="btn btn-success w-100">
                                                                <i class="bi bi-check2-circle"></i> Approve
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="col">
                                        <div class="alert alert-info text-center">
                                            No ads available.
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div>


<style>
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\hemo_project\resources\views/adminPanel/adApproves/ad.blade.php ENDPATH**/ ?>