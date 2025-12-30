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
                                    <td>{{ $request->email }}</td>
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
                                         <a href="javascript:void(0)" class="btn whatsapp"
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
    <script>
        function contactSupplier(whatsapp) {
                const cleanWhatsapp = whatsapp.replace(/\D/g, '');
                window.open(`https://wa.me/${cleanWhatsapp}`, '_blank');
          
        }
    </script>
@endsection
