<?php echo $__env->make('adminPanel.layout.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('adminPanel.layout.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php if(session('success')): ?>
    <script>
        swal("Success!", "<?php echo e(session('success')); ?>", "success");
    </script>
<?php endif; ?>

<?php if(session('error')): ?>
    <script>
        swal("Error!", "<?php echo e(session('error')); ?>", "error");
    </script>
<?php endif; ?>
<div class="content-wrapper">
    <?php echo $__env->yieldContent('main-section'); ?>
</div>

<?php echo $__env->make('adminPanel.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\partsfinder\resources\views/adminPanel/layout/main.blade.php ENDPATH**/ ?>