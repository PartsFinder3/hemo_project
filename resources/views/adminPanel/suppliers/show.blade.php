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
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-left">
                    {{-- <h5 class="card-title">
                        Total Domains
                    </h5> --}}
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @else
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
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
                                @if (auth()->guard('admins')->user()->role == 'admin')
                                    <th>Active</th>
                                    <th>Verified</th>
                                @endif
                                <th>Active-Shop</th>
                                @if (auth()->guard('admins')->user()->role == 'admin')
                                    <th>Invoice</th>
                                @endif
                                <th>Shop</th>
                                @if (auth()->guard('admins')->user()->role == 'admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>
                                        @if (auth()->guard('admins')->user()->role == 'admin')
                                            <a href="{{ route('payment.index', $supplier->id) }}"
                                                class="text-decoration-none fw-semibold">
                                                {{ $supplier->name }}

                                            </a>
                                        @else
                                            <span class="text-decoration-none fw-semibold">
                                                {{ $supplier->name }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $supplier->city->name }}</td>
                                    <td>{{ $supplier->whatsapp }}</td>
                                    @if (auth()->guard('admins')->user()->role == 'admin')
                                      <td>
                                                @if ($supplier->subscription_status === "active")
                                                    <button class="btn btn-primary">
                                                        <i class="fa fa-check"></i> <!-- Active -->
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary">
                                                        <i class="fa fa-times"></i> <!-- Inactive -->
                                                    </button>
                                                @endif
                                        <td>
                                            @if ($supplier->is_verified)
                                                <a href="{{ route('suppliers.verified.toggle', $supplier->id) }}"
                                                    class="btn btn-warning">Unverify</a>
                                            @else
                                                <a href="{{ route('suppliers.verified.toggle', $supplier->id) }}"
                                                    class="btn btn-success">Verify</a>
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if ($supplier->shop)
                                            @if ($supplier->shop->is_active)
                                                <a href="{{ route('shops.toggle', $supplier->id) }}"
                                                    class="btn btn-danger">Ban</a>
                                            @else
                                                <a href="{{ route('shops.toggle', $supplier->id) }}"
                                                    class="btn btn-success">Unban</a>
                                            @endif
                                        @else
                                            <form action="{{ route('shops.create', $supplier->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Create</button>
                                            </form>
                                        @endif
                                    </td>
                                    @if (auth()->guard('admins')->user()->role == 'admin')
                                        <td>
                                            <a href="{{ route('invoices.create', $supplier->id) }}"
                                                class="btn btn-sm btn-light">Generate</a>
                                        </td>
                                    @endif
                                    <td>
                                        @if ($supplier->shop)
                                            <a href="{{ route('shops.view', $supplier->shop->id) }}"
                                                class="btn btn-sm btn-primary">View</a>
                                        @endif
                                    </td>
                                    @if (auth()->guard('admins')->user()->role == 'admin')
                                        <td>
                                            <a href="{{ route('payment.create.show', $supplier->id) }}"
                                                class="btn btn-sm btn-info">Payment</a>
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
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dataTable = new simpleDatatables.DataTable("#table1", {
            perPage: 100,              // default entries
            perPageSelect: [10, 25, 50, 100, 200] // dropdown options
        });
    });
</script>
