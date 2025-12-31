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
     z-index: 9999; 
}

.hero_section_text .hiliter {
    display: inline;   /* inline رکھیں تاکہ text کے ساتھ flow ہو */
    padding: 0 3px;
    font-weight: bold;
    width: auto;
    margin-right: 5px !important;
    z-index: 9999;
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
        font-size: 22px !important;
    }
}

.secound_hero_section {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    position: relative;
    height: auto;
}
.part_finder_card {
    flex: 1 1 45%;
    display: flex;
     margin-left: 93px !important;
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
        margin-left: 49px !important;

}

.hero_image_section {
    flex: 1 1 45%;
    display: flex;                /* ✅ YE MISSING THA */
    justify-content: flex-start;  /* ✅ left align */
    align-items: center;          /* optional */
    top: -60px;
    left: 46%;
    position: absolute;
    text-align: left;             /* center hatao */
}
.hero_image_section img {
    max-width: 540px;
    width: 100%;
    height: auto;
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
@media (max-width: 992px) {
    .secound_hero_section {
        flex-direction: column;
        align-items: center;
        gap: 25px;
        padding: 0 20px;
    }
    .part_finder_card, .hero_image_section {
        flex: 1 1 100%;
        margin: 0 auto;
    }
    .car {
        max-width: 420px;
    }
    .hero_section_text h1 {
        font-size: 32px;
    }
}

/* ===== Tablets ===== */
@media (max-width: 768px) {
    .car {
        max-width: 380px;
        padding: 15px;
        border-radius: 15px;
    }
    .hero_image_section img {
        max-width: 300px;
    }
    .hero_section_text h1 {
        font-size: 26px;
    }
    .find-btn {
        font-size: 16px;
        height: 45px;
    }
}

/* ===== Mobile ===== */
@media (max-width: 550px) {
    .car {
        max-width: 330px !important;
        margin-top: 40px !important;
        margin-left: 0 !important;
        padding: 10px !important;
    }
    .hero_image_section img {
        max-width: 260px !important;
    }
    .hero_section_text h1 {
        font-size: 22px !important;
    }
    .radio-option label {
        font-size: 12px !important;
    }
    .hero-section_p {
        min-height: auto !important;
    }
.part_finder_card{
        margin-left: 10px !important;

    }
}

/* ===== Small Mobile (Extra Small) ===== */
@media (max-width: 380px) {
    .car {
        max-width: 280px !important;
        padding: 8px !important;
        margin-top: 30px !important;
    }
    .hero_image_section{
       top: -300px;
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
    .secound_hero_section {
        gap: 15px;
        padding: 0 10px !important;
    }
      .part_finder_card{
        margin-left: -176px !important;
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
.select2-search--dropdown {
    position: relative;
}

.select2-search--dropdown::after {
    content: "\1F50D"; /* 🔍 */
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
    color: #999;
    pointer-events: none;
    z-index: 10;
}

.select2-search--dropdown .select2-search__field {
    padding-right: 32px !important;
}

/* ===============================
   MULTIPLE (PARTS) SEARCH ICON
================================ */
.select2-search--inline {
    position: relative;
    width: 100%;
}

.select2-search--inline::after {
    content: "\1F50D"; /* 🔍 */
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
    color: #999;
    pointer-events: none;
}

.select2-search--inline .select2-search__field {
    padding-right: 30px !important;
    width: 100% !important;
    box-sizing: border-box;
}
#condition-group {
    display: none;
}
.select2-container--default 
.select2-selection--multiple 
.select2-selection__choice {
    font-size: 13px !important;   /* font chota */
    font-weight: 500 !important;  /* normal / medium */
    padding: 3px 6px !important;
    line-height: 1.2 !important;
}
.active-step .select2-selection,
.active-step {
    border: 1px solid #28a745 !important;
    box-shadow: 0 0 8px rgba(40, 167, 69, 0.6) !important;
    transition: all 0.3s ease;
    border-radius: 3px;
}

/* Condition box green */
.condition-active {
    border: 1px solid #28a745 !important;
    box-shadow: 0 0 8px rgba(40, 167, 69, 0.6) !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: normal !important;
    padding-top: 2px !important;   /* 👈 text thora upar */
      color: #000 !important;  
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    padding-top: 2px !important;   /* 👈 multiple ke liye bhi */
      color: #000 !important;  
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
         <option value="">Select Make</option>
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
         <option value="">Select Year</option>

        <option value="">Select a Year</option>
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
            placeholder: 'Select Parts',
            width: '100%'
        });
    });
});
$('#car-make').on('change', function() {
    var makeId = $(this).val();

    var $model = $('#car-model');

    if(makeId) {
        // Show "Loading Models..." while fetching
        $model.empty().append('<option value="">Loading models...</option>').trigger('change');

        $.ajax({
            url: "{{ url('get-models') }}/" + makeId, // Laravel url() helper
            type: 'GET',
            success: function(data) {
                $model.empty(); // Clear old options
                $model.append('<option value="">Select Model</option>'); // Default

                $.each(data, function(key, model) {
                    $model.append('<option value="'+model.id+'">'+model.name+'</option>');
                });

                // Refresh Select2
                $model.trigger('change');
            },
            error: function() {
                $model.empty().append('<option value="">Error loading models</option>').trigger('change');
            }
        });
    } else {
        $model.empty().append('<option value="">Select Model</option>').trigger('change');
    }
});

</script>
<script>
$(document).ready(function () {

    // Hide condition section initially
    $('#condition-group').hide();

    // When PART is selected (Select2 multiple)
    $('#parts-dropdown-parts').on('change', function () {

        let selectedParts = $(this).val();

        if (selectedParts && selectedParts.length > 0) {
            // Show condition when part selected
            $('#condition-group').slideDown();
        } else {
            // Hide again if no part selected
            $('#condition-group').slideUp();
        }
    });

});
</script>
<script>
$(document).ready(function () {

    // Helper: remove all active states
    function resetSteps() {
        $('.form-group').removeClass('active-step');
        $('.condition-section').removeClass('condition-active');
    }

    // Initial state → Make active
    resetSteps();
    $('#make-group').addClass('active-step');

    // MAKE selected
    $('#car-make').on('change', function () {
        if ($(this).val()) {
            resetSteps();
            $('#model-group').addClass('active-step');
        }
    });

    // MODEL selected
    $('#car-model').on('change', function () {
        if ($(this).val()) {
            resetSteps();
            $('#year-group').addClass('active-step');
        }
    });

    // YEAR selected
    $('#car-year').on('change', function () {
        if ($(this).val()) {
            resetSteps();
            $('select[name="parts[]"]').closest('.form-group')
                .addClass('active-step')
                .slideDown();
        }
    });

    // PART selected
    $('#parts-dropdown-parts').on('change', function () {
        let parts = $(this).val();
        if (parts && parts.length > 0) {
            resetSteps();
            $('#condition-group').slideDown();
            $('.condition-section').addClass('condition-active');
        }
    });

});
</script>