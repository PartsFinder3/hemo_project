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
    background-color: #f5f7fa;
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
    display: inline;
    padding: 0 3px;
    font-weight: bold;
    width: auto;
    margin-right: 5px !important;
    color: #ff6a00;
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
    background: rgba(255, 255, 255, 0.98);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    margin-left: 0;
}

.card-header {
    text-align: center;
    margin-bottom: 25px;
}

.free-text {
    background: #4CAF50;
    color: white;
    padding: 6px 15px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 14px;
    display: inline-block;
    margin-bottom: 10px;
}

.search-title {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
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
    border-radius: 10px;
}

/* ===== Button ===== */
.find-btn {
    width: 100%;
    background: linear-gradient(135deg, #ff6a00, #ff9500);
    color: white;
    padding: 12px;
    border: none;
    border-radius: 10px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    height: 50px;
    margin-top: 15px;
    transition: all 0.3s ease;
}

.find-btn:hover {
    background: linear-gradient(135deg, #ff9500, #ff6a00);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 106, 0, 0.3);
}

/* ===== Dropdown ===== */
.dropdown {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

/* ===== Condition Section ===== */
.condition-section {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    border: 2px solid #e1e5e9;
    margin-top: 15px;
}

.condition-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
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

.radio-option input[type="radio"] {
    margin-right: 5px;
}

.radio-option label {
    cursor: pointer;
    font-size: 14px;
    color: #555;
}

/* ===== Select2 styling ===== */
.select2-container {
    width: 100% !important;
    font-size: 16px;
    margin-bottom: 15px;
}

.select2-container--default .select2-selection--single {
    height: 45px !important;
    border: 1px solid #ddd !important;
    border-radius: 8px !important;
    padding: 8px !important;
}

.select2-container--default .select2-selection--multiple {
    min-height: 45px !important;
    border: 1px solid #ddd !important;
    border-radius: 8px !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background: #4CAF50 !important;
    color: white !important;
    border: none !important;
    border-radius: 4px !important;
    padding: 4px 8px !important;
    margin: 4px 4px 0 0 !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: white !important;
    margin-right: 5px !important;
    opacity: 0.8 !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    opacity: 1 !important;
}

.select2-container--default .select2-selection__rendered {
    line-height: 28px !important;
}

.select2-container--default .select2-selection__arrow {
    height: 45px !important;
}

/* Selected items display */
.selected-parts-container {
    margin-top: 10px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 8px;
    display: none;
}

.selected-parts-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    font-size: 14px;
}

.selected-parts-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.selected-part-item {
    background: #4CAF50;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.remove-part {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 16px;
    padding: 0;
    margin-left: 5px;
    opacity: 0.8;
}

.remove-part:hover {
    opacity: 1;
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

.form-group {
    width: 100%;
    margin-bottom: 15px;
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border: 1px solid #4CAF50 !important;
    outline: 0;
}

.select2-dropdown {
    z-index: 99999 !important;
}
</style>

<div class="hero_section_text">
    <h1>Find Your Perfect <span class="hiliter">{!! $part !!}</span></h1>
</div>

<div class="secound_hero_section">
    <div class="part_finder_card">
        <div class="car">
            <div class="card-header">
                <div class="free-text">100% FREE</div>
                <div class="search-title">Search Your Part Here</div>
            </div>
            <form id="partFinderForm" action="{{ route('buyer.inquiry.send') }}" method="post">
                @csrf
                
                <div class="form-group" id="make-group">
                    <select class="dropdown" id="car-make" name="car_make_id">
                        <option value="">Select Car Make</option>
                        @foreach ($makes as $make)
                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group" id="model-group">
                    <select class="dropdown" id="car-model" name="car_model_id">
                        <option value="">Select Car Model</option>
                        @foreach ($models as $model)
                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group" id="year-group">
                    <select class="dropdown" id="car-year" name="year_id">
                        <option value="">Select Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group" id="parts-group">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Select Parts (Select Multiple)</label>
                    <select id="parts-dropdown" name="parts[]" class="dropdown" multiple="multiple">
                        @foreach ($parts as $part)
                            <option value="{{ $part->id }}">{{ $part->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Selected Parts Display -->
                <div class="selected-parts-container" id="selectedPartsContainer">
                    <div class="selected-parts-title">Selected Parts:</div>
                    <div class="selected-parts-list" id="selectedPartsList">
                        <!-- Selected parts will be shown here -->
                    </div>
                </div>
                
                <div class="form-group" id="condition-group">
                    <div class="condition-section">
                        <div class="condition-title">Condition Required ?</div>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" id="used" name="condition" value="used" />
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

                <button type="submit" class="find-btn" id="find-btn">Find My Part</button>
            </form>
        </div>
    </div>

    <div class="hero_image_section">
        <img src="{{ asset($image) }}" alt="Car Parts" loading="lazy">
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize single selects with better configuration
    $('#car-make').select2({
        placeholder: 'Select Car Make',
        width: '100%',
        allowClear: true
    });
    
    $('#car-model').select2({
        placeholder: 'Select Car Model',
        width: '100%',
        allowClear: true
    });
    
    $('#car-year').select2({
        placeholder: 'Select Year',
        width: '100%',
        allowClear: true
    });
    
    // Initialize multi-select for parts with better configuration
    $('#parts-dropdown').select2({
        placeholder: 'Select one or more parts',
        width: '100%',
        allowClear: true,
        closeOnSelect: false, // This keeps dropdown open for multiple selections
        tags: false,
        tokenSeparators: [',', ' ']
    });
    
    // Function to update selected parts display
    function updateSelectedPartsDisplay() {
        var selectedParts = $('#parts-dropdown').val();
        var selectedPartsList = $('#selectedPartsList');
        var selectedPartsContainer = $('#selectedPartsContainer');
        
        // Clear the current list
        selectedPartsList.empty();
        
        if (selectedParts && selectedParts.length > 0) {
            // Show container
            selectedPartsContainer.show();
            
            // Get selected option texts
            var selectedOptions = $('#parts-dropdown option:selected');
            
            // Add each selected part to display
            selectedOptions.each(function() {
                var partId = $(this).val();
                var partName = $(this).text();
                
                selectedPartsList.append(`
                    <div class="selected-part-item" data-part-id="${partId}">
                        ${partName}
                        <button type="button" class="remove-part" data-part-id="${partId}">×</button>
                    </div>
                `);
            });
            
            // Update button text with count
            var count = selectedParts.length;
            $('#find-btn').text('Find My Parts (' + count + ')');
        } else {
            // Hide container if no parts selected
            selectedPartsContainer.hide();
            $('#find-btn').text('Find My Part');
        }
    }
    
    // Update display when parts selection changes
    $('#parts-dropdown').on('change', function() {
        var selectedParts = $(this).val();
        console.log('Selected Parts:', selectedParts);
        
        // Update the display
        updateSelectedPartsDisplay();
    });
    
    // Handle remove button clicks
    $(document).on('click', '.remove-part', function(e) {
        e.preventDefault();
        var partId = $(this).data('part-id');
        var currentSelection = $('#parts-dropdown').val();
        
        // Remove the part from selection
        var newSelection = currentSelection.filter(function(id) {
            return id !== partId;
        });
        
        // Update select2
        $('#parts-dropdown').val(newSelection).trigger('change');
        
        // Update display
        updateSelectedPartsDisplay();
    });
    
    // Form submission handler
    $('#partFinderForm').on('submit', function(e) {
        var selectedParts = $('#parts-dropdown').val();
        
        if (!selectedParts || selectedParts.length === 0) {
            e.preventDefault();
            alert('Please select at least one part.');
            $('#parts-dropdown').select2('open');
            return false;
        }
        
        // Show loading state
        $('#find-btn').prop('disabled', true).text('Processing...');
        
        // Form will submit normally
        return true;
    });
    
    // Initialize display on page load
    updateSelectedPartsDisplay();
    
    // Add some styling to make selected items more visible
    $('.select2-container--default .select2-selection--multiple').css({
        'min-height': '45px',
        'border-radius': '8px',
        'border': '1px solid #ddd'
    });
});
</script>