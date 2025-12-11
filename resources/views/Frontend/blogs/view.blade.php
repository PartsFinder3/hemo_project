@extends('Frontend.blogs.layout.main')
@section('main-section')

<style>
    :root {
        --abdul-primary-color: #ff7700;
        --abdul-secondary-color: #2b2d2f;
        --abdul-accent-color: #f8f9fa;
        --abdul-card-bg: #ffffff;
        --abdul-card-shadow: rgba(0, 0, 0, 0.1);
    }

    /* Page Header */
    .abdul-page-header {
        background: linear-gradient(135deg, #ff7700 0%, #d44822 100%);
        color: white;
        padding: 60px 20px;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 40px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .abdul-page-header h1 {
        font-size: 3rem;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .abdul-page-header p {
        font-size: 1.2rem;
        opacity: 0.85;
    }

    /* Blog Card */
    .abdul-blog-card {
        background: var(--abdul-card-bg);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px var(--abdul-card-shadow);
        margin-bottom: 30px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

  

.abdul-blog-card img {
    width: 100%;
    height: 250px !important; /* smaller height */
    object-fit: cover; /* keeps image proportions and covers area */
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    transition: transform 0.3s ease;
}




    .abdul-card-body {
        padding: 25px 20px;
        margin-top: 300px !important;
    }

    .abdul-badge {
        display: inline-block;
        background-color: var(--abdul-primary-color);
        color: #fff;
        padding: 5px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        margin-bottom: 12px;
        transition: background-color 0.3s;
    }

 
    .abdul-card-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--abdul-secondary-color);
    }

    .abdul-card-text {
        font-size: 1rem;
        color: #555;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .abdul-card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        color: #6c757d;
        flex-wrap: wrap;
        gap: 10px;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .abdul-author-info {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .abdul-author-info span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .abdul-post-date {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .abdul-blog-card img {
            height: 200px; 
        }

        .abdul-card-title {
            font-size: 1.6rem;
        }

        .abdul-card-body {
            padding: 20px 15px;
        }
    }

    @media (max-width: 480px) {
        .abdul-blog-card img {
            height: 150px;
        }

        .abdul-card-title {
            font-size: 1.4rem;
        }

        .abdul-card-text {
            font-size: 0.95rem;
        }
    }
</style>

<div class="container my-5">
    <div class="abdul-blog-grid">
        <article class="abdul-blog-card">
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
            @endif
            <div class="abdul-card-body">
                @if($blog->category)
                    <span class="abdul-badge">{{ $blog->category->name }}</span>
                @endif
                <h2 class="abdul-card-title">{{ $blog->title }}</h2>
                <p class="abdul-card-text">{!! $blog->content !!}</p>
                <div class="abdul-card-meta">
                    <div class="abdul-author-info">
                        <span class="abdul-author-name">{{ $blog->author }}</span>
                        <span>Views: <b>{{ $blog->is_view }}</b></span>
                    </div>
                    <span class="abdul-post-date">{{ $blog->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </article>
    </div>
</div>

@endsection
