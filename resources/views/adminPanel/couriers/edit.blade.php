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
                    <h3>Edit</h3>
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
                    <form action="{{ route('admin.couriers.update',$courier->id) }}" method="POST" class="form form-vertical"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="name">Company Name</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Enter Company Name" value="{{ $courier->name }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="email">Address</label>
                                    <input type="text" id="email" class="form-control" name="address"
                                        placeholder="Enter Company Address" value="{{ $courier->address }}  ">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" class="form-control" name="phone"
                                        placeholder="Enter Company Phone" value="{{ $courier->phone }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="role">Shipping Countries</label>
                                    <textarea name="countries" id="" class="form-control" placeholder="UAE,Oman,Saudi Arabia etc">
                                        {{ $courier->countries }}
                                    </textarea>
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

        </section>
    </div>
@endsection
