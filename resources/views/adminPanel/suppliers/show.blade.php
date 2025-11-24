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
                                            <form action="{{ route('suppliers.active.toggle', $supplier->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <label class="switch">
                                                    <input type="checkbox" name="is_active" onchange="this.form.submit()" {{ $supplier->is_active ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </form>


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
    <style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0;
  right: 0; bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 24px;
}

/* The slider before (the circle) */
.slider:before {
  position: absolute;
  content: "";
  height: 18px; width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

/* When checked */
input:checked + .slider {
  background-color: #2196F3; /* blue */
}

input:checked + .slider:before {
  transform: translateX(26px);
}

/* Blur effect when not active */
input:not(:checked) + .slider {
  filter: blur(1px);
}
</style>
@endsection
