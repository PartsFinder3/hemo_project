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
                    <h3>Supplier Requests</h3>
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
                                <th>Business Name</th>
                                <th>City</th>
                                <th>Email</th>
                                <th>WhatsApp</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($request->name); ?></td>
                                    <td><?php echo e($request->business_name); ?></td>
                                    <td><?php echo e($request->city->name); ?></td>
                                    <td><?php echo e($request->email); ?></td>
                                    <td><?php echo e($request->whatsapp); ?></td>
                                    <td>
                                        <?php if($request->status == 'approved'): ?>
                                            <span class="badge bg-success">Approved</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="d-flex gap-2 flex-wrap justify-content-center align-items-center">
                                            <a class="btn btn-sm btn-primary">
                                                <form action="<?php echo e(route('supplier.approve', $request->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    <button class="btn-transparent" type="submit">Approve</button>
                                                </form>
                                            </a>
                                            <a class="btn btn-sm btn-warning" href="<?php echo e(route('supplier.reject', $request->id)); ?>"><i
                                                    class="fa-solid fa-trash"></i>
                                                Reject</a>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\hemo_project\resources\views/adminPanel/SupplierRequests/show.blade.php ENDPATH**/ ?>