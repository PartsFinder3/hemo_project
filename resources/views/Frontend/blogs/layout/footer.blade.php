
    <!-- Footer Section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-logo">
                        <img src="{{asset('storage/' . $domain->logo)}}" alt="">
                    </div>

                    <p class="footer-description">
                        We are car spare parts price comparison website helping you get the best local deals on spare
                        parts in UAE
                    </p>
                </div>

                <!-- Information Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Information</h5>
                    <ul class="footer-links">
                        <li><a href="{{route('about.page')}}">About Us</a></li>
                        <li><a href="{{route('frontend.terms')}}">Terms & Condition</a></li>
                        <li><a href="{{route('frontend.privacy')}}">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="{{route('supplier.login')}}">Supplier Login</a></li>
                        <li><a href="{{ route('frontend.signup') }}">Become a Supplier</a></li>
                        <li><a href="{{ route('view.shops') }}">Spare Part Shops</a></li>
                        {{-- <li><a href="#faqs">FAQs</a></li> --}}
                        <li><a href="{{ route('frontend.blogs') }}">Blog</a></li>
                    </ul>
                </div>

                <!-- Contact & Social -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="footer-title">Need Help?</h5>
                    <p class="mb-3" style="color: #adb5bd; font-size: 1.1rem; font-weight: 600;">Contact Us</p>

                    <a href="tel:00971557872262" class="contact-phone">
                        <i class="fas fa-phone"></i>
                        00971-55-7872262
                    </a>

                    {{-- <div class="social-icons">
                        <a href="#" class="social-icon facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon pinterest">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div> --}}
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="copyright mb-0">© Copyrights Partfinder UAE All Rights Reserved</p>
            </div>
        </div>
    </footer>
    <script>
        // Mobile Menu Functionality
        const burgerMenu = document.getElementById("burger-menu");
        const navMenu = document.getElementById("nav-menu");

        if (burgerMenu && navMenu) {
            burgerMenu.addEventListener("click", function() {
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
            document.addEventListener("click", function(event) {
                if (
                    !burgerMenu.contains(event.target) &&
                    !navMenu.contains(event.target)
                ) {
                    burgerMenu.classList.remove("active");
                    navMenu.classList.remove("active");
                }
            });

            // Close mobile menu on window resize
            window.addEventListener("resize", function() {
                if (window.innerWidth > 768) {
                    burgerMenu.classList.remove("active");
                    navMenu.classList.remove("active");
                }
            });
        }

        // Category filtering function
        function filterPosts(category) {
            const blogCards = document.querySelectorAll('.blog-card');
            const categoryItems = document.querySelectorAll('.category-item');

            // Remove active state from all categories
            categoryItems.forEach(item => {
                item.style.background = '';
                item.style.color = '';
            });

            // Add active state to clicked category
            event.target.closest('.category-item').style.background =
                'linear-gradient(135deg, var(--accent-color) 0%, #ff9933 100%)';
            event.target.closest('.category-item').style.color = 'var(--secondary-color)';

            // Filter blog cards
            blogCards.forEach(card => {
                const badge = card.querySelector('.badge');
                const cardCategory = badge.textContent.toLowerCase().trim();

                if (category === 'all' || cardCategory.includes(category.toLowerCase())) {
                    card.style.display = 'block';
                    card.style.opacity = '1';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const blogCards = document.querySelectorAll('.blog-card');

            blogCards.forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const content = card.querySelector('.card-text').textContent.toLowerCase();

                if (title.includes(searchTerm) || content.includes(searchTerm) || searchTerm === '') {
                    card.style.display = 'block';
                    card.style.opacity = '1';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Smooth scroll animation for better UX
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to blog cards
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

            document.querySelectorAll('.blog-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });

        // Add click handlers for popular posts
        document.querySelectorAll('.popular-post').forEach(post => {
            post.addEventListener('click', function() {
                // In a real application, this would navigate to the post
                console.log('Navigating to:', this.querySelector('h6').textContent);
            });
        });

        // Add show all posts functionality
        function showAllPosts() {
            const blogCards = document.querySelectorAll('.blog-card');
            const categoryItems = document.querySelectorAll('.category-item');

            // Remove active state from all categories
            categoryItems.forEach(item => {
                item.style.background = '';
                item.style.color = '';
            });

            // Show all cards
            blogCards.forEach(card => {
                card.style.display = 'block';
                card.style.opacity = '1';
            });
        }

        // Add show all button functionality (can be called from anywhere)
        window.showAllPosts = showAllPosts;
    </script>
</body>

</html>
