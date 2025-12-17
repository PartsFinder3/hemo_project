@extends('Frontend.layout.main')

@section('main-section')
<style>
    .domain-about-wrapper {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 80px 0;
    }

    .domain-about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .domain-about-header {
        text-align: center;
        margin-bottom: 60px;
        padding-bottom: 30px;
        border-bottom: 3px solid #e63946;
    }

    .domain-about-title {
        font-family: 'Montserrat', sans-serif;
        font-size: 2.8rem;
        font-weight: 700;
        color: #25396f;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .domain-about-subtitle {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2rem;
        color: #6c757d;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .domain-about-content-wrapper {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(37, 57, 111, 0.15);
        padding: 60px;
        margin-bottom: 40px;
        border: 1px solid rgba(0,0,0,0.05);
    }

    /* Override the database content styles */
    .domain-about-content-wrapper h1,
    .domain-about-content-wrapper h2,
    .domain-about-content-wrapper h3 {
        font-family: 'Montserrat', sans-serif;
        color: #25396f;
        margin: 30px 0 15px 0;
        font-weight: 700;
        line-height: 1.3;
    }

    .domain-about-content-wrapper h2 {
        font-size: 1.8rem;
        border-left: 4px solid #e63946;
        padding-left: 15px;
        margin-left: -19px;
    }

    .domain-about-content-wrapper h3 {
        font-size: 1.5rem;
        color: #2a4365;
    }

    .domain-about-content-wrapper p {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 1.1rem;
        line-height: 1.8;
        color: #4a5568;
        margin-bottom: 25px;
        text-align: justify;
    }

    .domain-about-content-wrapper ul {
        list-style: none;
        padding-left: 0;
        margin: 25px 0;
    }

    .domain-about-content-wrapper li {
        font-family: 'Inter', sans-serif;
        font-size: 1.1rem;
        line-height: 1.8;
        color: #4a5568;
        margin-bottom: 15px;
        padding-left: 30px;
        position: relative;
    }

    .domain-about-content-wrapper li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #e63946;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .highlight-box {
        background: linear-gradient(135deg, #25396f 0%, #1e2d56 100%);
        border-radius: 15px;
        padding: 40px;
        margin: 40px 0;
        color: white;
        box-shadow: 0 10px 30px rgba(37, 57, 111, 0.3);
    }

    .highlight-box h3 {
        color: white !important;
        font-size: 1.8rem;
        margin-top: 0;
    }

    .highlight-box p {
        color: rgba(255,255,255,0.9) !important;
        font-size: 1.1rem;
        line-height: 1.7;
    }

    .mission-vision-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin: 40px 0;
    }

    .mission-card, .vision-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border-top: 4px solid #e63946;
        transition: transform 0.3s ease;
    }

    .mission-card:hover, .vision-card:hover {
        transform: translateY(-5px);
    }

    .mission-card h3, .vision-card h3 {
        color: #e63946;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .cta-section {
        text-align: center;
        margin-top: 60px;
        padding: 40px;
        background: linear-gradient(135deg, #f0f7ff 0%, #e6f0ff 100%);
        border-radius: 20px;
        border: 2px dashed #25396f;
    }

    .cta-button {
        display: inline-block;
        background: linear-gradient(135deg, #e63946 0%, #c1121f 100%);
        color: white;
        padding: 15px 40px;
        border-radius: 50px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        font-size: 1.1rem;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(230, 57, 70, 0.3);
    }

    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(230, 57, 70, 0.4);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .domain-about-wrapper {
            padding: 40px 0;
        }
        
        .domain-about-content-wrapper {
            padding: 40px 30px;
        }
        
        .domain-about-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 768px) {
        .domain-about-content-wrapper {
            padding: 30px 20px;
            border-radius: 15px;
        }
        
        .domain-about-title {
            font-size: 1.8rem;
        }
        
        .domain-about-content-wrapper h2 {
            font-size: 1.5rem;
        }
        
        .domain-about-content-wrapper p {
            font-size: 1rem;
            text-align: left;
        }
        
        .highlight-box {
            padding: 25px 20px;
            margin: 30px 0;
        }
        
        .mission-vision-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .domain-about-wrapper {
            padding: 20px 0;
        }
        
        .domain-about-content-wrapper {
            padding: 20px 15px;
        }
        
        .domain-about-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="domain-about-wrapper">
    <div class="domain-about-container">
        <div class="domain-about-header">
            <h1 class="domain-about-title">About Us</h1>
            <p class="domain-about-subtitle">Discover our story, mission, and commitment to revolutionizing the auto parts industry in the UAE</p>
        </div>
        
        <div class="domain-about-content-wrapper">
            @if($domain)
                {!! $domain->about !!}
            @else
                <div class="text-center py-5">
                    <h3>No domain configuration found.</h3>
                    <p>Please contact the administrator.</p>
                </div>
            @endif
            
            <!-- Enhanced CTA Section -->
            <div class="cta-section">
                <h3 style="color: #25396f; margin-bottom: 20px;">Ready to Find Your Perfect Auto Part?</h3>
                <p style="color: #4a5568; margin-bottom: 30px; font-size: 1.1rem;">Join thousands of satisfied customers who found exactly what they needed through our platform.</p>
                <a href="{{ url('/find-parts') }}" class="cta-button">Start Your Search Now</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Add some interactivity to the page
    document.addEventListener('DOMContentLoaded', function() {
        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe mission and vision cards
        document.querySelectorAll('.mission-card, .vision-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
        
        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if(targetId !== '#') {
                    const targetElement = document.querySelector(targetId);
                    if(targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    });
</script>
@endsection