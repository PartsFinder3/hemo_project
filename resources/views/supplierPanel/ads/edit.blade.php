@extends('supplierPanel.layout.main')
@section('main-section')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="col-md-10">
                    @php
                    $shop_id = Auth::guard('supplier')->user()->shop->id;
                @endphp
                    <!-- Top Navigation -->
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
                                href="{{ route('supplier.ads.approved',$shop_id) }}">Approved Ads</a>
                            <a class="text-decoration-none fw-semibold"
                                href="{{ route('shop.ads.waiting', $shop_id) }}">Waiting for
                                Approval</a>
                        </div>

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
                                    <form
                                        action="{{ route('supplier.ads.update', ['id' => $ad->id, 'slug' => $ad->slug]) }}"
                                        method="post" enctype="multipart/form-data">
                                        <h2 class="text-sm">Spare Part Information</h2>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Make</label>
                                            <select class="form-select form-select-lg" name="car_make_id" id="carMake">
                                                <option value="{{ $ad->car_make_id }}">{{ $ad->carMake->name }}</option>
                                                @foreach ($makes as $make)
                                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Model</label>
                                            <select class="form-select form-select-lg" name="car_model_id" id="carModel">
                                                <option value="{{ $ad->car_model_id }}">{{ $ad->carModel->name }}</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Year</label>
                                            <select class="form-select form-select-lg" name="year_id" id="">
                                                <option value="{{ $ad->year_id }}" selected>{{ $ad->year->year }}
                                                </option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Fuel</label>
                                       <select class="form-select form-select-lg" name="fuel_id" id="fuelSelect">
                                            <option value="0" {{ $ad->fuel_id == 0 ? 'selected' : '' }}>N/A</option>

                                            @foreach($fuels as $fuel)
                                                <option value="{{ $fuel->id }}" {{ $ad->fuel_id == $fuel->id ? 'selected' : '' }}>
                                                    {{ $fuel->type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Engine Size</label>
                                            <select class="form-select form-select-lg" name="engine_size_id"
                                                id="engineSelect">
                                                <option value="{{ $ad->engine_size_id }}">{{ $ad->engineSize->size }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Spare Part</label>
                                            <select class="form-select form-select-lg" name="part_id" id="">
                                                <option value="{{ $ad->part_id }}" selected>{{ $ad->part->name }}
                                                </option>
                                                @foreach ($parts as $part)
                                                    <option value="{{ $part->id }}">{{ $part->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Condition</label>
                                            <select class="form-select form-select-lg" name="condition" id="">
                                                <option value="{{ $ad->condition }}" selected>{{ $ad->condition }}
                                                </option>
                                                <option value="new">New</option>
                                                <option value="used">Used</option>
                                                <option value="refurbished">Refurbished</option>
                                            </select>
                                        </div>
                                        <h2 class="text-sm">Ad Information</h2>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title" id="titleField"
                                                value="{{ $ad->title }}" placeholder="Auto Generated" />

                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Price</label>
                                            <input type="text" class="form-control" name="price" id=""
                                                aria-describedby="helpId" placeholder="" value="{{ $ad->price }}" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Currency Type</label>

                                            <select class="form-select form-select-lg" name="currency" id="currency">
                                                <option disabled>Select Currency</option>

                                                <option value="AED" {{ $ad->currency == 'AED' ? 'selected' : '' }}>AED — UAE Dirham</option>
                                                <option value="USD" {{ $ad->currency == 'USD' ? 'selected' : '' }}>USD — US Dollar</option>
                                                <option value="SAR" {{ $ad->currency == 'SAR' ? 'selected' : '' }}>SAR — Saudi Riyal</option>
                                                <option value="PKR" {{ $ad->currency == 'PKR' ? 'selected' : '' }}>PKR — Pakistani Rupee</option>
                                                <option value="INR" {{ $ad->currency == 'INR' ? 'selected' : '' }}>INR — Indian Rupee</option>
                                                <option value="EUR" {{ $ad->currency == 'EUR' ? 'selected' : '' }}>EUR — Euro</option>
                                                <option value="GBP" {{ $ad->currency == 'GBP' ? 'selected' : '' }}>GBP — British Pound</option>
                                                <option value="CNY" {{ $ad->currency == 'CNY' ? 'selected' : '' }}>Chinese Yuan</option>
                                                <option value="JPY" {{ $ad->currency == 'JPY' ? 'selected' : '' }}>Japanese Yen</option>
                                                <option value="CAD" {{ $ad->currency == 'CAD' ? 'selected' : '' }}>Canadian Dollar</option>
                                                <option value="AUD" {{ $ad->currency == 'AUD' ? 'selected' : '' }}>Australian Dollar</option>
                                                <option value="CHF" {{ $ad->currency == 'CHF' ? 'selected' : '' }}>Swiss Franc</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Warranty</label>
                                            <input type="text" class="form-control" name="warranty" id=""
                                                aria-describedby="helpId" placeholder="" value="{{ $ad->warranty }}" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Delivery</label>
                                            <input type="text" class="form-control" name="delivery" id=""
                                                aria-describedby="helpId" placeholder="" value="{{ $ad->delivery }}" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="" rows="3">{{ $ad->description }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Images</label>
                                            <input type="file" class="form-control" name="images[]" id=""
                                                multiple aria-describedby="helpId" placeholder="" />
                                            <span class="uploadedImages">
                                                @foreach (json_decode($ad->images) as $image)
                                                    <img src="{{ asset($image) }}" alt="" />
                                                @endforeach
                                            </span>
                                        </div>

                                        <button type="submit" class="btn btn-orange">Update Ad</button>
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
