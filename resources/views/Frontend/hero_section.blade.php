   
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
    background: none;           /* gradient remove */
    -webkit-background-clip: unset;  /* gradient clip remove */
    -webkit-text-fill-color: black;  /* solid black text */
    color: black;               /* fallback color */
}

.secound_hero_section {
    width: 100%;
    height: calc(100% - 80px); /* adjust hero text height */
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 0 50px;
}

.part_finder_card {
    width: 50%;
    display: flex;
    justify-content: flex-start; /* card left align */
    margin-top: -70px;
    margin-left: 10%;
    
}

.car {
    width: 400px;
    background: rgba(255, 255, 255, 0.95);
    /* backdrop-filter: blur(10px); */
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.hero_image_section {
    width: 50%;
    height: 100%;
    margin-right: 10%;
    margin-top: 60px;
    background-color: black;
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

/* Responsive */
@media (max-width: 768px) {
    .secound_hero_section {
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .part_finder_card,
    .hero_image_section {
        width: 100%;
    }

    .hero_image_section {
        height: 250px;
    }
}
.dropdown {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    max-height: 150px; /* تقریباً 5-6 options */
    overflow-y: auto;  /* scroll show کرے گا جب زیادہ options ہوں */
}
.select2-results__options {
    max-height: 180px !important;  /* 5–6 items */
    overflow-y: auto !important;
}
body, main, header, nav, .hero-section, .hero-section_p {
    background-image: none !important;
    background: none !important;
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
                        <select class="dropdown" id="make" name="car_make_id">
                            <option disabled selected value="">Select Your Make</option>
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
                            <option value="">Select Your Model Year</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}">{{ $year->year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group hidden" id="parts-group">
                        <select id="parts-dropdown" class="dropdown" disabled>
                            <option disabled selected value="">Select a part to add</option>
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
            <img src="https://partsfinder.ae/storage/profile_images/hero_section_image.png" alt="">
        </div>
    </div>

