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
        margin-bottom: 40px;
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
            margin-top: 40px;
        }
    }

    /* Blog Card */
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .blog-card {
        background: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px var(--card-shadow);
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px var(--card-shadow);
    }

    .blog-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    .card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .badge {
        display: inline-block;
        background-color: var(--primary-color);
        color: white;
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 0.8rem;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .card-text {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .author-info {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .read-more {
        background: var(--primary-color);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .read-more:hover {
        background: #d44822;
        text-decoration: none;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 40px 0;
        flex-wrap: wrap;
    }

    .page-item {
        padding: 10px 15px;
        border-radius: 8px;
        background-color: white;
        border: 1px solid #dee2e6;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--secondary-color);
    }

    .page-item.active, .page-item:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    /* Sidebar */
    .sidebar-widget {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px var(--card-shadow);
    }

    .widget-title {
        font-size: 1.2rem;
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
        text-decoration: none;
        transition: background 0.3s ease;
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

    /* Responsive adjustments for small screens */
    @media (max-width: 575.98px) {
        .blog-card img {
            height: 180px;
        }
        .card-body {
            padding: 15px;
        }
        .read-more {
            padding: 5px 10px;
            font-size: 0.9rem;
        }
        .widget-title {
            font-size: 1rem;
        }
        .category-item {
            font-size: 0.95rem;
        }
    }

</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>Latest Articles</h1>
        <p>Discover the latest insights in Sedans, SUVs, and more.</p>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <!-- Blog Posts -->
        <div class="col-main">
            <div class="blog-grid" id="blogGrid">
                @foreach ($blogs as $b)
                    <article class="blog-card">
                        <img src="{{ asset('storage/' . $b->image) }}" alt="{{ $b->title }}">
                        <div class="card-body">
                            <span class="badge">{{ $b->category->name }}</span>
                            <h2 class="card-title">{{ $b->title }}</h2>
                            <p class="card-text">{{ Str::limit(strip_tags($b->content), 150, '...') }}</p>
                            <div class="card-meta">
                                <div class="author-info">
                                    <span class="author-name">{{ $b->author }}</span>
                                    <span>Views:<b>{{ $b->is_view }}</b></span>
                                </div>
                                <span class="post-date">{{ $b->created_at->format('M d, Y') }}</span>
                                <span>
                                    <a href="{{route('frontend.blog.view', ['slug' => $b->slug, 'id' => $b->id])}}" class="read-more">
                                        Read More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->

        </div>
    </div>
</div>
@endsection
