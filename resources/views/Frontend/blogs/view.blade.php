@extends('Frontend.blogs.layout.main')
@section('main-section')

<style>
    :root {
        --primary-color: #ff7700;
        --secondary-color: #2b2d2f;
        --accent-color: #f8f9fa;
        --card-bg: #ffffff;
        --card-shadow: rgba(0, 0, 0, 0.15);
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f5f7;
        color: var(--secondary-color);
        margin: 0;
        padding: 0;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #ff7700 0%, #d44822 100%);
        color: white;
        padding: 60px 20px;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .page-header h1 {
        font-size: 2.8rem;
        margin-bottom: 10px;
    }

    .page-header p {
        font-size: 1.2rem;
        opacity: 0.85;
    }

    /* Blog Card */
.blog-card {
    background: var(--card-bg);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    margin-bottom: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.blog-card img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    object-position: center;
    display: block;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.card-body {
    padding: 25px 20px;
}

.card-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 12px;
}

.card-text {
    font-size: 1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 20px;
}

.badge {
    display: inline-block;
    background-color: var(--primary-color);
    color: #fff;
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 0.8rem;
    margin-bottom: 12px;
}

    .card-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .card-text {
        font-size: 1rem;
        color: #6c757d;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        color: #6c757d;
        flex-wrap: wrap;
        gap: 10px;
    }

    .author-info {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .blog-card img {
            height: 250px;
        }

        .card-title {
            font-size: 1.6rem;
        }

        .card-body {
            padding: 20px 15px;
        }
    }

    @media (max-width: 480px) {
        .blog-card img {
            height: 200px;
        }

        .card-title {
            font-size: 1.4rem;
        }

        .card-text {
            font-size: 0.95rem;
        }
    }
</style>

<div class="container my-5">
    <div class="blog-grid">
        <article class="blog-card">
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
            @endif
            <div class="card-body">
                @if($blog->category)
                    <span class="badge">{{ $blog->category->name }}</span>
                @endif
                <h2 class="card-title">{{ $blog->title }}</h2>
                <p class="card-text">{!! $blog->content !!}</p>
                <div class="card-meta">
                    <div class="author-info">
                        <span class="author-name">{{ $blog->author }}</span>
                        <span>Views: <b>{{ $blog->is_view }}</b></span>
                    </div>
                    <span class="post-date">{{ $blog->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </article>
    </div>
</div>

@endsection
