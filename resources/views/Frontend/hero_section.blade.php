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
    margin-bottom: 20px;
}

.hero_section_text .hiliter {
    display: inline;   /* inline رکھیں تاکہ text کے ساتھ flow ہو */
    padding: 0 5px;
    font-weight: bold;
    margin-right: 7px !important;
  
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
    margin-top: -20px;

}

.part_finder_card {
    flex: 1 1 45%;
    display: flex;
    justify-content: flex-end; /* کارڈ کو رائٹ پر بھیجیں */
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
    border-radius: 4px;
    height: 40px;
    padding: 5px 10px;
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
                    <select class="dropdown mySelect highlight-border" id="make" name="car_make_id">
                        <option selected value="">Select a part make</option>
                        @foreach ($makes as $make)
                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="model-group">
                    <select class="dropdown" id="model" name="car_model_id">
                        <option value="">Select a Model</option>
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
    <img src="{{ asset($image) }}" alt="">
</div>
</div>

<script>
// ===== تمام handlers کے لیے global variables =====
const partsGroup = document.getElementById("parts-group");
const partsDropdown = document.getElementById("parts-dropdown");
const conditionGroup = document.getElementById("condition-group");
let partSelected = false;

// ===== Select2 initialization =====
$('#make').select2({
    placeholder: "Select Your Make",
    ajax: {
        url: '/search-makes',
        dataType: 'json',
        delay: 250,
        data: function(params) { return { q: params.term }; },
        processResults: function(data) {
            return { results: $.map(data, item => ({ id: item.id, text: item.name })) };
        },
        cache: true
    }
});

$('#model').select2({
    placeholder: "Select Your Model",
    ajax: {
        url: '/search-models',
        dataType: 'json',
        delay: 250,
        data: function(params) { return { q: params.term, make_id: $('#make').val() }; },
        processResults: function(data) {
            return { results: $.map(data, item => ({ id: item.id, text: item.name })) };
        },
        cache: true
    }
});

$('#year').select2({
    placeholder: "Select Year",
    ajax: {
        url: '/search-years',
        dataType: 'json',
        delay: 250,
        data: function(params) { return { q: params.term, model_id: $('#model').val() }; },
        processResults: function(data) { return { results: data }; }
    }
});

$('#parts-dropdown').select2({
    placeholder: "Select Parts",
    ajax: {
        url: '/search-parts',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return { q: params.term, model_id: $('#model').val(), year_id: $('#year').val() };
        },
        processResults: function(data) {
            return { results: $.map(data, item => ({ id: item.id, text: item.name })) };
        },
        cache: true
    }
});

// ===== Event handlers =====

// Make select ہونے پر
$('#make').on('select2:select', function() {
    $('#model, #year').val(null).trigger('change'); 
    partsGroup.classList.add("hidden");
    conditionGroup.classList.add("hidden");
    
    partSelected = false;
    updateButton();
});

// Model select ہونے پر
$('#model').on('select2:select', function() {
    $('#year').val(null).trigger('change');
    partsGroup.classList.add("hidden");
    conditionGroup.classList.add("hidden");
    partSelected = false;
    updateButton();
});

// Year select ہونے پر
$('#year').on('select2:select', function() {
    partsGroup.classList.remove("hidden");
    partsDropdown.disabled = false;
    updateButton();
});

// Part select ہونے پر
$('#parts-dropdown').on('select2:select', function() {
    partSelected = true;
    conditionGroup.classList.remove("hidden");
    updateButton();
});

// Button enable/disable logic
function updateButton() {
    const makeVal = $('#make').val();
    const modelVal = $('#model').val();
    const yearVal = $('#year').val();
    const partVal = $('#parts-dropdown').val();
    const findBtn = $('#find-btn');

    if (makeVal && modelVal && yearVal && partVal && partVal.length > 0) {
        findBtn.prop('disabled', false);
    } else {
        findBtn.prop('disabled', true);
    }
}
// Make ko start me highlight
$("#make").next('.select2-container').find('.select2-selection').addClass("highlight-border");

// Step 1: Make → Model
$('#make').on('select2:select', function () {
    $("#make").next('.select2-container').find('.select2-selection').removeClass("highlight-border");
    $("#model").next('.select2-container').find('.select2-selection').addClass("highlight-border");
});

// Step 2: Model → Year
$('#model').on('select2:select', function () {
    $("#model").next('.select2-container').find('.select2-selection').removeClass("highlight-border");
    $("#year").next('.select2-container').find('.select2-selection').addClass("highlight-border");
});

// Step 3: Year → Parts
$('#year').on('select2:select', function () {
    $("#year").next('.select2-container').find('.select2-selection').removeClass("highlight-border");
    $("#parts-dropdown").next('.select2-container').find('.select2-selection').addClass("highlight-border");
});

// Step 4: Parts selected → remove highlight
$('#parts-dropdown').on('select2:select', function () {
    $("#parts-dropdown").next('.select2-container').find('.select2-selection').removeClass("highlight-border");
});
        const burgerMenu = document.getElementById("burger-menu");
const navMenu = document.getElementById("nav-menu");

if (burgerMenu && navMenu) {
    burgerMenu.addEventListener("click", function () {
        burgerMenu.classList.toggle("active");
        navMenu.classList.toggle("active");
    });

    // Close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll(".nav-menu a");
    navLinks.forEach((link) => {
        link.addEventListener("click", () => {
            burgerMenu.classList.remove("active");
            navMenu.classList.remove("active");
        });
    });

    // Close mobile menu when clicking outside
    document.addEventListener("click", function (event) {
        if (
            !burgerMenu.contains(event.target) &&
            !navMenu.contains(event.target)
        ) {
            burgerMenu.classList.remove("active");
            navMenu.classList.remove("active");
        }
    });

    // Close mobile menu on window resize
    window.addEventListener("resize", function () {
        if (window.innerWidth > 768) {
            burgerMenu.classList.remove("active");
            navMenu.classList.remove("active");
        }
    });
}
</script>
