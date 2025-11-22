<?php $__env->startSection('main-section'); ?>
<?php echo $__env->make('Frontend.hero_section', ['part' => "Find City of " . $city->name], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>
    <section class="carMakes">
        <div class="section-text">
            <h3>TOP MAKES</h3>
            <h2>Browse By Brands</h2>
        </div>

        <div class="brands">
            <?php $__currentLoopData = $carMakes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('makes.show', $m->id)); ?>" class="make">
                    <?php if($m->logo): ?>
                          <img src="<?php echo e(asset('storage/' . $m->logo)); ?>" alt="<?php echo e($m->name); ?>">
                    <?php endif; ?>
                    <h4><?php echo e(strtoupper($m->name)); ?></h4>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <section class="ad-cards">
        <div class="section-text">
            <h3><?php echo e($city->name); ?> ADS</h3>
            <h2>Find the Best Deals For You</h2>
        </div>
        <div class="filters">
            <a href="#" class="active">All</a>
            <?php $__currentLoopData = $randomParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="#"><?php echo e($p->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="grid" id="productGrid1">
            <!-- Example Card -->
            <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card">
                    <?php
                        $images = json_decode($ad->images, true);
                    ?>

                    <?php if(is_array($images) && isset($images[0])): ?>
                        <img src="<?php echo e(asset('' . $images[0])); ?>" alt="Product">
                    <?php endif; ?>
                    <div class="card-body">
                        <a href="" class="card-title"><?php echo e($ad->title); ?></a>
                        <div class="price">AED <?php echo e($ad->price); ?></div>
                        <div class="meta">
                            Availability: In Stock <br>
                            Condition: <?php echo e($ad->condition); ?> <br>
                            Delivery: Ask Supplier <br>
                            Warranty: Ask Supplier
                        </div>
                        <?php
                            $ad->shop->supplier->whatsapp;
                        ?>
                        <div class="buttons">
                            <a href="javascript:void(0)" class="btn whatsapp"
                                onclick="contactSupplier('<?php echo e($ad->shop->supplier->is_active); ?>', '<?php echo e($ad->shop->supplier->whatsapp); ?>', '<?php echo e($ad->title); ?>')">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                            </a>

                            <a href="javascript:void(0)" class="btn call"
                                onclick="callSupplier('<?php echo e($ad->shop->supplier->is_active); ?>', '<?php echo e($ad->shop->supplier->whatsapp); ?>')">
                                <i class="fa-solid fa-phone"></i> Click to Call
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="pagination" id="pagination1"></div>
    </section>

        <section class="ad-cards">
        <div class="section-text">
            <h3><?php echo e($city->name); ?> CAR ADS</h3>
            <h2>Our Sellers are Currently Breaking These Cars for Spare Parts</h2>
        </div>
        <div class="filters">
            <a href="#" class="active">All</a>
            <?php $__currentLoopData = $randomMakes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('make.ads', ['slug' => $m->slug, 'id' => $m->id])); ?>"><?php echo e($m->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="grid" id="productGrid2">
            <!-- Example Card -->
            <?php $__currentLoopData = $carAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card">
                    <?php
                        $images = json_decode($ad->images, true);
                    ?>

                    <?php if(is_array($images) && isset($images[0])): ?>
                        <img src="<?php echo e(asset('storage/' . $images[0])); ?>" alt="Product">
                    <?php endif; ?>
                    <div class="card-body">
                        <a href="" class="card-title"><?php echo e($ad->title); ?></a>
                        
                        <div class="meta">
                            Availability: In Stock <br>
                            
                            Delivery: Ask Supplier <br>
                            Warranty: Ask Supplier
                        </div>
                        <?php
                            $ad->shop->supplier->whatsapp;
                        ?>
                        <div class="buttons">
                            <a href="javascript:void(0)" class="btn whatsapp"
                                onclick="contactSupplier('<?php echo e($ad->shop->supplier->is_active); ?>', '<?php echo e($ad->shop->supplier->whatsapp); ?>', '<?php echo e($ad->title); ?>')">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                            </a>

                            <a href="javascript:void(0)" class="btn call"
                                onclick="callSupplier('<?php echo e($ad->shop->supplier->is_active); ?>', '<?php echo e($ad->shop->supplier->whatsapp); ?>')">
                                <i class="fa-solid fa-phone"></i> Click to Call
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            <!-- Repeat similar cards... -->
        </div>

        <div class="pagination" id="pagination2"></div>
    </section>

    <!-- Locations -->
    <section class="locations-section">
        <div class="section-text">
            <h2>Auto Parts for Cars, Vans, SUVs Anywhere in the <?php echo e($city->name); ?></h2>

        </div>
        <div class="locations-grid">

            <?php $__currentLoopData = $domain->cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('city.ads',['slug' => $city->slug, 'id' => $city->id])); ?>" class="location-card"><i class="fa-solid fa-location-dot"></i> <?php echo e($city->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

<?php echo $__env->make('Frontend.layout.company', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        function contactSupplier(isActive, number, title) {
            if (isActive == 1) {
                let message = encodeURIComponent("Hello, I'm interested in your ad: " + title);
                let isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

                let url = isMobile ?
                    `https://wa.me/${number}?text=${message}` :
                    `https://web.whatsapp.com/send?phone=${number}&text=${message}`;

                window.open(url, "_blank");
            } else {
                // Supplier inactive → stay on same page
                window.location.reload();
            }
        }

        function callSupplier(isActive, number) {
            if (isActive == 1) {
                window.location.href = `tel:${number}`;
            } else {
                // Supplier inactive → stay on same page
                window.location.reload();
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Frontend.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/Frontend/city-search.blade.php ENDPATH**/ ?>