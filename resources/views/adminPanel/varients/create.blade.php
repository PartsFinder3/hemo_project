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
                    <h3>Car Varients</h3>
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
                    <form action="{{ route('varient.create',$model->id) }}" method="POST" class="form form-vertical"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Varient Name</label>
                                        <input type="text" id="email-id-vertical" class="form-control" name="name"
                                            placeholder="Varient Name">
                                    </div>
                                </div>
                               <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Fuel Type</label>
                                        <select class="form-select form-select-lg" name="fuel_id" id="">
                                            <option selected>Select one</option>
                                            @foreach ($fuel as $data)
                                                <option value="{{ $data->id }}">{{ $data->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Engine Size</label>
                                        <select class="form-select form-select-lg" name="engine_size_id" id="">
                                            <option selected>Select one</option>
                                            @foreach ($engine as $data)
                                                <option value="{{ $data->id }}">{{ $data->size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Transmission</label>
                                        <select class="form-select form-select-lg" name="transmission" id="">
                                            <option selected>Select one</option>
                                            <option value="Manual">Manual</option>
                                            <option value="Automatic">Automatic</option>
                                            <option value="CVT">CVT</option>
                                            <option value="Semi-Automatic">Semi-Automatic</option>
                                            <option value="Dual-Clutch">Dual-Clutch</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
