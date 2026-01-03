<!-- Review Section -->
<section class="review-section">
  <h2>What Our Customers Say</h2>
  <div class="review-container">
    <button class="slide-btn left">&#10094;</button>
    <div class="review-slider">
      <!-- Card 1 -->
      <div class="review-card">
        <div class="stars">⭐⭐⭐⭐⭐</div>
        <p class="message">Amazing service! Highly recommend.</p>
        <h3 class="name">John Doe</h3>
      </div>
      <!-- Card 2 -->
      <div class="review-card">
        <div class="stars">⭐⭐⭐⭐</div>
        <p class="message">Very professional and fast delivery.</p>
        <h3 class="name">Jane Smith</h3>
      </div>
      <!-- Card 3 -->
      <div class="review-card">
        <div class="stars">⭐⭐⭐⭐⭐</div>
        <p class="message">Exceeded my expectations!</p>
        <h3 class="name">Ali Khan</h3>
      </div>
      <!-- Card 4 -->
      <div class="review-card">
        <div class="stars">⭐⭐⭐</div>
        <p class="message">Good, but can improve in some areas.</p>
        <h3 class="name">Sara Ahmed</h3>
      </div>
      <!-- Card 5 -->
      <div class="review-card">
        <div class="stars">⭐⭐⭐⭐</div>
        <p class="message">Great experience overall.</p>
        <h3 class="name">David Lee</h3>
      </div>
    </div>
    <button class="slide-btn right">&#10095;</button>
  </div>
</section>

<style>
.review-section {
  max-width: 900px;
  margin: 50px auto;
  text-align: center;
  font-family: Arial, sans-serif;
}

.review-container {
  position: relative;
  overflow: hidden;
}

.review-slider {
  display: flex;
  gap: 20px;
  transition: transform 0.3s ease-in-out;
}

.review-card {
  background: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
  min-width: 250px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.stars {
  color: #ffb400;
  margin-bottom: 10px;
}

.message {
  font-size: 0.95rem;
  margin-bottom: 15px;
}

.name {
  font-weight: bold;
  color: #333;
}

.slide-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: #ffb400;
  border: none;
  padding: 10px;
  border-radius: 50%;
  cursor: pointer;
  font-size: 18px;
  z-index: 10;
}

.slide-btn.left { left: 0; }
.slide-btn.right { right: 0; }
</style>

<script>
const slider = document.querySelector('.review-slider');
const leftBtn = document.querySelector('.slide-btn.left');
const rightBtn = document.querySelector('.slide-btn.right');

let scrollAmount = 0;

rightBtn.addEventListener('click', () => {
  scrollAmount += 260; // width + gap
  if(scrollAmount > (slider.scrollWidth - slider.clientWidth)) scrollAmount = slider.scrollWidth - slider.clientWidth;
  slider.style.transform = `translateX(-${scrollAmount}px)`;
});

leftBtn.addEventListener('click', () => {
  scrollAmount -= 260;
  if(scrollAmount < 0) scrollAmount = 0;
  slider.style.transform = `translateX(-${scrollAmount}px)`;
});
</script>
