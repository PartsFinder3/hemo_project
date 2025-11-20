@include('frontend.layout.head')

@section('main-section')

@if($domain)
    {!! $domain->about !!}
@else
    <p>No domain configuration found.</p>
@endif

@endsection