@extends('Frontend.blogs.layout.main')
@section('main-section')
<section style="margin: 50px" class="terms-container py-5 px-4">
    <div class="container">
        <div class="p-4 bg-white rounded shadow-sm">
            {{-- <h2 class="h4 mb-4">Terms &amp; Conditions</h2> --}}

            {!! $domain->companyData->privacy_policy
                ?? '<p class="text-muted">Currently, no privacy policy is available.</p>' !!}
        </div>
    </div>
</section>

@endsection
