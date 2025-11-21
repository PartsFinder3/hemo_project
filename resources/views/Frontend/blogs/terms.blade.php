@extends('Frontend.blogs.layout.main')
@section('main-section')
<section style="margin: 50px" class="terms-container py-5 px-4">
    <div class="container">
        <div class="p-4 bg-white rounded shadow-sm">
            {{-- <h2 class="h4 mb-4">Terms &amp; Conditions</h2> --}}

            {!! $domain->companyData->terms_conditions
                ?? '<p class="text-muted">Currently, no terms and conditions are available.</p>' !!}
        </div>
    </div>
</section>

@endsection
