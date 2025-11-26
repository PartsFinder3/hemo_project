<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($domain && $domain->partsMeta && $domain->partsMeta->isNotEmpty()): ?>
        <?php $meta = $domain->partsMeta->first(); ?>

        <title><?php echo e($meta->title); ?></title>
        <meta name="description" content="<?php echo e($meta->description); ?>">
        <meta name="keywords" content="<?php echo e($meta->focus_keywords); ?>">
        <meta name="author" content="<?php echo e($meta->title); ?>">
        <meta name="image" content="<?php echo e(asset('storage/' . $domain->partMeta)); ?>">

        <script type="application/ld+json">
        <?php echo $meta->structure_data; ?>

    </script>
    <?php endif; ?>

    <?php if($domain && $domain->metaTags): ?>
        <meta name="description" content="<?php echo e($domain->metaTags->description); ?>">
        <meta name="keywords" content="<?php echo e($domain->metaTags->keywords); ?>">
        <meta name="author" content="<?php echo e($domain->metaTags->title); ?>">
        <title><?php echo e($domain->metaTags->title); ?></title>
    <?php endif; ?>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />


    <!-- AOS Animation Styles -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Include Select2 CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('Frontend/css/style.css')); ?>">
    <?php if($domain && $domain->logo): ?>
        <link rel="icon" href="https://partsfinder.ae/storage/logo/44444.png">
    <?php endif; ?>
    
        <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <?php
    $scripts = \App\Models\SciteScripts::where('status', true)->get();
    ?>
    <?php if($scripts->count() > 0): ?>
        <?php $__currentLoopData = $scripts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $script): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo $script->script_content; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<body>
    <!-- Toast Container -->
<div class="toast-container
        position-fixed top-0 start-0 p-3" style="z-index: 1100;">
    <?php if(session('success')): ?>
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo e(session('success')); ?>

                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo e(session('error')); ?>

                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
    </div>

    <main>
        <nav>
            <a href="https://partsfinder.ae">
            <div class="logo">
              
              
                    <img src="https://partsfinder.ae/storage/logo/44444.png" alt="">
            
            </div>
            </a>
            <div class="nav-menu" id="nav-menu">
                <ul>
                    <li><a href="<?php echo e(route('frontend.index')); ?>">Home</a></li>
                    <li><a href="<?php echo e(route('about.page')); ?>">About</a></li>
                    <li><a href="<?php echo e(route('frontend.blogs')); ?>">Blogs</a></li>
                </ul>
<span class="hero-btns">
    <a href="<?php echo e(route('supplier.login')); ?>" 
       style="display: inline-block; padding: 10px 20px; background-color: #a2a3a5; color: #fff; text-decoration: none; border-radius: 5px; pointer-events: auto;">
       Login
    </a>
    <a href="<?php echo e(route('frontend.signup')); ?>" 
       style="display: inline-block; padding: 10px 20px; background-color: #e57224; color: #fff; text-decoration: none; border-radius: 5px; pointer-events: auto;">
       Sign Up
    </a>
</span>
            </div>
            <div class="burger-menu" id="burger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
<style>
 nav{
 
    background-color: white;
 }
    nav .logo {
    z-index: 1001;
      width: 170px;
      position: absolute;
      margin-top: -30px;
      margin-left: 0px;
}
nav a{
    color: black !important;
}
nav .logo img {
    width: 65% !important;
}

.hero-btns a {
    text-decoration: none;
    padding: 7px 25px;
    font-weight: 500;
    font-size: 18px;
    border-radius: 8px;
    transition: 0.3s ease;
    padding-left: 50px !important;
    padding-right: 50px !important;
    padding-bottom: 30px !important; 
        font-size: 15px !important;
            border-radius: 50rem !important;
height: 35px;
}
.nav-menu.active {
    background: #ffffff !important;
    color: white;
}
/* Tablet & Mobile */
@media (max-width: 992px) {

    /* Menu ko right se slide banayenge */
    #nav-menu {
        position: fixed;
        top: 70px;
        right: -100%;
        width: 230px;
        background: #fff;
        padding: 25px 20px;
        flex-direction: column;
        gap: 25px;
        transition: 0.3s;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        z-index: 999;
    }
        nav .logo img {
            width: 50% !important;
        }

    /* Menu open hote hi show */
    #nav-menu.active {
        right: 0;
            width: 100% !important;
    }

    /* UL vertical */
    #nav-menu ul {
        flex-direction: column;
        gap: 15px;
        padding: 0;
    }

    #nav-menu ul li a {
        font-size: 16px !important;
    }

    /* Buttons vertical */
    .hero-btns {
        flex-direction: column;
        gap: 10px;
    }

    .hero-btns a {
        width: 100%;
        text-align: center;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    /* Burger show */
    #burger-menu {
        display: flex !important;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        z-index: 1001;
    }

    #burger-menu span {
        width: 25px;
        height: 3px;
        background: black;
        border-radius: 2px;
    }
}

/* Mobile Small */
@media (max-width: 480px) {

    nav .logo {
        width: 130px;
        margin-top: -15px;
    }
        nav .logo img {
            width: 40% !important;
        }
    .hero-btns a {
        font-size: 13px !important;
        height: auto;
    }

}

</style><?php /**PATH C:\laragon\www\partsfinder\resources\views/Frontend/layout/head.blade.php ENDPATH**/ ?>