    <!-- Footer Section -->
    <style>
/* Scroll to Top Button – Premium Style */
#scrollTopBtn {
    display: none;
    position: fixed;
    bottom: 40px;
    right: 40px;
    z-index: 999;

    width: 54px;
    height: 54px;

    background: linear-gradient(135deg, #ff7700, #ff9a3c);
    color: #fff;

    border: none;
    border-radius: 50%;

    cursor: pointer;

    display: flex;
    align-items: center;
    justify-content: center;

    box-shadow:
        0 8px 25px rgba(255, 119, 0, 0.45),
        inset 0 0 0 1px rgba(255, 255, 255, 0.2);

    transition: all 0.35s ease;
}

/* Icon styling */
#scrollTopBtn i {
    font-size: 20px;
    transition: transform 0.3s ease;
}

/* Hover effect */
#scrollTopBtn:hover {
    transform: translateY(-6px) scale(1.05);
    box-shadow:
        0 12px 35px rgba(255, 119, 0, 0.65);
}

/* Icon move on hover */
#scrollTopBtn:hover i {
    transform: translateY(-2px);
}

/* Active (click) effect */
#scrollTopBtn:active {
    transform: scale(0.95);
}

/* Mobile adjustment */
@media (max-width: 768px) {
    #scrollTopBtn {
        bottom: 20px;
        right: 20px;
        width: 48px;
        height: 48px;
    }

    #scrollTopBtn i {
        font-size: 18px;
    }
}
    </style>    <!-- Footer Section -->
    <footer class="footer-section">
        <button id="scrollTopBtn" title="Go to top">
    <i class="fas fa-chevron-up"></i>
</button>
        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6 mb-4">
            <a href="https://partsfinder.ae">

                  <div class="footer-logo">
                   
              
                            <img src="https://partsfinder.ae/storage/logo/44444.png" alt="">
                       
                    </div>
            </a>
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
                        <li><a href="{{route('found_pages.index')}}">Found Pages</a></li>
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

                    <a href="tel:+971 50 256 6002" class="contact-phone">
                        <i class="fas fa-phone"></i>
                        +971 50 256 6002
                    </a>

                 <div class="social-icons">
                    <a href="https://www.facebook.com/partsfinderuae/" class="social-icon facebook" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://medium.com/@partsfinder" class="social-icon medium" target="_blank">
                        <i class="fab fa-medium"></i>
                    </a>
                    <a href="https://www.pinterest.com/partsfinderae/" class="social-icon pinterest" target="_blank">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>

                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="copyright mb-0">© Copyrights Partfinder UAE All Rights Reserved</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        window.getModelsUrl = "{{ url('get-models') }}/";
    </script>

    <script>
        function contactSupplier(isActive, number, title) {
            if (isActive == 1) {
                let message = encodeURIComponent("Hello, I'm interested in your ad: " + title);
                let isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

                let url = isMobile ?
                    `https://wa.me/${number}?text=${message}` :
                    `https://web.whatsapp.com/send?phone=${number}&text=${message}`;

                window.open(url, "_blank");
            } else {
                // Supplier inactive → stay on same page
                window.location.reload();
            }
        }

        function callSupplier(isActive, number) {
            if (isActive == 1) {
                window.location.href = `tel:${number}`;
            } else {
                // Supplier inactive → stay on same page
                window.location.reload();
            }
        }
        let scrollTopBtn = document.getElementById("scrollTopBtn");

// Show button when user scrolls down 100px
window.onscroll = function() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        scrollTopBtn.style.display = "flex";
    } else {
        scrollTopBtn.style.display = "none";
    }
};

// Scroll smoothly to top on click
scrollTopBtn.addEventListener("click", function() {
    window.scrollTo({ top: 0, behavior: "smooth" });
});
    </script>
    <script src="{{ asset('Frontend/js/script.js') }}"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    </body>

    </html>
