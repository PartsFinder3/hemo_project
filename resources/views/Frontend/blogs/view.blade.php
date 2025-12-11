@extends('Frontend.blogs.layout.main')
@section('main-section')

<style>
    :root {
        --abdul-primary-color: #ff7700;
        --abdul-primary-dark: #d44822;
        --abdul-secondary-color: #2b2d2f;
        --abdul-light-bg: #f8f9fa;
        --abdul-card-bg: #ffffff;
        --abdul-card-shadow: rgba(0, 0, 0, 0.08);
        --abdul-text-color: #444;
        --abdul-muted-color: #6c757d;
        --abdul-border-color: #eaeaea;
        --abdul-gradient: linear-gradient(135deg, #ff7700 0%, #ff5500 100%);
    }

    .dark-mode {
        --abdul-secondary-color: #f8f9fa;
        --abdul-card-bg: #1e1e1e;
        --abdul-light-bg: #121212;
        --abdul-text-color: #e0e0e0;
        --abdul-muted-color: #a0a0a0;
        --abdul-border-color: #333;
        --abdul-card-shadow: rgba(0, 0, 0, 0.25);
    }

    /* Page Container */
    .abdul-blog-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Breadcrumb Navigation */
    .abdul-breadcrumb {
        background: var(--abdul-light-bg);
        padding: 15px 25px;
        border-radius: 10px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        border-left: 4px solid var(--abdul-primary-color);
    }

    .abdul-breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem;
    }

    .abdul-breadcrumb-nav a {
        color: var(--abdul-muted-color);
        text-decoration: none;
        transition: color 0.3s;
    }

    .abdul-breadcrumb-nav a:hover {
        color: var(--abdul-primary-color);
    }

    .abdul-breadcrumb-nav span {
        color: var(--abdul-primary-color);
        font-weight: 600;
    }

    .abdul-actions {
        display: flex;
        gap: 10px;
    }

    .abdul-action-btn {
        background: var(--abdul-card-bg);
        border: 1px solid var(--abdul-border-color);
        padding: 8px 15px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.3s;
        color: var(--abdul-text-color);
        font-size: 0.9rem;
    }

    .abdul-action-btn:hover {
        background: var(--abdul-primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 119, 0, 0.2);
    }

    /* Blog Card */
    .abdul-blog-card {
        background: var(--abdul-card-bg);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px var(--abdul-card-shadow);
        margin-bottom: 40px;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), 
                    box-shadow 0.4s ease;
        position: relative;
        border: 1px solid var(--abdul-border-color);
    }

    .abdul-blog-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .abdul-image-container {
        position: relative;
        overflow: hidden;
        height: 500px;
    }

    .abdul-blog-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .abdul-image-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 40px 30px 20px;
        color: white;
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.4s ease;
    }

    .abdul-blog-card:hover .abdul-image-overlay {
        transform: translateY(0);
        opacity: 1;
    }

    .abdul-blog-card:hover img {
        transform: scale(1.08);
    }

    .abdul-card-body {
        padding: 40px;
    }

    .abdul-badge-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .abdul-badge {
        display: inline-block;
        background: var(--abdul-gradient);
        color: #fff;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        text-decoration: none;
    }

    .abdul-badge:hover {
        background: var(--abdul-primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 119, 0, 0.3);
    }

    .abdul-badge-secondary {
        background: var(--abdul-light-bg);
        color: var(--abdul-text-color);
    }

    .abdul-card-title {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 25px;
        color: var(--abdul-secondary-color);
        line-height: 1.2;
        position: relative;
        padding-bottom: 15px;
    }

    .abdul-card-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--abdul-gradient);
        border-radius: 2px;
    }

    .abdul-card-content {
        font-size: 1.15rem;
        color: var(--abdul-text-color);
        line-height: 1.9;
        margin-bottom: 35px;
    }

    .abdul-card-content p {
        margin-bottom: 1.5em;
    }

    .abdul-card-content h2, 
    .abdul-card-content h3 {
        color: var(--abdul-secondary-color);
        margin-top: 2em;
        margin-bottom: 1em;
    }

    .abdul-card-content blockquote {
        border-left: 4px solid var(--abdul-primary-color);
        padding-left: 25px;
        margin: 2em 0;
        font-style: italic;
        color: var(--abdul-muted-color);
        background: var(--abdul-light-bg);
        padding: 20px;
        border-radius: 0 10px 10px 0;
    }

    .abdul-card-content img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin: 2em 0;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Meta Information */
    .abdul-card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 40px;
        background: var(--abdul-light-bg);
        border-top: 1px solid var(--abdul-border-color);
        flex-wrap: wrap;
        gap: 20px;
    }

    .abdul-author-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .abdul-author-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--abdul-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .abdul-author-details {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .abdul-author-name {
        font-weight: 600;
        color: var(--abdul-secondary-color);
        font-size: 1.1rem;
    }

    .abdul-meta-stats {
        display: flex;
        gap: 25px;
    }

    .abdul-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--abdul-muted-color);
        font-size: 0.95rem;
    }

    .abdul-meta-item i {
        color: var(--abdul-primary-color);
        font-size: 1.1rem;
    }

    .abdul-meta-item b {
        color: var(--abdul-secondary-color);
        margin-left: 3px;
    }

    .abdul-post-date {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--abdul-muted-color);
        font-size: 0.95rem;
    }

    .abdul-post-date i {
        color: var(--abdul-primary-color);
    }

    /* Related Posts & Comments Section */
    .abdul-extra-sections {
        margin-top: 60px;
    }

    .abdul-section-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 30px;
        color: var(--abdul-secondary-color);
        position: relative;
        padding-bottom: 15px;
    }

    .abdul-section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: var(--abdul-gradient);
    }

    /* Floating Share Buttons */
    .abdul-share-floating {
        position: fixed;
        left: 30px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 15px;
        z-index: 100;
    }

    .abdul-share-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--abdul-card-bg);
        border: 1px solid var(--abdul-border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--abdul-text-color);
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .abdul-share-btn:hover {
        background: var(--abdul-primary-color);
        color: white;
        transform: scale(1.1);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .abdul-image-container {
            height: 400px;
        }
        
        .abdul-card-title {
            font-size: 2.3rem;
        }
        
        .abdul-card-body {
            padding: 30px;
        }
    }

    @media (max-width: 768px) {
        .abdul-breadcrumb {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .abdul-share-floating {
            position: static;
            flex-direction: row;
            justify-content: center;
            margin: 30px 0;
            transform: none;
        }
        
        .abdul-card-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .abdul-image-container {
            height: 300px;
        }
        
        .abdul-card-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .abdul-blog-container {
            padding: 15px;
        }
        
        .abdul-image-container {
            height: 250px;
        }
        
        .abdul-card-body,
        .abdul-card-meta {
            padding: 25px 20px;
        }
        
        .abdul-card-title {
            font-size: 1.7rem;
        }
        
        .abdul-card-content {
            font-size: 1.05rem;
        }
        
        .abdul-meta-stats {
            flex-wrap: wrap;
            gap: 15px;
        }
    }
</style>

<div class="abdul-blog-container">
    <!-- Breadcrumb Navigation -->
    <div class="abdul-breadcrumb">
        <div class="abdul-breadcrumb-nav">
            <a href="{{ url('/') }}">Home</a>
            <span>></span>
            <a href="{{ route('blogs.index') }}">Blogs</a>
            <span>></span>
            <span>{{ Str::limit($blog->title, 30) }}</span>
        </div>
        <div class="abdul-actions">
            <button class="abdul-action-btn" onclick="window.print()">
                <i class="fas fa-print"></i> Print
            </button>
            <button class="abdul-action-btn" onclick="toggleDarkMode()">
                <i class="fas fa-moon"></i> Dark Mode
            </button>
        </div>
    </div>

    <!-- Floating Share Buttons -->
    <div class="abdul-share-floating">
        <button class="abdul-share-btn" onclick="shareOnFacebook()">
            <i class="fab fa-facebook-f"></i>
        </button>
        <button class="abdul-share-btn" onclick="shareOnTwitter()">
            <i class="fab fa-twitter"></i>
        </button>
        <button class="abdul-share-btn" onclick="shareOnLinkedIn()">
            <i class="fab fa-linkedin-in"></i>
        </button>
        <button class="abdul-share-btn" onclick="copyLink()">
            <i class="fas fa-link"></i>
        </button>
    </div>

    <!-- Main Blog Card -->
    <article class="abdul-blog-card">
        @if($blog->image)
            <div class="abdul-image-container">
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                <div class="abdul-image-overlay">
                    <div class="abdul-badge-container">
                        @if($blog->category)
                            <a href="{{ route('blogs.category', $blog->category->slug) }}" class="abdul-badge">
                                {{ $blog->category->name }}
                            </a>
                        @endif
                        <span class="abdul-badge abdul-badge-secondary">
                            {{ $blog->reading_time ?? '5' }} min read
                        </span>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="abdul-card-body">
            @if(!$blog->image)
                <div class="abdul-badge-container">
                    @if($blog->category)
                        <a href="{{ route('blogs.category', $blog->category->slug) }}" class="abdul-badge">
                            {{ $blog->category->name }}
                        </a>
                    @endif
                    <span class="abdul-badge abdul-badge-secondary">
                        {{ $blog->reading_time ?? '5' }} min read
                    </span>
                </div>
            @endif
            
            <h1 class="abdul-card-title">{{ $blog->title }}</h1>
            
            <div class="abdul-card-content">
                {!! $blog->content !!}
            </div>
        </div>
        
        <div class="abdul-card-meta">
            <div class="abdul-author-info">
                <div class="abdul-author-avatar">
                    {{ substr($blog->author, 0, 1) }}
                </div>
                <div class="abdul-author-details">
                    <span class="abdul-author-name">{{ $blog->author }}</span>
                    <small>Posted on {{ $blog->created_at->format('F d, Y') }}</small>
                </div>
            </div>
            
            <div class="abdul-meta-stats">
                <span class="abdul-meta-item">
                    <i class="fas fa-eye"></i> Views: <b>{{ $blog->is_view ?? 0 }}</b>
                </span>
                <span class="abdul-meta-item">
                    <i class="far fa-comment"></i> Comments: <b>0</b>
                </span>
                <span class="abdul-meta-item">
                    <i class="fas fa-heart"></i> Likes: <b>0</b>
                </span>
            </div>
            
            <span class="abdul-post-date">
                <i class="far fa-calendar-alt"></i>
                {{ $blog->created_at->format('M d, Y') }}
            </span>
        </div>
    </article>

    <!-- Related Posts Section -->
    @if(isset($relatedPosts) && $relatedPosts->count() > 0)
        <div class="abdul-extra-sections">
            <h3 class="abdul-section-title">Related Articles</h3>
            <div class="row">
                @foreach($relatedPosts as $related)
                    <div class="col-md-4 mb-4">
                        <div class="abdul-related-card">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}">
                            @endif
                            <div class="abdul-related-body">
                                <h4>{{ $related->title }}</h4>
                                <a href="{{ route('blogs.show', $related->slug) }}" class="abdul-read-more">Read More →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Comments Section -->
    <div class="abdul-extra-sections">
        <h3 class="abdul-section-title">Comments (0)</h3>
        <div class="abdul-comments-section">
            <p>No comments yet. Be the first to comment!</p>
            <!-- Add comment form here -->
        </div>
    </div>
</div>

<script>
    // Dark Mode Toggle
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
    }

    // Check for saved dark mode preference
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }

    // Social Sharing Functions
    function shareOnFacebook() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
    }

    function shareOnTwitter() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent("{{ $blog->title }}");
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
    }

    function shareOnLinkedIn() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank');
    }

    function copyLink() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('Link copied to clipboard!');
        });
    }

    // Image lazy loading
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.abdul-blog-card img');
        
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    });
</script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection