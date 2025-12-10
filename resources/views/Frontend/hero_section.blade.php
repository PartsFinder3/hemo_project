<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>

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
    width: 100%;
    padding: 50px 0;
    background-color: #f8f8f8;
}

.abdul-part_finder_card {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    padding: 30px;
}

.abdul-card-header {
    text-align: center;
    margin-bottom: 20px;
}

.abdul-free-text {
    font-size: 14px;
    font-weight: bold;
    color: #ff0000;
}

.abdul-search-title {
    font-size: 24px;
    font-weight: bold;
    margin-top: 10px;
}

.abdul-form-group {
    margin-bottom: 15px;
}

.abdul-dropdown {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.abdul-condition-section {
    margin-top: 20px;
}

.abdul-condition-title {
    font-weight: bold;
    margin-bottom: 10px;
}

.abdul-radio-group {
    display: flex;
    gap: 15px;
}

.abdul-radio-option input {
    margin-right: 5px;
}

.abdul-find-btn {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

.abdul-find-btn:hover {
    background-color: #0056b3;
}



</style>

<div class="hero_section_text">
    <h1>{!! $part !!}</h1>
</div>
<div class="abdul-secound_hero_section">
    <div class="abdul-part_finder_card">
        <div class="abdul-car">
            <div class="abdul-card-header">
                <div class="abdul-free-text">100% FREE</div>
                <div class="abdul-search-title">Search Your Part Here</div>
            </div>
            <form action="{{ route('buyer.inquiry.send') }}" method="post">
                @csrf
                <div class="abdul-form-group" id="abdul-make-group">
                    <select class="abdul-dropdown" id="abdul-car-make" name="car_make_id">
                        @foreach ($makes as $make)
                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="abdul-form-group" id="abdul-model-group">
                    <select class="abdul-dropdown" id="abdul-car-model" name="car_model_id">
                        @foreach ($models as $model)
                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="abdul-form-group" id="abdul-year-group">
                    <select class="abdul-dropdown" id="abdul-car-year" name="year_id">
                        <option value="">Select a year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="abdul-form-group" id="abdul-parts-group">
                    <select id="abdul-parts-dropdown" name="parts[]">
                        @foreach ($parts as $part)
                            <option value="{{ $part->id }}">{{ $part->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="abdul-form-group" id="abdul-condition-group">
                    <div class="abdul-condition-section">
                        <div class="abdul-condition-title">Condition Required ?</div>
                        <div class="abdul-radio-group">
                            <div class="abdul-radio-option">
                                <input type="radio" id="abdul-used" name="condition" value="used" />
                                <label for="abdul-used">Used</label>
                            </div>
                            <div class="abdul-radio-option">
                                <input type="radio" id="abdul-new" name="condition" value="new" checked />
                                <label for="abdul-new">New</label>
                            </div>
                            <div class="abdul-radio-option">
                                <input type="radio" id="abdul-doesnt-matter" name="condition" value="does_not_matter" />
                                <label for="abdul-doesnt-matter">Doesn't matter</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="abdul-find-btn" id="abdul-find-btn">Find My Part</button>
            </form>
        </div>
    </div>
</div>

 

<div class="hero_image_section">
    <img src="{{ asset($image) }}" alt="" loading="lazy">
</div>
</div>
