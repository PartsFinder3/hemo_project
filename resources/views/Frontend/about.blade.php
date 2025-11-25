@extends('Frontend.layout.main')
@section('main-section')
<style>
    /* Section styling */
    .domain-about-section {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 80px 20px;
        min-height: 70vh;
        background: #1a1a1a; /* dark background */
        color: #f1f1f1;
        text-align: center;
        box-sizing: border-box;
        position: relative;
        overflow: hidden;
    }

    /* Decorative accent line */
    .domain-about-section::before {
        content: "";
        position: absolute;
        width: 100px;
        height: 4px;
        background: #ff7700;
        top: 30px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Content wrapper */
    .domain-about-content {
        max-width: 850px;
        width: 100%;
        font-size: 22px;
        line-height: 1.9;
        padding: 40px 30px;
        background-color: rgba(255, 255, 255, 0.05); /* subtle overlay */
        border-left: 5px solid #ff7700; /* side accent line */
        border-radius: 8px;
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .domain-about-content p {
        margin: 0 0 20px 0;
    }

    /* Hover effect */
    @media (min-width: 769px) {
        .domain-about-content:hover {
            transform: translateY(-8px);
            background-color: rgba(255, 255, 255, 0.1);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .domain-about-section {
            padding: 60px 15px;
        }
        .domain-about-content, .domain-about-content p {
            font-size: 18px;
            line-height: 1.7;
            padding: 30px 20px;
        }
        .domain-about-section::before {
            width: 60px;
            top: 20px;
        }
    }

    /* Reset other backgrounds */
    body, main, header, nav, .hero-section, .hero-section_p {
        background-image: none !important;
        background: none !important;
    }
</style>

<div class="domain-about-section">
    <div class="domain-about-content">
        @if($domain)
            {!! $domain->about !!}
        @else
            <p>No domain configuration found.</p>
        @endif
    </div>
</div>
@endsection
