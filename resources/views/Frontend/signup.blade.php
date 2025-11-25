@extends('Frontend.layout.main')

@section('main-section')
<style>
    /* Reset hero and page backgrounds */
    body, main, header, nav, .hero-section, .hero-section_p {
        background: none !important;
    }

    /* Theme colors */
    :root {
        --primary-orange: #ff7700;
        --primary-dark: #2b2d2f;
        --primary-orange-hover: #d44822;
        --primary-dark-light: #2a2f4a;
    }

    /* Container styling */
    .container-fluid {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Signup card */
    .signup-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        overflow: hidden;
        min-height: 650px;
    }

    /* Left branding panel */
    .signup-left {
        background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-hover));
        color: #fff;
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: left;
        height: 100%;
    }

    .signup-left .logo img {
        max-width: 200px;
        margin-bottom: 20px;
        align-self: center;
    }

    .signup-left h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .signup-left p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 15px;
    }

    #steps {
        padding-left: 20px;
        margin-top: 10px;
        gap: 8px;
        display: flex;
        flex-direction: column;
    }

    #steps h4 {
        margin-bottom: 10px;
    }

    #steps li {
        list-style-type: disc;
        margin-left: 20px;
        margin-bottom: 5px;
    }

    /* Right signup form */
    .signup-right {
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .signup-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .signup-title {
        color: var(--primary-dark);
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .signup-subtitle {
        color: #6c757d;
        font-size: 1rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--primary-dark);
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .form-control, .form-select {
        height: 55px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 12px 18px;
        font-size: 1rem;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-orange);
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(233, 84, 38, 0.15);
    }

    /* Input group fixes */
    .input-group .form-select {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
        border-right: none;
    }

    .input-group .form-control {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    /* Signup button */
    .btn-signup {
        background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-hover));
        border: none;
        border-radius: 12px;
        height: 55px;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #fff;
        transition: all 0.3s ease;
    }

    .btn-signup:hover {
        background: linear-gradient(135deg, var(--primary-orange-hover), #c23d1e);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(233, 84, 38, 0.3);
    }

    /* Login link */
    .login-link {
        text-align: center;
        margin-top: 20px;
        color: #6c757d;
    }

    .login-link a {
        color: var(--primary-orange);
        font-weight: 600;
        text-decoration: none;
    }

    .login-link a:hover {
        color: var(--primary-orange-hover);
        text-decoration: underline;
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .signup-left {
            display: none;
        }

        .signup-right {
            padding: 30px 20px;
        }
    }
</style>

<!-- Toast Notifications -->
<div class="toast-container position-fixed top-0 start-0 p-3" style="z-index: 1100;">
    @foreach (['success', 'error'] as $msg)
        @if(session($msg))
            <div class="toast align-items-center text-bg-{{ $msg == 'success' ? 'success' : 'danger' }} border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">{{ session($msg) }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    @endforeach
</div>

<div class="container-fluid">
    <div class="row g-0 justify-content-center">
        <div class="col-xl-10 col-lg-11 col-md-12">
            <div class="card signup-card">
                <div class="row g-0 h-100">

                    <!-- Left Branding Panel -->
                    <div class="col-lg-6 d-none d-lg-flex">
                        <div class="signup-left w-100">
                            <div class="logo">
                                @if($domain && $domain->logo)
                                    <img src="{{ asset('storage/logo/44444.png') }}" alt="PartsFinder Logo" style="width:100%">
                                @endif
                            </div>
                            <h1>Join PartsFinder</h1>
                            <p>Ready to Join the UAE’s Largest Car Parts Network?</p>
                            <p class="fw-bold">
                                Showcase your business to thousands of car owners and garages actively searching for car parts across the UAE.
                            </p>

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

                    <!-- Right Signup Form -->
                    <div class="col-lg-6">
                        <div class="signup-right">
                            <div class="signup-header">
                                <h2 class="signup-title">Create Account</h2>
                                <p class="signup-subtitle">Fill in the details to get started</p>
                            </div>

                            <form action="{{ route('supplier.create') }}" method="POST">
                                @csrf
                                <x-form.input label="Full Name" name="name" icon="user" placeholder="Enter your full name" />
                                <x-form.input label="Business Name" name="business_name" icon="building" placeholder="Enter your business name" />
                                <x-form.select label="Select City" name="city_id" :options="$cities" placeholder="Choose city" />
                                <x-form.input label="Email" name="email" type="email" icon="envelope" placeholder="Enter your email" />
                                
                                <!-- Phone input with country code -->
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-phone me-2"></i>Phone Number</label>
                                    <div class="input-group">
                                        <select class="form-select" style="max-width:120px;" name="country_code">
                                            <option value="">Select Country</option>
                                            @include('Frontend.contries')
                                        </select>
                                        <input type="tel" class="form-control" placeholder="Enter phone number" name="phone" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-signup w-100 mt-3">
                                    <i class="fas fa-user-check me-2"></i> Sign Up
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

<!-- Bootstrap Toast Script -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toastElList = [].slice.call(document.querySelectorAll(".toast"));
        toastElList.forEach(toastEl => {
            new bootstrap.Toast(toastEl, { delay: 4000 }).show();
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection
