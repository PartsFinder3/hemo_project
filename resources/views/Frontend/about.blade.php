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
        background: #ffffff; /* pure white background */
        color: #333333; /* dark text for contrast */
        text-align: center;
        box-sizing: border-box;
    }

    /* Content wrapper */
    .domain-about-content {
        max-width: 850px;
        width: 100%;
        font-size: 22px;
        line-height: 1.8;
        padding: 40px 30px;
        background-color: #f9f9f9; /* subtle off-white card */
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08); /* soft shadow */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .domain-about-content p {
        margin: 0 0 20px 0;
        font-size: 20px;
    }

    /* Hover effect on desktop */
    @media (min-width: 769px) {
        .domain-about-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .domain-about-section {
            padding: 60px 15px;
        }
        .domain-about-content, .domain-about-content p {
            font-size: 18px;
            line-height: 1.6;
            padding: 30px 20px;
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
