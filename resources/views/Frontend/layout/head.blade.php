<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if ($domain && $domain->partsMeta && $domain->partsMeta->isNotEmpty())
        @php $meta = $domain->partsMeta->first(); @endphp

        <title>{{ $meta->title }}</title>
        <meta name="description" content="{{ $meta->description }}">
        <meta name="keywords" content="{{ $meta->focus_keywords }}">
        <meta name="author" content="{{ $meta->title }}">
        <meta name="image" content="{{ asset('storage/' . $domain->partMeta) }}">

        <script type="application/ld+json">
        {!! $meta->structure_data !!}
    </script>
    @endif

    @if($domain && $domain->metaTags)
        <meta name="description" content="{{ $domain->metaTags->description }}">
        <meta name="keywords" content="{{ $domain->metaTags->keywords }}">
        <meta name="author" content="{{ $domain->metaTags->title }}">
        <title>{{ $domain->metaTags->title }}</title>
    @endif
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
    <link rel="stylesheet" href="{{ asset('Frontend/css/style.css') }}">
    @if($domain && $domain->logo)
        <link rel="icon" href="{{ asset($domain->logo) }}">
    @endif
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @php
    $scripts = \App\Models\SciteScripts::where('status', true)->get();
    @endphp
    @if ($scripts->count() > 0)
        @foreach ($scripts as $script) {!! $script->script_content !!} @endforeach
    @endif
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

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
            <div class="logo">
                @if($domain && $domain->logo)
              
                    <img src="{{ asset( $domain->logo) }}" alt="">
                @endif
            </div>
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
<style>
 nav{
    background-color: white;
 }
    nav .logo {
    width: 100px;
    z-index: 1001;
}
nav a{
    color: black;
}
nav .logo img {
    width: 65% !important;
}

</style>