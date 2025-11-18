<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($domain->metaTags->description); ?>">
    <meta name="keywords" content="<?php echo e($domain->metaTags->keywords); ?>">
    <meta name="author" content="<?php echo e($domain->metaTags->title); ?>">
    <title><?php echo e($domain->metaTags->title); ?> - Latest Blogs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #fcfbfb;
            --secondary-color: rgb(3, 3, 3);
            --accent-color: #ff7700;
            --tertiary-color: #a2a3a5;
            --whatsapp-btn: #2bb75e;
            --footer-color: #2b2d2f;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .logo {
            width: 120px;
        }

        .logo img {
            width: 100%;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 10%;
            position: relative;
            z-index: 1000;
            background-color: var(--footer-color);
            border-bottom: 1px solid #333;
        }

        nav .logo {
            width: 120px;
            z-index: 1001;
            color: var(--accent-color);
            font-size: 1.8rem;
            font-weight: bold;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-menu ul {
            display: flex;
            list-style: none;
            gap: 30px;
            margin: 0;
            padding: 0;
        }

        .nav-menu ul li a {
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 500;
            font-size: 18px;
            transition: 0.3s;
        }

        .nav-menu ul li a:hover {
            color: var(--accent-color);
        }

        .hero-btns {
            display: flex;
            gap: 15px;
        }

        .login-btn,
        .signup-btn {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .login-btn {
            color: var(--primary-color);
            border: 2px solid var(--accent-color);
        }

        .login-btn:hover {
            background-color: var(--accent-color);
            color: var(--secondary-color);
        }

        .signup-btn {
            background-color: var(--accent-color);
            color: var(--secondary-color);
            border: 2px solid var(--accent-color);
        }

        .signup-btn:hover {
            background-color: transparent;
            color: var(--accent-color);
        }

        .burger-menu {
            display: none;
            flex-direction: column;
            cursor: pointer;
            z-index: 1001;
        }

        .burger-menu span {
            width: 25px;
            height: 3px;
            background-color: var(--primary-color);
            margin: 3px 0;
            transition: 0.3s;
        }

        .burger-menu.active span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .burger-menu.active span:nth-child(2) {
            opacity: 0;
        }

        .burger-menu.active span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        /* Page Header */
        .page-header {
            /* background: linear-gradient(135deg, var(--accent-color) 0%, #ff9933 100%); */
            color: var(--secondary-color);
            padding: 60px 0;
            text-align: center;
            margin-bottom: 50px;
        }

        .page-header h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .page-header p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .row {
            display: flex;
            gap: 30px;
            margin-bottom: 50px;
        }

        .col-main {
            flex: 2;
        }

        .col-sidebar {
            flex: 1;
        }

        /* Blog Cards */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .blog-card {
            background-color: var(--primary-color);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #333;
            position: relative;
        }

        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(255, 119, 0, 0.2);
            border-color: var(--accent-color);
        }

        .blog-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-card:hover img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 25px;
        }

        .badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .badge.javascript {
            background-color: #f7df1e;
            color: #000;
        }

        .badge.react {
            background-color: #61dafb;
            color: #000;
        }

        .badge.css {
            background-color: #1572b6;
            color: white;
        }

        .badge.nodejs {
            background-color: #339933;
            color: white;
        }

        .badge.ai {
            background-color: #ff6b6b;
            color: white;
        }

        .badge.mobile {
            background-color: #6c5ce7;
            color: white;
        }

        .card-title {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: var(--accent-color);
            font-weight: 600;
            line-height: 1.4;
        }

        .card-text {
            color: var(--tertiary-color);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #333;
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .author-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 2px solid var(--accent-color);
        }

        .author-name {
            font-weight: 500;
            color: var(--primary-color);
        }

        .post-date {
            color: var(--tertiary-color);
            font-size: 0.9rem;
        }

        /* Sidebar */
        .sidebar-widget {
            background-color: var(--primary-color);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid #333;
        }

        .widget-title {
            color: var(--footer-color);
            font-size: 1.5rem;
            margin-bottom: 25px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .widget-title i {
            color: var(--accent-color);
        }

        .category-item {
            padding: 15px 20px;
            border-bottom: 1px solid #333;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .category-item:hover {
            background: linear-gradient(135deg, var(--accent-color) 0%, #ff9933 100%);
            color: var(--primary-color);
            transform: translateX(10px);
        }

        .category-item:last-child {
            border-bottom: none;
        }

        .category-icon {
            margin-right: 10px;
        }

        .badge-count {
            background: var(--accent-color);
            color: var(--secondary-color);
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .category-item:hover .badge-count {
            background: rgba(0, 0, 0, 0.3);
            color: var(--primary-color);
        }

        .popular-post {
            padding: 15px 0;
            border-bottom: 1px solid #333;
        }

        .popular-post:last-child {
            border-bottom: none;
        }

        .popular-post h6 {
            color: var(--primary-color);
            margin-bottom: 8px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .popular-post:hover h6 {
            color: var(--accent-color);
            cursor: pointer;
        }

        .popular-post small {
            color: var(--tertiary-color);
        }

        /* Search Box */
        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid #333;
            border-radius: 25px;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-box:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(255, 119, 0, 0.1);
        }

        .search-btn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--accent-color);
            font-size: 18px;
            cursor: pointer;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 50px 0;
        }

        .page-item {
            padding: 12px 16px;
            background-color: #1a1a1a;
            color: var(--primary-color);
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid #333;
        }

        .page-item:hover {
            background-color: var(--accent-color);
            color: var(--secondary-color);
            text-decoration: none;
        }

        .page-item.active {
            background-color: var(--accent-color);
            color: var(--secondary-color);
        }

        /* Footer Styles */
        .footer-section {
            background: var(--footer-color);
            color: white;
            padding: 60px 0 20px 0;
        }

        .footer-logo {
            width: 200px;
        }

        .footer-logo img {
            width: 100%;
        }

        .footer-description {
            color: #adb5bd;
            font-style: italic;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .footer-title {
            color: var(--accent);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.95rem;
        }

        .footer-links a:hover {
            color: var(--accent);
        }

        .contact-phone {
            background: var(--accent);
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .contact-phone:hover {
            /* background: #d35400; */
            color: white;
            transform: translateY(-2px);
        }

        .contact-phone i {
            margin-right: 8px;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .social-icon.facebook {
            background: #3b5998;
        }

        .social-icon.twitter {
            background: #1da1f2;
        }

        .social-icon.pinterest {
            background: #bd081c;
        }

        .social-icon:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .app-stores {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .app-store-btn {
            transition: transform 0.3s ease;
        }

        .app-store-btn:hover {
            transform: translateY(-2px);
        }

        .app-store-btn img {
            height: 50px;
            border-radius: 8px;
        }

        .footer-bottom {
            border-top: 1px solid #495057;
            padding-top: 2rem;
            margin-top: 3rem;
            text-align: center;
        }

        .copyright {
            color: #adb5bd;
            font-size: 0.9rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .burger-menu {
                display: flex;
            }

            .nav-menu {
                position: fixed;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100vh;
                background-color: var(--secondary-color);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                transition: 0.3s;
                border-right: 1px solid #333;
            }

            .nav-menu.active {
                left: 0;
            }

            .nav-menu ul {
                flex-direction: column;
                gap: 40px;
            }

            .nav-menu ul li a {
                font-size: 24px;
            }

            .hero-btns {
                flex-direction: column;
                gap: 20px;
                margin-top: 30px;
            }

            .row {
                flex-direction: column;
            }

            .blog-grid {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 2.5rem;
            }

            .page-header {
                padding: 40px 0;
            }

            nav {
                padding: 15px 5%;
            }

            .footer-content {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .blog-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .card-body {
                padding: 20px;
            }

            .sidebar-widget {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="logo">
            <img src="<?php echo e(asset('storage/' . $domain->logo)); ?>" alt="">
        </div>
        <div class="nav-menu" id="nav-menu">
            <ul>
                <li><a href="<?php echo e(route('frontend.index')); ?>">Home</a></li>
                <li><a href="<?php echo e(route('about.page')); ?>">About</a></li>
                
                <li><a href="<?php echo e(route('frontend.blogs')); ?>">Blogs</a></li>
            </ul>
            <span class="hero-btns">
                <a href="<?php echo e(route('supplier.login')); ?>" class="login-btn">Login</a>
                <a href="<?php echo e(route('frontend.signup')); ?>" class="signup-btn">Sign Up</a>
            </span>
        </div>
        <div class="burger-menu" id="burger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
<?php /**PATH C:\laragon\www\hemo_project\resources\views/frontend/blogs/layout/head.blade.php ENDPATH**/ ?>