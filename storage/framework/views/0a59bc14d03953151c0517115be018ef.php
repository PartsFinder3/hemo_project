<?php $__env->startSection('main-section'); ?>
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
                

                <div class="blog-grid" id="blogGrid">
                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="blog-card">
                            <img src="<?php echo e(asset('storage/' . $b->image)); ?>" alt="JavaScript Tips">
                            <div class="card-body">
                                <span class="badge javascript"><?php echo e($b->category->name); ?></span>
                                <h2 class="card-title"><?php echo e($b->title); ?></h2>
                                <p class="card-text"><?php echo e(Str::limit(strip_tags($b->content), 150, '...')); ?></p>
                                <div class="card-meta">
                                    <div class="author-info">
                                        <span class="author-name"><?php echo e($b->author); ?></span>
                                        <span>Views:<b><?php echo e($b->is_view); ?></b></span>
                                    </div>
                                    <span class="post-date"><?php echo e($b->created_at->format('M d, Y')); ?></span>
                                    <span>
                                        <a href="<?php echo e(route('frontend.blog.view', ['slug' => $b->slug, 'id' => $b->id])); ?>"
                                            style="text-decoration: none; color: var(--primary-color); background: var(--accent-color); padding: 8px 10px; width: 60px;"
                                            class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                                    </span>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <a style="text-decoration: none; color: var(--secondary-color);" href="<?php echo e(route('frontend.blogs')); ?>" class="category-item" onclick="filterPosts('javascript')">
                            <span>All</span>
                            <span class="badge-count"><?php echo e($blogs->count()); ?></span>
                    </a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $categoryBlogs = $c->blogs()->count();
                        ?>
                        <a style="text-decoration: none; color: var(--secondary-color);" href="<?php echo e(route('frontend.blogs.category',$c->id)); ?>" class="category-item" onclick="filterPosts('javascript')">
                            <span><?php echo e($c->name); ?></span>
                            <span class="badge-count"><?php echo e($categoryBlogs); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.blogs.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\hemo_project\resources\views/Frontend/blogs/index.blade.php ENDPATH**/ ?>