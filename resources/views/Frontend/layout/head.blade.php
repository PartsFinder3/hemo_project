<!DOCTYPE html>
<html lang="en">

<head>
   @php
        use Illuminate\Support\Facades\Request;
        use App\Models\Domain;

       $host = preg_replace('/^www\./', '', Request::getHost());
         
        // Current domain fetch karen
        $currentDomain = Domain::where('domain_url', $host)->first();

        // Logo aur favicon set karein, default logo agar na mile
        $logo = $currentDomain && $currentDomain->logo ? $currentDomain->logo : 'logo/44444.png';
        $favicon = $currentDomain && $currentDomain->map_img ? $currentDomain->map_img : 'logo/44444.png';
      $currentDomainUrl = Request::getSchemeAndHttpHost();
      $logoPath = 'storage/' . $logo;
      $faviconExt = strtolower(pathinfo($logo, PATHINFO_EXTENSION));
        $faviconMime = match($faviconExt) {
        'ico' => 'image/x-icon',
        'svg' => 'image/svg+xml',
        'png' => 'image/png',
        'jpg', 'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        default => 'image/png',
        };

   @endphp

@if(isset($meta) && $meta)
    <title>{{ $meta['title'] }}</title>
    <meta name="description" content="{{ $meta['description'] }}">

    <script type="application/ld+json">
        {!! $meta['structure_data'] !!}
    </script>
@endif
<link rel="canonical" href="{{ url()->current() }}">

 

@if(empty($meta) && isset($domain->metaTags))
    <meta name="description" content="{{ $domain->metaTags->description }}">
    <meta name="keywords" content="{{ $domain->metaTags->keywords }}">
    <meta name="author" content="{{ $domain->metaTags->title }}">
    <title>{{ $domain->metaTags->title }}</title>
@endif
@if(!empty($domain))
<meta property="og:title" content="{{ $domain->metaTags->title }}">
<meta property="og:description" content="{{ $domain->metaTags->description }}">
<meta property="og:image" content="https://partsfinder.ae/storage/logo/44444.png">
<meta property="og:url" content="https://partsfinder.ae">
<meta property="og:type" content="website">
<meta property="og:image:width" content="1800"> <!-- Badi image -->
<meta property="og:image:height" content="945">
@endif
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fonts -->
     <link rel="preload" 
          as="image" 
          href="{{ asset('storage/profile_images/hero_section_image_1.png') }}" 
          fetchpriority="high">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />


    <!-- AOS Animation Styles -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Include Select2 CSS & JS -->
       <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('Frontend/css/style.css') }}">

    {{-- <style>
                                  @media (max-width:480px){
                                #w-left{
                                    display: none
                                }
             
                                }
    </style> --}}
        <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    @php
    $scripts = \App\Models\SciteScripts::where('status', true)->get();
    @endphp
    @if ($scripts->count() > 0)
        @foreach ($scripts as $script) {!! $script->script_content !!} @endforeach
    @endif
<link rel="icon"  href="{{ asset($logoPath) }}?v={{ time() }}"  type="{{ $faviconMime }}">
<link rel="shortcut icon" href="{{ asset($logoPath) }}?v={{ time() }}" type="{{ $faviconMime }}">

<script defer src="https://scripts.clarity.ms/js/clarity.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
<script async src="https://www.googletagmanager.com/gtag/js?id=G-E6ZGW2V8LH"></script>


<meta property="og:image" content="{{ asset('storage/'.$logo) }}">
 
</head>
<style>
    @font-face {
    font-family: "Font Awesome 6 Free";
    font-style: normal;
    font-weight: 400;
    font-display: swap;
    src: url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/webfonts/fa-regular-400.woff2") format("woff2");
}

@font-face {
    font-family: "Font Awesome 6 Free";
    font-style: normal;
    font-weight: 900;
    font-display: swap;
    src: url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/webfonts/fa-solid-900.woff2") format("woff2");
}

@font-face {
    font-family: "Font Awesome 6 Brands";
    font-style: normal;
    font-weight: 400;
    font-display: swap;
    src: url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/webfonts/fa-brands-400.woff2") format("woff2");
}
    .hero-btns a.login-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #a2a3a5;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    pointer-events: auto;
    transition: background-color 0.3s ease;
}


    .hero-btns a.signup-btn {
    display: inline-block;
    padding: 10px 20px;
   background: var(--accent-color);
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}
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
           padding-bottom: 10px !important; 
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
           padding-bottom: 10px !important; 
    }

}

</style>

<body>
    <!-- Toast Container -->
<div class="toast-container
        position-fixed top-0 start-0 p-3" style="z-index: 1100;">
    @if (session('success'))
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif
    </div>

    <main>
        <nav>
    <a href="{{ $currentDomainUrl }}">

    <div class="logo">
        <img src="{{ asset('storage/'.$logo) }}" alt="Go to PartsFinder Home">
    </div>
</a>
            <div class="nav-menu" id="nav-menu">
                <ul>
                    <li><a href="{{ route('frontend.index') }}">Home</a></li>
                    <li><a href="{{ route('about.page') }}">About</a></li>
                    <li><a href="{{ route('frontend.blogs') }}">Blogs</a></li>
                </ul>
<span class="hero-btns">
<a href="{{ route('supplier.login') }}" class="login-btn">Login</a>
<a href="{{ route('frontend.signup') }}" class="signup-btn">Sign Up</a>
</span>
            </div>
            <div class="burger-menu" id="burger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>

<script>
$(document).ready(function() {
    $('#make').select2({
        placeholder: "Select Car Make",
        allowClear: true,
        width: '100%'
    });

    $('#parts-dropdown').select2({
        placeholder: "Select Part",
        allowClear: true,
        width: '100%'
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const burger = document.getElementById('burger-menu');
    const navMenu = document.getElementById('nav-menu');

    burger.addEventListener('click', function() {
        navMenu.classList.toggle('active');
    });

    // Optional: Close menu when a link is clicked
    const navLinks = navMenu.querySelectorAll('a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
        });
    });
});


</script>