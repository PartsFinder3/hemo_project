<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
/* ===== CSS Reset ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ===== Hero Section ===== */
.hero-section_p {
    width: 100%;
    min-height: 630px;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
    position: relative;
    padding: 40px 0;
    overflow: hidden;
}

.hero_section_text {
    width: 100%;
    text-align: center;
    margin-bottom: 40px;
    padding: 0 20px;
}

.hero_section_text h1 {
    font-size: 40px !important;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 15px;
    line-height: 1.3;
}

.hero_section_text .hiliter {
    display: inline-block;
    background: linear-gradient(135deg, #ff6a00, #ff9500);
    color: white;
    padding: 0 15px;
    border-radius: 8px;
    font-weight: bold;
    margin: 0 5px;
    transform: rotate(-1deg);
}

/* ===== Main Container ===== */
.secound_hero_section {
    width: 100%;
    max-width: 1400px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 0 50px;
    gap: 60px;
    position: relative;
}

/* ===== Part Finder Card ===== */
.part_finder_card {
    flex: 1;
    max-width: 500px;
    z-index: 2;
}

.car {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.car:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.2);
}

.card-header {
    text-align: center;
    margin-bottom: 30px;
}

.free-text {
    display: inline-block;
    background: linear-gradient(135deg, #00b09b, #96c93d);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 15px;
}

.search-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    line-height: 1.3;
}

/* ===== Form Elements ===== */
.form-group {
    margin-bottom: 20px;
}

.dropdown {
    width: 100%;
    height: 50px;
    padding: 0 15px;
    border: 2px solid #e1e5e9;
    border-radius: 10px;
    font-size: 16px;
    color: #333;
    background: white;
    transition: all 0.3s ease;
}

.dropdown:focus {
    border-color: #ff6a00;
    box-shadow: 0 0 0 3px rgba(255, 106, 0, 0.1);
    outline: none;
}

/* ===== Condition Section ===== */
.condition-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border: 2px solid #e1e5e9;
}

.condition-title {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.radio-group {
    display: flex;
    gap: 20px;
    justify-content: space-between;
}

.radio-option {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.radio-option input[type="radio"] {
    width: 18px;
    height: 18px;
    accent-color: #ff6a00;
}

.radio-option label {
    font-size: 14px;
    color: #555;
    cursor: pointer;
}

/* ===== Find Button ===== */
.find-btn {
    width: 100%;
    background: linear-gradient(135deg, #ff6a00, #ff9500);
    color: white;
    padding: 15px;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 20px;
    height: 55px;
}

.find-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #e55d00, #e58400);
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(255, 106, 0, 0.3);
}

.find-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

/* ===== Hero Image Section ===== */
.hero_image_section {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero_image_section img {
    max-width: 100%;
    height: auto;
    transform: perspective(1000px) rotateY(-10deg);
    transition: transform 0.5s ease;
    filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.2));
}

.hero_image_section img:hover {
    transform: perspective(1000px) rotateY(0deg);
}

/* ===== Select2 Customization ===== */
.select2-container--default {
    width: 100% !important;
}

.select2-container--default .select2-selection--single,
.select2-container--default .select2-selection--multiple {
    border: 2px solid #e1e5e9 !important;
    border-radius: 10px !important;
    height: 50px !important;
    min-height: 50px !important;
    padding: 5px 10px !important;
    transition: all 0.3s ease !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered,
.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    line-height: 38px !important;
    padding-left: 5px !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 48px !important;
}

.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #ff6a00 !important;
    box-shadow: 0 0 0 3px rgba(255, 106, 0, 0.1) !important;
}

.select2-dropdown {
    border: 2px solid #e1e5e9 !important;
    border-radius: 10px !important;
    margin-top: 5px !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1) !important;
}

.select2-results__option--highlighted[aria-selected] {
    background-color: #ff6a00 !important;
}

