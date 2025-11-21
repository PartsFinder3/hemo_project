<?php $__env->startSection('main-section'); ?>
<style>
    .hero-section_p{
       width: 100%;
       height: auto;
       display: flex;
       flex-direction: column
    }
   .hero_section_text{
     width: 100%;
     height: 7%;
    font-size: 4rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-align: center;
    font-weight: bolder;
   }
   .secound_hero_section{
    widows: 100%;
    height: 88%;
   
    display: flex;
    flex-direction: row;   
}
   .part_finder_card{
     width: 50%;
     height: 100%;
     
   }
   .search-title{
      padding-bottom: 10px;
   }
   .car{
    width: 400px !important;
   
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    width: 450px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-left: 140px;

   }


   .free-text {
    background: var(--accent-color);
    color: var(--primary-color);
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    display: inline-block;
    margin-top: -15px;
    
}
.find-btn {
    width: 100%;
    background: linear-gradient(135deg, var(--accent-color), #ff9500);
    color: var(--primary-color);
    padding: 10px;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    /* margin-top: 10px; */
    height: 50px !important;
    font-family: 'Montserrat', sans-serif;
}
.grid {
    display: flex; /* ya grid */
    flex-wrap: wrap;
    gap: 15px !important; /* <-- spacing yahan control hoga */
}
</style>
<div class="hero-section_p">
         <div class="hero_section_text">
               <h1>Find Your Perfect Parts</h1>
         </div>
        <div class="secound_hero_section">
             <div class="part_finder_card">
             <div class="car">
              <div class="card-header">
                 <div class="free-text">100% FREE</div>
                <div class="search-title">Search Your Part Here</div>
              </div>
               <form action="<?php echo e(route('buyer.inquiry.send')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="form-group" id="make-group">
                <select class="dropdown" id="make" name="car_make_id">
                    <option disabled selected value="">Select Your Make</option>
                    <?php $__currentLoopData = $makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($make->id); ?>">    <?php echo e($make->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group" id="model-group">
                <select class="dropdown" id="model" name="car_model_id">
                    <option value="">Select Your Model</option>
                </select>
            </div>

            <div class="form-group" id="year-group">
                <select class="dropdown" id="year" name="year_id">
                    <option value="">Select Your Model Year</option>
                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($year->id); ?>"><?php echo e($year->year); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group hidden" id="parts-group">
                <select id="parts-dropdown" class="dropdown" disabled>
                    <option disabled selected value="">Select a part to add</option>
                    <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($part->id); ?>"><?php echo e($part->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div id="parts-tags" class="parts-tags"></div>
            </div>

            <div class="form-group hidden" id="condition-group">
                <div class="condition-section">
                    <div class="condition-title">Condition Required ?</div>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="used" name="condition" value="used" />
                            <label for="used">Used</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="new" name="condition" value="new" checked />
                            <label for="new">New</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="doesnt-matter" name="condition" value="does_not_matter" />
                            <label for="doesnt-matter">Doesn't matter</label>
                        </div>
                    </div>
                </div>
            </div>

            <button class="find-btn" id="find-btn" disabled>Find My Part</button>
        </form>
             </div>
        </div>

 

     
    </div>
</div>



    </main>
    <!-- How It Works -->
    <section class="how-it-works-section">
        <div class="how-text">
            <h2>How It Works</h2>
            <p>
                We partner with the UAE’s top spare parts suppliers to ensure you get the service you deserve.
            </p>
        </div>

        <div class="steps">
            <div class="step">
                <div class="step-icon">
                    <img src="<?php echo e(asset('Frontend/assets/1.png')); ?>" alt="Step 1" />
                </div>
                <div class="step-text">
                    <h3>Enter Your Part Requirement</h3>
                    <p>
                        Select your car and specify the spare parts you need.
                        We will search our suppliers’ inventory to find the best matches for your request.
                    </p>
                </div>
            </div>

            <div class="step">
                <div class="step-icon">
                    <img src="<?php echo e(asset('Frontend/assets/2.png')); ?>" alt="Step 2" />
                </div>
                <div class="step-text">
                    <h3>Receive Price Quotes on WhatsApp</h3>
                    <p>
                        Provide your contact, and we’ll send quotes from trusted and vetted spare parts sellers.
                        Compare prices and select the seller that suits your needs best.
                    </p>
                </div>
            </div>

            <div class="step">
                <div class="step-icon">
                    <img src="<?php echo e(asset('Frontend/assets/3.png')); ?>" alt="Step 3" />
                </div>
                <div class="step-text">
                    <h3>Sit Back and Relax</h3>
                    <p>
                        Check your WhatsApp for received quotes.
                        Confirm your order with the selected supplier and choose whether you want delivery, fitting, or
                        pickup yourself.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="carMakes">
        <div class="section-text">
            <h3>TOP MAKES</h3>
            <h2>Browse By Brands</h2>
        </div>

        <div class="brands">
            <?php $__currentLoopData = $carMakes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('make.ads', ['slug' => $make->slug, 'id' => $make->id])); ?>" class="make">
                    <?php if($make->logo): ?>
               
                      <img src="<?php echo e(asset('storage/' . $make->logo)); ?>" alt="<?php echo e($make->name); ?>">
                      

                    <?php endif; ?>
                    <h4><?php echo e(strtoupper($make->name)); ?></h4>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <section class="ad-cards">
        <div class="section-text">
            <h3>TOP ADS</h3>
            <h2>Find the Best Deals For You</h2>
        </div>
        <div class="filters">
            <a href="#" class="active">All</a>
            <?php $__currentLoopData = $randomParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('part.ads', ['partName' => Str::slug($part->name), 'id' => $part->id])); ?>">
                    <?php echo e($part->name); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="grid" id="productGrid1">
            <!-- Example Card -->
            <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card">
                    <?php
                        $images = json_decode($ad->images, true);
                    ?>

                         <?php if(!empty($images[0])): ?>
                                            <img src="<?php echo e(asset($images[0])); ?>" class="card-img-top img-fluid" alt="Product">
               <?php endif; ?>
                    <div class="card-body">
                        <a href="<?php echo e(route('view.ad', ['slug' => Str::slug($ad->title), 'id' => $ad->id])); ?>"
                            class="card-title"><?php echo e($ad->title); ?></a>
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

            

            <!-- Repeat similar cards... -->
        </div>

        <div class="pagination" id="pagination1"></div>
    </section>
    <section class="spareParts">
        <h2>Popular Car Spare Parts in UAE</h2>
        <div class="popular-part-container">
            <?php $__currentLoopData = $sParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <a style="text-decoration: none; color: black; width:250px; "
                        href="<?php echo e(route('part.ads', ['partName' => Str::slug($p->name), 'id' => $p->id])); ?>">
                <div class="part-card">
                    <?php if($p->image): ?>
                        
                      <img src="<?php echo e(asset('storage/' . $p->image)); ?>" alt="Spare Part" >
                    <?php else: ?>
                        <img src="<?php echo e(asset('Frontend/assets/quote.png')); ?>" alt="<?php echo e($p->name); ?>" />
                    <?php endif; ?>
                   
                        <?php echo e($p->name); ?>

                   
                </div>
                 </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <section class="ad-cards">
        <div class="section-text">
            <h3>TOP CAR ADS</h3>
            <h2>Our Sellers are Currently Breaking These Cars for Spare Parts</h2>
        </div>
        <div class="filters">
            <a href="#" class="active">All</a>
            <?php $__currentLoopData = $randomMakes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('make.ads', ['slug' => $make->slug, 'id' => $make->id])); ?>"><?php echo e($make->name); ?></a>
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
                        <a href="<?php echo e(route('view.car.ad', ['slug' => $ad->slug, 'id' => $ad->id])); ?>"
                            class="card-title"><?php echo e($ad->title); ?></a>
                        
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

    <!-- Map -->
    <section class="map">
        <div class="map-text">
            <ul>
                <li>Save Time, Save Money</li>
                <li>Search 10,000+ Auto Parts in One Go</li>
                <li>Check Prices & Stock of Top Part Suppliers</li>
                <li>Car, Van, and SUV Parts Fitted & Delivered</li>
                <li>Genuine, Aftermarket, Used & New Parts</li>
            </ul>
        </div>
        <div class="map-img">
            <?php if($domain && $domain->map_img): ?>
                <img src="<?php echo e(asset( $domain->map_img)); ?>" alt="Map" />
            <?php endif; ?>
        </div>
    </section>
    <!-- Locations -->
    <section class="locations-section">
        <div class="section-text">
            <h2>Auto Parts for Cars, Vans, SUVs Anywhere in the UAE</h2>

        </div>
        <div class="locations-grid">
            <?php if($domain && $domain->cities): ?>
                <?php $__currentLoopData = $domain->cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('city.ads', ['slug' => $city->slug, 'id' => $city->id])); ?>" class="location-card"><i
                            class="fa-solid fa-location-dot"></i> <?php echo e($city->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </section>

    <?php echo $__env->make('Frontend.layout.company', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .search-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    width: 450px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: -50px;
}
.form-group {
    margin-bottom: 10px;
    opacity: 1;
    transform: translateY(0);
    transition: all 0.4s ease;
}

.dropdown {
    width: 100%;
    padding: 15px;
    border: 2px solid #e1e5e9;
    border-radius: 10px;
    font-size: 13px;
    background-color: white;
    cursor: pointer;
    transition: 0.3s;
    font-family: 'Montserrat', sans-serif;
}
.part-tag {
    background: var(--accent-color);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
    animation: slideIn 0.3s ease;
}
 .condition-section {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 10px;
    border: 2px solid #e1e5e9;
    margin-top: -10px;
}
#condition-group {
    display: block;
}

