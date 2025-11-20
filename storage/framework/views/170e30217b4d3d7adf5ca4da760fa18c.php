<?php $__env->startSection('main-section'); ?>

    <!-- Search Section -->
    <div class="search-section py-4 bg-light">
        <div class="container">
            <!-- Mobile Toggle Button -->
            <div class="d-lg-none mb-3">
                <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse"
                    data-bs-target="#searchFilters" aria-expanded="false">
                    <i class="fas fa-search me-2"></i> Show Filters
                    <i class="fas fa-chevron-down ms-2"></i>
                </button>
            </div>

            <!-- Collapsible Search Form -->
            <div class="collapse show" id="searchFilters">
                <form method="GET" action="<?php echo e(route('supplier.panel')); ?>">
                    <div class="row g-3 mb-3">
                        <!-- Time Range -->
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label d-block d-lg-none">Time Range</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <select class="form-select" name="time_range">
                                    <option value="">All Time</option>
                                    <option value="24h" <?php echo e(request('time_range') == '24h' ? 'selected' : ''); ?>>Last 24
                                        Hours</option>
                                    <option value="7d" <?php echo e(request('time_range') == '7d' ? 'selected' : ''); ?>>Last 7 Days
                                    </option>
                                    <option value="30d" <?php echo e(request('time_range') == '30d' ? 'selected' : ''); ?>>Last 30
                                        Days</option>
                                    <option value="1y" <?php echo e(request('time_range') == '1y' ? 'selected' : ''); ?>>Last Year
                                    </option>
                                    <option value="custom" <?php echo e(request('time_range') == 'custom' ? 'selected' : ''); ?>>Custom
                                        Range</option>
                                </select>
                            </div>
                        </div>

                        <!-- Make -->
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label d-block d-lg-none">Make</label>
                            <select class="form-select" name="make" id="makeSelect">
                                <option value="">Select Make</option>
                                <?php $__currentLoopData = $makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($make->id); ?>"
                                        <?php echo e(request('make') == $make->id ? 'selected' : ''); ?>><?php echo e($make->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Model -->
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label d-block d-lg-none">Model</label>
                            <select class="form-select" name="model" id="modelSelect">
                                <option value="">Select Model</option>
                                <?php if(request('make')): ?>
                                    <?php $__currentLoopData = \App\Models\CarModels::where('car_make_id', request('make'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($model->id); ?>"
                                            <?php echo e(request('model') == $model->id ? 'selected' : ''); ?>><?php echo e($model->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- City -->
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label d-block d-lg-none">City</label>
                            <select class="form-select" name="city">
                                <option value="">All Cities</option>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($city->id); ?>"
                                        <?php echo e(request('city') == $city->id ? 'selected' : ''); ?>><?php echo e($city->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Min Year -->
                        <div class="col-lg-1 col-md-6">
                            <label class="form-label d-block d-lg-none">Min Year</label>
                            <select class="form-select" name="min_year">
                                <option value="">Min</option>
                                <?php for($year = date('Y'); $year >= 2000; $year--): ?>
                                    <option value="<?php echo e($year); ?>"
                                        <?php echo e(request('min_year') == $year ? 'selected' : ''); ?>><?php echo e($year); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Max Year -->
                        <div class="col-lg-1 col-md-6">
                            <label class="form-label d-block d-lg-none">Max Year</label>
                            <select class="form-select" name="max_year">
                                <option value="">Max</option>
                                <?php for($year = date('Y'); $year >= 2000; $year--): ?>
                                    <option value="<?php echo e($year); ?>"
                                        <?php echo e(request('max_year') == $year ? 'selected' : ''); ?>><?php echo e($year); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Parts & Action Buttons -->
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-4 col-md-6">
                            <label class="form-label d-block d-lg-none">Parts</label>
                            <input type="text" class="form-control" name="parts" placeholder="Search parts..."
                                value="<?php echo e(request('parts')); ?>">
                        </div>
                        <div class="col-lg-2 d-none d-lg-block">
                            <button type="submit" class="btn btn-primary w-100"><i
                                    class="fas fa-search me-2"></i>Search</button>
                        </div>
                        <div class="col-lg-2 d-none d-lg-block">
                            <a href="<?php echo e(route('supplier.panel')); ?>" class="btn btn-outline-secondary w-100"><i
                                    class="fas fa-times me-2"></i>Clear</a>
                        </div>
                    </div>

                    <!-- Custom Date Range -->
                    <div class="row g-3 mt-3" id="customDateRange"
                        style="display: <?php echo e(request('time_range') == 'custom' ? 'flex' : 'none'); ?>;">
                        <div class="col-12">
                            <div class="card border-primary shadow-sm">
                                <div class="card-header bg-primary text-white py-2">
                                    <h6 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Custom Date Range</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label"><i
                                                    class="fas fa-calendar-day text-success me-1"></i>From Date</label>
                                            <input type="date" name="from_date" class="form-control"
                                                value="<?php echo e(request('from_date')); ?>" max="<?php echo e(date('Y-m-d')); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"><i class="fas fa-calendar-day text-danger me-1"></i>To
                                                Date</label>
                                            <input type="date" name="to_date" class="form-control"
                                                value="<?php echo e(request('to_date')); ?>" max="<?php echo e(date('Y-m-d')); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Action Buttons -->
                    <div class="row g-3 mt-3 d-lg-none">
                        <div class="col-6"><button type="submit" class="btn btn-primary w-100"><i
                                    class="fas fa-search me-2"></i>Search</button></div>
                        <div class="col-6"><a href="<?php echo e(route('supplier.panel')); ?>"
                                class="btn btn-outline-secondary w-100"><i class="fas fa-times me-2"></i>Clear</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Active Filters -->
    <?php if(request()->hasAny(['make', 'model', 'parts', 'city', 'min_year', 'max_year', 'time_range', 'from_date', 'to_date'])): ?>
        <div class="container mt-3">
            <div class="alert alert-info d-flex flex-wrap justify-content-between align-items-center shadow-sm">
                <div>
                    <strong><i class="fas fa-filter me-2"></i>Active Filters:</strong>
                    <?php if(request('make')): ?>
                        <span class="badge bg-primary me-1">Make:
                            <?php echo e($makes->find(request('make'))->name ?? 'Unknown'); ?></span>
                    <?php endif; ?>
                    <?php if(request('model')): ?>
                        <span class="badge bg-primary me-1">Model:
                            <?php echo e(\App\Models\CarModels::find(request('model'))->name ?? 'Unknown'); ?></span>
                    <?php endif; ?>
                    <?php if(request('parts')): ?>
                        <span class="badge bg-primary me-1">Parts: <?php echo e(request('parts')); ?></span>
                    <?php endif; ?>
                    <?php if(request('city')): ?>
                        <span class="badge bg-primary me-1">City:
                            <?php echo e($cities->find(request('city'))->name ?? 'Unknown'); ?></span>
                    <?php endif; ?>
                    <?php if(request('min_year')): ?>
                        <span class="badge bg-success me-1">Min Year: <?php echo e(request('min_year')); ?></span>
                    <?php endif; ?>
                    <?php if(request('max_year')): ?>
                        <span class="badge bg-success me-1">Max Year: <?php echo e(request('max_year')); ?></span>
                    <?php endif; ?>
                    <?php if(request('time_range')): ?>
                        <span class="badge bg-warning me-1">Time:
                            <?php echo e(ucfirst(str_replace('_', ' ', request('time_range')))); ?></span>
                    <?php endif; ?>
                </div>
                <a href="<?php echo e(route('supplier.panel')); ?>" class="btn btn-sm btn-outline-danger"><i
                        class="fas fa-times me-1"></i>Clear All</a>
            </div>
        </div>
    <?php endif; ?>

    <!-- Inquiry Listings -->
    <div class="container mt-4">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php $uniqueUsages = $usages->unique('buyer_inquiry_id'); ?>

        <?php if($uniqueUsages->count() > 0): ?>
            <div class="row g-3">
                <?php $__currentLoopData = $uniqueUsages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $inquiry = $usage->buyerInquiry;
                        $shopPartIds = Auth::guard('supplier')->user()->shop->parts->pluck('part_id')->toArray();
                        $matchingParts = $inquiry->partsList->whereIn('id', $shopPartIds)->pluck('name')->toArray();
                    ?>

                    <?php if(count($matchingParts) > 0): ?>
                        <div class="col-md-12">
                            <div
                                class="card shadow-sm mb-3 <?php echo e($inquiry->inquiryUsages->where('buyer_inquiry_id', $inquiry->id)->first()?->is_open ? 'opacity-50' : ''); ?>">
                                <div class="card-body d-flex justify-content-between align-items-center">

                                    <!-- Left Content -->
                                    <div>
                                        <h6 class="card-title mb-2">
                                            <?php echo e($inquiry->carMake->name ?? 'Unknown'); ?>

                                            <?php echo e($inquiry->carModel->name ?? 'Unknown'); ?>

                                            <?php echo e($inquiry->year->year ?? 'Unknown'); ?>

                                        </h6>
                                        <p class="text-muted mb-1">
                                            <?php echo e($inquiry->buyer->city->name ?? 'United Arab Emirates'); ?> |
                                            Ref: PF-<?php echo e(str_pad($inquiry->id, 7, '0', STR_PAD_LEFT)); ?> |
                                            <?php echo e($inquiry->created_at->format('d-M-Y h:i A')); ?>

                                        </p>
                                        <p class="mb-1"><strong>Parts:</strong> <?php echo e(implode(', ', $matchingParts)); ?></p>
                                        <p class="mb-0"><strong>Condition:</strong>
                                            <?php echo e($inquiry->condition ?? 'Unknown'); ?></p>
                                    </div>

                                    <!-- Right Action Buttons (Icons Only) -->
                                    <div class="d-flex gap-4 ms-3">
                                        <span class="d-flex align-items-center flex-column text-center">
                                            <a href="tel:<?php echo e($inquiry->buyer->whatsapp ?? ''); ?>"
                                                class="btn  btn-info rounded-circle">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                            Click To Call
                                        </span>
                                        <span class="d-flex align-items-center flex-column text-center">
                                            <a href="<?php echo e(route('supplier.shop.whatsappQuote', $inquiry->id)); ?>"
                                            target="_blank" class="btn  btn-success rounded-circle">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        Click To WhatsApp
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="text-center text-muted">No inquiries found.</p>
        <?php endif; ?>
    </div>

    <?php
        $user = Auth::guard('supplier')->user();
        $has_shop = $user->shop->is_active;
        $shop_id = $user->shop->id;
    ?>

    <!-- Floating Create Ad Button -->
    <?php if($has_shop): ?>
        <a href="<?php echo e(route('supplier.ads.index', $shop_id)); ?>"
            class="position-fixed bottom-0 end-0 m-4 btn btn-danger btn-lg rounded-circle shadow-lg"
            style="width:60px;height:60px;display:flex;align-items:center;justify-content:center;">
            <i class="fas fa-plus"></i>
        </a>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        /* Modern clean styling */
        .search-section .form-label {
            font-weight: 500;
        }

        .listing-item .card {
            transition: transform 0.2s ease;
        }

        .listing-item .card:hover {
            transform: translateY(-3px);
        }

        .btn-orange {
            background-color: #ff6b00;
            color: #fff;
            border: none;
        }

        .btn-orange:hover {
            background-color: #e65a00;
            color: #fff;
        }

        .btn-red {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-red:hover {
            background-color: #c82333;
            color: #fff;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('supplierPanel.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\partsfinder\resources\views/supplierPanel/index.blade.php ENDPATH**/ ?>