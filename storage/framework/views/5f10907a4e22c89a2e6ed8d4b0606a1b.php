
<?php $__env->startSection('main-section'); ?>

<div class="container mt-4">
    <h2>SEO Templates Description</h2>

    <!-- Add SEO Template Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSEOModal">
        Add SEO Description
    </button>

    <!-- Modal (Large) -->
<!-- Modal (Large) -->
<div class="modal fade" id="addSEOModal" tabindex="-1" aria-labelledby="addSEOModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo e(route('tamplate.add')); ?>" method="POST">
                <?php echo csrf_field(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addSEOModalLabel">Add SEO Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">



                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="7" placeholder="Enter description"></textarea>
                </div>
                 <div class="mb-3">
                        <label for="template_type" class="form-label">Template Type</label>
                        <select name="template_description_type" id="template_type" class="form-control" required>
                            <option value="" selected disabled>Select Template Type</option>
                            <option value="makes">makes</option>
                            <option value="models">models</option>
                            <option value="parts">parts</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Template</button>
            </div>
            </form>
        </div>
    </div>
</div>

    <!-- SEO Templates Table -->
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>#</th>
             
                <th>Description</th>
                   <th>type</th>
                <th width="130px">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example Row -->
<?php $__currentLoopData = $Tamplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tamplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($index + 1); ?></td>

    <td style="word-break: break-word; white-space: normal;"><?php echo e($tamplate->description); ?></td>
    <td style="word-break: break-word; white-space: normal;"><?php echo e($tamplate->type); ?></td>
   
    <td>
    <a href="<?php echo e(route('tamplate.edit', $tamplate->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
       <form action="<?php echo e(route('tamplate.destroy', $tamplate->id)); ?>" method="POST" class="d-inline">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
    </form>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/adminPanel/seo_tamplate/index.blade.php ENDPATH**/ ?>