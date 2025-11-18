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
                    <h3>Add Couriers</h3>
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
                        <!--Modal lg size -->
                        <div class="me-1 mb-1 d-inline-block">
                            <!-- Button trigger for large size modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#large">
                                Add Couriers
                            </button>
                            <!--large size Modal -->
                            <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel17" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel17">Add Couriers</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.couriers.store') }}" method="POST"
                                                class="form form-vertical" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label for="name">Company Name</label>
                                                            <input type="text" id="name" class="form-control"
                                                                name="name" placeholder="Enter Company Name">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="email">Address</label>
                                                            <input type="text" id="email" class="form-control"
                                                                name="address" placeholder="Enter Company Address">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" id="phone" class="form-control"
                                                                name="phone" placeholder="Enter Company Phone">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="role">Shipping Countries</label>
                                                            <textarea name="countries" id="" class="form-control" placeholder="UAE,Oman,Saudi Arabia etc"></textarea>
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end gap-2">
                                                            <button type="submit" class="btn btn-primary">Add</button>
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Shipping Countries</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($couriers as $courier)
                                <tr>
                                    <td>{{ $courier->name }}</td>
                                    <td>{{ $courier->address }}</td>
                                    <td>{{ $courier->phone }}</td>
                                    <td>{{ $courier->countries }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.couriers.edit', $courier->id) }}"
                                            class="btn btn-sm btn-primary me-1">Edit</a>
                                        <form action="{{ route('admin.couriers.delete', $courier->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this courier?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
