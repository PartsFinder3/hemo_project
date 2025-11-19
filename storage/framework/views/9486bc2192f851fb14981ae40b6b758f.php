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
                <h3>Approve Car Ads</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm border-0 rounded-3 mt-4">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Spare Parts Ads</h5>

                <?php if($carAds->count() > 0): ?>
                <div class="row g-4">
                    <?php $__currentLoopData = $carAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm rounded-3 hover-card">
                            <?php
                                $images = json_decode($ad->images, true);
                            ?>

                            <?php if(is_array($images) && isset($images[0])): ?>
                                <img src="<?php echo e(asset('storage/' . $images[0])); ?>"
                                     class="card-img-top img-fluid rounded-top"
                                     style="height: 200px; object-fit: cover;"
                                     alt="Product">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/placeholder.png')); ?>"
                                     class="card-img-top img-fluid rounded-top"
                                     style="height: 200px; object-fit: cover;"
                                     alt="No Image">
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-semibold mb-2"><?php echo e($ad->title); ?></h6>

                                <ul class="list-unstyled small text-muted mb-3">
                                    <li><b>Availability:</b> <span class="text-success">In Stock</span></li>
                                    <li><b>Condition:</b> <?php echo e($ad->condition); ?></li>
                                    <li><b>Delivery:</b> Ask Supplier</li>
                                    <li><b>Warranty:</b> Ask Supplier</li>
                                </ul>

                                <?php if(!$ad->is_approved): ?>
                                    <form action="<?php echo e(route('admin.carAds.approve', $ad->id)); ?>"
                                          method="POST" class="mt-auto">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-success w-100">
                                            Approve
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="badge bg-success mt-auto align-self-start">Approved</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                    <p class="text-muted">No car ads available for approval.</p>
                <?php endif; ?>

            </div>
        </div>
    </section>
</div>


<?php $__env->startPush('styles'); ?>
<style>
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\hemo_project\resources\views/adminPanel/adApproves/carAd.blade.php ENDPATH**/ ?>