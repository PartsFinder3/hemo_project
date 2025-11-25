@extends('Frontend.layout.main')

@section('main-section')
<style>
    :root {
        --primary-orange: #ff7700;
        --primary-dark: #2b2d2f;
        --primary-orange-hover: #d44822;
        --primary-dark-light: #2a2f4a;
        --success-color: #28a745;
        --error-color: #dc3545;
        --light-gray: #f8f9fa;
        --medium-gray: #e9ecef;
        --text-muted: #6c757d;
        --shadow-light: 0 4px 12px rgba(0,0,0,0.08);
        --shadow-medium: 0 8px 24px rgba(0,0,0,0.12);
    }

    body, main, header, nav, .hero-section, .hero-section_p {
        background-image: none !important;
        background: none !important;
    }

    .registration-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
    }

    .container-fluid {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .signup-card {
        background: white;
        border-radius: 24px;
        box-shadow: var(--shadow-medium);
        overflow: hidden;
        min-height: 680px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .signup-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 70px rgba(0,0,0,0.2);
    }

    .signup-left {
        background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
        color: white;
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        text-align: left;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .signup-left::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.3;
    }

    .signup-left .logo {
        max-width: 220px;
        margin-bottom: 25px;
        align-self: center;
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease;
    }

    .signup-left .logo:hover {
        transform: scale(1.05);
    }

    .signup-left h1 { 
        font-size: 2.6rem; 
        font-weight: 800; 
        margin-bottom: 20px; 
        position: relative;
        z-index: 1;
        line-height: 1.2;
    }
    
    .signup-left p { 
        font-size: 1.15rem; 
        opacity: 0.9; 
        margin-bottom: 18px; 
        position: relative;
        z-index: 1;
        line-height: 1.6;
    }

    .signup-left .highlight {
        background: rgba(255,255,255,0.15);
        padding: 12px 18px;
        border-radius: 12px;
        margin: 15px 0;
        border-left: 4px solid white;
    }

    #steps { 
        display: flex; 
        flex-direction: column; 
        align-items: flex-start; 
        padding-left: 20px; 
        margin-top: 15px; 
        gap: 12px; 
        position: relative;
        z-index: 1;
    }
    
    #steps h4 { 
        margin-bottom: 15px; 
        font-weight: 700;
        font-size: 1.3rem;
    }

    #steps li {
        position: relative;
        padding-left: 10px;
        line-height: 1.5;
    }

    #steps li::before {
        content: "✓";
        position: absolute;
        left: -20px;
        color: white;
        font-weight: bold;
        background: rgba(255,255,255,0.2);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    .signup-right { 
        padding: 60px 50px; 
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        background-color: white;
        position: relative;
    }

    .signup-header { 
        text-align: center; 
        margin-bottom: 35px; 
    }
    
    .signup-title { 
        color: var(--primary-dark); 
        font-size: 2.2rem; 
        font-weight: 800; 
        margin-bottom: 12px; 
        background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .signup-subtitle { 
        color: var(--text-muted); 
        font-size: 1.05rem; 
        max-width: 400px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .form-label { 
        font-weight: 600; 
        color: var(--primary-dark); 
        margin-bottom: 10px; 
        font-size: 1rem; 
        display: flex;
        align-items: center;
    }

    .required::after {
        content: "*";
        color: var(--error-color);
        margin-left: 4px;
    }

    .form-control, .form-select {
        height: 56px;
        border: 2px solid var(--medium-gray);
        border-radius: 14px;
        padding: 12px 18px;
        font-size: 1rem;
        background-color: white;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-light);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-orange);
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(233,84,38,0.15);
        transform: translateY(-2px);
    }

    .input-group .form-select { 
        border-top-right-radius: 14px; 
        border-bottom-right-radius: 14px; 
        border-right: none; 
    }
    
    .input-group .form-control { 
        border-top-left-radius: 14px; 
        border-bottom-left-radius: 14px; 
    }

    .btn-signup {
        background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
        border: none;
        border-radius: 14px;
        height: 58px;
        font-size: 1.15rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #fff;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(233,84,38,0.3);
    }

    .btn-signup::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(255,255,255,0.2), transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .btn-signup:hover {
        background: linear-gradient(135deg, var(--primary-orange-hover) 0%, #c23d1e 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(233,84,38,0.4);
    }

    .btn-signup:hover::after {
        opacity: 1;
    }

    .btn-signup:active {
        transform: translateY(-1px);
    }

    .login-link { 
        text-align: center; 
        margin-top: 25px; 
        color: var(--text-muted); 
        font-size: 1rem;
    }
    
    .login-link a { 
        color: var(--primary-orange); 
        font-weight: 700; 
        text-decoration: none; 
        transition: color 0.3s;
        position: relative;
    }
    
    .login-link a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-orange);
        transition: width 0.3s ease;
    }
    
    .login-link a:hover { 
        color: var(--primary-orange-hover); 
    }
    
    .login-link a:hover::after {
        width: 100%;
    }

    .form-group {
        position: relative;
        margin-bottom: 1.7rem;
    }

    .form-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        z-index: 10;
        transition: color 0.3s;
    }

    .form-control:focus + .form-icon {
        color: var(--primary-orange);
    }

    .form-control.with-icon {
        padding-left: 50px;
    }

    .progress-container {
        margin: 25px 0 30px;
        padding: 0 10px;
    }

    .progress-bar {
        height: 8px;
        background-color: var(--medium-gray);
        border-radius: 4px;
        overflow: hidden;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
        width: 0%;
        transition: width 0.5s ease;
        border-radius: 4px;
        position: relative;
        overflow: hidden;
    }

    .progress-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-image: linear-gradient(
            -45deg,
            rgba(255, 255, 255, 0.2) 25%,
            transparent 25%,
            transparent 50%,
            rgba(255, 255, 255, 0.2) 50%,
            rgba(255, 255, 255, 0.2) 75%,
            transparent 75%,
            transparent
        );
        background-size: 20px 20px;
        animation: move 1s linear infinite;
    }

    @keyframes move {
        0% { background-position: 0 0; }
        100% { background-position: 20px 0; }
    }

    .progress-steps {
        display: flex;
        justify-content: space-between;
        margin-top: 12px;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .step-active {
        color: var(--primary-orange);
        font-weight: 700;
    }

    .validation-feedback {
        font-size: 0.85rem;
        margin-top: 8px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .validation-feedback.valid {
        color: var(--success-color);
    }

    .validation-feedback.invalid {
        color: var(--error-color);
    }

    .form-check {
        display: flex;
        align-items: flex-start;
        margin-top: 20px;
        padding: 12px 15px;
        background: rgba(233,84,38,0.05);
        border-radius: 12px;
        transition: background 0.3s;
    }

    .form-check:hover {
        background: rgba(233,84,38,0.08);
    }

    .form-check-input {
        margin-top: 0.3rem;
        margin-right: 12px;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: var(--primary-orange);
        border-color: var(--primary-orange);
    }

    .form-check-label {
        font-size: 0.92rem;
        color: var(--text-muted);
        line-height: 1.5;
    }

    .form-check-label a {
        color: var(--primary-orange);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .form-check-label a:hover {
        color: var(--primary-orange-hover);
        text-decoration: underline;
    }

    .password-strength {
        margin-top: 8px;
        height: 6px;
        border-radius: 3px;
        background: var(--medium-gray);
        overflow: hidden;
    }

    .password-strength-bar {
        height: 100%;
        width: 0%;
        transition: width 0.3s, background 0.3s;
        border-radius: 3px;
    }

    .strength-weak { background: var(--error-color); width: 25%; }
    .strength-fair { background: #ff9800; width: 50%; }
    .strength-good { background: #2196f3; width: 75%; }
    .strength-strong { background: var(--success-color); width: 100%; }

    .mobile-hero {
        display: none;
        text-align: center;
        margin-bottom: 25px;
        padding: 20px;
        background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
        border-radius: 16px;
        color: white;
    }

    .mobile-hero h2 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .mobile-hero p {
        opacity: 0.9;
        margin-bottom: 0;
    }

    @media (max-width: 991.98px) {
        .signup-left { 
            padding: 40px 30px; 
        }
        
        .signup-right { 
            padding: 40px 35px; 
        }
        
        .signup-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 767.98px) {
        .registration-container {
            padding: 10px 0;
        }
        
        .signup-left { 
            display: none; 
        }
        
        .mobile-hero {
            display: block;
        }
        
        .signup-right { 
            padding: 30px 25px; 
        }
        
        .signup-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 575.98px) {
        .signup-right {
            padding: 25px 20px;
        }
        
        .form-control, .form-select, .btn-signup {
            height: 52px;
        }
        
        .btn-signup {
            font-size: 1.05rem;
        }
        
        .input-group .form-select {
            max-width: 120px;
        }
    }

    /* Animation for form elements */
    .form-group {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Stagger animation for form groups */
    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
    .form-group:nth-child(5) { animation-delay: 0.5s; }
    .form-group:nth-child(6) { animation-delay: 0.6s; }

    /* Success animation */
    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .success-pulse {
        animation: successPulse 0.5s ease;
    }

    /* Floating label effect */
    .floating-label-group {
        position: relative;
        margin-bottom: 1.7rem;
    }

    .floating-label {
        position: absolute;
        top: 18px;
        left: 18px;
        font-size: 1rem;
        color: var(--text-muted);
        pointer-events: none;
        transition: all 0.3s ease;
        background: white;
        padding: 0 5px;
        z-index: 10;
    }

    .form-control:focus ~ .floating-label,
    .form-control:not(:placeholder-shown) ~ .floating-label {
        top: -10px;
        left: 12px;
        font-size: 0.8rem;
        color: var(--primary-orange);
        font-weight: 600;
    }
</style>

<div class="registration-container">
    <div class="container-fluid">
        <div class="row g-0 justify-content-center">
            <div class="col-xl-10 col-lg-11 col-md-12">
                <div class="card signup-card">
                    <div class="row g-0 h-100">

                        <!-- Left Side -->
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="signup-left w-100">
                                <div class="logo">
                                    @if($domain && $domain->logo)
                                        <img style="width:100%" src="{{ $domain->logo }}" alt="PartsFinder Logo">
                                    @endif
                                </div>
                                <h1>Join PartsFinder</h1>
                                <p>Ready to Join the UAE's Largest Car Parts Network?</p>
                                
                                <div class="highlight">
                                    <p style="font-weight:700; margin:0;">Showcase your business to thousands of car owners and garages actively searching for car parts across the UAE.</p>
                                </div>

                                <ul id="steps">
                                    <h4>Why Join PartsFinder UAE?</h4>
                                    <li>As easy as using WhatsApp</li>
                                    <li>Reach thousands of car part buyers instantly</li>
                                    <li>Perfect for both new and used part sellers</li>
                                    <li>Trusted by part suppliers all over the UAE</li>
                                    <li>Stay ahead of your competition with more visibility</li>
                                </ul>
                                <p>Join PartsFinder UAE Today — Grow Your Sales Faster Than Ever!</p>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="col-lg-6">
                            <div class="signup-right">
                                <!-- Mobile Hero Section -->
                                <div class="mobile-hero d-lg-none">
                                    <h2>Join PartsFinder UAE</h2>
                                    <p>Connect with thousands of car part buyers across the UAE</p>
                                </div>

                                <div class="signup-header">
                                    <h2 class="signup-title">Create Account</h2>
                                    <p class="signup-subtitle">Fill in the details to get started with your PartsFinder supplier account</p>
                                </div>

                                <!-- Progress Indicator -->
                                <div class="progress-container">
                                    <div class="progress-bar">
                                        <div class="progress-fill" id="form-progress"></div>
                                    </div>
                                    <div class="progress-steps">
                                        <span class="step-active">Account Details</span>
                                        <span>Business Info</span>
                                        <span>Complete</span>
                                    </div>
                                </div>

                                <form action="{{ route('supplier.create') }}" method="POST" id="supplier-registration-form">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-label required" for="name">
                                            <i class="fas fa-user me-2"></i>Full Name
                                        </label>
                                        <div class="position-relative">
                                            <i class="form-icon fas fa-user"></i>
                                            <input type="text" class="form-control with-icon" id="name" placeholder="Enter your full name" required name="name">
                                        </div>
                                        <div class="validation-feedback" id="name-feedback"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label required" for="business_name">
                                            <i class="fas fa-building me-2"></i>Business Name
                                        </label>
                                        <div class="position-relative">
                                            <i class="form-icon fas fa-building"></i>
                                            <input type="text" class="form-control with-icon" id="business_name" placeholder="Enter your business name" required name="business_name">
                                        </div>
                                        <div class="validation-feedback" id="business-feedback"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label required" for="city_id">
                                            <i class="fas fa-city me-2"></i>Select City
                                        </label>
                                        <div class="position-relative">
                                            <i class="form-icon fas fa-city"></i>
                                            <select class="form-select with-icon" id="city_id" required name="city_id">
                                                <option selected disabled value="">Choose city</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="validation-feedback" id="city-feedback"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label required" for="email">
                                            <i class="fas fa-envelope me-2"></i>Email
                                        </label>
                                        <div class="position-relative">
                                            <i class="form-icon fas fa-envelope"></i>
                                            <input type="email" class="form-control with-icon" id="email" placeholder="Enter your email" required name="email">
                                        </div>
                                        <div class="validation-feedback" id="email-feedback"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label required" for="phone">
                                            <i class="fas fa-phone me-2"></i>Phone Number
                                        </label>
                                        <div class="input-group">
                                            <div class="position-relative flex-grow-0" style="width: 140px;">
                                                <i class="form-icon fas fa-globe"></i>
                                                <select class="form-select with-icon" style="max-width:140px;" name="country_code" id="country_code" required>
                                                    <option value="" selected disabled>Code</option>
                                                    @include('Frontend.contries')
                                                </select>
                                            </div>
                                            <div class="position-relative flex-grow-1">
                                                <i class="form-icon fas fa-phone" style="left: 15px;"></i>
                                                <input type="tel" class="form-control with-icon" id="phone" placeholder="Enter phone number" name="phone" required style="padding-left: 45px;">
                                            </div>
                                        </div>
                                        <div class="validation-feedback" id="phone-feedback"></div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-signup w-100 mt-4" id="submit-btn">
                                        <i class="fas fa-user-check me-2"></i> Create Account
                                    </button>
                                </form>

                                <div class="login-link">
                                    Already have an account? <a href="{{ route('supplier.login') }}">Login here</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed top-0 start-0 p-3" style="z-index:1100;">
    @if(session('success'))
        <div class="toast align-items-center text-bg-success border-0 show" role="alert">
            <div class="d-flex">
                <div class="toast-body">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert">
            <div class="d-flex">
                <div class="toast-body">{{ session('error') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){
    // Toast notifications
    const toastElList = [].slice.call(document.querySelectorAll(".toast"));
    toastElList.map(function(toastEl){
        const toast = new bootstrap.Toast(toastEl, {delay:5000});
        toast.show();
    });

    // Form validation and progress tracking
    const form = document.getElementById('supplier-registration-form');
    const inputs = form.querySelectorAll('input, select');
    const progressFill = document.getElementById('form-progress');
    const submitBtn = document.getElementById('submit-btn');
    
    // Update progress bar
    function updateProgress() {
        let filledCount = 0;
        inputs.forEach(input => {
            if (input.type !== 'checkbox' && input.value.trim() !== '') {
                filledCount++;
            } else if (input.type === 'checkbox' && input.checked) {
                filledCount++;
            }
        });
        
        const progress = (filledCount / inputs.length) * 100;
        progressFill.style.width = `${progress}%`;
    }
    
    // Validate individual fields
    function validateField(field) {
        const feedback = document.getElementById(`${field.id}-feedback`);
        
        if (!field.value.trim()) {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
            if (feedback) {
                feedback.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>This field is required';
                feedback.className = 'validation-feedback invalid';
            }
            return false;
        }
        
        // Email validation
        if (field.type === 'email') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(field.value)) {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                if (feedback) {
                    feedback.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Please enter a valid email address';
                    feedback.className = 'validation-feedback invalid';
                }
                return false;
            }
        }
        
        // Phone validation (basic)
        if (field.name === 'phone') {
            const phoneRegex = /^[0-9+\-\s()]{8,}$/;
            if (!phoneRegex.test(field.value)) {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                if (feedback) {
                    feedback.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Please enter a valid phone number';
                    feedback.className = 'validation-feedback invalid';
                }
                return false;
            }
        }
        
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        if (feedback) {
            feedback.innerHTML = '<i class="fas fa-check-circle me-2"></i>Looks good!';
            feedback.className = 'validation-feedback valid';
        }
        return true;
    }
    
    // Add event listeners to all inputs
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            updateProgress();
            if (this.type !== 'checkbox') {
                validateField(this);
            }
        });
        
        input.addEventListener('blur', function() {
            if (this.type !== 'checkbox') {
                validateField(this);
            }
        });
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        inputs.forEach(input => {
            if (!validateField(input)) {
                isValid = false;
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            
            // Add shake animation to invalid fields
            const invalidFields = form.querySelectorAll('.is-invalid');
            invalidFields.forEach(field => {
                field.style.animation = 'shake 0.5s';
                setTimeout(() => {
                    field.style.animation = '';
                }, 500);
            });
            
            // Scroll to first invalid field
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            
            // Show error message
            const toastContainer = document.querySelector('.toast-container');
            const errorToast = document.createElement('div');
            errorToast.className = 'toast align-items-center text-bg-danger border-0 show';
            errorToast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body"><i class="fas fa-exclamation-triangle me-2"></i>Please fix the errors in the form</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            toastContainer.appendChild(errorToast);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (errorToast.parentNode) {
                    errorToast.parentNode.removeChild(errorToast);
                }
            }, 5000);
        } else {
            // Change button text and add loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Creating Account...';
            submitBtn.disabled = true;
            submitBtn.classList.add('success-pulse');
        }
    });
    
    // Add shake animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }
        
        .is-valid {
            border-color: var(--success-color) !important;
        }
        
        .is-invalid {
            border-color: var(--error-color) !important;
        }
    `;
    document.head.appendChild(style);
    
    // Initialize progress
    updateProgress();
    
    // Auto-select UAE country code if available
    const countrySelect = document.getElementById('country_code');
    if (countrySelect) {
        for (let i = 0; i < countrySelect.options.length; i++) {
            if (countrySelect.options[i].text.includes('UAE') || countrySelect.options[i].text.includes('+971')) {
                countrySelect.selectedIndex = i;
                break;
            }
        }
    }
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection