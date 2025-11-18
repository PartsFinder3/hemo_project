<?php $__env->startSection('main-section'); ?>
    <div class="hero-section">
        <div class="hero-text d-flex justify-content-center align-items-center flex-column">
            <h1>About Our Vision</h1>
                        <span class="scroll-bounce" aria-hidden="true">

                <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 7l6 6 6-6M6 13l6 6 6-6" />
                </svg>
            </span>
            <style>
                .scroll-bounce {
                    display: inline-block;
                    animation: bounce 1.4s infinite;
                }

                @keyframes bounce {

                    0%,
                    20%,
                    50%,
                    80%,
                    100% {
                        transform: translateY(0);
                    }

                    40% {
                        transform: translateY(6px);
                    }

                    60% {
                        transform: translateY(3px);
                    }
                }
            </style>

            
        </div>
    </div>
    </main>
<?php if($domain): ?>
    <?php echo $domain->about; ?>

<?php else: ?>
    <p>No domain configuration found.</p>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\hemo_project\resources\views/Frontend/about.blade.php ENDPATH**/ ?>