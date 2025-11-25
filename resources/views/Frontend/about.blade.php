@extends('Frontend.layout.main')

@section('main-section')
<style>
    .domain-about-section {
        display: ''; /* center content */
        justify-content: center;
        align-items: center;
        padding: 80px 20px;
        min-height: 70vh;
    
        color: white;
        text-align: center;
        box-sizing: border-box;
    }

    .domain-about-content {
        max-width: 900px;
        width: 100%;
        font-size: 24px; /* bigger text */
        line-height: 2;  /* better spacing */
    }

    .domain-about-content p {
        font-size: 24px; /* make paragraph bigger too */
        line-height: 2;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .domain-about-section {
            padding: 50px 15px;
        }
        .domain-about-content, .domain-about-content p {
            font-size: 18px; /* smaller on mobile */
        }
    }
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
