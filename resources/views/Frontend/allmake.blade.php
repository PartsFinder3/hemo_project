@extends('Frontend.layout.main')
@section('main-section')
<section class="carMakes">
        <div class="section-text">
           
            <h2>Browse By Brands</h2>
        </div>

        <div class="brands">
            @foreach ($carMakes as $make)
                <a href="{{ route('make.ads', ['slug' => $make->slug, 'id' => $make->id]) }}" class="make">
                    @if($make->logo)
               
                      <img src="{{ asset('storage/' . $make->logo) }}" alt="{{ $make->name }}">
                      

                    @endif
                    <h4>{{ strtoupper($make->name) }}</h4>
                </a>
            @endforeach
        </div>
            <div class="pagination-links">
        {{ $carMakes->links() }}
    </div>
    </section>
@endsection
