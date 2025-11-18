@extends('supplierPanel.layout.main')
@section('main-section')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="col-md-10">
                    <!-- Top Navigation -->
                    @php
                        $shop_id = Auth::guard('supplier')->user()->shop->id;
                    @endphp
                    <div class="row mb-4">
                        <!-- Links -->
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-wrap align-items-center">
                            <a class="text-decoration-none me-3 fw-semibold"
                                href="{{ route('supplier.ads.index', $shop_id) }}">All Ads</a>
                            <a class="text-decoration-none me-3 fw-semibold"
                                href="{{ route('supplier.ads.active', $shop_id) }}">Active
                                Ads</a>
                            <a class="text-decoration-none me-3 fw-semibold"
                                href="{{ route('supplier.ads.inactive', $shop_id) }}">Inactive
                                Ads</a>
                            <a class="text-decoration-none me-3 fw-semibold"
                                href="{{ route('supplier.ads.approved', $shop_id) }}">Approved Ads</a>
                            <a class="text-decoration-none fw-semibold"
                                href="{{ route('shop.ads.waiting', $shop_id) }}">Waiting for
                                Approval</a>
                        </div>

                        <!-- Buttons -->
                        <!-- Buttons -->
                        <div class="col-12 col-md-4 d-flex justify-content-md-end flex-wrap gap-2">
                            <a class="btn btn-orange" href="{{ route('shop.supplier.ads.create') }}">
                                <i class="bi bi-plus-circle me-1"></i> Create New Ad
                            </a>
                            <a class="btn btn-red" href="{{ route('shop.supplier.ads.createCar') }}">
                                <i class="bi bi-car-front me-1"></i> Car Breaking Ad
                            </a>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-center">
                                <!-- Ad Form -->
                                <div class="col">
                                    <!-- Display validation errors -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('shop.supplier.ads.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        <h2 class="text-sm">Spare Part Information</h2>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Make</label>
                                            <select class="form-select form-select-lg" name="car_make_id" id="carMake">
                                                <option value="">Select one</option>
                                                @foreach ($makes as $make)
                                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                                @endforeach
                                            </select>
                                            {{-- @error()

                                            @enderror --}}
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Model</label>
                                            <select class="form-select form-select-lg" name="car_model_id" id="carModel">
                                                <option value="">Select one</option>
                                                {{-- @foreach ($models as $model)
                                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Year</label>
                                            <select class="form-select form-select-lg" name="year_id" id="">
                                                <option selected>Select one</option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Fuel</label>
                                            <select class="form-select form-select-lg" name="fuel_id" id="">
                                                <option value="">Select one</option>
                                                {{-- <option value="999">N/A</option> --}}
                                                @foreach ($fuels as $fuel)
                                                    <option value="{{ $fuel->id }}">{{ $fuel->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Engine Size</label>
                                            <select class="form-select form-select-lg" name="engine_size_id" id="">
                                                <option value="">Select one</option>
                                                {{-- <option value="999">N/A</option> --}}
                                                @foreach ($engineSize as $size)
                                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Spare Part</label>
                                            <select class="form-select form-select-lg" name="part_id" id="">
                                                <option selected>Select one</option>
                                                @foreach ($parts as $part)
                                                    <option value="{{ $part->id }}">{{ $part->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Condition</label>
                                            <select class="form-select form-select-lg" name="condition" id="">
                                                <option selected>Select one</option>
                                                <option value="new">New</option>
                                                <option value="used">Used</option>
                                                <option value="refurbished">Refurbished</option>
                                            </select>
                                        </div>
                                        <h2 class="text-sm">Ad Information</h2>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" id="titleField"
                                                placeholder="Auto Generated" />

                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Price</label>
                                            <input type="text" class="form-control" name="price" id=""
                                                aria-describedby="helpId" placeholder="" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Warranty</label>
                                            <select name="warranty" id="days" class="form-control">
                                                <option value="" selected disabled>Select Warranty</option>
                                                @for ($i = 0; $i <= 30; $i++)
                                                    <option value="{{ $i }} Day{{ $i > 1 ? 's' : '' }}">
                                                        {{ $i }} Day{{ $i > 1 ? 's' : '' }}</option>
                                                @endfor
                                            </select>

                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Delivery</label>
                                            <select name="delivery" id="delivery" class="form-control">
                                                <option value="" selected disabled>Select Delivery Option</option>
                                                <option value="Available">Available</option>
                                                <option value="Not Available">Not Available</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Images</label>
                                            <input type="file" class="form-control" name="images[]" id=""
                                                multiple aria-describedby="helpId" placeholder="" />
                                            <span class="uploadedImages">
                                                <img src="" alt="" />
                                            </span>
                                        </div>

                                        <button type="submit" class="btn btn-orange">Create Ad</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // When Make is selected → fetch Models
            $('#carMake').change(function() {
                let makeId = $(this).val();
                $('#carModel').empty().append('<option value="">Select one</option>');
                $('#fuelSelect').empty().append('<option value="">Select one</option>');
                $('#engineSelect').empty().append('<option value="">Select one</option>');

                if (makeId) {
                    $.get('/get-models/' + makeId, function(data) {
                        $.each(data, function(index, model) {
                            $('#carModel').append('<option value="' + model.id + '">' +
                                model.name + '</option>');
                        });
                    });
                }
            });

            // When Model is selected → fetch Variants
            $('#carModel').change(function() {
                let modelId = $(this).val();
                $('#fuelSelect').empty().append('<option value="">Select one</option>');
                $('#engineSelect').empty().append('<option value="">Select one</option>');

                if (modelId) {
                    $.get('/get-variants/' + modelId, function(data) {
                        $.each(data.fuels, function(index, fuel) {
                            $('#fuelSelect').append('<option value="' + fuel.id + '">' +
                                fuel.type + '</option>');
                        });
                        $.each(data.engineSizes, function(index, size) {
                            $('#engineSelect').append('<option value="' + size.id + '">' +
                                size.size + '</option>');
                        });
                    });
                }
            });

            function updateTitle() {
                let make = $('#carMake option:selected').text();
                let model = $('#carModel option:selected').text();
                let year = $('select[name="year_id"] option:selected').text();
                let part = $('select[name="part_id"] option:selected').text();
                let fuel = $('#fuelSelect option:selected').text();
                let engine = $('#engineSelect option:selected').text();

                // Only add if value is not "Select one"
                let titleParts = [];
                if (make && make !== "Select one") titleParts.push(make);
                if (model && model !== "Select one") titleParts.push(model);
                if (year && year !== "Select one") titleParts.push(year);
                if (part && part !== "Select one") titleParts.push(part);
                if (fuel && fuel !== "Select one") titleParts.push(fuel);
                if (engine && engine !== "Select one") titleParts.push(engine);

                $('#titleField').val(titleParts.join(' - '));
            }

            // Trigger update on change
            $('#carMake, #carModel, select[name="year_id"], select[name="part_id"], #fuelSelect, #engineSelect')
                .change(updateTitle);

        });
    </script>
@endsection
