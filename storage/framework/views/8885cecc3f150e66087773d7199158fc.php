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
                    <h3>Blog Posts</h3>
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

                        <span>
                            <a href="<?php echo e(route('blogs.create')); ?>" class="btn btn-primary">Create New Blog</a>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Views</th>
                                <th>Show</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($blog->title); ?></td>
                                    <td><?php echo e($blog->category->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($blog->author); ?></td>
                                    <td><?php echo e($blog->is_view); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('blogs.show', $blog->id)); ?>" class="btn btn-info">Show</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="<?php echo e(route('blogs.edit', $blog->id)); ?>"><i
                                                class="fa-solid fa-pen-to-square"></i>
                                            Edit</a>
                                        <a class="btn btn-danger" href="<?php echo e(route('blogs.delete', $blog->id)); ?>"><i
                                                class="fa-solid fa-trash"></i>
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

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\hemo_project\resources\views/adminPanel/blogs/index.blade.php ENDPATH**/ ?>