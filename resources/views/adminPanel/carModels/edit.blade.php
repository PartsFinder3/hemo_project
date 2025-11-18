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
                    <h3>Car Models</h3>
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
                    <form action="{{ route('model.update', $model->id) }}" method="POST" class="form form-vertical">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Car Make</label>
                                        <select
                                            class="form-select form-select-lg @error('car_make_id') is-invalid @enderror"
                                            name="car_make_id">
                                            <option value="">Select Car Make</option>
                                            @foreach ($makes as $make)
                                                <option value="{{ $make->id }}"
                                                    {{ $model->car_make_id == $make->id ? 'selected' : '' }}>
                                                    {{ $make->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('car_make_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="model-name">Model Name</label>
                                        <input type="text" id="model-name"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            placeholder="Model Name" value="{{ old('name', $model->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="year-start" class="form-label">Starting Year</label>
                                        <input type="text" id="year-start"
                                            class="form-control @error('year_start') is-invalid @enderror" name="year_start"
                                            placeholder="Starting Year" value="{{ old('year_start', $model->year_start) }}">
                                        @error('year_start')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="year-end" class="form-label">Ending Year (Empty if model
                                            continues)</label>
                                        <input type="text" id="year-end"
                                            class="form-control @error('year_end') is-invalid @enderror" name="year_end"
                                            placeholder="Ending Year" value="{{ old('year_end', $model->year_end) }}">
                                        @error('year_end')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
