  @extends('Frontend.layout.main')

@section('main-section')
    <style>
                body, main, header, nav, .hero-section, .hero-section_p {
    background-image: none !important;
    background: none !important;
}
        :root {
            --primary-orange: #ff7700;
            --primary-dark: #2b2d2f;
            --primary-orange-hover: #d44822;
            --primary-dark-light: #2a2f4a;
        }
.login-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px; /* optional, for small screens */
}
        .signup-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            min-height: 650px;
        }

        .signup-left {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            text-align: left;
            height: 100%;
        }

        .signup-left .logo {
            max-width: 200px;
            margin-bottom: 20px;
            align-self: center;
        }

        .signup-left h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .signup-left p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        #steps {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-left: 20px;
            margin-top: 10px;
            gap: 8px;
        }

        #steps h4 {
            margin-bottom: 10px;
        }

        .signup-right {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .signup-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .signup-title {
            color: var(--primary-dark);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .signup-subtitle {
            color: #6c757d;
            font-size: 1rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .form-control,
        .form-select {
            height: 55px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 1rem;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-orange);
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(233, 84, 38, 0.15);
        }

        .input-group .form-select {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
            border-right: none;
        }

        .input-group .form-control {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .btn-signup {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-hover) 100%);
            border: none;
            border-radius: 12px;
            height: 55px;
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-signup:hover {
            background: linear-gradient(135deg, var(--primary-orange-hover) 0%, #c23d1e 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(233, 84, 38, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }

        .login-link a {
            color: var(--primary-orange);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            color: var(--primary-orange-hover);
            text-decoration: underline;
        }

        @media (max-width: 767.98px) {
            .signup-left {
                display: none;
            }

            .signup-right {
                padding: 30px 20px;
            }
        }
    </style>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 start-0 p-3 login-container"  style="z-index: 1100;">
        @if (session('success'))
            <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="row g-0 justify-content-center">
            <div class="col-xl-10 col-lg-11 col-md-12">
                <div class="card signup-card">
                    <div class="row g-0 h-100">
                        <!-- Left Side - Brand -->
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="signup-left w-100">
                                <div class="logo">
                                    @if($domain && $domain->logo)
                                        <img style="width: 100%" src="https://partsfinder.ae/storage/logo/44444.png" alt="">
                                    @endif
                                </div>
                                <h1>Join PartsFinder</h1>
                                <p>Ready to Join the UAE’s Largest Car Parts Network?</p>
                                <p style="font-weight: 700;">
                                    Showcase your business to thousands of car owners and garages actively searching for
                                    car parts across the UAE.
                                </p>

                                <ul id="steps">
                                    <h4>Why Join PartsFinder UAE?</h4>
                                    <li>As easy as using WhatsApp</li>
                                    <li>Reach thousands of car part buyers instantly</li>
                                    <li>Perfect for both new and used part sellers</li>
                                    <li>Trusted by part suppliers all over the UAE</li>
                                    <li>Stay ahead of your competition with more visibility</li>
                                </ul>

                                <p>Join PartsFinder UAE Today — Grow Your Sales Faster Than Ever!</p>
                            </div>
                        </div>

                        <!-- Right Side - Signup Form -->
                        <div class="col-lg-6">
                            <div class="signup-right">
                                <div class="signup-header">
                                    <h2 class="signup-title">Create Account</h2>
                                    <p class="signup-subtitle">Fill in the details to get started</p>
                                </div>

                                <form action="{{ route('supplier.create') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-user me-2"></i>Full Name</label>
                                        <input type="text" class="form-control" placeholder="Enter your full name"
                                            required name="name">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-building me-2"></i>Business
                                            Name</label>
                                        <input type="text" class="form-control"
                                            placeholder="Enter your business name" required name="business_name">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-city me-2"></i>Select City</label>
                                        <select class="form-select" required name="city_id">
                                            <option selected disabled>Choose city</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                                        <input type="email" class="form-control" placeholder="Enter your email"
                                            required name="email">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-phone me-2"></i>Phone Number</label>
                                        <div class="input-group">
                                            <select class="form-select" style="max-width:120px;" name="country_code">
                                                <option value="">Select Country</option>
                                                <option value="+93">🇦🇫 Afghanistan (+93)</option>
                                                <option value="+355">🇦🇱 Albania (+355)</option>
                                                <option value="+213">🇩🇿 Algeria (+213)</option>
                                                <option value="+376">🇦🇩 Andorra (+376)</option>
                                                <option value="+244">🇦🇴 Angola (+244)</option>
                                                <option value="+1-268">🇦🇬 Antigua and Barbuda (+1-268)</option>
                                                <option value="+54">🇦🇷 Argentina (+54)</option>
                                                <option value="+374">🇦🇲 Armenia (+374)</option>
                                                <option value="+61">🇦🇺 Australia (+61)</option>
                                                <option value="+43">🇦🇹 Austria (+43)</option>
                                                <option value="+994">🇦🇿 Azerbaijan (+994)</option>
                                                <option value="+973">🇧🇭 Bahrain (+973)</option>
                                                <option value="+880">🇧🇩 Bangladesh (+880)</option>
                                                <option value="+1-246">🇧🇧 Barbados (+1-246)</option>
                                                <option value="+375">🇧🇾 Belarus (+375)</option>
                                                <option value="+32">🇧🇪 Belgium (+32)</option>
                                                <option value="+501">🇧🇿 Belize (+501)</option>
                                                <option value="+229">🇧🇯 Benin (+229)</option>
                                                <option value="+975">🇧🇹 Bhutan (+975)</option>
                                                <option value="+591">🇧🇴 Bolivia (+591)</option>
                                                <option value="+387">🇧🇦 Bosnia and Herzegovina (+387)</option>
                                                <option value="+267">🇧🇼 Botswana (+267)</option>
                                                <option value="+55">🇧🇷 Brazil (+55)</option>
                                                <option value="+673">🇧🇳 Brunei (+673)</option>
                                                <option value="+359">🇧🇬 Bulgaria (+359)</option>
                                                <option value="+226">🇧🇫 Burkina Faso (+226)</option>
                                                <option value="+257">🇧🇮 Burundi (+257)</option>
                                                <option value="+855">🇰🇭 Cambodia (+855)</option>
                                                <option value="+237">🇨🇲 Cameroon (+237)</option>
                                                <option value="+1">🇨🇦 Canada (+1)</option>
                                                <option value="+238">🇨🇻 Cape Verde (+238)</option>
                                                <option value="+236">🇨🇫 Central African Republic (+236)</option>
                                                <option value="+235">🇹🇩 Chad (+235)</option>
                                                <option value="+56">🇨🇱 Chile (+56)</option>
                                                <option value="+86">🇨🇳 China (+86)</option>
                                                <option value="+57">🇨🇴 Colombia (+57)</option>
                                                <option value="+269">🇰🇲 Comoros (+269)</option>
                                                <option value="+243">🇨🇩 Congo, Democratic Republic (+243)</option>
                                                <option value="+242">🇨🇬 Congo, Republic (+242)</option>
                                                <option value="+506">🇨🇷 Costa Rica (+506)</option>
                                                <option value="+385">🇭🇷 Croatia (+385)</option>
                                                <option value="+53">🇨🇺 Cuba (+53)</option>
                                                <option value="+357">🇨🇾 Cyprus (+357)</option>
                                                <option value="+420">🇨🇿 Czech Republic (+420)</option>
                                                <option value="+45">🇩🇰 Denmark (+45)</option>
                                                <option value="+253">🇩🇯 Djibouti (+253)</option>
                                                <option value="+1-767">🇩🇲 Dominica (+1-767)</option>
                                                <option value="+1-809">🇩🇴 Dominican Republic (+1-809)</option>
                                                <option value="+593">🇪🇨 Ecuador (+593)</option>
                                                <option value="+20">🇪🇬 Egypt (+20)</option>
                                                <option value="+503">🇸🇻 El Salvador (+503)</option>
                                                <option value="+240">🇬🇶 Equatorial Guinea (+240)</option>
                                                <option value="+291">🇪🇷 Eritrea (+291)</option>
                                                <option value="+372">🇪🇪 Estonia (+372)</option>
                                                <option value="+251">🇪🇹 Ethiopia (+251)</option>
                                                <option value="+679">🇫🇯 Fiji (+679)</option>
                                                <option value="+358">🇫🇮 Finland (+358)</option>
                                                <option value="+33">🇫🇷 France (+33)</option>
                                                <option value="+241">🇬🇦 Gabon (+241)</option>
                                                <option value="+220">🇬🇲 Gambia (+220)</option>
                                                <option value="+995">🇬🇪 Georgia (+995)</option>
                                                <option value="+49">🇩🇪 Germany (+49)</option>
                                                <option value="+233">🇬🇭 Ghana (+233)</option>
                                                <option value="+30">🇬🇷 Greece (+30)</option>
                                                <option value="+1-473">🇬🇩 Grenada (+1-473)</option>
                                                <option value="+502">🇬🇹 Guatemala (+502)</option>
                                                <option value="+224">🇬🇳 Guinea (+224)</option>
                                                <option value="+245">🇬🇼 Guinea-Bissau (+245)</option>
                                                <option value="+592">🇬🇾 Guyana (+592)</option>
                                                <option value="+509">🇭🇹 Haiti (+509)</option>
                                                <option value="+504">🇭🇳 Honduras (+504)</option>
                                                <option value="+36">🇭🇺 Hungary (+36)</option>
                                                <option value="+354">🇮🇸 Iceland (+354)</option>
                                                <option value="+91">🇮🇳 India (+91)</option>
                                                <option value="+62">🇮🇩 Indonesia (+62)</option>
                                                <option value="+98">🇮🇷 Iran (+98)</option>
                                                <option value="+964">🇮🇶 Iraq (+964)</option>
                                                <option value="+353">🇮🇪 Ireland (+353)</option>
                                                <option value="+972">🇮🇱 Israel (+972)</option>
                                                <option value="+39">🇮🇹 Italy (+39)</option>
                                                <option value="+1-876">🇯🇲 Jamaica (+1-876)</option>
                                                <option value="+81">🇯🇵 Japan (+81)</option>
                                                <option value="+962">🇯🇴 Jordan (+962)</option>
                                                <option value="+7">🇰🇿 Kazakhstan (+7)</option>
                                                <option value="+254">🇰🇪 Kenya (+254)</option>
                                                <option value="+686">🇰🇮 Kiribati (+686)</option>
                                                <option value="+965">🇰🇼 Kuwait (+965)</option>
                                                <option value="+996">🇰🇬 Kyrgyzstan (+996)</option>
                                                <option value="+856">🇱🇦 Laos (+856)</option>
                                                <option value="+371">🇱🇻 Latvia (+371)</option>
                                                <option value="+961">🇱🇧 Lebanon (+961)</option>
                                                <option value="+266">🇱🇸 Lesotho (+266)</option>
                                                <option value="+231">🇱🇷 Liberia (+231)</option>
                                                <option value="+218">🇱🇾 Libya (+218)</option>
                                                <option value="+423">🇱🇮 Liechtenstein (+423)</option>
                                                <option value="+370">🇱🇹 Lithuania (+370)</option>
                                                <option value="+352">🇱🇺 Luxembourg (+352)</option>
                                                <option value="+853">🇲🇴 Macao (+853)</option>
                                                <option value="+389">🇲🇰 North Macedonia (+389)</option>
                                                <option value="+261">🇲🇬 Madagascar (+261)</option>
                                                <option value="+265">🇲🇼 Malawi (+265)</option>
                                                <option value="+60">🇲🇾 Malaysia (+60)</option>
                                                <option value="+960">🇲🇻 Maldives (+960)</option>
                                                <option value="+223">🇲🇱 Mali (+223)</option>
                                                <option value="+356">🇲🇹 Malta (+356)</option>
                                                <option value="+692">🇲🇭 Marshall Islands (+692)</option>
                                                <option value="+222">🇲🇷 Mauritania (+222)</option>
                                                <option value="+230">🇲🇺 Mauritius (+230)</option>
                                                <option value="+52">🇲🇽 Mexico (+52)</option>
                                                <option value="+691">🇫🇲 Micronesia (+691)</option>
                                                <option value="+373">🇲🇩 Moldova (+373)</option>
                                                <option value="+377">🇲🇨 Monaco (+377)</option>
                                                <option value="+976">🇲🇳 Mongolia (+976)</option>
                                                <option value="+382">🇲🇪 Montenegro (+382)</option>
                                                <option value="+212">🇲🇦 Morocco (+212)</option>
                                                <option value="+258">🇲🇿 Mozambique (+258)</option>
                                                <option value="+95">🇲🇲 Myanmar (+95)</option>
                                                <option value="+264">🇳🇦 Namibia (+264)</option>
                                                <option value="+674">🇳🇷 Nauru (+674)</option>
                                                <option value="+977">🇳🇵 Nepal (+977)</option>
                                                <option value="+31">🇳🇱 Netherlands (+31)</option>
                                                <option value="+64">🇳🇿 New Zealand (+64)</option>
                                                <option value="+505">🇳🇮 Nicaragua (+505)</option>
                                                <option value="+227">🇳🇪 Niger (+227)</option>
                                                <option value="+234">🇳🇬 Nigeria (+234)</option>
                                                <option value="+47">🇳🇴 Norway (+47)</option>
                                                <option value="+968">🇴🇲 Oman (+968)</option>
                                                <option value="+92">🇵🇰 Pakistan (+92)</option>
                                                <option value="+680">🇵🇼 Palau (+680)</option>
                                                <option value="+507">🇵🇦 Panama (+507)</option>
                                                <option value="+675">🇵🇬 Papua New Guinea (+675)</option>
                                                <option value="+595">🇵🇾 Paraguay (+595)</option>
                                                <option value="+51">🇵🇪 Peru (+51)</option>
                                                <option value="+63">🇵🇭 Philippines (+63)</option>
                                                <option value="+48">🇵🇱 Poland (+48)</option>
                                                <option value="+351">🇵🇹 Portugal (+351)</option>
                                                <option value="+974">🇶🇦 Qatar (+974)</option>
                                                <option value="+40">🇷🇴 Romania (+40)</option>
                                                <option value="+7">🇷🇺 Russia (+7)</option>
                                                <option value="+250">🇷🇼 Rwanda (+250)</option>
                                                <option value="+966">🇸🇦 Saudi Arabia (+966)</option>
                                                <option value="+221">🇸🇳 Senegal (+221)</option>
                                                <option value="+381">🇷🇸 Serbia (+381)</option>
                                                <option value="+248">🇸🇨 Seychelles (+248)</option>
                                                <option value="+232">🇸🇱 Sierra Leone (+232)</option>
                                                <option value="+65">🇸🇬 Singapore (+65)</option>
                                                <option value="+421">🇸🇰 Slovakia (+421)</option>
                                                <option value="+386">🇸🇮 Slovenia (+386)</option>
                                                <option value="+677">🇸🇧 Solomon Islands (+677)</option>
                                                <option value="+252">🇸🇴 Somalia (+252)</option>
                                                <option value="+27">🇿🇦 South Africa (+27)</option>
                                                <option value="+82">🇰🇷 South Korea (+82)</option>
                                                <option value="+211">🇸🇸 South Sudan (+211)</option>
                                                <option value="+34">🇪🇸 Spain (+34)</option>
                                                <option value="+94">🇱🇰 Sri Lanka (+94)</option>
                                                <option value="+249">🇸🇩 Sudan (+249)</option>
                                                <option value="+597">🇸🇷 Suriname (+597)</option>
                                                <option value="+268">🇸🇿 Eswatini (+268)</option>
                                                <option value="+46">🇸🇪 Sweden (+46)</option>
                                                <option value="+41">🇨🇭 Switzerland (+41)</option>
                                                <option value="+963">🇸🇾 Syria (+963)</option>
                                                <option value="+886">🇹🇼 Taiwan (+886)</option>
                                                <option value="+992">🇹🇯 Tajikistan (+992)</option>
                                                <option value="+255">🇹🇿 Tanzania (+255)</option>
                                                <option value="+66">🇹🇭 Thailand (+66)</option>
                                                <option value="+228">🇹🇬 Togo (+228)</option>
                                                <option value="+676">🇹🇴 Tonga (+676)</option>
                                                <option value="+1-868">🇹🇹 Trinidad and Tobago (+1-868)</option>
                                                <option value="+216">🇹🇳 Tunisia (+216)</option>
                                                <option value="+90">🇹🇷 Turkey (+90)</option>
                                                <option value="+993">🇹🇲 Turkmenistan (+993)</option>
                                                <option value="+256">🇺🇬 Uganda (+256)</option>
                                                <option value="+380">🇺🇦 Ukraine (+380)</option>
                                                <option value="+971">🇦🇪 United Arab Emirates (+971)</option>
                                                <option value="+44">🇬🇧 United Kingdom (+44)</option>
                                                <option value="+1">🇺🇸 United States (+1)</option>
                                                <option value="+598">🇺🇾 Uruguay (+598)</option>
                                                <option value="+998">🇺🇿 Uzbekistan (+998)</option>
                                                <option value="+678">🇻🇺 Vanuatu (+678)</option>
                                                <option value="+379">🇻🇦 Vatican City (+379)</option>
                                                <option value="+58">🇻🇪 Venezuela (+58)</option>
                                                <option value="+84">🇻🇳 Vietnam (+84)</option>
                                                <option value="+967">🇾🇪 Yemen (+967)</option>
                                                <option value="+260">🇿🇲 Zambia (+260)</option>
                                                <option value="+263">🇿🇼 Zimbabwe (+263)</option>
                                            </select>
                                            <input type="tel" class="form-control"
                                                placeholder="Enter phone number" name="phone" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-signup w-100 mt-3">
                                        <i class="fas fa-user-check me-2"></i> Sign Up
                                    </button>
                                </form>

                                <div class="login-link">
                                    Already have an account? <a href="{{ route('supplier.login') }}">Login here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toastElList = [].slice.call(document.querySelectorAll(".toast"));
            toastElList.map(function (toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 4000
                });
                toast.show();
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection