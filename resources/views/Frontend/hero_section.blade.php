<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* ===== General Hero Section ===== */
body, main, header, nav, .hero-section, .hero-section_p {
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

.hero_section_text {
    width: 100%;
    text-align: center;
    margin-bottom: 10px;
    z-index: 9999; 
}

.hero_section_text h1, .h1 {
    font-size: 40px !important;
    display: flex;
    justify-content: center;
    line-height: 1.2;
}

.hero_section_text .hiliter {
    display: inline;
    padding: 0 3px;
    font-weight: bold;
    margin-right: 5px;
}

/* ===== Hero Content Section ===== */
.secound_hero_section {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    position: relative;
    height: auto;
    margin-left: 60px !important;
}

.part_finder_card {
    flex: 1 1 45%;
    display: flex;
    margin-left: 68px;
    position: relative;
    z-index: 2;
}

.car {
    width: 400px;
    max-width: 450px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    border: 1px solid rgba(255,255,255,0.2);
    margin-left: 138px;
}

.hero_image_section {
    flex: 1 1 45%;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    position: absolute;
    top: -60px;
    left: 45%;
    text-align: left;
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
    color: #fff;
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
    font-weight: bold;
}

/* ===== Condition Section ===== */
.condition-section {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 10px;
    border: 2px solid #e1e5e9;
    margin-top: 10px;
}

.radio-group {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.radio-option {
    display: flex;
    align-items: center;
    gap: 5px;
}

/* ===== Select2 Styling ===== */
.select2-container--default {
    width: 100% !important;
    font-size: 16px;
}

.select2-selection--single,
.select2-selection--multiple {
    min-height: 45px !important;
    height: auto !important;
    padding: 6px 10px !important;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.select2-selection__rendered {
    line-height: 45px !important;
    font-weight: bold !important;
    padding-top: 2px;
    color: #000 !important;
}

.select2-selection__arrow {
    height: 45px !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    font-size: 13px !important;
    font-weight: 500 !important;
    padding: 3px 6px !important;
    line-height: 1.2 !important;
}

/* Search Icon for Select2 */
.select2-search--inline::after,
.select2-search--dropdown::after {
    content: "\1F50D"; /* 🔍 */
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
    color: #999;
    pointer-events: none;
}

.select2-search--inline .select2-search__field,
.select2-search--dropdown .select2-search__field {
    padding-right: 30px !important;
    width: 100% !important;
    box-sizing: border-box;
}

/* Active Steps Highlight */
.active-step .select2-selection,
.active-step {
    border: 1px solid #28a745 !important;
    box-shadow: 0 0 8px rgba(40,167,69,0.6) !important;
    border-radius: 3px;
    transition: all 0.3s ease;
}

.condition-active {
    border: 1px solid #28a745 !important;
    box-shadow: 0 0 8px rgba(40,167,69,0.6) !important;
}

/* ===============================
        Responsive Fixes
================================ */
@media (min-width: 1024px) and (max-width: 1199px) and (max-width: 913px){

    main{
        min-height: 68vh;
    }
}

/* Tablets (≤768px) */
@media (max-width: 768px) {
    .car { max-width: 380px; padding: 15px; border-radius: 15px; }
    .hero_image_section img { max-width: 300px; }
    .hero_section_text h1 { font-size: 26px; }
    .find-btn { font-size: 16px; height: 45px; }
}

/* Large tablets and below */
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
        top: 0px !important;
    }
    .car { max-width: 420px; }
    .hero_section_text h1 { font-size: 32px; }
}

/* Tablets (≤768px) */
@media (max-width: 768px) {
    .car { max-width: 380px; padding: 15px; border-radius: 15px; }
    .hero_image_section img { max-width: 300px; }
    .hero_section_text h1 { font-size: 26px; }
    .find-btn { font-size: 16px; height: 45px; }
}

/* Mobile (≤550px) */
@media (max-width: 550px) {
    .car { max-width: 320px !important; margin: 20px auto !important; padding: 12px !important; }
       .hero_image_section {
        position: relative !important;
        top: 0 !important;
        left: 0 !important;
        margin: 0 auto;
        text-align: center;
        justify-content: center;
    }

   .hero_image_section img {
        max-width: 300px !important; /* adjust as needed */
        height: auto;
    }
    .hero_section_text h1 { font-size: 22px !important; }
    .radio-option label { font-size: 12px !important; }
    .secound_hero_section { gap: 20px; padding: 0 10px !important; }
     .part_finder_card {
        margin-left: 0 !important;
        flex: 1 1 100%;
        margin-left: auto !important;
    }
    .find-btn { font-size: 16px; height: 45px; }
    .part_finder_card {
        margin-left: 0 !important;
        width: 100% !important;
        display: flex;
        justify-content: center;
    }

    .car {
        width: 100% !important;
        max-width: 95% !important; /* thora gap side se */
        margin: 0 auto !important;
    }

}
@media (max-width: 395px) {
    .car {
    max-width: 320px !important;
     margin: auto;
      padding: 10px !important;
      margin-left: 20px !important;
       }
    .hero_image_section 
    { 
         margin-left: -30px !important; 
         margin-top: -35px !important;
    }
    .search-title{
        padding-bottom: 13px;
    }
    .hero_image_section img { 
      max-width: 249px !important;
      
        margin-left: -4px;
        margin-top: 38px;
     }
    .hero_section_text h1 { font-size: 20px !important; margin-top: 15px; }
    .find-btn { font-size: 14px !important; height: 40px !important; }
    .radio-option label { font-size: 11px !important; }
   .secound_hero_section {
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center;
        gap: 20px;
    }
     .part_finder_card {
   margin-left: -40px !important;  
}
.hero_section_text h1{
    font-size: 17px !important;
}
main{
    min-height: 87vh;
}
}
/* Small Mobile (≤380px) */
@media (max-width: 420px) {
    .car {
    max-width: 320px !important;
     margin: auto;
      padding: 10px !important;
      margin-left: 20px !important;
       }
    .hero_image_section 
    { 
         margin-left: -30px !important; 
         margin-top: -35px !important;
    }
    .search-title{
        padding-bottom: 13px;
    }
    .hero_section_text h1{
    font-size: 17px !important;
}
    .hero_image_section img { 
      max-width: 249px !important;
      
        margin-left: -4px;
        margin-top: 38px;
     }
    .hero_section_text h1 { font-size: 20px !important; margin-top: 15px; }
    .find-btn { font-size: 14px !important; height: 40px !important; }
    .radio-option label { font-size: 11px !important; }
   .secound_hero_section {
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center;
        gap: 20px;
    }
     .part_finder_card {
   margin-left: -40px !important;  
}
    main {
        min-height: 68vh;
    }
}
@media (max-width: 440px) {
    .car {
    max-width: 320px !important;
     margin: auto;
      padding: 10px !important;
      margin-left: 20px !important;
       }
    .hero_image_section 
    { 
         margin-left: -30px !important; 
         margin-top: -35px !important;
    }
    .search-title{
        padding-bottom: 13px;
    }
    
    .hero_image_section img { 
      max-width: 249px !important;
      
        margin-left: -4px;
        margin-top: 38px;
     }
    .hero_section_text h1 { font-size: 17px !important; margin-top: 15px; }
    .find-btn { font-size: 14px !important; height: 40px !important; }
    .radio-option label { font-size: 11px !important; }
   .secound_hero_section {
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center;
        gap: 20px;
    }
     .part_finder_card {
   margin-left: -40px !important;  
}
    main {
        min-height: 68vh;
    }
}
@media (max-width: 380px) {
    .car {
    max-width: 320px !important;
     margin: auto;
      padding: 10px !important;
      margin-left: 20px !important;
       }
    .hero_image_section 
    { 
         margin-left: -30px !important; 
         margin-top: -35px !important;
    }
    .search-title{
        padding-bottom: 13px;
    }
    .hero_image_section img { 
      max-width: 249px !important;
      
        margin-left: -4px;
        margin-top: 38px;
     }
    .hero_section_text h1 { font-size: 20px !important; margin-top: 15px; }
    .find-btn { font-size: 14px !important; height: 40px !important; }
    .radio-option label { font-size: 11px !important; }
   .secound_hero_section {
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center;
        gap: 20px;
    }
     .part_finder_card {
   margin-left: -40px !important;  
}
    main {
        min-height: 68vh;
    }
}
/* Reduce the height of inputs and Select2 fields */
.dropdown,
.select2-container--default .select2-selection--single,
.select2-container--default .select2-selection--multiple {
    min-height: 40px !important;   /* smaller than 45px */
    height: 36px !important;
    padding: 4px 8px !important;
    font-size: 14px;               /* smaller font */
}

.select2-selection__rendered {
    line-height: 28px !important;  /* adjust to fit smaller height */
    padding-top: 0 !important;
}

.select2-selection__arrow {
    height: 40px !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    font-size: 12px !important;    /* smaller tags inside multi-select */
    padding: 2px 5px !important;
    line-height: 1 !important;
}
#parts-dropdown-parts + .select2-container--default .select2-selection--multiple {
    min-height: 40px;       /* starting height */
    max-height: none;       /* کوئی max limit نہیں */
    height: auto !important;
    overflow: hidden;
}

/* ہر selected item چھوٹا رکھیں */
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    font-size: 13px !important;
    line-height: 1.2 !important;
    padding: 3px 6px !important;
}
@media (min-width: 768px) and (max-width: 1024px) {

    /* Hero Section Text */
    .hero_section_text {
        font-size: 28px !important;
        text-align: center;
        margin-bottom: 20px;
    }

    .hero_section_text h1 {
        font-size: 28px !important;
        line-height: 1.3 !important;
    }

    /* Hero & Finder Card Layout */
    .secound_hero_section {
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 20px;
        padding: 0 20px;
        position: relative;
    }

    .part_finder_card {
        flex: 1 1 100%;
        margin-left: 0 !important;
    }

    .car {
        max-width: 420px !important;
        margin: 0 auto;
        padding: 18px;
        border-radius: 18px;
    }

    /* Hero Image */
    .hero_image_section {
        position: relative !important;
        top: 0 !important;
        left: 0 !important;
        margin: 20px auto 0;
        justify-content: center;
        text-align: center;
    }

    .hero_image_section img {
        max-width: 400px !important;
        width: 100%;
        height: auto;
    }

    /* Select2 Inputs */
    .dropdown,
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        min-height: 38px !important;
        height: 38px !important;
        font-size: 14px !important;
        padding: 4px 8px !important;
    }

    .select2-selection__rendered {
        line-height: 28px !important;
    }

    .select2-selection__arrow {
        height: 38px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        font-size: 12px !important;
        padding: 2px 5px !important;
        line-height: 1 !important;
    }

    /* Find Button */
    .find-btn {
        font-size: 16px !important;
        height: 45px !important;
    }

    /* Radio Options */
    .radio-option label {
        font-size: 13px !important;
    }

    /* Condition Section */
    .condition-section {
        padding: 8px !important;
    }
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