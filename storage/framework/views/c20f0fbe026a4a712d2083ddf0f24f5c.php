<?php echo $__env->make('frontend.layout.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('main-section'); ?>
<?php echo $__env->make('Frontend.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\partsfinder\resources\views/Frontend/layout/main.blade.php ENDPATH**/ ?>