.radio-group {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 20px; 
    margin-top: 5px; 
}

.radio-option {
    display: flex;
    align-items: center;
    gap: 5px; 
}
.card {
    width: 300px;
    height: 450px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin: 10px;
    transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
  margin: 0 !important;
}

.card:hover {
    transform: translateY(-5px); /* slight lift on hover */
    box-shadow: 0 4px 12px rgba(0,0,0,0.2); /* stronger shadow */
    border-color: #aaa; /* subtle border change on hover */
}

.card img {
    width: 100%;
    height: 150px;
    object-fit: contain !important; /* full image dikhayega */
    background-color: #f7f7f7; /* optional clean background */
    padding: 5px; /* thoda gap for clean look */
}

.card-body {
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex-grow: 1;
}

.card-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
    line-height: 1.2em;
    height: 3.6em;
    overflow: hidden;
}

.price {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

.meta {
    font-size: 14px;
    margin-bottom: 10px;
    line-height: 1.4;
}

.btn.whatsapp {
    background: var(--whatsapp-btn);
}
.part-card {
    width: 250px;            /* fix width */
    height: 180px;           /* fix height */
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 10px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    gap: 10px;
    overflow: hidden;
    background: #fff;
    transition: 0.3s ease;
}

/* Hover effect */
.part-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-color: #ccc;
}