/* ===== Highlight Border ===== */
.highlight-border {
    border-color: #ff6a00 !important;
    box-shadow: 0 0 0 3px rgba(255, 106, 0, 0.2) !important;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(255, 106, 0, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(255, 106, 0, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 106, 0, 0); }
}

/* ===== Utility Classes ===== */
.hidden {
    display: none !important;
}

/* ===== Responsive Design ===== */
@media (max-width: 1200px) {
    .secound_hero_section {
        padding: 0 30px;
        gap: 40px;
    }
}

@media (max-width: 992px) {
    .secound_hero_section {
        flex-direction: column;
        gap: 50px;
    }
    
    .part_finder_card,
    .hero_image_section {
        width: 100%;
        max-width: 600px;
    }
    
    .hero_image_section img {
        max-width: 500px;
        transform: none;
    }
}

@media (max-width: 768px) {
    .hero-section_p {
        min-height: auto;
        padding: 30px 0;
    }
    
    .hero_section_text h1 {
        font-size: 32px !important;
    }
    
    .secound_hero_section {
        padding: 0 20px;
    }
    
    .car {
        padding: 20px;
    }
    
    .search-title {
        font-size: 24px;
    }
    
    .radio-group {
        flex-direction: column;
        gap: 12px;
    }
    
    .find-btn {
        height: 50px;
        font-size: 16px;
    }
}

@media (max-width: 576px) {
    .hero_section_text h1 {
        font-size: 28px !important;
    }
    
    .secound_hero_section {
        padding: 0 15px;
    }
    
    .car {
        padding: 15px;
        border-radius: 15px;
    }
    
    .free-text {
        font-size: 12px;
        padding: 6px 15px;
    }
    
    .search-title {
        font-size: 22px;
    }
    
    .dropdown {
        height: 45px;
        font-size: 15px;
    }
    
    .hero_image_section img {
        max-width: 100%;
    }
}

@media (max-width: 400px) {
    .hero_section_text h1 {
        font-size: 24px !important;
    }
    
    .hero_section_text .hiliter {
        padding: 0 10px;
    }
    
    .search-title {
        font-size: 20px;
    }
}
</style>

