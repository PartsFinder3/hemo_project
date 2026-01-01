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
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#large">
                        <i class="fa-solid fa-plus me-1"></i> Add Supplier
                    </button>
                </div>

        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-left">
                    {{-- <h5 class="card-title">
                        Total Domains
                    </h5> --}}
                  
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
                                                    onclick="contactSupplier('{{  $request->name }}', '{{  $request->whatsapp }}', '{{  $request->business_name }}')">
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

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label fw-semibold">
                    <i class="fas fa-user me-2"></i>Full Name
                </label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">
                    <i class="fas fa-building me-2"></i>Business Name
                </label>
                <input type="text" class="form-control" name="business_name" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">
                    <i class="fas fa-city me-2"></i>City
                </label>
                <select class="form-select" name="city_id" required>
                    <option disabled selected>Select City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">
                    <i class="fas fa-envelope me-2"></i>Email
                </label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">
                    <i class="fas fa-flag me-2"></i>Country Code
                </label>
                <select class="form-select" name="country_code">
                    @include('Frontend.contries')
                </select>
            </div>

            <div class="col-md-8">
                <label class="form-label fw-semibold">
                    <i class="fas fa-phone me-2"></i>Phone Number
                </label>
                <input type="tel" class="form-control" name="phone" required>
            </div>

        </div>

        <div class="modal-footer border-0 mt-4">
            <button type="submit" class="btn btn-success w-100">
                <i class="fas fa-check-circle me-1"></i> Save Supplier
            </button>
        </div>
    </form>
</div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
       function contactSupplier(name, whatsapp, business_name, isActive) {
                    if (isActive === '1') {
                        const message = `
                Hello, ${name}
                ${business_name}

                We offer free ad posting for auto spare parts sellers on our official website:
                *partsfinder.ae*

                If you have an auto parts shop in the UAE, you can list your products with us completely free.
                I will give you a free-of-cost customer to help increase your business.

                Let us know if you’re interested.
                        `;

                        // Encode message for URL
                        const encodedMessage = encodeURIComponent(message);

                        // Clean WhatsApp number (only digits)
                        const cleanWhatsapp = whatsapp.replace(/\D/g, '');

                        // Open WhatsApp chat
                        window.open(`https://wa.me/${cleanWhatsapp}?text=${encodedMessage}`, '_blank');
                    } else {
                        alert('Supplier is currently inactive');
                    }
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
.modal-content {
    border-radius: 12px;
}

.modal-header {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.form-control, .form-select {
    border-radius: 8px;
}

    </style>
@endsection
