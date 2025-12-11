@extends('Frontend.layout.main')

@section('main-section')
<div class="container my-5">
    <h1>Site Map</h1>
    <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}">About Us</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>
        <li>
            Products
            <ul>
                <li><a href="{{ url('/products/category1') }}">Category 1</a></li>
                <li><a href="{{ url('/products/category2') }}">Category 2</a></li>
                <li><a href="{{ url('/products/category3') }}">Category 3</a></li>
            </ul>
        </li>
        <li>
            Blog
            <ul>
                <li><a href="{{ url('/blog/post1') }}">Post 1</a></li>
                <li><a href="{{ url('/blog/post2') }}">Post 2</a></li>
            </ul>
            Models
             <ul>
                @foreach ($parts as $part)
               <li>
                <a href="{{ route('part.ads', ['partName' => $part->name, 'id' => $part->id]) }}">
                    {{$part->name}}
                </a>
            </li>

                @endforeach
            </ul>   
        </li>
    </ul>
</div>
@endsection
