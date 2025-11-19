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
                    <h3>Buyer Inquiries</h3>
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
                                <th>Buyer</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Spare Parts</th>
                                <th>Condition</th>
                                <th>VIN</th>
                                <th>OEM</th>
                                <th>Send</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($inquiry->buyer->whatsapp ?? 'N/A'); ?></td>
                                    <td><?php echo e($inquiry->carMake->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($inquiry->carModel->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($inquiry->year->year ?? 'N/A'); ?></td>
                                    <td>
                                        <?php echo e($inquiry->partsList->isNotEmpty() ? $inquiry->partsList->pluck('name')->join(', ') : 'N/A'); ?>

                                    </td>

                                    <td>
                                        <?php if($inquiry->condition): ?>
                                            <?php if($inquiry->condition == 'new'): ?>
                                                <span class="badge badge-success bg-success">
                                                    New
                                                </span>
                                            <?php elseif($inquiry->condition == 'used'): ?>
                                                <span class="badge badge-warning">
                                                    Used
                                                </span>
                                            <?php elseif($inquiry->condition == 'does_not_matter'): ?>
                                                <span class="badge badge-secondary">
                                                    Does Not Matter
                                                </span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($inquiry->vin_num ?? 'N/A'); ?></td>
                                    <td><?php echo e($inquiry->oem_num ?? 'N/A'); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($inquiry->is_send ? 'bg-success' : 'bg-danger'); ?>">
                                            <?php echo e($inquiry->is_send ? 'Sent' : 'Not Sent'); ?>

                                        </span>
                                    </td>
                                    <td class="d-flex gap-2 flex-column">
                                        <form action="<?php echo e(route('inquiries.send', $inquiry->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-primary">Share</button>
                                        </form>
                                        <a href="<?php echo e(route('inquiries.send.whatsapp', $inquiry->id)); ?>"
                                            class="btn btn-success">WhatsApp</a>
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

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\hemo_project\resources\views/adminPanel/enquiries/show.blade.php ENDPATH**/ ?>