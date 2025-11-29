<?php $__env->startSection('main-section'); ?>

<div class="container mt-4">
    <h2>Assign SEO Template to Product</h2>

    <form action="#" method="POST">
        <?php echo csrf_field(); ?>

        <!-- Select SEO Template -->
        <div class="mb-3">
            <label for="seo_template" class="form-label">Select SEO Template</label>
            <select id="seo_template" name="seo_template_id" class="form-select" required>
                <option value="">-- Choose Template --</option>
                <option value="1" data-description="Meta tags for homepage">Homepage SEO</option>
                <option value="2" data-description="Meta tags for products page">Product SEO</option>
                <option value="3" data-description="Meta tags for blog">Blog SEO</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign Template</button>
    </form>

    <!-- Preview Row -->
    <div class="mt-4">
        <h5>Selected Template Preview:</h5>
        <div class="card p-3" id="template_preview">
            <strong>Template Name:</strong> <span id="preview_name">None</span><br>
            <strong>Description:</strong> <span id="preview_description">No template selected</span>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/adminPanel/partsMeta/index.blade.php ENDPATH**/ ?>