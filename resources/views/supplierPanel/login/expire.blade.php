@extends('Frontend.layout.main')

@section('main-section')
    <title>Subscription Expired</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-orange: #e95426;
            --primary-dark: #1e2136;
            --primary-orange-hover: #d44822;
            --primary-dark-light: #2a2f4a;
        }

        body {
            background-color: var(--primary-dark);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .expired-icon {
            font-size: 5rem;
            color: var(--primary-orange);
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
            padding: 0.75rem 2rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: var(--primary-orange-hover);
            border-color: var(--primary-orange-hover);
        }

        .btn-outline-light {
            padding: 0.75rem 2rem;
            font-weight: 500;
        }

        .expired-date {
            background-color: var(--primary-dark-light);
            border-left: 4px solid var(--primary-orange);
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .features {
            background-color: var(--primary-dark-light);
            padding: 2rem;
            margin: 2rem 0;
        }

        .feature-item {
            margin-bottom: 0.75rem;
        }

        .feature-icon {
            color: var(--primary-orange);
            margin-right: 0.75rem;
        }

        .text-muted {
            color: #9ca3af !important;
        }

        h1 {
            color: var(--primary-orange);
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="text-center">
                    <div class="expired-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>

                    <h1 class="display-4 mb-4">Subscription Expired</h1>

                    {{-- <div class="expired-date">
                        <strong><i class="fas fa-calendar-times me-2"></i>Expired on:</strong> January 15, 2025
                    </div> --}}

                    <p class="lead text-muted mb-4">
                        Your subscription has expired and you no longer have access to your shop.
                        Renew now to continue enjoying all the benefits!
                    </p>

                    <div class="features">
                        <h5 class="mb-4">What you're missing:</h5>
                        <div class="text-start">
                            <div class="feature-item">
                                <i class="fas fa-check feature-icon"></i>
                                <span>Unlimited access to premium Inquiries</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check feature-icon"></i>
                                <span>Priority customer support</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check feature-icon"></i>
                                <span>Advanced Ad Posting</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check feature-icon"></i>
                                <span>And Much More</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-3 d-md-block">
                        <a href="#" class="btn btn-primary btn-lg me-md-3">
                            <i class="fas fa-credit-card me-2"></i>
                            Renew Subscription
                        </a>
                    </div>

                    {{-- <div class="mt-4">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            30-day money-back guarantee • Cancel anytime
                        </small>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>


    @endsection