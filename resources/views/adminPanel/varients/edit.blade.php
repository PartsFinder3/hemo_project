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
                    <h3>Edit Spare Parts</h3>
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
                    <form action="{{ route('varient.update', $variant->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Variant Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $variant->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fuel Type</label>
                            <select name="fuel_id" class="form-select" required>
                                <option selected value="{{ $variant->fuel->id }}">{{ $variant->fuel->type }}</option>
                                @foreach ($fuels as $fuel)
                                    <option value="{{ $fuel->id }}">{{ $fuel->type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Engine Size</label>
                            <select name="engine_size_id" class="form-select" required>
                                @foreach ($engineSizes as $engine)
                                    <option value="{{ $engine->id }}"
                                        {{ $engine->id == $variant->engine_size_id ? 'selected' : '' }}>
                                        {{ $engine->size }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Transmission</label>
                            <select name="transmission" class="form-select" required>
                                <option selected value="{{ $variant->transmission }}">{{ $variant->transmission }}
                                </option>
                                <option value="Manual">Manual</option>
                                <option value="Automatic">Automatic</option>
                                <option value="CVT">CVT</option>
                                <option value="Semi-Automatic">Semi-Automatic</option>
                                <option value="Dual-Clutch">Dual-Clutch</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Variant</button>
                    </form>

                </div>
            </div>

        </section>
    </div>
@endsection
