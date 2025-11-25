@extends('Frontend.blogs.layout.main')
@section('main-section')

<style>
    :root {
        --primary-color: #ff7700;
        --secondary-color: #2b2d2f;
        --accent-color: #f8f9fa;
        --card-bg: #ffffff;
        --card-shadow: rgba(0, 0, 0, 0.1);
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
        margin-bottom: 30px; /* Space below header */
    }

    .page-header h1 {
        font-size: 2.8rem;
        margin-bottom: 10px;
    }

    .page-header p {
        font-size: 1.2rem;
        opacity: 0.85;
    }

    /* Layout */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .col-main {
        flex: 0 0 70%;
        max-width: 70%;
        padding: 0 15px;
    }

    .col-sidebar {
        flex: 0 0 30%;
        max-width: 30%;
        padding: 0 15px;
    }

    @media (max-width: 991.98px) {
        .col-main, .col-sidebar {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .col-sidebar {
            margin-top: 30px;
        }
    }

    /* Blog Card */
    .blog-card {
        background: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px var(--card-shadow);
        margin-bottom: 30px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px var(--card-shadow);
    }

    .blog-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
    }

    .card-body {
        padding: 20px;
    }

    .badge {
        display: inline-block;
        background-color: var(--primary-color);
        color: white;
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 0.8rem;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
        margin-bottom: 20px;
    }

    .card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .author-info {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    /* Sidebar */
    .sidebar-widget {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px var(--card-shadow);
    }

    .widget-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .category-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        background: var(--accent-color);
        color: var(--secondary-color);
        cursor: pointer;
        transition: background 0.3s ease, color 0.3s ease;
    }

    .category-item:hover {
        background: var(--primary-color);
        color: white;
    }

    .badge-count {
        background: #dee2e6;
        color: var(--secondary-color);
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
    }

    /* Responsive */
    @media (max-width: 575.98px) {
        .blog-card img {
            height: 200px;
        }
        .card-body {
            padding: 15px;
        }
        .card-title {
            font-size: 1.5rem;
        }
        .widget-title {
            font-size: 1rem;
        }
        .category-item {
            font-size: 0.95rem;
        }
    }
</style>

<div class="container" style="margin-top:30px;">
    <div class="row">
        <!-- Blog Post -->
        <div class="col-main">
            <div class="blog-grid">
                <article class="blog-card">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                    <div class="card-body">
                        <span class="badge">{{ $blog->category->name }}</span>
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

 
    </div>
</div>

@endsection
