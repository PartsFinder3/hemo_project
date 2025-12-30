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
                    <h3>Supplier Requests</h3>
                </div>
            </div>
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#large">
    Add Supplier
</button>

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
                                <th>Business Name</th>
                                <th>City</th>
                                <th>Email</th>
                                <th>WhatsApp</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td>{{ $request->name }}</td>
                                    <td>{{ $request->business_name }}</td>
                                    <td>{{ $request->city->name }}</td>
                                   <td>{{ \Illuminate\Support\Str::limit($request->email, 20) }}</td>
                                    <td>{{ $request->whatsapp }}</td>
                                    <td>
                                        @if ($request->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="d-flex gap-2 flex-wrap justify-content-center align-items-center">
                                            <a class="btn btn-sm btn-primary">
                                                <form action="{{ route('supplier.approve', $request->id) }}" method="POST">
                                                    @csrf
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    <button class="btn-transparent" type="submit">Approve</button>
                                                </form>
                                            </a>
                                            <a class="btn btn-sm btn-warning" href="{{ route('supplier.reject', $request->id) }}"><i
                                                    class="fa-solid fa-trash"></i>
                                                Reject</a>
                                        </span>
                                         <a href="javascript:void(0)" class="btn bt_sup_whatsapp"
                                                    onclick="contactSupplier('{{ $request->whatsapp }}')">
                                                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                                </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="d-flex justify-content-center mt-3">
    {{ $requests->links() }}
</div>
                </div>
            </div>

        </section>
    </div>

<div class="modal fade" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Supplier</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('supplier.create.add.admin') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="abdul-form-label">
                            <i class="fas fa-user me-2"></i>Full Name
                        </label>
                        <input type="text" class="abdul-form-control"
                               placeholder="Enter your full name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="abdul-form-label">
                            <i class="fas fa-building me-2"></i>Business Name
                        </label>
                        <input type="text" class="abdul-form-control"
                               placeholder="Enter your business name" name="business_name" required>
                    </div>

                    <div class="mb-3">
                        <label class="abdul-form-label">
                            <i class="fas fa-city me-2"></i>Select City
                        </label>
                        <select class="abdul-form-select" name="city_id" required>
                            <option value="" disabled selected>Choose city</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="abdul-form-label">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <input type="email" class="abdul-form-control"
                               placeholder="Enter your email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label class="abdul-form-label">
                            <i class="fas fa-phone me-2"></i>Country Code
                        </label>
                        <select class="abdul-form-select" name="country_code">
                            <option value="">Select Country</option>
                            @include('Frontend.contries')
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="abdul-form-label">
                            <i class="fas fa-phone me-2"></i>Phone Number
                        </label>
                        <input type="tel" class="abdul-form-control"
                               placeholder="Enter phone number" name="phone" required>
                    </div>

                    <button type="submit" class="abdul-btn-signup w-100">
                        <i class="fas fa-user-check me-2"></i> Sign Up
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

    <script>
        function contactSupplier(whatsapp) {
                const cleanWhatsapp = whatsapp.replace(/\D/g, '');
                window.open(`https://wa.me/${cleanWhatsapp}`, '_blank');
          
        }
    </script>
    <style>
  .bt_sup_whatsapp{
  width: 110px;
    height: 48px;
    color: green;
    background: white;
    padding-top: 1px;
  }

    </style>
@endsection
