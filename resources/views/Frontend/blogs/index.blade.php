@extends('Frontend.blogs.layout.main')
@section('main-section')
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
            <!-- Blog Posts (Left Side) -->
            <div class="col-main">
                {{-- <div class="search-container">
                    <input type="text" class="search-box" placeholder="Search articles..." id="searchInput">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                </div> --}}

                <div class="blog-grid" id="blogGrid">
                    @foreach ($blogs as $b)
                        <article class="blog-card">
                            <img src="{{ asset('storage/' . $b->image) }}" alt="JavaScript Tips">
                            <div class="card-body">
                                <span class="badge javascript">{{ $b->category->name }}</span>
                                <h2 class="card-title">{{ $b->title }}</h2>
                                <p class="card-text">{{ Str::limit(strip_tags($b->content), 150, '...') }}</p>
                                <div class="card-meta">
                                    <div class="author-info">
                                        <span class="author-name">{{ $b->author }}</span>
                                        <span>Views:<b>{{ $b->is_view }}</b></span>
                                    </div>
                                    <span class="post-date">{{ $b->created_at->format('M d, Y') }}</span>
                                    <span>
                                        <a href="{{route('frontend.blog.view', ['slug' => $b->slug, 'id' => $b->id])}}"
                                            style="text-decoration: none; color: var(--primary-color); background: var(--accent-color); padding: 8px 10px; width: 60px;"
                                            class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <span class="page-item">Previous</span>
                    <a href="#" class="page-item active">1</a>
                    <a href="#" class="page-item">2</a>
                    <a href="#" class="page-item">3</a>
                    <a href="#" class="page-item">Next</a>
                </div>
            </div>

            <!-- Categories Sidebar (Right Side) -->
            <div class="col-sidebar">
                <div class="sidebar-widget">
                    <h3 class="widget-title">
                        <i class="fas fa-tags"></i>Categories
                    </h3>
                    <a style="text-decoration: none; color: var(--secondary-color);" href="{{route('frontend.blogs')}}" class="category-item" onclick="filterPosts('javascript')">
                            <span>All</span>
                            <span class="badge-count">{{ $blogs->count() }}</span>
                    </a>
                    @foreach ($categories as $c)
                        @php
                            $categoryBlogs = $c->blogs()->count();
                        @endphp
                        <a style="text-decoration: none; color: var(--secondary-color);" href="{{route('frontend.blogs.category',$c->id)}}" class="category-item" onclick="filterPosts('javascript')">
                            <span>{{ $c->name }}</span>
                            <span class="badge-count">{{ $categoryBlogs }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
