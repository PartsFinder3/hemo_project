@extends('Frontend.layout.main')
@section('main-section')
@php
                 use App\Models\SeoContentMake;
               
             @endphp
<section class="carMakes">
        <div class="section-text">
           
            <h2>Browse By Brands</h2>
        </div>

        <div class="brands">
            @foreach ($carMakes as $make)
            @php
              
                 $Content=SeoContentMake::where('make_id',$make->id)->first();
             @endphp
             @if($make->logo && $Content)
             
                <a href="{{ route('make.ads', ['slug' => $make->slug, 'id' => $make->id]) }}" class="make">
                    @if($make->logo )
               
                      <img src="{{ asset('storage/' . $make->logo) }}" alt="{{ $make->name }}">
                      

                    @endif
                    <h4>{{ strtoupper($make->name) }}</h4>
                </a>
                @endif
            @endforeach
        </div>
        
    </section>

    <style>
    .make {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    width: 150px;
    height: 115px;
    margin: 10px;
    text-decoration: none;
    color: black;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
    background: #fff;
}
</style>
@endsection
