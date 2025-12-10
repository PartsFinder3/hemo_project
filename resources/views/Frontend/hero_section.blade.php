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
.select2-selection--multiple {
    min-height: 45px !important; /* کم از کم height */
    height: auto !important;     /* auto height تاکہ multiple items دکھیں */
}

/* Selected items rendering */
.select2-selection__rendered {
    line-height: normal !important; /* auto line height for multi-select */
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
.select2-container {
    z-index: 9999 !important;
}
</style>

<div class="hero_section_text">
    <h1>{!! $part !!}</h1>
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
