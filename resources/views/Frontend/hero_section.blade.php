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
}

.hero_image_section img {
    width: 500px;          
    height: 400px;        
    object-fit: cover;   
}

.find-btn {
    width: 100%;
    background: linear-gradient(135deg, var(--accent-color), #ff9500);
    color: var(--primary-color);
    padding: 10px;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    height: 50px;
}

/* Add this CSS for hidden class */
.hidden {
    display: none !important;
}

.dropdown {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    max-height: 150px;
    overflow-y: auto;
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

#condition-group {
    display: block;
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

/* Responsive Styles */
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
            <form action="{{ route('buyer.inquiry.send') }}" method="post">
                @csrf
                <div class="form-group" id="make-group">
                    <select class="dropdown mySelect" id="make" name="car_make_id">
                        <option value="">Select Your Make</option>
                        @foreach ($makes as $make)
                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="model-group">
                    <select class="dropdown" id="model" name="car_model_id">
                        <option value="">Select Your Model</option>
                    </select>
                </div>

                <div class="form-group" id="year-group">
                    <select class="dropdown" id="year" name="year_id">
                        <option value="">Select Your Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group hidden" id="parts-group">
                    <select id="parts-dropdown" class="dropdown" name="part_id">
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

                <button class="find-btn" id="find-btn" disabled>Find My Part</button>
            </form>
        </div>
    </div>

    <div class="hero_image_section">
        <img src="https://partsfinder.ae/storage/profile_images/hero_section_image_1.png" alt="">
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('#make').select2({
        placeholder: "Select Your Make"
    });

    $('#model').select2({
        placeholder: "Select Your Model"
    });

    $('#year').select2({
        placeholder: "Select Year"
    });

    $('#parts-dropdown').select2({
        placeholder: "Select a part to add"
    });

    // Elements
    const partsGroup = document.getElementById("parts-group");
    const conditionGroup = document.getElementById("condition-group");
    const findBtn = document.getElementById("find-btn");

    let partSelected = false;

    // --- SHOW MODEL WHEN MAKE SELECTED ---
    $('#make').on('change', function() {
        const makeId = $(this).val();
        console.log("Make Selected:", makeId);
        
        // Reset and disable dependent fields
        $('#model').val(null).trigger('change').prop('disabled', !makeId);
        $('#year').val(null).trigger('change').prop('disabled', true);
        $('#parts-dropdown').val(null).trigger('change').prop('disabled', true);
        
        // Hide sections
        partsGroup.classList.add("hidden");
        conditionGroup.classList.add("hidden");
        partSelected = false;
        
        updateButton();
    });

    // --- SHOW YEAR WHEN MODEL SELECTED ---
    $('#model').on('change', function() {
        const modelId = $(this).val();
        console.log("Model Selected:", modelId);
        
        // Reset and disable dependent fields
        $('#year').val(null).trigger('change').prop('disabled', !modelId);
        $('#parts-dropdown').val(null).trigger('change').prop('disabled', true);
        
        // Hide sections
        partsGroup.classList.add("hidden");
        conditionGroup.classList.add("hidden");
        partSelected = false;
        
        updateButton();
    });

    // --- SHOW PARTS WHEN YEAR SELECTED ---
    $('#year').on('change', function() {
        const yearId = $(this).val();
        console.log("Year Selected:", yearId);
        
        if (yearId) {
            partsGroup.classList.remove("hidden");
            $('#parts-dropdown').prop('disabled', false);
        } else {
            partsGroup.classList.add("hidden");
            $('#parts-dropdown').prop('disabled', true);
            conditionGroup.classList.add("hidden");
        }
        
        partSelected = false;
        updateButton();
    });

    // --- WHEN USER SELECTS A PART ---
    $('#parts-dropdown').on('change', function() {
        const partId = $(this).val();
        console.log("Part Selected:", partId);
        
        if (partId) {
            partSelected = true;
            conditionGroup.classList.remove("hidden");
        } else {
            partSelected = false;
            conditionGroup.classList.add("hidden");
        }
        
        updateButton();
    });

    // --- CONDITION SELECT ---
    $("input[name='condition']").on('change', function() {
        updateButton();
    });

    // --- ENABLE BUTTON ONLY WHEN READY ---
    function updateButton() {
        const makeOk = $('#make').val() != "";
        const modelOk = $('#model').val() != "";
        const yearOk = $('#year').val() != "";
        const partOk = partSelected;

        console.log("Validation:", {makeOk, modelOk, yearOk, partOk});

        if (makeOk && modelOk && yearOk && partOk) {
            findBtn.disabled = false;
        } else {
            findBtn.disabled = true;
        }
    }

    // Initialize button state
    updateButton();
});
</script>