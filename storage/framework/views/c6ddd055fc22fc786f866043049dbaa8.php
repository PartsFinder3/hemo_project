<?php echo $__env->make('adminPanel.layout.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('adminPanel.layout.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('main-section'); ?>
<?php echo $__env->make('adminPanel.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\hemo_project\resources\views/adminPanel/layout/main.blade.php ENDPATH**/ ?>