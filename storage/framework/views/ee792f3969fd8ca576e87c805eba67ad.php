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
                    <h3>Spare Parts</h3>
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
                        <!--Modal lg size -->
                        <div class="me-1 mb-1 d-inline-block">
                            <!-- Button trigger for large size modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#large">
                                Add Part
                            </button>
                            <!--large size Modal -->
                            <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel17" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel17">Add Spare Part</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo e(route('spareparts.store')); ?>" method="POST"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>

                                                <div class="mb-3">
                                                    <label>Category</label>
                                                    <select name="category_id" class="form-control" required>
                                                        <option value="">-- Select Category --</option>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Part Name</label>
                                                    <input type="text" name="name" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>OEM Number</label>
                                                    <input type="text" name="oem_number" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label>Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>

                                                <button type="submit" class="btn btn-success">Save</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>OEM Number</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>SEO</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $spareParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($part->name); ?></td>
                                    <td><?php echo e($part->oem_number); ?></td>
                                    <td><?php echo e($part->category->name ?? 'N/A'); ?></td>
                                    <td>
                                        <?php if($part->image): ?>
                                            <img src="<?php echo e(asset('storage/' . $part->image)); ?>" alt="Spare Part" width="80">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.parts.meta',$part->id)); ?>" class="btn btn-warning">SEO</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="<?php echo e(route('spareparts.edit',$part->id)); ?>"><i
                                                        class="fa-solid fa-pen-to-square"></i>
                                                    Edit</a>
                                                <a class="btn btn-danger" href="<?php echo e(route('spareparts.destroy',$part->id)); ?>"><i class="fa-solid fa-trash"></i>
                                                    Delete</a>
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

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/adminPanel/parts/show.blade.php ENDPATH**/ ?>