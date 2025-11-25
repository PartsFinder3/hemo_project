<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
<style>
.hero-section_p {
    width: 100%;
    height: 630px;
    display: flex;
    flex-direction: column;
    background-image: url('https://www.thepartfinder.ae/assets/theme/pf-main/images/banner-bg.jpg');
    background-size: cover;
    background-position: center;
}
.hero_section_text {
    width: 100%;
    font-size: 4rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 20px;
    background: none;
    -webkit-background-clip: unset;
    -webkit-text-fill-color: black;
    color: black;
}

.secound_hero_section {
    width: 100%;
    height: calc(100% - 80px);
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 0 50px;
}

.part_finder_card {
    width: 50%;
    display: flex;
    justify-content: flex-start;
    margin-top: -70px;
    margin-left: 10%;
}

.car {
    width: 400px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.hero_image_section {
    width: 50%;
    height: 100%;
    background-size: cover;
    background-position: center;
    margin-right: 10%;
    margin-top: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.hero_image_section img {
    width: 500px;
    height: 400px;
    object-fit: cover;
}
.find-btn {
    width: 100%;
    background: linear-gradient(135deg, #3a8ffe, #ff9500);
    color: white;
    padding: 10px;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    height: 50px;
    margin-top: 15px;
}

.find-btn:disabled {
    background: #cccccc;
    cursor: not-allowed;
}

/* Form styles */
.form-group {
    margin-bottom: 15px;
}

.card-header {
    text-align: center;
    margin-bottom: 20px;
}

.free-text {
    color: #ff9500;
    font-weight: bold;
    font-size: 18px;
}

.search-title {
    font-size: 22px;
    font-weight: bold;
    margin-top: 5px;
}

.dropdown {
    width: 100%;
}

.select2-container--default .select2-selection--single {
    height: 42px;
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 5px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 32px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px;
}

.select2-results__options {
    max-height: 180px !important;
    overflow-y: auto !important;
}

.condition-section {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 10px;
    border: 2px solid #e1e5e9;
    margin-top: -10px;
}

.condition-title {
    font-weight: bold;
    margin-bottom: 8px;
}

.radio-group {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 20px;
    margin-top: 5px;
}

.radio-option {
    display: flex;
    align-items: center;
    gap: 5px;
}

.parts-tags {
    margin-top: 10px;
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.part-tag {
    background: #e9ecef;
    padding: 5px 10px;
    border-radius: 15px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.part-tag button {
    background: none;
    border: none;
    cursor: pointer;
    font-weight: bold;
}

.hidden {
    display: none !important;
}

/* Responsive */
@media (max-width: 992px) {
    .hero-section_p {
        height: auto;
        padding: 30px 20px;
    }

    .hero_section_text h1 {
        font-size: 2.5rem !important;
        padding: 0 20px;
    }

    .secound_hero_section {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 30px;
        padding: 0 20px;
        height: auto;
    }

    .part_finder_card {
        width: 100%;
        margin-top: 0;
        margin-left: 0;
        display: flex;
        justify-content: center;
    }

    .car {
        width: 100%;
        max-width: 420px;
    }

    .hero_image_section {
        width: 100%;
        margin-top: 20px;
        margin-right: 0;
        text-align: center;
    }

    .hero_image_section img {
        width: 90%;
        height: auto;
        max-width: 380px;
    }
}

@media (max-width: 768px) {
    .hero_section_text h1 {
        font-size: 2rem !important;
        line-height: 1.2;
    }

    .car {
        padding: 15px;
        border-radius: 15px;
    }

    .hero_image_section img {
        max-width: 300px;
        margin-top: 10px;
    }

    .find-btn {
        font-size: 16px;
        height: 45px;
    }
    
    .radio-group {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .hero_section_text h1 {
        font-size: 1.6rem !important;
    }

    .car {
        max-width: 330px;
    }

    .hero_image_section img {
        max-width: 260px;
    }

    .dropdown {
        font-size: 14px;
        padding: 7px;
    }
}
</style>

<div class="hero_section_text">
    <h1>{{$part}}.</h1>
</div>

<div class="secound_hero_section">
    <div class="part_finder_card">
        <div class="car">
            <div class="card-header">
                <div class="free-text">100% FREE</div>
                <div class="search-title">Search Your Part Here</div>
            </div>
            <form action="{{ route('buyer.inquiry.send') }}" method="post" id="part-finder-form">
                @csrf
                <input type="hidden" name="selected_parts" id="selected-parts">
                
                <div class="form-group" id="make-group">
                    <select class="dropdown mySelect" id="make" name="car_make_id">
                        <option value="">Select Your Make</option>
                        @foreach ($makes as $make)
                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="model-group">
                    <select class="dropdown" id="model" name="car_model_id" disabled>
                        <option value="">Select Your Model</option>
                    </select>
                </div>

                <div class="form-group" id="year-group">
                    <select class="dropdown" id="year" name="year_id" disabled>
                        <option value="">Select Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group hidden" id="parts-group">
                    <select id="parts-dropdown" class="dropdown" disabled>
                        <option value="">Select a part to add</option>
                        @foreach ($parts as $part)
                            <option value="{{ $part->id }}">{{ $part->name }}</option>
                        @endforeach
                    </select>
                    <div id="parts-tags" class="parts-tags"></div>
                </div>

                <div class="form-group hidden" id="condition-group">
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

                <button class="find-btn" id="find-btn" type="submit" disabled>Find My Part</button>
            </form>
        </div>
    </div>

    <div class="hero_image_section">
        <img src="https://partsfinder.ae/storage/profile_images/hero_section_image_1.png" alt="">
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize Select2 for all dropdowns
    $('#make').select2({
        placeholder: "Select Your Make"
    });
    
    $('#model').select2({
        placeholder: "Select Your Model",
        disabled: true
    });
    
    $('#year').select2({
        placeholder: "Select Year",
        disabled: true
    });
    
    $('#parts-dropdown').select2({
        placeholder: "Select Part",
        disabled: true
    });

    // Variables to track state
    let selectedParts = [];
    
    // Make selected
    $('#make').on('change', function () {
        const makeId = $(this).val();
        
        if (makeId) {
            // Enable model dropdown
            $('#model').prop('disabled', false).trigger('change');
            $('#model').select2('enable');
            
            // Reset and disable subsequent dropdowns
            $('#model').val(null).trigger('change');
            $('#year').val(null).trigger('change');
            $('#year').prop('disabled', true).select2('enable', false);
            $('#parts-dropdown').val(null).trigger('change');
            $('#parts-dropdown').prop('disabled', true).select2('enable', false);
            
            // Hide parts and condition sections
            $('#parts-group').addClass('hidden');
            $('#condition-group').addClass('hidden');
            
            // Clear selected parts
            selectedParts = [];
            updatePartsTags();
            updateButton();
            
            // Load models for selected make
            $.ajax({
                url: '/search-models',
                data: {
                    make_id: makeId
                },
                success: function(data) {
                    // Clear and populate model dropdown
                    $('#model').empty().append('<option value="">Select Your Model</option>');
                    $.each(data, function(index, model) {
                        $('#model').append('<option value="' + model.id + '">' + model.name + '</option>');
                    });
                }
            });
        } else {
            // Reset all if no make selected
            $('#model').val(null).trigger('change');
            $('#model').prop('disabled', true).select2('enable', false);
            $('#year').val(null).trigger('change');
            $('#year').prop('disabled', true).select2('enable', false);
            $('#parts-dropdown').val(null).trigger('change');
            $('#parts-dropdown').prop('disabled', true).select2('enable', false);
            $('#parts-group').addClass('hidden');
            $('#condition-group').addClass('hidden');
            selectedParts = [];
            updatePartsTags();
            updateButton();
        }
    });

    // Model selected
    $('#model').on('change', function () {
        const modelId = $(this).val();
        
        if (modelId) {
            // Enable year dropdown
            $('#year').prop('disabled', false).trigger('change');
            $('#year').select2('enable');
            
            // Reset and disable subsequent dropdowns
            $('#year').val(null).trigger('change');
            $('#parts-dropdown').val(null).trigger('change');
            $('#parts-dropdown').prop('disabled', true).select2('enable', false);
            
            // Hide parts and condition sections
            $('#parts-group').addClass('hidden');
            $('#condition-group').addClass('hidden');
            
            // Clear selected parts
            selectedParts = [];
            updatePartsTags();
            updateButton();
        } else {
            // Reset if no model selected
            $('#year').val(null).trigger('change');
            $('#year').prop('disabled', true).select2('enable', false);
            $('#parts-dropdown').val(null).trigger('change');
            $('#parts-dropdown').prop('disabled', true).select2('enable', false);
            $('#parts-group').addClass('hidden');
            $('#condition-group').addClass('hidden');
            selectedParts = [];
            updatePartsTags();
            updateButton();
        }
    });

    // Year selected
    $('#year').on('change', function () {
        const yearId = $(this).val();
        
        if (yearId) {
            // Enable parts dropdown
            $('#parts-dropdown').prop('disabled', false);
            $('#parts-dropdown').select2('enable');
            
            // Show parts group
            $('#parts-group').removeClass('hidden');
            
            // Hide condition section until part is selected
            $('#condition-group').addClass('hidden');
            
            // Clear selected parts
            selectedParts = [];
            updatePartsTags();
            updateButton();
        } else {
            // Reset if no year selected
            $('#parts-dropdown').val(null).trigger('change');
            $('#parts-dropdown').prop('disabled', true).select2('enable', false);
            $('#parts-group').addClass('hidden');
            $('#condition-group').addClass('hidden');
            selectedParts = [];
            updatePartsTags();
            updateButton();
        }
    });

    // Part selected
    $('#parts-dropdown').on('change', function () {
        const partId = $(this).val();
        const partText = $(this).find('option:selected').text();
        
        if (partId && !selectedParts.some(part => part.id === partId)) {
            // Add part to selected parts
            selectedParts.push({
                id: partId,
                text: partText
            });
            
            // Update tags display
            updatePartsTags();
            
            // Reset dropdown
            $(this).val(null).trigger('change');
            
            // Show condition section if at least one part is selected
            if (selectedParts.length > 0) {
                $('#condition-group').removeClass('hidden');
            }
            
            updateButton();
        }
    });

    // Function to update parts tags display
    function updatePartsTags() {
        const tagsContainer = $('#parts-tags');
        tagsContainer.empty();
        
        selectedParts.forEach((part, index) => {
            const tag = $('<div class="part-tag"></div>');
            tag.text(part.text);
            
            const removeBtn = $('<button type="button">&times;</button>');
            removeBtn.on('click', function() {
                selectedParts.splice(index, 1);
                updatePartsTags();
                
                // Hide condition section if no parts selected
                if (selectedParts.length === 0) {
                    $('#condition-group').addClass('hidden');
                }
                
                updateButton();
            });
            
            tag.append(removeBtn);
            tagsContainer.append(tag);
        });
        
        // Update hidden input with selected parts
        $('#selected-parts').val(JSON.stringify(selectedParts));
    }

    // Function to update button state
    function updateButton() {
        const hasParts = selectedParts.length > 0;
        $('#find-btn').prop('disabled', !hasParts);
    }

    // Form submission
    $('#part-finder-form').on('submit', function(e) {
        if (selectedParts.length === 0) {
            e.preventDefault();
            alert('Please select at least one part');
            return false;
        }
    });
});
</script>