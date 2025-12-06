<style>
.about {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
    overflow: hidden;
}

.about::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="white" opacity="0.3" d="M0,0 L100,0 L100,100 Z"/></svg>');
    background-size: cover;
    pointer-events: none;
}

.about-content {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.about-content:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
}

.about-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(to bottom, #4361ee, #3a0ca3);
    border-radius: 4px 0 0 4px;
}

.about-content h1, 
.about-content h2, 
.about-content h3 {
    color: #1a1a1a;
    margin-bottom: 1.5rem;
    font-weight: 700;
    position: relative;
    padding-bottom: 10px;
}

.about-content h1::after,
.about-content h2::after,
.about-content h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(to right, #4361ee, #3a0ca3);
    border-radius: 2px;
}

.about-content p {
    color: #4a5568;
    line-height: 1.8;
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
}

.about-content ul, 
.about-content ol {
    padding-left: 2rem;
    margin-bottom: 1.5rem;
}

.about-content li {
    margin-bottom: 0.75rem;
    color: #4a5568;
    line-height: 1.6;
    position: relative;
}

.about-content ul li::before {
    content: '✓';
    position: absolute;
    left: -1.5rem;
    color: #4361ee;
    font-weight: bold;
}

.about-content blockquote {
    border-left: 4px solid #e57224;
    padding-left: 2rem;
    margin: 2rem 0;
    font-style: italic;
    color: #2d3748;
    background: #f7fafc;
    padding: 1.5rem 2rem;
    border-radius: 0 10px 10px 0;
}

.about-content img {
    border-radius: 12px;
    max-width: 100%;
    height: auto;
    margin: 2rem 0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.about-content img:hover {
    transform: scale(1.02);
}

.about-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    overflow: hidden;
}

.about-content table th {
    background: linear-gradient(135deg, #4361ee, #3a0ca3);
    color: white;
    padding: 1rem;
    text-align: left;
}

.about-content table td {
    padding: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.about-content table tr:nth-child(even) {
    background-color: #f8fafc;
}

.about-content a {
    color: #4361ee;
    text-decoration: none;
    position: relative;
    transition: color 0.3s ease;
}

.about-content a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: #4361ee;
    transition: width 0.3s ease;
}

.about-content a:hover {
    color: #3a0ca3;
}

.about-content a:hover::after {
    width: 100%;
}

@media (max-width: 768px) {
    .about-content {
        padding: 2rem;
        margin: 0 1rem;
    }
    
    .about-content h1 {
        font-size: 2rem;
    }
    
    .about-content h2 {
        font-size: 1.75rem;
    }
    
    .about-content h3 {
        font-size: 1.5rem;
    }
    
    .about-content p {
        font-size: 1rem;
    }
}
</style>
<section class="about">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="about-content">
                    @if($domain && $domain->companyData && $domain->companyData->about_us)
                        {!! $domain->companyData->about_us !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- FAQs -->
@if($getFAQS->count() > 0)
    <section class="faqs">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <h1 class="main-title text-center mb-5">Frequently Asked Questions</h1>

                    <!-- General Service Questions -->
                    @foreach ($getFAQS as $FAQS)              
                    <div class="mb-5">
                        <div class="accordion" id="generalServiceAccordion">
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#general1" aria-expanded="false" aria-controls="general1">
                                        {{$FAQS->F_question}}
                                    </button>
                                </h3>
                                <div id="general1" class="accordion-collapse collapse"
                                    data-bs-parent="#generalServiceAccordion">
                                    <div class="accordion-body">
                                        {{$FAQS->F_answer}}
                                       
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                  @endforeach
                
                    <!-- Support Section -->
                
                </div>
            </div>
        </div>
    </section>
    @endif
    <section class="cta-banner">
        <div class="cta-content">
            <h2>Find Car Spare Parts Online Today</h2>
            <p>Get instant quotes from local spare part sellers and compare prices in just a few clicks.</p>

            <div class="cta-actions">
                <a href="#" class="cta-btn">Find My Part</a>
                <div class="trust-points">
                    <span><i class="fa-solid fa-shield-check"></i> Verified Sellers</span>
                    <span><i class="fa-solid fa-coins"></i> Save Time & Money</span>
                </div>
            </div>
        </div>

        <div class="cta-image">
            <img src="{{asset('Frontend/assets/quote.png')}}" alt="Mechanics fixing car">
        </div>
    </section>