/* Fix image size */
.part-card img {
    width: 80px; 
    height: 80px;
    object-fit: contain;     /* Image stays inside nicely */
}

/* Text styling */
.part-card-text {
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    color: black;
    margin-top: 5px;
}
.make {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    width: 150px;           /* fixed width */
    height: 115px;          /* fixed height */
    margin: 10px;
    text-decoration: none;
    color: black;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
    background: #fff;
}

.make:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-color: #ccc;
}

.make img {
    width: 90%;            /* fixed image width */
    height: 60px;           /* fixed image height */
    object-fit: contain;     /* keep logo proportions */
    margin-bottom: 8px;
}

.make h4 {
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    margin: 0;
    line-height: 1.2em;
    height: 2.4em;          /* max 2 lines */
    overflow: hidden;
}
.hero-section {
    display: flex;
    flex-direction: column;
    align-items: center; /* center hero text horizontally */
    padding: 50px 10%;
    gap: 50px;
}

.hero-text {
    text-align: center;
}

.search-card {
    align-self: flex-start; /* align form to left */
    width: 100%;
    max-width: 500px; /* limit form width */
}

 #make {
        font-weight: bold;      /* makes selected value bold */
        padding: 8px 12px;
        font-size: 16px;
    }

    #make option {
        font-weight: bold;      /* makes dropdown options bold */
    }

    /* Optional: make the select box look nicer */
    #make {
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        color: #333;
        width: 100%;
        max-width: 100%;
    }



    .dropdown {
    font-weight: bold;       /* selected value bold */
    font-size: 16px;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    background-color: #fff;
    cursor: pointer;
    width: 100%;
}

/* Make all options bold */
.dropdown option {
    font-weight: bold;
}

/* Focus state for dropdowns */
.dropdown:focus {
    outline: none;
    border-color: #6a11cb;  /* matches gradient theme */
    box-shadow: 0 0 6px rgba(106,17,203,0.3);
}

/* Ensure parts dropdown shows when enabled */
#parts-dropdown:enabled {
    background-color: #fff;
    cursor: pointer;
}

/* Radio buttons bold text */
.radio-option label {
    font-weight: bold;
    cursor: pointer;
}

/* Hero section adjustments */
.hero-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 50px 10%;
    gap: 50px;
}

/* Align search card to left under hero text */
.search-card {
    align-self: flex-start;
    max-width: 500px;
    width: 100%;
}

/* Buttons bold */
.find-btn, .btn {
    font-weight: bold;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-section {
        padding: 30px 5%;
        gap: 30px;
    }

    .dropdown {
        font-size: 14px;
        padding: 8px 10px;
    }
}
 </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Frontend.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/Frontend/index.blade.php ENDPATH**/ ?>