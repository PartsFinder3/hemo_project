  @extends('Frontend.layout.main')

@section('main-section')

  <style>
        body, main, header, nav, .hero-section, .hero-section_p {
    background-image: none !important;
    background: none !important;
}
        :root {
            --primary-orange: #ff7700;
            --primary-dark: #2b2d2f;
            --primary-orange-hover: #d44822;
            --primary-dark-light: #2a2f4a;
            --whatsapp-btn: #25D366;
            --whatsapp-hover: #128C7E;
        }




         .btn-whatsapp {
            background: linear-gradient(135deg, var(--whatsapp-btn), var(--whatsapp-hover));
            border: none;
            border-radius: 12px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .btn-whatsapp:hover {
            background: linear-gradient(135deg, var(--whatsapp-hover), var(--whatsapp-btn));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
            color: white;
        }

        .login-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            min-height: 600px;
        }

        .login-left {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="30" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
            pointer-events: none;
        }

        .brand-logo {
            font-size: 3rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .brand-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .feature-list {
            list-style: none;
            text-align: left;
            position: relative;
            z-index: 1;
        }

        .feature-list li {
            font-size: 1.1rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .feature-list li i {
            margin-right: 15px;
            font-size: 1.3rem;
            width: 25px;
        }

        .login-right {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-title {
            color: var(--primary-dark);
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .form-control {
            height: 55px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px rgba(233, 84, 38, 0.1);
            background-color: white;
            outline: none;
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            z-index: 3;
            font-size: 1.1rem;
        }

        .password-input {
            padding-right: 50px !important;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
            border: none;
            border-radius: 12px;
            height: 55px;
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, var(--primary-orange-hover) 0%, #c23d1e 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(233, 84, 38, 0.3);
        }

        .btn-login:focus {
            box-shadow: 0 0 0 3px rgba(233, 84, 38, 0.2);
        }

        .form-check {
            margin: 25px 0;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            border: 2px solid #dee2e6;
        }

        .form-check-input:checked {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
        }

        .form-check-label {
            font-size: 0.95rem;
            color: #6c757d;
            margin-left: 8px;
        }

        .forgot-password {
            color: var(--primary-orange);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--primary-orange-hover);
            text-decoration: underline;
        }

        .divider {
            margin: 30px 0;
            position: relative;
            text-align: center;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #dee2e6;
        }

        .divider span {
            background: white;
            padding: 0 20px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .btn-social {
            flex: 1;
            height: 50px;
            border-radius: 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-google {
            background: #fff;
            border: 2px solid #dee2e6;
            color: #495057;
        }

        .btn-google:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
            color: #495057;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .btn-facebook {
            background: #4267B2;
            border: 2px solid #4267B2;
            color: white;
        }

        .btn-facebook:hover {
            background: #365899;
            border-color: #365899;
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }

        .signup-link a {
            color: var(--primary-orange);
            font-weight: 600;
            text-decoration: none;
        }

        .signup-link a:hover {
            color: var(--primary-orange-hover);
            text-decoration: underline;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .login-left {
                padding: 40px 30px;
                text-align: center;
            }

            .brand-title {
                font-size: 2rem;
            }

            .brand-subtitle {
                font-size: 1rem;
            }

            .feature-list {
                text-align: center;
            }

            .feature-list li {
                justify-content: center;
                font-size: 1rem;
            }
        }

        @media (max-width: 767.98px) {
            body {
                padding: 10px;
            }

            .login-right {
                padding: 30px 25px;
            }

            .login-left {
                padding: 30px 20px;
            }

            .login-title {
                font-size: 1.8rem;
            }

            .brand-title {
                font-size: 1.8rem;
            }

            .form-control {
                height: 50px;
                font-size: 0.95rem;
            }

            .btn-login {
                height: 50px;
                font-size: 1rem;
            }

            .social-login {
                flex-direction: column;
            }
        }

        @media (max-width: 575.98px) {
            .login-card {
                border-radius: 15px;
                margin: 10px;
            }

            .login-right {
                padding: 25px 20px;
            }

            .login-left {
                padding: 25px 15px;
            }
        }
    </style>

    <div class="container-fluid login-container">
        <div class="row g-0 justify-content-center">
            <div class="col-xl-10 col-lg-11 col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                @endif
                <div class="card login-card">
                    <div class="row g-0 h-100">
                        <!-- Left Side - Brand -->
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="login-left w-100">
                                <div class="logo" style="max-width: 200px; margin-bottom: 20px;">
                                    @if($domain && $domain->logo)
                                        <img style="width: 100%" src="{{ asset('storage/' . $domain->logo) }}"
                                            alt="">
                                    @endif
                                </div>
                                <p class="brand-subtitle">Your trusted automotive parts marketplace</p>

                                <ul class="feature-list">
                                    <li>
                                        <i class="fas fa-shield-alt"></i>
                                        Verified sellers and genuine parts
                                    </li>
                                    <li>
                                        <i class="fas fa-shipping-fast"></i>
                                        Fast delivery worldwide
                                    </li>
                                    <li>
                                        <i class="fas fa-tools"></i>
                                        Expert technical support
                                    </li>
                                    <li>
                                        <i class="fas fa-award"></i>
                                        Best prices guaranteed
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Right Side - Login Form -->
                        <div class="col-lg-6">
                            <div class="login-right">
                                <div class="login-header">
                                    <h2 class="login-title">Welcome Back</h2>
                                    <p class="login-subtitle">Sign in to your account to continue</p>
                                </div>

                                <!-- Sample Alert (Remove in production) -->
                                <div class="alert alert-danger d-none" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Invalid email or password. Please try again.
                                </div>

                                <!-- Login Form -->
                                <form method="POST" action="{{ route('supplier.login.post') }}">
                                    <!-- CSRF Token for Laravel -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <i class="fab fa-whatsapp me-2"></i>WhatsApp/Username
                                        </label>
                                        <input type="text" class="form-control" id="email" name="whatsapp"
                                            placeholder="Enter your WhatsApp/Username" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Password
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control password-input" id="password"
                                                name="password" placeholder="Enter your password" required>

                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="#" class="forgot-password" data-bs-toggle="modal"
                                            data-bs-target="#border-less">
                                            Forgot Password?
                                        </a>
                                    </div>


                                    <!--BorderLess Modal Modal -->
                                    <div class="modal fade text-left modal-borderless" id="border-less"
                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body d-flex flex-column align-items-center">
                                                    <h2>
                                                        Forget Your Password?
                                                    </h2>
                                                    <span>
                                                        Please contact admin to reset your password.
                                                    </span>
                                                    <a href="https://wa.me/923004531248" target="_blank" class="btn btn-whatsapp px-4 py-2 rounded-pill">
                                                        <i class="fab fa-whatsapp me-2"></i>WhatsApp Us</a>
                                                </div>
                                                {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
                                                    <button type="button" class="btn btn-primary ms-1"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Accept</span>
                                                    </button>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-login w-100 mt-4">
                                        <i class="fas fa-sign-in-alt me-2"></i>
                                        Sign In
                                    </button>
                                </form>

                                <div class="signup-link">
                                    Don't have an account? <a href="{{route('frontend.signup')}}">Create Account</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (for responsive behavior only, no custom JS) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endsection