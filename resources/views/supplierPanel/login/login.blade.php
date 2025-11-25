@extends('Frontend.layout.main')

@section('main-section')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<style>
    /* Copy all the styles from your login page */
    body, main, header, nav, .hero-section, .hero-section_p { background: none !important; }
    :root {
        --primary-orange: #ff7700;
        --primary-dark: #2b2d2f;
        --primary-orange-hover: #d44822;
        --whatsapp-btn: #25D366;
        --whatsapp-hover: #128C7E;
    }
    .btn-whatsapp { /* same styles as login */ }
    .login-container { width: 100%; max-width: 1200px; margin: 0 auto; }
    .login-card { border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); min-height: 600px; overflow:hidden; }
    .login-left { background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-hover)); color:white; padding:60px 40px; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; }
    .login-left .feature-list { list-style:none; text-align:left; padding:0; }
    .login-left .feature-list li { margin-bottom:15px; display:flex; align-items:center; }
    .login-left .feature-list li i { margin-right:10px; font-size:1.2rem; }
    .login-right { padding:60px 50px; display:flex; flex-direction:column; justify-content:center; }
    .login-header { text-align:center; margin-bottom:40px; }
    .login-title { color:var(--primary-dark); font-size:2.2rem; font-weight:700; margin-bottom:10px; }
    .login-subtitle { color:#6c757d; font-size:1.1rem; }
    .form-group { margin-bottom:25px; }
    .form-label { font-weight:600; color:var(--primary-dark); margin-bottom:8px; font-size:1rem; }
    .form-control { height:55px; border-radius:12px; padding:15px 20px; font-size:1rem; border:2px solid #e9ecef; background:#f8f9fa; }
    .form-control:focus { border-color:var(--primary-orange); background:white; box-shadow:0 0 0 3px rgba(233,84,38,0.1); outline:none; }
    .btn-login { background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-hover)); border:none; border-radius:12px; height:55px; font-weight:600; font-size:1.1rem; text-transform:uppercase; letter-spacing:0.5px; }
    .btn-login:hover { background: linear-gradient(135deg, var(--primary-orange-hover), #c23d1e); transform:translateY(-2px); box-shadow:0 10px 25px rgba(233,84,38,0.3); }
    .signup-link { text-align:center; margin-top:20px; color:#6c757d; }
    .signup-link a { color:var(--primary-orange); font-weight:600; text-decoration:none; }
    .signup-link a:hover { color:var(--primary-orange-hover); text-decoration:underline; }
    @media (max-width:767.98px) { .login-left { display:none; } }
</style>

<div class="container-fluid login-container">
    <div class="row g-0 justify-content-center">
        <div class="col-xl-10 col-lg-11 col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card login-card">
                <div class="row g-0 h-100">
                    <!-- Left Side -->
                    <div class="col-lg-6 d-none d-lg-flex">
                        <div class="login-left w-100">
                            <div class="logo mb-3" style="max-width:200px;">
                                @if($domain && $domain->logo)
                                    <img style="width:100%" src="{{ $domain->logo }}" alt="">
                                @endif
                            </div>
                            <p class="brand-subtitle">Join UAE’s Largest Car Parts Network</p>
                            <ul class="feature-list">
                                <li><i class="fas fa-shield-alt"></i>Verified suppliers and genuine parts</li>
                                <li><i class="fas fa-shipping-fast"></i>Fast delivery across UAE</li>
                                <li><i class="fas fa-tools"></i>Expert support available</li>
                                <li><i class="fas fa-award"></i>Best prices guaranteed</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right Side - Signup Form -->
                    <div class="col-lg-6">
                        <div class="login-right">
                            <div class="login-header">
                                <h2 class="login-title">Create Account</h2>
                                <p class="login-subtitle">Fill in your details to get started</p>
                            </div>

                            <form method="POST" action="{{ route('supplier.create') }}">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Business Name</label>
                                    <input type="text" class="form-control" name="business_name" placeholder="Enter your business name" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter your phone number" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                                </div>

                                <button type="submit" class="btn btn-login w-100 mt-4">
                                    <i class="fas fa-user-plus me-2"></i> Sign Up
                                </button>
                            </form>

                            <div class="signup-link">
                                Already have an account? <a href="{{ route('frontend.login') }}">Sign In</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Right Side -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
