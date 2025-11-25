@extends('Frontend.layout.main')
@section('main-section')
<style>
    /* Section styling */
    .domain-about-section {
        display: flex; /* flex for centering */
        justify-content: center;
        align-items: center;
        padding: 100px 20px;
        min-height: 70vh;
        background: linear-gradient(135deg, #ff7700, #ff9900); /* gradient background */
        color: #fff;
        text-align: center;
        box-sizing: border-box;
    }

    /* Content wrapper */
    .domain-about-content {
        max-width: 900px;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* semi-transparent background for readability */
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        font-size: 24px;
        line-height: 2;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Paragraph styling */
    .domain-about-content p {
        font-size: 24px;
        line-height: 2;
        margin: 0 auto 20px auto;
    }

    /* Hover effect on desktop */
    @media (min-width: 769px) {
        .domain-about-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .domain-about-section {
            padding: 60px 15px;
        }
        .domain-about-content, .domain-about-content p {
            font-size: 18px;
            line-height: 1.8;
            padding: 30px 20px;
        }
    }

    /* Remove any existing hero/backgrounds */
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
