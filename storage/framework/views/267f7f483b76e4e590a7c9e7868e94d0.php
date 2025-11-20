<?php $__env->startSection('main-section'); ?>
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <?php if(auth()->guard('admins')->user()->role == 'admin'): ?>
            <h3>Profile Statistics - Admin</h3>
        <?php else: ?>
            <h3>Profile Statistics - Editor</h3>
        <?php endif; ?>
        <div class="buttons">
            <a href="<?php echo e(route('inquiries.index')); ?>" type="button" class="btn btn-primary btn-icon icon-left">
                <i class="fa-solid fa-envelope mx-2"></i> Enquiries <span
                    class="badge bg-transparent"><?php echo e($buyerInquiries); ?></span>
            </a>
            <a href="<?php echo e(route('supplier.requests')); ?>" type="button" class="btn btn-info btn-icon icon-left">
                <i class="fa-solid fa-user-plus mx-2"></i> Supplier Signups Requests <span
                    class="badge bg-transparent"><?php echo e($requests); ?></span>
            </a>
            <a href="<?php echo e(route('admin.ads')); ?>" class="btn btn-success">Ads To Approve <span
                    class="badge bg-transparent"><?php echo e($ads); ?></span></a>
            <a href="<?php echo e(route('admin.carAds')); ?>" class="btn btn-warning">Car Ads To Approve <span
                    class="badge bg-transparent"><?php echo e($carAds); ?></span></a>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="fa-solid fa-wrench"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Parts</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo e($totalParts); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Suppliers</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo e($totalSuppliers); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="fa-solid fa-car-side"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Makes</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo e($totalMakes); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="fa-solid fa-store"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Shops</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo e($totalShops); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        <?php if(auth()->guard('admins')->user()->role == 'admin'): ?>
            <section class="section">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Payments</h4>
                                <div id="pagination-controls" class="d-flex gap-2"></div>

                            </div>
                            <div class="card-body">
                                
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $accordionId = 'flush-collapse-' . $supplier->id;
                                            $headingId = 'flush-heading-' . $supplier->id;
                                            $modalId = 'borderless-' . $supplier->id;
                                            $carouselId = 'carousel-' . $supplier->id;
                                        ?>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="<?php echo e($headingId); ?>">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#<?php echo e($accordionId); ?>"
                                                    aria-expanded="false" aria-controls="<?php echo e($accordionId); ?>">
                                                    <?php echo e($supplier->name); ?> - <?php echo e($supplier->whatsapp); ?>

                                                </button>
                                            </h2>

                                            <div id="<?php echo e($accordionId); ?>" class="accordion-collapse collapse"
                                                aria-labelledby="<?php echo e($headingId); ?>"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body d-flex flex-column gap-2">
                                                    

                                                    <span>
                                                        <ul class="list-unstyled">
                                                            <?php
                                                                $sent = $supplier->inquiries->sum('used_inquiries');
                                                                $open = $supplier->inquiryUsages->sum('is_open');
                                                                $ctr = $sent > 0 ? round(($open / $sent) * 100, 2) : 0; // safe divide
                                                            ?>

                                                            <li>Inquiries Sent: <?php echo e($sent); ?></li>
                                                            <li>Inquiries Open: <?php echo e($open); ?></li>
                                                            <li>CTR : <?php echo e($ctr); ?>%</li>

                                                            <span>
                                                                <button type="button" class="btn btn-outline-primary block"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#<?php echo e($modalId); ?>">
                                                                    View Payment Screen Shots
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade text-left modal-borderless"
                                                                    id="<?php echo e($modalId); ?>" tabindex="-1" role="dialog"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                                                        role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Payment Screenshots
                                                                                </h5>
                                                                                <button type="button"
                                                                                    class="close rounded-pill"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <i data-feather="x"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <div id="carousel-<?php echo e($supplier->id); ?>"
                                                                                    class="carousel slide"
                                                                                    data-bs-ride="false">
                                                                                    <!-- ❌ auto scroll disabled -->

                                                                                    <div class="carousel-inner">
                                                                                        <?php $__currentLoopData = $supplier->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <div
                                                                                                class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                                                                                                <img src="<?php echo e(asset('storage/' . $payment->image)); ?>"
                                                                                                    class="d-block mx-auto img-fluid"
                                                                                                    style="max-height: 500px; object-fit: contain;"
                                                                                                    alt="Payment Screenshot">
                                                                                            </div>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    </div>

                                                                                    <!-- Controls -->
                                                                                    <button class="carousel-control-prev"
                                                                                        type="button"
                                                                                        data-bs-target="#carousel-<?php echo e($supplier->id); ?>"
                                                                                        data-bs-slide="prev">
                                                                                        <span
                                                                                            class="carousel-control-prev-icon"
                                                                                            aria-hidden="true"></span>
                                                                                        <span
                                                                                            class="visually-hidden">Previous</span>
                                                                                    </button>

                                                                                    <button class="carousel-control-next"
                                                                                        type="button"
                                                                                        data-bs-target="#carousel-<?php echo e($supplier->id); ?>"
                                                                                        data-bs-slide="next">
                                                                                        <span
                                                                                            class="carousel-control-next-icon"
                                                                                            aria-hidden="true"></span>
                                                                                        <span
                                                                                            class="visually-hidden">Next</span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </span>
                                                        </ul>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        <?php endif; ?>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const items = document.querySelectorAll(".supplier-item");
            const perPage = 5; // show 5 suppliers per page
            let currentPage = 1;

            function showPage(page) {
                items.forEach((item, index) => {
                    item.style.display =
                        index >= (page - 1) * perPage && index < page * perPage ?
                        "block" :
                        "none";
                });
            }

            function renderPagination() {
                const totalPages = Math.ceil(items.length / perPage);
                const controls = document.getElementById("pagination-controls");
                controls.innerHTML = "";

                const prevBtn = document.createElement("button");
                prevBtn.textContent = "Prev";
                prevBtn.className = "btn btn-sm btn-outline-primary";
                prevBtn.disabled = currentPage === 1;
                prevBtn.onclick = () => {
                    if (currentPage > 1) {
                        currentPage--;
                        showPage(currentPage);
                        renderPagination();
                    }
                };
                controls.appendChild(prevBtn);

                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement("button");
                    btn.textContent = i;
                    btn.className =
                        "btn btn-sm " + (i === currentPage ? "btn-primary" : "btn-outline-primary");
                    btn.onclick = () => {
                        currentPage = i;
                        showPage(currentPage);
                        renderPagination();
                    };
                    controls.appendChild(btn);
                }

                const nextBtn = document.createElement("button");
                nextBtn.textContent = "Next";
                nextBtn.className = "btn btn-sm btn-outline-primary";
                nextBtn.disabled = currentPage === totalPages;
                nextBtn.onclick = () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        showPage(currentPage);
                        renderPagination();
                    }
                };
                controls.appendChild(nextBtn);
            }

            showPage(currentPage);
            renderPagination();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/adminPanel/index.blade.php ENDPATH**/ ?>