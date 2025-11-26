<?php echo $__env->make('adminPanel.layout.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('adminPanel.layout.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="content-wrapper">
    <?php echo $__env->yieldContent('main-section'); ?>
</div>

<?php echo $__env->make('adminPanel.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\partsfinder\resources\views/adminPanel/layout/main.blade.php ENDPATH**/ ?>