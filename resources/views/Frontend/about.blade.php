@extends('frontend.layout.main')
@section('main-section')
 
    </main>
@if($domain)
    {!! $domain->about !!}
@else
    <p>No domain configuration found.</p>
@endif
@endsection
