@extends('frontend.layout.main')
@section('main-section')

<style>
    .hero-section {
        background: none !important;
        height: auto !important;
    }
</style>

@if($domain)
    {!! $domain->about !!}
@else
    <p>No domain configuration found.</p>
@endif  

@endsection
