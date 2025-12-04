<?php $__env->startSection('main-section'); ?>
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Suppliers</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-left">
                    
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        <?php else: ?>
                            <?php if(session('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo e(session('error')); ?>

                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>City</th>
                                <th>WhatsApp</th>
                                <?php if(auth()->guard('admins')->user()->role == 'admin'): ?>
                                    <th>Active</th>
                                    <th>Verified</th>
                                <?php endif; ?>
                                <th>Active-Shop</th>
                                <?php if(auth()->guard('admins')->user()->role == 'admin'): ?>
                                    <th>Invoice</th>
                                <?php endif; ?>
                                <th>Shop</th>
                                <?php if(auth()->guard('admins')->user()->role == 'admin'): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php if(auth()->guard('admins')->user()->role == 'admin'): ?>
                                            <a href="<?php echo e(route('payment.index', $supplier->id)); ?>"
                                                class="text-decoration-none fw-semibold">
                                                <?php echo e($supplier->name); ?>


                                            </a>
                                        <?php else: ?>
                                            <span class="text-decoration-none fw-semibold">
                                                <?php echo e($supplier->name); ?>

                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($supplier->city->name); ?></td>
                                    <td><?php echo e($supplier->whatsapp); ?></td>
                                    <?php if(auth()->guard('admins')->user()->role == 'admin'): ?>
                                      <td>
                                                <?php if($supplier->subscription_status === "active"): ?>
                                                    <button class="btn btn-primary">
                                                        <i class="fa fa-check"></i> <!-- Active -->
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-secondary">
                                                        <i class="fa fa-times"></i> <!-- Inactive -->
                                                    </button>
                                                <?php endif; ?>
                                        <td>
                                            <?php if($supplier->is_verified): ?>
                                                <a href="<?php echo e(route('suppliers.verified.toggle', $supplier->id)); ?>"
                                                    class="btn btn-warning">Unverify</a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('suppliers.verified.toggle', $supplier->id)); ?>"
                                                    class="btn btn-success">Verify</a>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                    <td>
                                        <?php if($supplier->shop): ?>
                                            <?php if($supplier->shop->is_active): ?>
                                                <a href="<?php echo e(route('shops.toggle', $supplier->id)); ?>"
                                                    class="btn btn-danger">Ban</a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('shops.toggle', $supplier->id)); ?>"
                                                    class="btn btn-success">Unban</a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <form action="<?php echo e(route('shops.create', $supplier->id)); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-sm btn-success">Create</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(auth()->guard('admins')->user()->role == 'admin'): ?>
                                        <td>
                                            <a href="<?php echo e(route('invoices.create', $supplier->id)); ?>"
                                                class="btn btn-sm btn-light">Generate</a>
                                        </td>
                                    <?php endif; ?>
                                    <td>
                                        <?php if($supplier->shop): ?>
                                            <a href="<?php echo e(route('shops.view', $supplier->shop->id)); ?>"
                                                class="btn btn-sm btn-primary">View</a>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(auth()->guard('admins')->user()->role == 'admin'): ?>
                                        <td>
                                            <a href="<?php echo e(route('payment.create.show', $supplier->id)); ?>"
                                                class="btn btn-sm btn-info">Payment</a>
                                        </td>
                                    <?php endif; ?>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/adminPanel/suppliers/show.blade.php ENDPATH**/ ?>