<div class="hero-section_p">
    <div class="hero_section_text">
        <h1>{!! $part !!}</h1>
        <p class="subtitle">Find genuine parts for your vehicle with our comprehensive search</p>
    </div>

    <div class="secound_hero_section">
        <div class="part_finder_card">
            <div class="car">
                <div class="card-header">
                    <div class="free-text">100% FREE SEARCH</div>
                    <div class="search-title">Search Your Part Here</div>
                </div>
                
                <form action="{{ route('buyer.inquiry.send') }}" method="post" id="part-finder-form">
                    @csrf
                    
                    <div class="form-group" id="make-group">
                        <select class="dropdown highlight-border" id="make" name="car_make_id">
                            <option value="">Select a car make</option>
                            @foreach ($makes as $make)
                                <option value="{{ $make->id }}">{{ $make->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="model-group">
                        <select class="dropdown" id="model" name="car_model_id">
                            <option value="">Select a model</option>
                        </select>
                    </div>

                    <div class="form-group" id="year-group">
                        <select class="dropdown" id="year" name="year_id">
                            <option value="">Select a year</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}">{{ $year->year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group hidden" id="parts-group">
                        <select id="parts-dropdown" name="parts[]" class="dropdown" disabled multiple>
                            @foreach ($parts as $part)
                                <option value="{{ $part->id }}">{{ $part->name }}</option>
                            @endforeach
                        </select>
                        <small class="form-text">You can select multiple parts</small>
                    </div>

                    <div class="form-group hidden" id="condition-group">
                        <div class="condition-section">
                            <div class="condition-title">Condition Required?</div>
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

                    <button type="submit" class="find-btn" id="find-btn" disabled>
                        <span id="btn-text">Find My Part</span>
                        <span id="btn-loader" class="hidden">
                            <i class="fas fa-spinner fa-spin"></i> Searching...
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <div class="hero_image_section">
            <img src="{{ asset($image) }}" alt="Car Parts" loading="lazy">
        </div>
    </div>
</div>

<script>
// ===== Page Initialization =====
document.addEventListener('DOMContentLoaded', function() {
    initializeSelect2();
    setupEventHandlers();
    addFormSubmissionHandler();
});

// ===== Select2 Initialization =====
function initializeSelect2() {
    $('#make').select2({
        placeholder: "Select Your Car Make",
        allowClear: true,
        width: '100%',
        theme: 'default'
    });

    $('#model').select2({
        placeholder: "Select Your Model",
        allowClear: true,
        width: '100%',
        disabled: true,
        theme: 'default'
    });

    $('#year').select2({
        placeholder: "Select Year",
        allowClear: true,
        width: '100%',
        disabled: true,
        theme: 'default'
    });

    $('#parts-dropdown').select2({
        placeholder: "Select Parts (You can select multiple)",
        allowClear: true,
        width: '100%',
        theme: 'default'
    });
}

// ===== Event Handlers Setup =====
function setupEventHandlers() {
    // Make selection
    $('#make').on('select2:select', function() {
        const makeId = $(this).val();
        
        // Reset and enable model dropdown
        $('#model').val(null).trigger('change');
        $('#model').prop('disabled', false);
        
        // Load models for selected make
        loadModels(makeId);
        
        // Hide parts and condition sections
        hideSections(['parts-group', 'condition-group']);
        
        // Update highlights
        updateHighlights('make', 'model');
        updateButtonState();
    });

    // Model selection
    $('#model').on('select2:select', function() {
        const modelId = $(this).val();
        
        // Reset and enable year dropdown
        $('#year').val(null).trigger('change');
        $('#year').prop('disabled', false);
        
        // Load years for selected model
        loadYears(modelId);
        
        // Hide parts and condition sections
        hideSections(['parts-group', 'condition-group']);
        
        // Update highlights
        updateHighlights('model', 'year');
        updateButtonState();
    });

    // Year selection
    $('#year').on('select2:select', function() {
        const yearId = $(this).val();
        const modelId = $('#model').val();
        
        if (yearId && modelId) {
            // Show parts dropdown
            $('#parts-group').removeClass('hidden');
            $('#parts-dropdown').prop('disabled', false);
            
            // Load parts for selected model and year
            loadParts(modelId, yearId);
            
            // Update highlights
            updateHighlights('year', 'parts-dropdown');
        }
        
        updateButtonState();
    });

    // Parts selection
    $('#parts-dropdown').on('select2:select', function() {
        if ($(this).val().length > 0) {
            $('#condition-group').removeClass('hidden');
            updateHighlights('parts-dropdown', null);
        }
        updateButtonState();
    });

    $('#parts-dropdown').on('select2:unselect', updateButtonState);
}

// ===== AJAX Functions =====
function loadModels(makeId) {
    $('#model').select2({
        placeholder: "Loading models...",
        disabled: true
    });

    $.ajax({
        url: '/search-models',
        type: 'GET',
        data: { make_id: makeId },
        success: function(data) {
            const options = data.map(item => `<option value="${item.id}">${item.name}</option>`);
            $('#model').html('<option value=""></option>' + options.join(''));
            
            $('#model').select2({
                placeholder: "Select Your Model",
                disabled: false
            });
        },
        error: function() {
            $('#model').select2({
                placeholder: "Error loading models",
                disabled: false
            });
        }
    });
}

function loadYears(modelId) {
    $('#year').select2({
        placeholder: "Loading years...",
        disabled: true
    });

    $.ajax({
        url: '/search-years',
        type: 'GET',
        data: { model_id: modelId },
        success: function(data) {
            const options = data.map(item => `<option value="${item.id}">${item.year}</option>`);
            $('#year').html('<option value=""></option>' + options.join(''));
            
            $('#year').select2({
                placeholder: "Select Year",
                disabled: false
            });
        },
        error: function() {
            $('#year').select2({
                placeholder: "Error loading years",
                disabled: false
            });
        }
    });
}

function loadParts(modelId, yearId) {
    $('#parts-dropdown').select2({
        placeholder: "Loading parts...",
        disabled: true
    });

    $.ajax({
        url: '/search-parts',
        type: 'GET',
        data: { model_id: modelId, year_id: yearId },
        success: function(data) {
            const options = data.map(item => `<option value="${item.id}">${item.name}</option>`);
            $('#parts-dropdown').html(options.join(''));
            
            $('#parts-dropdown').select2({
                placeholder: "Select Parts (You can select multiple)",
                disabled: false
            });
        },
        error: function() {
            $('#parts-dropdown').select2({
                placeholder: "Error loading parts",
                disabled: false
            });
        }
    });
}

// ===== Helper Functions =====
function hideSections(sectionIds) {
    sectionIds.forEach(id => {
        $(`#${id}`).addClass('hidden');
        if (id === 'parts-group') {
            $('#parts-dropdown').prop('disabled', true).val(null).trigger('change');
        }
    });
}

function updateHighlights(currentStep, nextStep) {
    // Remove all highlights
    $('.select2-selection').removeClass('highlight-border');
    
    // Add highlight to current step
    if (currentStep) {
        $(`#${currentStep}`).next('.select2-container').find('.select2-selection').addClass('highlight-border');
    }
    
    // Add highlight to next step if provided
    if (nextStep) {
        setTimeout(() => {
            $(`#${nextStep}`).next('.select2-container').find('.select2-selection').addClass('highlight-border');
        }, 100);
    }
}

function updateButtonState() {
    const makeVal = $('#make').val();
    const modelVal = $('#model').val();
    const yearVal = $('#year').val();
    const partsVal = $('#parts-dropdown').val();
    const findBtn = $('#find-btn');

    // Enable button only if all required fields are filled
    if (makeVal && modelVal && yearVal && partsVal && partsVal.length > 0) {
        findBtn.prop('disabled', false);
    } else {
        findBtn.prop('disabled', true);
    }
}

// ===== Form Submission Handler =====
function addFormSubmissionHandler() {
    $('#part-finder-form').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const btn = $('#find-btn');
        const btnText = $('#btn-text');
        const btnLoader = $('#btn-loader');
        
        // Show loading state
        btnText.addClass('hidden');
        btnLoader.removeClass('hidden');
        btn.prop('disabled', true);
        
        // Submit form via AJAX
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                // Show success message
                showNotification('success', 'Your request has been submitted successfully!');
                
                // Reset form
                form[0].reset();
                $('.select2').val(null).trigger('change');
                hideSections(['parts-group', 'condition-group']);
                updateHighlights('make', null);
                updateButtonState();
            },
            error: function(xhr) {
                showNotification('error', 'An error occurred. Please try again.');
            },
            complete: function() {
                // Hide loading state
                btnText.removeClass('hidden');
                btnLoader.addClass('hidden');
                btn.prop('disabled', false);
            }
        });
    });
}

// ===== Notification Function =====
function showNotification(type, message) {
    // Create notification element
    const notification = $('<div class="notification"></div>')
        .addClass(type === 'success' ? 'notification-success' : 'notification-error')
        .text(message)
        .hide()
        .appendTo('body');
    
    // Show notification with animation
    notification.fadeIn(300);
    
    // Remove notification after 5 seconds
    setTimeout(() => {
        notification.fadeOut(300, function() {
            $(this).remove();
        });
    }, 5000);
}

// ===== Add Notification Styles =====
const notificationStyles = `
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 9999;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        animation: slideIn 0.3s ease;
    }
    
    .notification-success {
        background: linear-gradient(135deg, #00b09b, #96c93d);
    }
    
    .notification-error {
        background: linear-gradient(135deg, #ff416c, #ff4b2b);
    }
    
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
`;

// Add styles to document
$('head').append(`<style>${notificationStyles}</style>`);
</script>