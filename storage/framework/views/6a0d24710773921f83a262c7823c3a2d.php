
<?php $__env->startSection('main-section'); ?>

<div class="container mt-4">
    <h2>Update SEO Template</h2>

    <!-- Update Form -->
    <form action="<?php echo e(route('seo.update.title', $Tamplate_title->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
     



                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter title" value="<?php echo e($Tamplate_title->tittle); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="template_type" class="form-label">Template Type</label>
                        <select name="template_description_type" id="template_type" class="form-control" required>
                            <option value="" disabled>Select Template Type</option>

                            <option value="makes" <?php echo e($Tamplate_title->type == 'makes' ? 'selected' : ''); ?>>makes</option>

                            <option value="models" <?php echo e($Tamplate_title->type == 'models' ? 'selected' : ''); ?>>models</option>

                            <option value="parts" <?php echo e($Tamplate_title->type == 'parts' ? 'selected' : ''); ?>>parts</option>

                        </select>
                    </div>


        <button type="submit" class="btn btn-success">Update Template</button>
        <a href="<?php echo e(route('SEO.SeoTitles')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/adminPanel/seo_tamplate/update_title.blade.php ENDPATH**/ ?>