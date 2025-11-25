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
    }

    body, main, header, nav, .hero-section, .hero-section_p {
        background-image: none !important;
        background: none !important;
    }

    .container-fluid {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .signup-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        overflow: hidden;
        min-height: 650px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .signup-card:hover {
        transform: translateY(-5px);
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
        max-width: 200px;
        margin-bottom: 20px;
        align-self: center;
        position: relative;
        z-index: 1;
    }

    .signup-left h1 { 
        font-size: 2.5rem; 
        font-weight: 700; 
        margin-bottom: 15px; 
        position: relative;
        z-index: 1;
    }
    
    .signup-left p { 
        font-size: 1.1rem; 
        opacity: 0.9; 
        margin-bottom: 15px; 
        position: relative;
        z-index: 1;
    }

    #steps { 
        display: flex; 
        flex-direction: column; 
        align-items: flex-start; 
        padding-left: 20px; 
        margin-top: 10px; 
        gap: 8px; 
        position: relative;
        z-index: 1;
    }
    
    #steps h4 { 
        margin-bottom: 10px; 
        font-weight: 600;
    }

    #steps li {
        position: relative;
        padding-left: 10px;
    }

    #steps li::before {
        content: "✓";
        position: absolute;
        left: -20px;
        color: white;
        font-weight: bold;
    }

    .signup-right { 
        padding: 60px 50px; 
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        background-color: var(--light-gray);
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
        color: var(--text-muted); 
        font-size: 1rem; 
    }

    .form-label { 
        font-weight: 600; 
        color: var(--primary-dark); 
        margin-bottom: 8px; 
        font-size: 1rem; 
        display: flex;
        align-items: center;
    }

    .form-control, .form-select {
        height: 55px;
        border: 2px solid var(--medium-gray);
        border-radius: 12px;
        padding: 12px 18px;
        font-size: 1rem;
        background-color: white;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-orange);
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(233,84,38,0.15);
    }

    .input-group .form-select { 
        border-top-right-radius: 12px; 
        border-bottom-right-radius: 12px; 
        border-right: none; 
    }
    
    .input-group .form-control { 
        border-top-left-radius: 12px; 
        border-bottom-left-radius: 12px; 
    }

    .btn-signup {
        background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
        border: none;
        border-radius: 12px;
        height: 55px;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #fff;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
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
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(233,84,38,0.3);
    }

    .btn-signup:hover::after {
        opacity: 1;
    }

    .login-link { 
        text-align: center; 
        margin-top: 20px; 
        color: var(--text-muted); 
    }
    
    .login-link a { 
        color: var(--primary-orange); 
        font-weight: 600; 
        text-decoration: none; 
        transition: color 0.3s;
    }
    
    .login-link a:hover { 
        color: var(--primary-orange-hover); 
        text-decoration: underline; 
    }

    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        z-index: 10;
    }

    .form-control.with-icon {
        padding-left: 45px;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        z-index: 10;
    }

    .progress-container {
        margin: 20px 0;
    }

    .progress-bar {
        height: 6px;
        background-color: var(--medium-gray);
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
        width: 0%;
        transition: width 0.5s ease;
    }

    .progress-steps {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .step-active {
        color: var(--primary-orange);
        font-weight: 600;
    }

    .validation-feedback {
        font-size: 0.85rem;
        margin-top: 5px;
        display: flex;
        align-items: center;
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
        margin-top: 15px;
    }

    .form-check-input {
        margin-top: 0.3rem;
        margin-right: 10px;
    }

    .form-check-label {
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .form-check-label a {
        color: var(--primary-orange);
        text-decoration: none;
    }

    .form-check-label a:hover {
        text-decoration: underline;
    }

    @media (max-width: 767.98px) {
        .signup-left { 
            display: none; 
        }
        
        .signup-right { 
            padding: 30px 20px; 
        }
        
        .signup-title {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 575.98px) {
        .signup-right {
            padding: 20px 15px;
        }
        
        .form-control, .form-select, .btn-signup {
            height: 50px;
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
</style>

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
                            <p style="font-weight:700;">Showcase your business to thousands of car owners and garages actively searching for car parts across the UAE.</p>

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
                            <div class="signup-header">
                                <h2 class="signup-title">Create Account</h2>
                                <p class="signup-subtitle">Fill in the details to get started</p>
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
                                    <label class="form-label" for="name">
                                        <i class="fas fa-user me-2"></i>Full Name
                                    </label>
                                    <div class="position-relative">
                                        <i class="form-icon fas fa-user"></i>
                                        <input type="text" class="form-control with-icon" id="name" placeholder="Enter your full name" required name="name">
                                    </div>
                                    <div class="validation-feedback" id="name-feedback"></div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="business_name">
                                        <i class="fas fa-building me-2"></i>Business Name
                                    </label>
                                    <div class="position-relative">
                                        <i class="form-icon fas fa-building"></i>
                                        <input type="text" class="form-control with-icon" id="business_name" placeholder="Enter your business name" required name="business_name">
                                    </div>
                                    <div class="validation-feedback" id="business-feedback"></div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="city_id">
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
                                    <label class="form-label" for="email">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </label>
                                    <div class="position-relative">
                                        <i class="form-icon fas fa-envelope"></i>
                                        <input type="email" class="form-control with-icon" id="email" placeholder="Enter your email" required name="email">
                                    </div>
                                    <div class="validation-feedback" id="email-feedback"></div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="phone">
                                        <i class="fas fa-phone me-2"></i>Phone Number
                                    </label>
                                    <div class="input-group">
                                        <div class="position-relative flex-grow-0" style="width: 140px;">
                                            <i class="form-icon fas fa-globe"></i>
                                            <select class="form-select with-icon" style="max-width:140px;" name="country_code" id="country_code">
                                                <option value="" selected disabled>Select Country</option>
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

                                <button type="submit" class="btn btn-signup w-100 mt-3" id="submit-btn">
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

<script>
document.addEventListener("DOMContentLoaded", function(){
    // Toast notifications
    const toastElList = [].slice.call(document.querySelectorAll(".toast"));
    toastElList.map(function(toastEl){
        const toast = new bootstrap.Toast(toastEl, {delay:4000});
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
                feedback.textContent = 'This field is required';
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
                    feedback.textContent = 'Please enter a valid email address';
                    feedback.className = 'validation-feedback invalid';
                }
                return false;
            }
        }
        
        // Phone validation (basic)
        if (field.name === 'phone') {
            const phoneRegex = /^[0-9+\-\s()]{10,}$/;
            if (!phoneRegex.test(field.value)) {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                if (feedback) {
                    feedback.textContent = 'Please enter a valid phone number';
                    feedback.className = 'validation-feedback invalid';
                }
                return false;
            }
        }
        
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        if (feedback) {
            feedback.textContent = 'Looks good!';
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
        } else {
            // Change button text and add loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Creating Account...';
            submitBtn.disabled = true;
        }
    });
    
    // Add shake animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection