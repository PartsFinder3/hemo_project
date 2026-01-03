<!-- Review Section -->
<section class="review-section">
    <div class="section-header">
      <h2 style="font-family: 'Arial Black', Gadget, sans-serif; font-size: 2.5rem; color: black;">
    What Our <span style="color: #ff7700;">Customers</span> Say
</h2>
        <p class="section-subtitle">Read authentic reviews from people who've experienced our service</p>
    </div>
    
    <div class="review-container">
        <button class="slide-btn left" aria-label="Previous review">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <div class="review-slider">
            <!-- Card 1 -->
            <div class="review-card">
                <div class="card-header">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="review-date">2 days ago</div>
                </div>
                <p class="message">"I needed a rare spare part for my car and found it instantly on partsfinder.ae. Fast delivery and genuine products — highly recommend!"</p>
                <div class="customer-info">
                    <div class="avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="customer-details">
                        <h3 class="name">Ahmed Al Mansoori</h3>
                        <p class="customer-role">Business Owner</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="review-card">
                <div class="card-header">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="review-date">1 week ago</div>
                </div>
                <p class="message">"Great selection of parts and very user-friendly search. I found exactly what I needed without any hassle!"</p>
                <div class="customer-info">
                    <div class="avatar" style="background-color: #4CAF50;">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="customer-details">
                        <h3 class="name">Sara Khan</h3>
                        <p class="customer-role">Marketing Director</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="review-card">
                <div class="card-header">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="review-date">2 weeks ago</div>
                </div>
                <p class="message">"Excellent prices and reliable quality. partsfinder.ae saved me time and money. The customer support was also very helpful"</p>
                <div class="customer-info">
                    <div class="avatar" style="background-color: #2196F3;">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="customer-details">
                        <h3 class="name">Omar Al Hashmi</h3>
                        <p class="customer-role">Startup Founder</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 4 -->
            <div class="review-card">
                <div class="card-header">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="review-date">3 weeks ago</div>
                </div>
                <p class="message">"Ordered multiple items and everything arrived perfectly packed and on time. A trustworthy place for auto parts!"</p>
                <div class="customer-info">
                    <div class="avatar" style="background-color: #9C27B0;">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="customer-details">
                        <h3 class="name">Fatima Yusuf</h3>
                        <p class="customer-role">Freelancer</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 5 -->
            <div class="review-card">
                <div class="card-header">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="review-date">1 month ago</div>
                </div>
                <p class="message">"partsfinder.ae makes finding spare parts so easy. The filters and search options are superb — will shop here again!"</p>
                <div class="customer-info">
                    <div class="avatar" style="background-color: #FF9800;">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="customer-details">
                        <h3 class="name">Hassan Qureshi</h3>
                        <p class="customer-role">Product Manager</p>
                    </div>
                </div>
            </div>
        </div>
        
        <button class="slide-btn right" aria-label="Next review">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
    
    <div class="slider-dots">
        <div class="dot active" data-index="0"></div>
        <div class="dot" data-index="1"></div>
        <div class="dot" data-index="2"></div>
        <div class="dot" data-index="3"></div>
        <div class="dot" data-index="4"></div>
    </div>
</section>

<style>
    /* Review Section Styles */
    .review-section {
        max-width: 1200px;
        margin: 80px auto;
        padding: 30px;
        text-align: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .section-header {
        margin-bottom: 50px;
    }
    
.section-title {
    font-size: 2.5rem;
    color: black; /* Pure black text for the title */
    margin-bottom: 10px;
    font-weight: 700;
    letter-spacing: -0.5px;
}
    
 .section-title .highlight {
    color: #ff7700; 
}
    
    .section-title .highlight::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 100%;
        height: 8px;
        background-color: rgba(255, 119, 0, 0.2);
        z-index: -1;
    }
    
    .section-subtitle {
        color: #666;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.5;
    }
    
    /* Review Container */
    .review-container {
        position: relative;
        overflow: hidden;
        margin: 0 auto 40px;
        padding: 10px;
    }
    
    /* Review Slider */
    .review-slider {
        display: flex;
        gap: 30px;
        transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        padding: 10px 5px;
    }
    
    /* Review Card */
    .review-card {
        width: 300px; 
        background: white;
        padding: 30px;
        border-radius: 16px;
        min-width: 320px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        flex-shrink: 0;
        border: 1px solid rgba(255, 119, 0, 0.1);
        position: relative;
        overflow: hidden;
        height: 299px;
    }
    
    .review-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #ff7700, #ffaa00);
    }
    
    .review-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(255, 119, 0, 0.15);
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .stars {
        color: #ff7700;
        font-size: 1.2rem;
    }
    
    .stars .far {
        color: #ddd;
    }
    
    .review-date {
        color: #888;
        font-size: 0.85rem;
    }
    
    .message {
        font-size: 1rem;
        line-height: 1.6;
        color: #555;
        margin-bottom: 25px;
        text-align: left;
        font-style: italic;
        height: 115px;
    }
    
    /* Customer Info */
    .customer-info {
        display: flex;
        align-items: center;
        text-align: left;
    }
    
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #ff7700;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
        font-size: 2rem;
    }
    
    .customer-details .name {
        font-weight: 700;
        color: #333;
        margin-bottom: 4px;
        font-size: 1.1rem;
    }
    
    .customer-role {
        color: #777;
        font-size: 0.9rem;
    }
    
    /* Slide Buttons */
    .slide-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.2rem;
        z-index: 10;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        color: #ff7700;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .slide-btn:hover {
        background: #ff7700;
        color: white;
        transform: translateY(-50%) scale(1.1);
    }
    
    .slide-btn.left {
        left: 10px;
    }
    
    .slide-btn.right {
        right: 10px;
    }
    
    /* Slider Dots */
    .slider-dots {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }
    
    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #ddd;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .dot.active {
        background-color: #ff7700;
        transform: scale(1.2);
    }
    
    .dot:hover {
        background-color: #ffaa00;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .review-section {
            padding: 20px;
            margin: 40px auto;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .review-card {
            min-width: 280px;
            padding: 25px;
        }
        
        .slide-btn {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .slide-btn.left {
            left: 5px;
        }
        
        .slide-btn.right {
            right: 5px;
        }
    }
    
    @media (max-width: 480px) {
        .review-card {
            min-width: 260px;
        }
        
        .review-slider {
            gap: 20px;
        }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.review-slider');
    const leftBtn = document.querySelector('.slide-btn.left');
    const rightBtn = document.querySelector('.slide-btn.right');
    const dots = document.querySelectorAll('.dot');
    const cards = document.querySelectorAll('.review-card');

    let currentIndex = 0;

    // Function to calculate widths
    function getCardWidth() {
        const cardStyle = getComputedStyle(cards[0]);
        const gap = parseInt(getComputedStyle(slider).gap) || 0;
        return cards[0].offsetWidth + gap;
    }

    function getMaxIndex() {
        const visibleCards = Math.floor(slider.parentElement.clientWidth / getCardWidth());
        return Math.max(cards.length - visibleCards, 0);
    }

    function updateSliderPosition() {
        const scrollAmount = currentIndex * getCardWidth();
        slider.style.transform = `translateX(-${scrollAmount}px)`;
        updateDots();
    }

    function updateDots() {
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
    }

    // Button clicks
    rightBtn.addEventListener('click', () => {
        currentIndex++;
        if (currentIndex > getMaxIndex()) currentIndex = getMaxIndex();
        updateSliderPosition();
    });

    leftBtn.addEventListener('click', () => {
        currentIndex--;
        if (currentIndex < 0) currentIndex = 0;
        updateSliderPosition();
    });

    // Dot clicks
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            currentIndex = parseInt(dot.getAttribute('data-index'));
            if (currentIndex > getMaxIndex()) currentIndex = getMaxIndex();
            updateSliderPosition();
        });
    });

    // Auto slide
    let autoSlide = setInterval(() => {
        if (currentIndex < getMaxIndex()) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateSliderPosition();
    }, 5000);

    // Pause auto-slide on hover
    slider.parentElement.addEventListener('mouseenter', () => clearInterval(autoSlide));
    slider.parentElement.addEventListener('mouseleave', () => {
        autoSlide = setInterval(() => {
            if (currentIndex < getMaxIndex()) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateSliderPosition();
        }, 5000);
    });

    // Update on window resize
    window.addEventListener('resize', () => {
        if (currentIndex > getMaxIndex()) currentIndex = getMaxIndex();
        updateSliderPosition();
    });

    // Initialize
    updateSliderPosition();
});
</script>
