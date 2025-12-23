<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* ===== Hero Section ===== */
    body, main, header, nav, .hero-section, .hero-section_p {
    background-image: none !important;
    background: none !important;
}

.hero-section_p {
    width: 100%;
    min-height: 630px;
    display: flex;
    flex-direction: column;
    background-color: #ccc;
    background-size: cover;
    background-position: center;
    position: relative;
    padding: 20px 0;
}
.h1, h1 {
    font-size: 40px !important;
    display: flex;
    justify-content: center;
}
.hero_section_text {
    width: 100%;
    text-align: center;
    margin-bottom: 3px;
}

.hero_section_text .hiliter {
    display: inline;   /* inline رکھیں تاکہ text کے ساتھ flow ہو */
    padding: 0 3px;
    font-weight: bold;
    width: auto;
    margin-right: 5px !important;
  
}

/* ===== Responsive ===== */
@media (max-width: 992px) {
    .hero_section_text h1 {
        font-size: 32px;
    }
}

@media (max-width: 768px) {
    .hero_section_text h1 {
        font-size: 26px;
    }
}

@media (max-width: 480px) {
    .hero_section_text h1 {
        font-size: 25px !important;
    }
}

.secound_hero_section {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 0 50px;
    flex-wrap: wrap;
    position: relative;
    /* margin-top: -20px; */

}

.part_finder_card {
    flex: 1 1 45%;
    display: flex;
    justify-content: flex-end; 
    position: relative;
    z-index: 2;
}

.car {
    width: 400px;
    max-width: 450px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.2);
    float: none; /* float ہٹا دیا */
    margin-left: 0; /* margin-left ہٹا دیا */
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

/* ===== Button ===== */
.find-btn {
    width: 100%;
    background: linear-gradient(135deg, #ff6a00, #ff9500);
    color: white;
    padding: 10px;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    height: 50px;
}
/* ===== Dropdown ===== */
.dropdown {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-weight: bold !important;
}

/* ===== Condition Section ===== */
.condition-section {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 10px;
    border: 2px solid #e1e5e9;
margin-top:10px;

}

.radio-group {
    display: flex;
    flex-direction: row;
    gap: 20px;
    margin-top: 5px;
}

.radio-option {
    display: flex;
    align-items: center;
    gap: 5px;
}

/* ===== Select2 styling ===== */
.select2-container--default {
    width: 100% !important;
    font-size: 16px;

}
.select2-container--default .select2-selection--single,
.select2-container--default .select2-selection--multiple {
    min-height: 45px !important;
    height: auto !important;
    padding: 6px 10px !important;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    display: flex !important;
    flex-wrap: wrap !important;
    align-items: center;
}

/* Each selected item */
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    margin-top: 4px;
    margin-bottom: 4px;
}
/* ===== Responsive ===== */
@media (max-width: 992px) {
    .secound_hero_section {
        flex-direction: column;
        align-items: center;
        gap: 30px;
        padding: 0 20px;
    }

    .part_finder_card,
    .hero_image_section {
        flex: 1 1 100%;
    }

    .car {
        max-width: 420px;
    }
}

@media (max-width: 768px) {
    .hero_section_text {
           margin-top: 10px;
        font-size: 2rem;
        line-height: 1.2;
    }

    .car {
        padding: 15px;
        border-radius: 15px;
    }

    .hero_image_section img {
        max-width: 300px;
    }

    .find-btn {
        font-size: 16px;
        height: 45px;
    }

    .radio-group {
        flex-direction: row;
        gap: 10px;
    }
}
@media (max-width: 550px) {
    .secound_hero_section .car {
        max-width: 330px !important;
        padding: 10px !important;
        margin-top: 40px !important;
        margin-left: 0px !important;
    }

    .secound_hero_section .hero_image_section img {
        max-width: 260px !important;
    }

    .radio-option label {
        font-size: 12px !important;
    }

    .hero-section_p {
        height: auto !important;
    }
}

