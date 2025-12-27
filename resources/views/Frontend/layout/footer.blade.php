    <!-- Footer Section -->
    <style>
       
    </style>
    <footer class="footer-section">
           @php
        use Illuminate\Support\Facades\Request;
        use App\Models\Domain;

        $host = Request::getHost();

        // Current domain fetch karen
        $currentDomain = Domain::where('domain_url', $host)->first();

        // Logo aur favicon set karein, default logo agar na mile
        $logo = $currentDomain && $currentDomain->logo ? $currentDomain->logo : 'logo/44444.png';
        $favicon = $currentDomain && $currentDomain->map_img ? $currentDomain->map_img : '/logo/44444.png';
 
   
    $currentDomainUrl = Request::getSchemeAndHttpHost();
@endphp

        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6 mb-4">
          <a href="{{ $currentDomainUrl }}">

                  <div class="footer-logo">
                   
              
                            <img src="{{ asset('storage/'.$logo) }}" alt="">
                       
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
    <a href="https://www.facebook.com/partsfinderuae/" class="social-icon facebook" target="_blank" aria-label="Visit PartsFinder on Facebook">
        <i class="fab fa-facebook-f" aria-hidden="true"></i>
    </a>
    <a href="https://medium.com/@partsfinder" class="social-icon medium" target="_blank" aria-label="Visit PartsFinder on Medium">
        <i class="fab fa-medium-m" aria-hidden="true"></i>
    </a>
    <a href="https://www.pinterest.com/partsfinderae/" class="social-icon pinterest" target="_blank" aria-label="Visit PartsFinder on Pinterest">
        <i class="fab fa-pinterest-p" aria-hidden="true"></i>
    </a>
    <a href="https://www.reddit.com/user/Aggressive_Sea4965/" class="social-icon reddit" target="_blank" aria-label="Visit PartsFinder on Reddit">
        <i class="fab fa-reddit-alien" aria-hidden="true"></i>
    </a>
    <a href="https://www.linkedin.com/in/parts-finder-uae/" class="social-icon linkedin" target="_blank" aria-label="Visit PartsFinder on LinkedIn">
        <i class="fab fa-linkedin-in" aria-hidden="true"></i>
    </a>
    <a href="https://x.com/partsfinderae1" class="social-icon x" target="_blank" aria-label="Visit PartsFinder on X">
        <i class="fab fa-x-twitter" aria-hidden="true"></i>
    </a>
</div>


                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="copyright mb-0">© Copyrights Partsfinder UAE All Rights Reserved</p>
            </div>
        </div>
    </footer>

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
