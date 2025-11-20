@extends('frontend.layout.main')
@section('main-section')
 
<style>
    main {
     
    max-width: 100%;
    background: linear-gradient(rgba(255, 0, 0, 0.342), rgba(0, 0, 0, 0.8)), url(../assets/Untitled design (2).png);
    min-height: 100vh;
    background-size: cover;
    background-position: center;
}
</style>
@if($domain)
    {!! $domain->about !!}
@else
    <p>No domain configuration found.</p>
@endif
@endsection
