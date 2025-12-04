<section class="about">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="about-content">
                    <?php if($domain && $domain->companyData && $domain->companyData->about_us): ?>
                        <?php echo $domain->companyData->about_us; ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- FAQs -->
<?php if($getFAQS->count() > 0): ?>
    <section class="faqs">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h1 class="main-title text-center mb-5">Frequently Asked Questions</h1>

                    <!-- General Service Questions -->
                    <?php $__currentLoopData = $getFAQS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $FAQS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>              
                    <div class="mb-5">
                        <div class="accordion" id="generalServiceAccordion">
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#general1" aria-expanded="false" aria-controls="general1">
                                        <?php echo e($FAQS->F_question); ?>

                                    </button>
                                </h3>
                                <div id="general1" class="accordion-collapse collapse"
                                    data-bs-parent="#generalServiceAccordion">
                                    <div class="accordion-body">
                                        <?php echo e($FAQS->F_answer); ?>

                                       
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                    <!-- Support Section -->
                
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <section class="cta-banner">
        <div class="cta-content">
            <h2>Find Car Spare Parts Online Today</h2>
            <p>Get instant quotes from local spare part sellers and compare prices in just a few clicks.</p>

            <div class="cta-actions">
                <a href="#" class="cta-btn">Find My Part</a>
                <div class="trust-points">
                    <span><i class="fa-solid fa-shield-check"></i> Verified Sellers</span>
                    <span><i class="fa-solid fa-coins"></i> Save Time & Money</span>
                </div>
            </div>
        </div>

        <div class="cta-image">
            <img src="<?php echo e(asset('Frontend/assets/quote.png')); ?>" alt="Mechanics fixing car">
        </div>
    </section>
<?php /**PATH C:\laragon\www\partsfinder\resources\views/Frontend/layout/company.blade.php ENDPATH**/ ?>