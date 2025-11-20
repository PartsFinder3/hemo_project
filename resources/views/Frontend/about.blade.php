@extends('frontend.layout.main')
@section('main-section')
    <div class="hero-section">
        <div class="hero-text d-flex justify-content-center align-items-center flex-column">
       
            </span>
            <style>
                .scroll-bounce {
                    display: inline-block;
                    animation: bounce 1.4s infinite;
                }

                @keyframes bounce {

                    0%,
                    20%,
                    50%,
                    80%,
                    100% {
                        transform: translateY(0);
                    }

                    40% {
                        transform: translateY(6px);
                    }

                    60% {
                        transform: translateY(3px);
                    }
                }
            </style>

            {{-- <p>Your one-stop solution for all your automotive needs.</p> --}}
        </div>
    </div>
    </main>
@if($domain)
    {!! $domain->about !!}
@else
    <p>No domain configuration found.</p>
@endif
@endsection
