@extends('adminPanel.layout.main')

@section('main-section')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Suppliers</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first text-end">
                <!-- Search box -->
                <div class="input-group">
                    <input type="text" id="tableSearch" class="form-control" placeholder="Search suppliers...">
                    <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-left">
                <div class="col-12 col-md-6 order-md-2 order-first">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>City</th>
                            <th>WhatsApp</th>
                            @if(auth()->guard('admins')->user()->role == 'admin')
                                <th>Active</th>
                                <th>Verified</th>
                            @endif
                            <th>Active-Shop</th>
                            @if(auth()->guard('admins')->user()->role == 'admin')
                                <th>Invoice</th>
                            @endif
                            <th>Shop</th>
                            @if(auth()->guard('admins')->user()->role == 'admin')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->city->name }}</td>
                            <td>{{ $supplier->whatsapp }}</td>
                            @if(auth()->guard('admins')->user()->role == 'admin')
                            <td>
                                @if($supplier->subscription_status === 'active')
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Active</span>
                                @else
                                    <span class="badge bg-secondary"><i class="bi bi-x-circle"></i> Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($supplier->is_verified)
                                    <a href="{{ route('suppliers.verified.toggle', $supplier->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-shield-slash"></i> Unverify
                                    </a>
                                @else
                                    <a href="{{ route('suppliers.verified.toggle', $supplier->id) }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-shield-check"></i> Verify
                                    </a>
                                @endif
                            </td>
                            @endif
                            <td>
                                @if($supplier->shop)
                                    @if($supplier->shop->is_active)
                                        <a href="{{ route('shops.toggle', $supplier->id) }}" class="btn btn-sm btn-danger">
                                            <i class="bi bi-ban"></i> Ban
                                        </a>
                                    @else
                                        <a href="{{ route('shops.toggle', $supplier->id) }}" class="btn btn-sm btn-success">
                                            <i class="bi bi-check-circle"></i> Unban
                                        </a>
                                    @endif
                                @else
                                    <form action="{{ route('shops.create', $supplier->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-shop"></i> Create
                                        </button>
                                    </form>
                                @endif
                            </td>
                            @if(auth()->guard('admins')->user()->role == 'admin')
                            <td>
                                <a href="{{ route('invoices.create', $supplier->id) }}" class="btn btn-sm btn-light">
                                    <i class="bi bi-receipt"></i> Generate
                                </a>
                            </td>
                            @endif
                            <td>
                                @if($supplier->shop)
                                    <a href="{{ route('shops.view', $supplier->shop->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                @else
                                    <span class="badge bg-warning">No Shop</span>
                                @endif
                            </td>
                            @if(auth()->guard('admins')->user()->role == 'admin')
                            <td>
                                <a href="{{ route('payment.create.show', $supplier->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-credit-card"></i> Payment
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<style>
    .datatable-container {
        overflow-x: auto;
    }
    .datatable-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .datatable-search {
        flex-grow: 1;
        margin-left: 1rem;
    }
    .datatable-selector {
        min-width: 120px;
    }
    .datatable-pagination {
        margin-top: 1rem;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if simpleDatatables is loaded
    if (typeof simpleDatatables === 'undefined') {
        console.error('Simple-DataTables library not loaded!');
        return;
    }

    // Destroy existing instances if any
    if (window.dataTableInstance) {
        window.dataTableInstance.destroy();
    }

    // Initialize Simple-DataTables
    window.dataTableInstance = new simpleDatatables.DataTable("#table1", {
        perPage: 10,
        perPageSelect: [5, 10, 25, 50, 100],
        searchable: true,
        sortable: true,
        fixedHeight: false,
        labels: {
            placeholder: "Search suppliers...",
            perPage: "{select} records per page",
            noRows: "No suppliers found",
            info: "Showing {start} to {end} of {rows} entries",
        }
    });

    // Get the table wrapper element
    const tableWrapper = document.querySelector('.datatable-wrapper');
    
    // Create a custom search input
    const customSearch = document.getElementById('tableSearch');
    const clearSearchBtn = document.getElementById('clearSearch');

    // Search function
    customSearch.addEventListener('input', function() {
        window.dataTableInstance.search(this.value);
        if (this.value) {
            clearSearchBtn.style.display = 'block';
        } else {
            clearSearchBtn.style.display = 'none';
        }
    });

    // Clear search function
    clearSearchBtn.addEventListener('click', function() {
        customSearch.value = '';
        window.dataTableInstance.search('');
        this.style.display = 'none';
    });

    // Hide clear button initially
    clearSearchBtn.style.display = 'none';

    // Move the built-in search box to our custom location if needed
    setTimeout(() => {
        const builtInSearch = document.querySelector('.datatable-search input');
        if (builtInSearch) {
            builtInSearch.style.display = 'none'; // Hide the default search
        }
    }, 100);

    // Add responsive breakpoints
    function handleResize() {
        const screenWidth = window.innerWidth;
        if (screenWidth < 768) {
            window.dataTableInstance.options.perPage = 5;
        } else {
            window.dataTableInstance.options.perPage = 10;
        }
        window.dataTableInstance.refresh();
    }

    // Initial resize
    handleResize();
    
    // Listen for window resize
    window.addEventListener('resize', handleResize);
});
</script>

@endsection