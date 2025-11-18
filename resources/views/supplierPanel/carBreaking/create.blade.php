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

                                    <form action="{{ route('shop.supplier.ads.storeCar') }}" method="post"
                                        enctype="multipart/form-data" id="carAdForm">
                                        <h2 class="text-sm">Car Information</h2>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Make <span class="text-danger">*</span></label>
                                            <select class="form-select form-select-lg" name="car_make_id" id="carMake"
                                                required>
                                                <option value="">Select one</option>
                                                @foreach ($makes as $make)
                                                    <option value="{{ $make->id }}"
                                                        >
                                                        {{ $make->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
{{-- {{ old('car_make_id') == $make->id ? 'selected' : '' }} --}}
                                        <div class="mb-3">
                                            <label class="form-label">Model <span class="text-danger">*</span></label>
                                            <select class="form-select form-select-lg" name="car_model_id" id="carModel"
                                                required>
                                                <option value="">Select one</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Year <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select form-select-lg" name="year_id" id="yearSelect"
                                                required>
                                                <option value="">Select one</option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}"
                                                        >
                                                        {{ $year->year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Fuel </label>
                                            <select class="form-select form-select-lg" name="fuel_id" id="fuelSelect">
                                                <option value="">Select one</option>
                                                {{-- <option value="999">N/A</option> --}}

                                                @foreach ($fuels as $fuel)
                                                    <option value="{{ $fuel->id }}"
                                                      >
                                                        {{ $fuel->type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Engine Size </label>
                                            <select class="form-select form-select-lg" name="engine_size_id"
                                                id="engineSelect">
                                                <option value="">Select one</option>
                                                {{-- <option value="999">N/A</option> --}}

                                                @foreach ($engineSizes as $size)
                                                    <option value="{{ $size->id }}" >
                                                        {{ $size->size }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">VIN Number</label>
                                            <input type="text" class="form-control" name="vin_number" id="vinNumberField"
                                                aria-describedby="helpId" placeholder="" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Trade License</label>
                                            <input type="text" class="form-control" name="trade_license_number"
                                                id="tradeLicenseField"
                                                aria-describedby="helpId" placeholder="" />
                                        </div>

                                        <h2 class="text-sm">Ad Information</h2>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Title <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" id="titleField"
                                                 placeholder="Auto Generated" required />
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="" rows="3"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Images</label>
                                            <input type="file" class="form-control" name="images[]" id="imageInput"
                                                multiple accept="image/*" aria-describedby="helpId" placeholder="" />
                                            <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF, SVG. Max size:
                                                2MB per image.</small>
                                            <span class="uploadedImages">
                                                <img src="" alt="" />
                                            </span>
                                        </div>

                                        <button type="submit" class="btn btn-orange" id="submitBtn">Create Ad</button>
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

                if (makeId) {
                    $.get('/get-models/' + makeId, function(data) {
                        $.each(data, function(index, model) {
                            $('#carModel').append('<option value="' + model.id + '">' +
                                model.name + '</option>');
                        });
                    }).fail(function() {
                        console.error('Failed to fetch models');
                        alert('Failed to load models. Please try again.');
                    });
                }
                updateTitle(); // Update title when make changes
            });

            function updateTitle() {
                let make = $('#carMake option:selected').text();
                let model = $('#carModel option:selected').text();
                let year = $('#yearSelect option:selected').text();
                let fuel = $('#fuelSelect option:selected').text();
                let engine = $('#engineSelect option:selected').text();

                let titleParts = [];
                if (make && make !== "Select one") titleParts.push(make);
                if (model && model !== "Select one") titleParts.push(model);
                if (year && year !== "Select one") titleParts.push(year);
                if (fuel && fuel !== "Select one") titleParts.push(fuel);
                if (engine && engine !== "Select one") titleParts.push(engine);

                // Join with just a space or use a cleaner separator
                $('#titleField').val(titleParts.join(''));
            }

            // Trigger update on change for all relevant fields
            $('#carMake, #carModel, #yearSelect, #fuelSelect, #engineSelect').change(updateTitle);

            // Form submission validation
            $('#carAdForm').submit(function(e) {
                let isValid = true;
                let errorMessage = '';

                // Check required fields
                if (!$('#carMake').val()) {
                    isValid = false;
                    errorMessage += 'Please select a car make.\n';
                }
                if (!$('#carModel').val()) {
                    isValid = false;
                    errorMessage += 'Please select a car model.\n';
                }
                if (!$('#yearSelect').val()) {
                    isValid = false;
                    errorMessage += 'Please select a year.\n';
                }
                if (!$('#titleField').val().trim()) {
                    isValid = false;
                    errorMessage += 'Please enter a title.\n';
                }

                if (!isValid) {
                    e.preventDefault();
                    alert(errorMessage);
                    return false;
                }

                // Disable submit button to prevent double submission
                $('#submitBtn').prop('disabled', true).text('Creating Ad...');
            });

            // Image preview functionality
            $('#imageInput').change(function() {
                let files = this.files;
                $('.uploadedImages').empty();

                if (files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $('.uploadedImages').append(
                                '<img src="' + e.target.result +
                                '" alt="Preview" style="width: 100px; height: 100px; object-fit: cover; margin: 5px; border-radius: 5px;">'
                            );
                        };
                        reader.readAsDataURL(files[i]);
                    }
                }
            });
        });
    </script>
@endsection
