@extends('frontend.layout.main')

@section('main-section')
<style>
    .domain-about-section {
     
        padding: 80px 20px;
        min-height: 70vh;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        text-align: center;
        box-sizing: border-box;
    }

    .domain-about-content {
        max-width: 800px;
        width: 100%;
        font-size: 15px;
    }

    .domain-about-content p {
        font-size: 1.2rem;
        line-height: 1.8;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .domain-about-section {
            padding: 50px 15px;
        }
        .domain-about-content p {
            font-size: 1rem;
        }
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
