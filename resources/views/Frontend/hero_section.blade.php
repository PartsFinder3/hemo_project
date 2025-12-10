<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* ===== Hero Section ===== */
    body, main, header, nav, .hero-section, .hero-section_p {
    background-image: none !important;
    background: none !important;
}

.hero_image_section {
    flex: 1 1 45%;
    text-align: center;
    margin-top: 20px;
}

.hero_image_section img {
    max-width: 500px;
    width: 100%;
    height: auto;
    object-fit: cover;
}
.abdul-secound_hero_section {
    display: flex;
    justify-content: center;
    padding: 50px 0;
    background-color: #f8f8f8;
}

.abdul-part_finder_card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    padding: 30px;
    width: 350px;
    text-align: center;
}

.abdul-free-text {
    display: inline-block;
    background-color: #ff7f00;
    color: #fff;
    font-weight: bold;
    font-size: 12px;
    padding: 5px 15px;
    border-radius: 20px;
    margin-bottom: 15px;
}

.abdul-search-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
}

.abdul-form-group {
    margin-bottom: 15px;
}

.abdul-dropdown {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.abdul-condition-section {
    margin: 20px 0;
    background: #f5f5f5;
    padding: 10px;
    border-radius: 6px;
    text-align: left;
}

.abdul-condition-title {
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 14px;
}

.abdul-radio-group {
    display: flex;
    justify-content: space-between;
}

.abdul-radio-option {
    display: flex;
    align-items: center;
    font-weight: bold;
    font-size: 13px;
    gap: 5px;
}

.abdul-radio-option input[type="radio"] {
    accent-color: #ff7f00;
}

.abdul-find-btn {
    width: 100%;
    background-color: #ff7f00;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.abdul-find-btn:hover {
    background-color: #e76a00;
}


</style>

<div class="hero_section_text">
    <h1>{!! $part !!}</h1>
</div>

<div class="abdul-secound_hero_section">
    <div class="abdul-part_finder_card">
        <div class="abdul-card-header">
            <div class="abdul-free-text">100% FREE</div>
            <div class="abdul-search-title">Search Your Part Here</div>
        </div>
        <form action="{{ route('buyer.inquiry.send') }}" method="post">
            @csrf
            <div class="abdul-form-group">
                <select class="abdul-dropdown" name="car_make_id">
                    @foreach ($makes as $make)
                        <option value="{{ $make->id }}">{{ $make->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="abdul-form-group">
                <select class="abdul-dropdown" name="car_model_id">
                    @foreach ($models as $model)
                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="abdul-form-group">
                <select class="abdul-dropdown" name="year_id">
                    <option value="">Select a year</option>
                    @foreach ($years as $year)
                        <option value="{{ $year->id }}">{{ $year->year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="abdul-form-group">
                <select class="abdul-dropdown" name="parts[]">
                    @foreach ($parts as $part)
                        <option value="{{ $part->id }}">{{ $part->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="abdul-condition-section">
                <div class="abdul-condition-title">Condition Required ?</div>
                <div class="abdul-radio-group">
                    <label class="abdul-radio-option">
                        <input type="radio" name="condition" value="used" />
                        <span>Used</span>
                    </label>
                    <label class="abdul-radio-option">
                        <input type="radio" name="condition" value="new" checked />
                        <span>New</span>
                    </label>
                    <label class="abdul-radio-option">
                        <input type="radio" name="condition" value="does_not_matter" />
                        <span>Doesn't matter</span>
                    </label>
                </div>
            </div>
            <button class="abdul-find-btn" type="submit">Find My Part</button>
        </form>
    </div>
</div>

<div class="hero_image_section">
    <img src="{{ asset($image) }}" alt="" loading="lazy">
</div>
</div>
<script>
$(document).ready(function() {
    // Single selects
    $('#car-make, #car-model, #car-year').select2({
        placeholder: 'Select an option',
        width: '100%'
    });

    // Multi-select
    $('#parts-dropdown').select2({
        placeholder: 'Select parts',
        width: '100%'
    });

    // Change event
    $('#parts-dropdown').on('change', function() {
        var selectedParts = $(this).val(); // array of selected IDs
        console.log(selectedParts);
    });
});

</script>
