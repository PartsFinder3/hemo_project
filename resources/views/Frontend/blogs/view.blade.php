@extends('Frontend.blogs.layout.main')
@section('main-section')
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Latest Articles</h1>
            <p>Discover the latest insights in Sedans, SUVs, and more.</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-main">
                <div class="blog-grid" id="blogGrid">
                    <article class="blog-card">
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="JavaScript Tips">
                        <div class="card-body">
                            <span class="badge javascript">{{ $blog->category->name }}</span>
                            <h2 class="card-title">{{ $blog->title }}</h2>
                            <p class="card-text">{!! $blog->content !!}</p>
                            <div class="card-meta">
                                <div class="author-info">
                                    <span class="author-name">{{ $blog->author }}</span>
                                    <span>Views:<b>{{ $blog->is_view }}</b></span>
                                </div>
                                <span class="post-date">{{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Categories Sidebar (Right Side) -->
            <div class="col-sidebar">
                <div class="sidebar-widget">
                    <h3 class="widget-title">
                        <i class="fas fa-tags"></i>Categories
                    </h3>
                    @foreach ($categories as $c)
                        @php
                            $categoryBlogs = $c->blogs()->count();
                        @endphp
                        <div class="category-item" onclick="filterPosts('javascript')">
                            <span>{{ $c->name }}</span>
                            <span class="badge-count">{{ $categoryBlogs }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
