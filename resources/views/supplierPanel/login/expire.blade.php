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
        color: #fff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .expired-card {
        background-color: var(--primary-dark-light);
        border-radius: 12px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .expired-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .expired-icon {
        font-size: 5rem;
        color: var(--primary-orange);
        margin-bottom: 1.5rem;
    }

    h1 {
        color: var(--primary-orange);
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .lead {
        color: #d1d5db;
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }

    .features {
        background-color: var(--primary-dark);
        padding: 25px 20px;
        margin-bottom: 2rem;
        border-radius: 8px;
        text-align: left;
    }

    .features h5 {
        color: var(--primary-orange);
        margin-bottom: 1rem;
    }

    .feature-item {
        margin-bottom: 0.75rem;
        font-size: 1rem;
    }

    .feature-icon {
        color: var(--primary-orange);
        margin-right: 0.75rem;
    }

    .btn-primary {
        background-color: var(--primary-orange);
        border-color: var(--primary-orange);
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: background 0.3s, transform 0.3s;
    }

    .btn-primary:hover {
        background-color: var(--primary-orange-hover);
        border-color: var(--primary-orange-hover);
        transform: translateY(-2px);
    }

    .text-muted {
        color: #9ca3af !important;
    }

    @media (max-width: 768px) {
        .expired-card {
            padding: 30px 20px;
        }

        .expired-icon {
            font-size: 4rem;
        }

        .lead {
            font-size: 1rem;
        }
    }
</style>

<div class="container">
    <div class="col-md-8 col-lg-6">
        <div class="expired-card">
            <div class="expired-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>

            <h1>Subscription Expired</h1>

            <p class="lead">
                Your subscription has expired and you no longer have access to your shop.
                Renew now to continue enjoying all the benefits!
            </p>

            <div class="features">
                <h5>What you're missing:</h5>
                <div class="feature-item"><i class="fas fa-check feature-icon"></i>Unlimited access to premium Inquiries</div>
                <div class="feature-item"><i class="fas fa-check feature-icon"></i>Priority customer support</div>
                <div class="feature-item"><i class="fas fa-check feature-icon"></i>Advanced Ad Posting</div>
                <div class="feature-item"><i class="fas fa-check feature-icon"></i>And Much More</div>
            </div>

            <a href="#" class="btn btn-primary btn-lg">
                <i class="fas fa-credit-card me-2"></i> Renew Subscription
            </a>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
@endsection
