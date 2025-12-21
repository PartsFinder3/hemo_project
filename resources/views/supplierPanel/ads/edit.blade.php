@extends('supplierPanel.layout.main')

@section('main-section')
<style>
.mb-3 label{
    font-weight: bold;
}
.uploadedImages {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}
.uploadedImages img {
    width: 200px;
    height: 200px;
    object-fit: contain;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 5px;
    background-color: #f8f9fa;
    transition: transform 0.3s ease;
}
.uploadedImages img:hover {
    transform: scale(1.05);
}
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @php $shop_id = Auth::guard('supplier')->user()->shop->id; @endphp

            <!-- Top Navigation -->
            <div class="row mb-4">
                <div class="col-12 col-md-8 d-flex flex-wrap align-items-center gap-2">
                    <a class="text-decoration-none fw-semibold" href="{{ route('supplier.ads.index', $shop_id) }}">All Ads</a>
                    <a class="text-decoration-none fw-semibold" href="{{ route('supplier.ads.active', $shop_id) }}">Active Ads</a>
                    <a class="text-decoration-none fw-semibold" href="{{ route('supplier.ads.inactive', $shop_id) }}">Inactive Ads</a>
                    <a class="text-decoration-none fw-semibold" href="{{ route('supplier.ads.approved',$shop_id) }}">Approved Ads</a>
                    <a class="text-decoration-none fw-semibold" href="{{ route('shop.ads.waiting', $shop_id) }}">Waiting for Approval</a>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-md-end flex-wrap gap-2 mt-2 mt-md-0">
                    <a class="btn btn-orange" href="{{ route('shop.supplier.ads.create') }}"><i class="bi bi-plus-circle me-1"></i> Create New Ad</a>
                    <a class="btn btn-red" href="{{ route('shop.supplier.ads.createCar') }}"><i class="bi bi-car-front me-1"></i> Car Breaking Ad</a>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('supplier.ads.update', ['id' => $ad->id, 'slug' => $ad->slug]) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <h2 class="text-sm">Spare Part Information</h2>

                        <div class="mb-3">
                            <label class="form-label">Make</label>
                            <select class="form-select" name="car_make_id" id="carMake">
                                <option value="{{ $ad->car_make_id }}" selected>{{ $ad->carMake->name }}</option>
                                @foreach ($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Model</label>
                            <select class="form-select" name="car_model_id" id="carModel">
                                <option value="{{ $ad->car_model_id }}" selected>{{ $ad->carModel->name }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Year</label>
                            <select class="form-select" name="year_id" id="yearSelect">
                                <option value="{{ $ad->year_id }}" selected>{{ $ad->year->year }}</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fuel</label>
                            <select class="form-select" name="fuel_id" id="fuelSelect">
                                <option value="0" {{ $ad->fuel_id == 0 ? 'selected' : '' }}>N/A</option>
                                @foreach ($fuels as $fuel)
                                    <option value="{{ $fuel->id }}" {{ $ad->fuel_id == $fuel->id ? 'selected' : '' }}>{{ $fuel->type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Engine Size</label>
                            <select class="form-select" name="engine_size_id" id="engineSelect">
                                <option value="{{ $ad->engine_size_id }}" selected>{{ $ad->engineSize->size }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Spare Part</label>
                            <select class="form-select" name="part_id" id="partSelect">
                                <option value="{{ $ad->part_id }}" selected>{{ $ad->part->name }}</option>
                                @foreach ($parts as $part)
                                    <option value="{{ $part->id }}">{{ $part->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Condition</label>
                            <select class="form-select" name="condition">
                                <option value="{{ $ad->condition }}" selected>{{ ucfirst($ad->condition) }}</option>
                                <option value="new">New</option>
                                <option value="used">Used</option>
                                <option value="refurbished">Refurbished</option>
                            </select>
                        </div>

                        <h2 class="text-sm">Ad Information</h2>

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="titleField" value="{{ $ad->title }}" placeholder="Auto Generated">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" value="{{ $ad->price }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Currency</label>
                            <select class="form-select" name="currency" id="currencySelect">
                                @php
                                    $currencies = ['AED'=>'AED — UAE Dirham','USD'=>'USD — US Dollar','SAR'=>'SAR — Saudi Riyal','PKR'=>'PKR — Pakistani Rupee','INR'=>'INR — Indian Rupee','EUR'=>'EUR — Euro','GBP'=>'GBP — British Pound','CNY'=>'CNY — Chinese Yuan','JPY'=>'JPY — Japanese Yen','CAD'=>'CAD — Canadian Dollar','AUD'=>'AUD — Australian Dollar','CHF'=>'CHF — Swiss Franc'];
                                @endphp
                                @foreach($currencies as $key => $val)
                                    <option value="{{ $key }}" {{ $ad->currency == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Warranty</label>
                            <select class="form-select" name="warranty" id="warrantySelect">
                                @for ($i=0;$i<=30;$i++)
                                    <option value="{{ $i }}" {{ $ad->warranty == $i ? 'selected' : '' }}>{{ $i }} Day{{ $i>1?'s':'' }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Delivery</label>
                            <input type="text" class="form-control" name="delivery" value="{{ $ad->delivery }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ $ad->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Images</label>
                            <input type="file" class="form-control" name="images[]" multiple>
                            <div class="uploadedImages">
                                @foreach(json_decode($ad->images) as $img)
                                    <img src="{{ asset($img) }}" alt="">
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-orange">Update Ad</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function(){

    $('#carMake, #carModel, #fuelSelect, #engineSelect, #yearSelect, #partSelect, #currencySelect, #warrantySelect').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%'
    });

    // Fetch models based on Make
    $('#carMake').change(function(){
        let makeId = $(this).val();
        $('#carModel').empty().append('<option value="">Select one</option>');
        $('#fuelSelect, #engineSelect').empty().append('<option value="">Select one</option>');
        if(makeId){
            $.get('/get-models/'+makeId, function(data){
                $.each(data, function(i, model){
                    $('#carModel').append('<option value="'+model.id+'">'+model.name+'</option>');
                });
            });
        }
    });

    // Fetch variants based on Model
    $('#carModel').change(function(){
        let modelId = $(this).val();
        $('#fuelSelect, #engineSelect').empty().append('<option value="">Select one</option>');
        if(modelId){
            $.get('/get-variants/'+modelId, function(data){
                $.each(data.fuels, function(i,fuel){
                    $('#fuelSelect').append('<option value="'+fuel.id+'">'+fuel.type+'</option>');
                });
                $.each(data.engineSizes, function(i,size){
                    $('#engineSelect').append('<option value="'+size.id+'">'+size.size+'</option>');
                });
            });
        }
    });

    // Auto-generate title
    function updateTitle(){
        let parts = [];
        let make = $('#carMake option:selected').text();
        let model = $('#carModel option:selected').text();
        let year = $('#yearSelect option:selected').text();
        let part = $('#partSelect option:selected').text();
        let fuel = $('#fuelSelect option:selected').text();
        let engine = $('#engineSelect option:selected').text();
        if(make && make != 'Select one') parts.push(make);
        if(model && model != 'Select one') parts.push(model);
        if(year && year != 'Select one') parts.push(year);
        if(part && part != 'Select one') parts.push(part);
        if(fuel && fuel != 'Select one') parts.push(fuel);
        if(engine && engine != 'Select one') parts.push(engine);
        $('#titleField').val(parts.join(' - '));
    }

    $('#carMake, #carModel, #yearSelect, #partSelect, #fuelSelect, #engineSelect').change(updateTitle);

});
</script>
@endsection