@media (max-width: 480px) {
    .car {
        max-width: 330px;
        padding: 10px;
        margin-top: 40px;
        margin-left: 0px;
    }

    .hero_image_section img {
        max-width: 260px;
    }

    .radio-option label {
        font-size: 12px;
    }
    .hero-section_p {
        height: auto;
    }
}
.select2-selection--single.highlight-border,
.select2-selection--multiple.highlight-border {
    border: 2px solid red !important;
}
@media (max-width: 380px) {
    .secound_hero_section {
        margin-top: -15px;
        padding: 0 10px !important;
        gap: 15px;
    }

    .car {
        max-width: 280px !important;
        padding: 8px !important;
        margin-top: 30px !important;
    }

    .hero_image_section img {
        max-width: 220px !important;
    }

    .hero_section_text h1 {
        font-size: 20px !important;
        margin-top: 20px;
    }

    .find-btn {
        font-size: 14px !important;
        height: 40px !important;
    }

    .radio-option label {
        font-size: 11px !important;
    }
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border: solid black 1px;
    outline: 0;
    height: auto;
}
.form-group {
    width: 100%;
    margin-bottom: 12px;
}
.select2-container--default .select2-selection--single {
    height: 45px !important;
    padding: 8px !important;
    display: flex;
    align-items: center;
}

.select2-selection__rendered {
    line-height: 45px !important;
}

.select2-selection__arrow {
    height: 45px !important;
}
/* Select2 options bold */
.select2-container--default .select2-results__option {
    font-weight: bold !important;
}

/* Select2 selected item بھی bold */
.select2-container--default .select2-selection__rendered {
    font-weight: bold !important;
}
.highlight-border {
    border: 2px solid red !important;
}

</style>

<div class="hero_section_text">
    <h1>{!! $part !!}</h1>
</div>

<div class="secound_hero_section">
    <div class="part_finder_card">
        <div class="car">
            <div class="card-header">
                <div class="free-text">100% FREE</div>
                <div class="search-title">Search Your Part Here</div>
            </div>
            <form action="{{ route('buyer.inquiry.send') }}" method="post">
                @csrf
            <div class="form-group" id="make-group">
    <select class="dropdown" id="car-make" name="car_make_id" required>
         <option value="">Select make</option>
        @foreach ($makes as $make)
            <option value="{{ $make->id }}">{{ $make->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group" id="model-group">
    <select class="dropdown" id="car-model" name="car_model_id" style="font-weight: bold" required>
         <option value="">Select Model</option>
        @foreach ($models as $model)
            <option value="{{ $model->id }}">{{ $model->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group" id="year-group">
    <select class="dropdown" id="car-year" name="year_id"  required>
         <option value="">Select year</option>

        <option value="">Select a year</option>
        @foreach ($years as $year)
            <option value="{{ $year->id }}">{{ $year->year }}</option>
        @endforeach
    </select>
</div>
<div class="form-group" id="year-group" style="display: none">
    <select class="dropdown" id="parts-dropdown-parts" name="parts[]" multiple required>
         <option value="">Select Part</option>
        
        <option value="">Select a year</option>
               @foreach ($parts as $part)
            <option value="{{ $part->id }}">{{ $part->name }}</option>
        @endforeach
    </select>
</div>


                <div class="form-group " id="condition-group">
                    <div class="condition-section">
                        <div class="condition-title">Condition Required ?</div>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" id="used" name="condition" value="used" required />
                                <label for="used">Used</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="new" name="condition" value="new" checked />
                                <label for="new">New</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="doesnt-matter" name="condition" value="does_not_matter" />
                                <label for="doesnt-matter">Doesn't matter</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="find-btn" id="find-btn" >Find My Part</button>
            </form>
        </div>
    </div>

<div class="hero_image_section">
    <img src="{{ asset($image) }}" alt="" loading="lazy">
</div>
</div>
<script>
$(document).ready(function() {
    $('#car-make, #car-model, #car-year').select2({
       
        width: '100%'
    });

  $('#parts-dropdown-parts').select2({
    placeholder: 'Select parts',
    width: '100%'
});
});
</script>
<script>
$(document).ready(function() {
    // Initialize Select2 for all dropdowns
    $('#car-make, #car-model, #car-year, select[name="parts[]"]').select2({
    
        width: '100%'
    });

    // Hide parts dropdown initially (already hidden via style, just in case)
    $('select[name="parts[]"]').closest('.form-group').hide();
    $(document).on('select2:open', function () {
        $('.select2-search__field').attr('placeholder', 'Search here');
    });
    // When Year is selected
    $('#car-year').on('change', function() {
        // Show the parts dropdown
        $('select[name="parts[]"]').closest('.form-group').slideDown();

        // Optional: focus/select2 refresh
        $('select[name="parts[]"]').select2({
            placeholder: 'Select parts',
            width: '100%'
        });
    });
});

</script>