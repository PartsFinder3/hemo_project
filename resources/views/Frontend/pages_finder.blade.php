@extends('Frontend.layout.main')

@section('main-section')
<style>
    .sitemap-container {
        max-width: 900px;
        margin: 50px auto;
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    .sitemap-container h1 {
        font-size: 2.5rem;
        margin-bottom: 30px;
        text-align: center;
        color: #333;
    }

    .sitemap-container ul {
        list-style: none;
        padding-left: 0;
    }

    .sitemap-container ul li {
        margin: 8px 0;
        position: relative;
        padding-left: 20px;
    }

    .sitemap-container ul li:before {
        content: "•";
        position: absolute;
        left: 0;
        color: #007bff;
        font-weight: bold;
    }

    .sitemap-container ul li a {
        text-decoration: none;
        color: #007bff;
        transition: color 0.3s;
    }

    .sitemap-container ul li a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    /* Nested lists styling */
    .sitemap-container ul li ul {
        margin-top: 5px;
        margin-bottom: 10px;
        padding-left: 20px;
        border-left: 2px dashed #ddd;
    }

    .sitemap-container ul li ul li:before {
        content: "–";
        color: #ff6600;
        font-weight: normal;
    }

    .sitemap-container h2.card-title {
        font-size: 1rem;
        margin: 0;
        display: inline;
    }

</style>

<div class="sitemap-container">
    <h1>Site Map</h1>
    <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('about.page') }}">About Us</a></li>
       
        
        <li>
            Blog
            <ul>
                @foreach ($blogs as $b)
                    <li>
                        <a href="{{ route('frontend.blog.view', ['slug' => $b->slug, 'id' => $b->id]) }}">
                            <h2 class="card-title">{{ $b->title }}</h2>
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

        <li>
            Parts
            <ul>
                @foreach ($parts as $part)
                    <li>
                        <a href="{{ route('part.ads', ['partName' => $part->name, 'id' => $part->id]) }}">
                            {{ $part->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

        <li>
            Makes
            <ul>
                @foreach ($makes as $make)
                    <li>
                        <a href="{{ route('make.ads', ['slug' => $make->name, 'id' => $make->id]) }}">
                            {{ $make->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

    </ul>
</div>
@endsection
