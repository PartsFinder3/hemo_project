@extends('Frontend.layout.main')
@section('main-section')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="row g-0">

                        <style>

                        </style>
                        <!-- Left Info Section -->
                        <div class="col-md-5 bg-grey text-white d-flex flex-column justify-content-center p-4" id="w-left">
                            <i class="fa-brands fa-whatsapp" id="icon"></i>
                            <h4 class="mb-3">Safe & Secure</h4>
                            <p class="small">
                                For a safe and secure experience on <strong>partsfinder.ae</strong>,
                                only verified users can connect with sellers.
                            </p>
                        </div>

                        <!-- Right Form Section -->
                        <div class="col-md-7 bg-light p-4">
                            <form action="{{ route('buyer.whatsapp.get', ['buyerInquiry' => $buyerInquiry->id]) }}"
                                method="post" id="whatsappForm" class="h-100 d-flex flex-column justify-content-center"
                                novalidate>
                                @csrf

                                <!-- Contact Information Section -->
                                <h5 class="mb-4 fw-bold text-orange">
                                    <i class="fab fa-whatsapp me-2"></i>Contact Information <span
                                        class="text-danger">*</span>
                                </h5>

                                <!-- WhatsApp Number Field -->
                                <div class="mb-4">
                                    <label for="whatsapp" class="form-label">
                                        <i class="fas fa-phone me-2"></i>WhatsApp Number
                                    </label>

                                    <div class="input-group">
                                        <select class="form-select" id="country_code" name="country_code"
                                            style="flex: 0 0 40%;" required>
                                            <option value="">Select Country</option>
                                            <option value="+93">+93 Afghanistan 🇦🇫</option>
                                            <option value="+355">+355 Albania 🇦🇱</option>
                                            <option value="+213">+213 Algeria 🇩🇿</option>
                                            <option value="+376">+376 Andorra 🇦🇩</option>
                                            <option value="+244">+244 Angola 🇦🇴</option>
                                            <option value="+1-268">+1-268 Antigua and Barbuda 🇦🇬</option>
                                            <option value="+54">+54 Argentina 🇦🇷</option>
                                            <option value="+374">+374 Armenia 🇦🇲</option>
                                            <option value="+61">+61 Australia 🇦🇺</option>
                                            <option value="+43">+43 Austria 🇦🇹</option>
                                            <option value="+994">+994 Azerbaijan 🇦🇿</option>
                                            <option value="+973">+973 Bahrain 🇧🇭</option>
                                            <option value="+880">+880 Bangladesh 🇧🇩</option>
                                            <option value="+1-246">+1-246 Barbados 🇧🇧</option>
                                            <option value="+375">+375 Belarus 🇧🇾</option>
                                            <option value="+32">+32 Belgium 🇧🇪</option>
                                            <option value="+501">+501 Belize 🇧🇿</option>
                                            <option value="+229">+229 Benin 🇧🇯</option>
                                            <option value="+975">+975 Bhutan 🇧🇹</option>
                                            <option value="+591">+591 Bolivia 🇧🇴</option>
                                            <option value="+387">+387 Bosnia and Herzegovina 🇧🇦</option>
                                            <option value="+267">+267 Botswana 🇧🇼</option>
                                            <option value="+55">+55 Brazil 🇧🇷</option>
                                            <option value="+673">+673 Brunei 🇧🇳</option>
                                            <option value="+359">+359 Bulgaria 🇧🇬</option>
                                            <option value="+226">+226 Burkina Faso 🇧🇫</option>
                                            <option value="+257">+257 Burundi 🇧🇮</option>
                                            <option value="+855">+855 Cambodia 🇰🇭</option>
                                            <option value="+237">+237 Cameroon 🇨🇲</option>
                                            <option value="+1">+1 Canada 🇨🇦</option>
                                            <option value="+238">+238 Cape Verde 🇨🇻</option>
                                            <option value="+236">+236 Central African Republic 🇨🇫</option>
                                            <option value="+235">+235 Chad 🇹🇩</option>
                                            <option value="+56">+56 Chile 🇨🇱</option>
                                            <option value="+86">+86 China 🇨🇳</option>
                                            <option value="+57">+57 Colombia 🇨🇴</option>
                                            <option value="+269">+269 Comoros 🇰🇲</option>
                                            <option value="+243">+243 Congo, Democratic Republic 🇨🇩</option>
                                            <option value="+242">+242 Congo, Republic 🇨🇬</option>
                                            <option value="+506">+506 Costa Rica 🇨🇷</option>
                                            <option value="+385">+385 Croatia 🇭🇷</option>
                                            <option value="+53">+53 Cuba 🇨🇺</option>
                                            <option value="+357">+357 Cyprus 🇨🇾</option>
                                            <option value="+420">+420 Czech Republic 🇨🇿</option>
                                            <option value="+45">+45 Denmark 🇩🇰</option>
                                            <option value="+253">+253 Djibouti 🇩🇯</option>
                                            <option value="+1-767">+1-767 Dominica 🇩🇲</option>
                                            <option value="+1-809">+1-809 Dominican Republic 🇩🇴</option>
                                            <option value="+593">+593 Ecuador 🇪🇨</option>
                                            <option value="+20">+20 Egypt 🇪🇬</option>
                                            <option value="+503">+503 El Salvador 🇸🇻</option>
                                            <option value="+240">+240 Equatorial Guinea 🇬🇶</option>
                                            <option value="+291">+291 Eritrea 🇪🇷</option>
                                            <option value="+372">+372 Estonia 🇪🇪</option>
                                            <option value="+251">+251 Ethiopia 🇪🇹</option>
                                            <option value="+679">+679 Fiji 🇫🇯</option>
                                            <option value="+358">+358 Finland 🇫🇮</option>
                                            <option value="+33">+33 France 🇫🇷</option>
                                            <option value="+241">+241 Gabon 🇬🇦</option>
                                            <option value="+220">+220 Gambia 🇬🇲</option>
                                            <option value="+995">+995 Georgia 🇬🇪</option>
                                            <option value="+49">+49 Germany 🇩🇪</option>
                                            <option value="+233">+233 Ghana 🇬🇭</option>
                                            <option value="+30">+30 Greece 🇬🇷</option>
                                            <option value="+1-473">+1-473 Grenada 🇬🇩</option>
                                            <option value="+502">+502 Guatemala 🇬🇹</option>
                                            <option value="+224">+224 Guinea 🇬🇳</option>
                                            <option value="+245">+245 Guinea-Bissau 🇬🇼</option>
                                            <option value="+592">+592 Guyana 🇬🇾</option>
                                            <option value="+509">+509 Haiti 🇭🇹</option>
                                            <option value="+504">+504 Honduras 🇭🇳</option>
                                            <option value="+36">+36 Hungary 🇭🇺</option>
                                            <option value="+354">+354 Iceland 🇮🇸</option>
                                            <option value="+91">+91 India 🇮🇳</option>
                                            <option value="+62">+62 Indonesia 🇮🇩</option>
                                            <option value="+98">+98 Iran 🇮🇷</option>
                                            <option value="+964">+964 Iraq 🇮🇶</option>
                                            <option value="+353">+353 Ireland 🇮🇪</option>
                                            <option value="+972">+972 Israel 🇮🇱</option>
                                            <option value="+39">+39 Italy 🇮🇹</option>
                                            <option value="+1-876">+1-876 Jamaica 🇯🇲</option>
                                            <option value="+81">+81 Japan 🇯🇵</option>
                                            <option value="+962">+962 Jordan 🇯🇴</option>
                                            <option value="+7">+7 Kazakhstan 🇰🇿</option>
                                            <option value="+254">+254 Kenya 🇰🇪</option>
                                            <option value="+686">+686 Kiribati 🇰🇮</option>
                                            <option value="+965">+965 Kuwait 🇰🇼</option>
                                            <option value="+996">+996 Kyrgyzstan 🇰🇬</option>
                                            <option value="+856">+856 Laos 🇱🇦</option>
                                            <option value="+371">+371 Latvia 🇱🇻</option>
                                            <option value="+961">+961 Lebanon 🇱🇧</option>
                                            <option value="+266">+266 Lesotho 🇱🇸</option>
                                            <option value="+231">+231 Liberia 🇱🇷</option>
                                            <option value="+218">+218 Libya 🇱🇾</option>
                                            <option value="+423">+423 Liechtenstein 🇱🇮</option>
                                            <option value="+370">+370 Lithuania 🇱🇹</option>
                                            <option value="+352">+352 Luxembourg 🇱🇺</option>
                                            <option value="+853">+853 Macao 🇲🇴</option>
                                            <option value="+389">+389 North Macedonia 🇲🇰</option>
                                            <option value="+261">+261 Madagascar 🇲🇬</option>
                                            <option value="+265">+265 Malawi 🇲🇼</option>
                                            <option value="+60">+60 Malaysia 🇲🇾</option>
                                            <option value="+960">+960 Maldives 🇲🇻</option>
                                            <option value="+223">+223 Mali 🇲🇱</option>
                                            <option value="+356">+356 Malta 🇲🇹</option>
                                            <option value="+692">+692 Marshall Islands 🇲🇭</option>
                                            <option value="+222">+222 Mauritania 🇲🇷</option>
                                            <option value="+230">+230 Mauritius 🇲🇺</option>
                                            <option value="+52">+52 Mexico 🇲🇽</option>
                                            <option value="+691">+691 Micronesia 🇫🇲</option>
                                            <option value="+373">+373 Moldova 🇲🇩</option>
                                            <option value="+377">+377 Monaco 🇲🇨</option>
                                            <option value="+976">+976 Mongolia 🇲🇳</option>
                                            <option value="+382">+382 Montenegro 🇲🇪</option>
                                            <option value="+212">+212 Morocco 🇲🇦</option>
                                            <option value="+258">+258 Mozambique 🇲🇿</option>
                                            <option value="+95">+95 Myanmar 🇲🇲</option>
                                            <option value="+264">+264 Namibia 🇳🇦</option>
                                            <option value="+674">+674 Nauru 🇳🇷</option>
                                            <option value="+977">+977 Nepal 🇳🇵</option>
                                            <option value="+31">+31 Netherlands 🇳🇱</option>
                                            <option value="+64">+64 New Zealand 🇳🇿</option>
                                            <option value="+505">+505 Nicaragua 🇳🇮</option>
                                            <option value="+227">+227 Niger 🇳🇪</option>
                                            <option value="+234">+234 Nigeria 🇳🇬</option>
                                            <option value="+47">+47 Norway 🇳🇴</option>
                                            <option value="+968">+968 Oman 🇴🇲</option>
                                            <option value="+92">+92 Pakistan 🇵🇰</option>
                                            <option value="+680">+680 Palau 🇵🇼</option>
                                            <option value="+507">+507 Panama 🇵🇦</option>
                                            <option value="+675">+675 Papua New Guinea 🇵🇬</option>
                                            <option value="+595">+595 Paraguay 🇵🇾</option>
                                            <option value="+51">+51 Peru 🇵🇪</option>
                                            <option value="+63">+63 Philippines 🇵🇭</option>
                                            <option value="+48">+48 Poland 🇵🇱</option>
                                            <option value="+351">+351 Portugal 🇵🇹</option>
                                            <option value="+974">+974 Qatar 🇶🇦</option>
                                            <option value="+40">+40 Romania 🇷🇴</option>
                                            <option value="+7">+7 Russia 🇷🇺</option>
                                            <option value="+250">+250 Rwanda 🇷🇼</option>
                                            <option value="+966">+966 Saudi Arabia 🇸🇦</option>
                                            <option value="+221">+221 Senegal 🇸🇳</option>
                                            <option value="+381">+381 Serbia 🇷🇸</option>
                                            <option value="+248">+248 Seychelles 🇸🇨</option>
                                            <option value="+232">+232 Sierra Leone 🇸🇱</option>
                                            <option value="+65">+65 Singapore 🇸🇬</option>
                                            <option value="+421">+421 Slovakia 🇸🇰</option>
                                            <option value="+386">+386 Slovenia 🇸🇮</option>
                                            <option value="+677">+677 Solomon Islands 🇸🇧</option>
                                            <option value="+252">+252 Somalia 🇸🇴</option>
                                            <option value="+27">+27 South Africa 🇿🇦</option>
                                            <option value="+82">+82 South Korea 🇰🇷</option>
                                            <option value="+211">+211 South Sudan 🇸🇸</option>
                                            <option value="+34">+34 Spain 🇪🇸</option>
                                            <option value="+94">+94 Sri Lanka 🇱🇰</option>
                                            <option value="+249">+249 Sudan 🇸🇩</option>
                                            <option value="+597">+597 Suriname 🇸🇷</option>
                                            <option value="+268">+268 Eswatini 🇸🇿</option>
                                            <option value="+46">+46 Sweden 🇸🇪</option>
                                            <option value="+41">+41 Switzerland 🇨🇭</option>
                                            <option value="+963">+963 Syria 🇸🇾</option>
                                            <option value="+886">+886 Taiwan 🇹🇼</option>
                                            <option value="+992">+992 Tajikistan 🇹🇯</option>
                                            <option value="+255">+255 Tanzania 🇹🇿</option>
                                            <option value="+66">+66 Thailand 🇹🇭</option>
                                            <option value="+228">+228 Togo 🇹🇬</option>
                                            <option value="+676">+676 Tonga 🇹🇴</option>
                                            <option value="+1-868">+1-868 Trinidad and Tobago 🇹🇹</option>
                                            <option value="+216">+216 Tunisia 🇹🇳</option>
                                            <option value="+90">+90 Turkey 🇹🇷</option>
                                            <option value="+993">+993 Turkmenistan 🇹🇲</option>
                                            <option value="+256">+256 Uganda 🇺🇬</option>
                                            <option value="+380">+380 Ukraine 🇺🇦</option>
                                            <option value="+971">+971 United Arab Emirates 🇦🇪</option>
                                            <option value="+44">+44 United Kingdom 🇬🇧</option>
                                            <option value="+1">+1 United States 🇺🇸</option>
                                            <option value="+598">+598 Uruguay 🇺🇾</option>
                                            <option value="+998">+998 Uzbekistan 🇺🇿</option>
                                            <option value="+678">+678 Vanuatu 🇻🇺</option>
                                            <option value="+379">+379 Vatican City 🇻🇦</option>
                                            <option value="+58">+58 Venezuela 🇻🇪</option>
                                            <option value="+84">+84 Vietnam 🇻🇳</option>
                                            <option value="+967">+967 Yemen 🇾🇪</option>
                                            <option value="+260">+260 Zambia 🇿🇲</option>
                                            <option value="+263">+263 Zimbabwe 🇿🇼</option>
                                        </select>

                                        <input type="tel" class="form-control" name="whatsapp" id="whatsapp"
                                            placeholder="Enter phone number" required>
                                    </div>
                                    <div class="help-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Enter your number without the country code (e.g., 1234567890)
                                    </div>
                                    <div class="invalid-feedback" id="phoneError"></div>
                                    <div class="valid-feedback" id="phoneSuccess">Looks good!</div>
                                </div>
                                <!-- Location Section -->
                                <h5 class="mb-3 fw-bold text-orange" style="opacity: 0.7">
                                    <i class="fas fa-map-marker-alt me-2"></i>Location
                                </h5>
                                <div class="row g-2 mb-4" style="opacity: 0.7">
                                    <div class="col-md-12">
                                        <label for="city" class="form-label">City / State</label>
                                        <input type="text" class="form-control" name="city" id="city"
                                            placeholder="Enter Your City/State">
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label for="country" class="form-label">Country</label>
                                        <select id="country" name="country" class="form-select select2"
                                            style="width:100%;" required>
                                            <option selected disabled>Choose...</option>
                                            <option value="Afghanistan">🇦🇫 Afghanistan</option>
                                            <option value="Albania">🇦🇱 Albania</option>
                                            <option value="Algeria">🇩🇿 Algeria</option>
                                            <option value="Andorra">🇦🇩 Andorra</option>
                                            <option value="Angola">🇦🇴 Angola</option>
                                            <option value="Antigua and Barbuda">🇦🇬 Antigua and Barbuda</option>
                                            <option value="Argentina">🇦🇷 Argentina</option>
                                            <option value="Armenia">🇦🇲 Armenia</option>
                                            <option value="Australia">🇦🇺 Australia</option>
                                            <option value="Austria">🇦🇹 Austria</option>
                                            <option value="Azerbaijan">🇦🇿 Azerbaijan</option>
                                            <option value="Bahamas">🇧🇸 Bahamas</option>
                                            <option value="Bahrain">🇧🇭 Bahrain</option>
                                            <option value="Bangladesh">🇧🇩 Bangladesh</option>
                                            <option value="Barbados">🇧🇧 Barbados</option>
                                            <option value="Belarus">🇧🇾 Belarus</option>
                                            <option value="Belgium">🇧🇪 Belgium</option>
                                            <option value="Belize">🇧🇿 Belize</option>
                                            <option value="Benin">🇧🇯 Benin</option>
                                            <option value="Bhutan">🇧🇹 Bhutan</option>
                                            <option value="Bolivia">🇧🇴 Bolivia</option>
                                            <option value="Bosnia and Herzegovina">🇧🇦 Bosnia and Herzegovina</option>
                                            <option value="Botswana">🇧🇼 Botswana</option>
                                            <option value="Brazil">🇧🇷 Brazil</option>
                                            <option value="Brunei">🇧🇳 Brunei</option>
                                            <option value="Bulgaria">🇧🇬 Bulgaria</option>
                                            <option value="Burkina Faso">🇧🇫 Burkina Faso</option>
                                            <option value="Burundi">🇧🇮 Burundi</option>
                                            <option value="Cambodia">🇰🇭 Cambodia</option>
                                            <option value="Cameroon">🇨🇲 Cameroon</option>
                                            <option value="Canada">🇨🇦 Canada</option>
                                            <option value="Cape Verde">🇨🇻 Cape Verde</option>
                                            <option value="Central African Republic">🇨🇫 Central African Republic</option>
                                            <option value="Chad">🇹🇩 Chad</option>
                                            <option value="Chile">🇨🇱 Chile</option>
                                            <option value="China">🇨🇳 China</option>
                                            <option value="Colombia">🇨🇴 Colombia</option>
                                            <option value="Comoros">🇰🇲 Comoros</option>
                                            <option value="Republic of the Congo">🇨🇬 Republic of the Congo</option>
                                            <option value="Costa Rica">🇨🇷 Costa Rica</option>
                                            <option value="Ivory Coast">🇨🇮 Ivory Coast</option>
                                            <option value="Croatia">🇭🇷 Croatia</option>
                                            <option value="Cuba">🇨🇺 Cuba</option>
                                            <option value="Cyprus">🇨🇾 Cyprus</option>
                                            <option value="Czech Republic">🇨🇿 Czech Republic</option>
                                            <option value="Democratic Republic of the Congo">🇨🇩 Democratic Republic of
                                                the Congo</option>
                                            <option value="Denmark">🇩🇰 Denmark</option>
                                            <option value="Djibouti">🇩🇯 Djibouti</option>
                                            <option value="Dominica">🇩🇲 Dominica</option>
                                            <option value="Dominican Republic">🇩🇴 Dominican Republic</option>
                                            <option value="Ecuador">🇪🇨 Ecuador</option>
                                            <option value="Egypt">🇪🇬 Egypt</option>
                                            <option value="El Salvador">🇸🇻 El Salvador</option>
                                            <option value="Equatorial Guinea">🇬🇶 Equatorial Guinea</option>
                                            <option value="Eritrea">🇪🇷 Eritrea</option>
                                            <option value="Estonia">🇪🇪 Estonia</option>
                                            <option value="Eswatini">🇸🇿 Eswatini</option>
                                            <option value="Ethiopia">🇪🇹 Ethiopia</option>
                                            <option value="Fiji">🇫🇯 Fiji</option>
                                            <option value="Finland">🇫🇮 Finland</option>
                                            <option value="France">🇫🇷 France</option>
                                            <option value="Gabon">🇬🇦 Gabon</option>
                                            <option value="Gambia">🇬🇲 Gambia</option>
                                            <option value="Georgia">🇬🇪 Georgia</option>
                                            <option value="Germany">🇩🇪 Germany</option>
                                            <option value="Ghana">🇬🇭 Ghana</option>
                                            <option value="Greece">🇬🇷 Greece</option>
                                            <option value="Grenada">🇬🇩 Grenada</option>
                                            <option value="Guatemala">🇬🇹 Guatemala</option>
                                            <option value="Guinea">🇬🇳 Guinea</option>
                                            <option value="Guinea-Bissau">🇬🇼 Guinea-Bissau</option>
                                            <option value="Guyana">🇬🇾 Guyana</option>
                                            <option value="Haiti">🇭🇹 Haiti</option>
                                            <option value="Honduras">🇭🇳 Honduras</option>
                                            <option value="Hungary">🇭🇺 Hungary</option>
                                            <option value="Iceland">🇮🇸 Iceland</option>
                                            <option value="India">🇮🇳 India</option>
                                            <option value="Indonesia">🇮🇩 Indonesia</option>
                                            <option value="Iran">🇮🇷 Iran</option>
                                            <option value="Iraq">🇮🇶 Iraq</option>
                                            <option value="Ireland">🇮🇪 Ireland</option>
                                            <option value="Israel">🇮🇱 Israel</option>
                                            <option value="Italy">🇮🇹 Italy</option>
                                            <option value="Jamaica">🇯🇲 Jamaica</option>
                                            <option value="Japan">🇯🇵 Japan</option>
                                            <option value="Jordan">🇯🇴 Jordan</option>
                                            <option value="Kazakhstan">🇰🇿 Kazakhstan</option>
                                            <option value="Kenya">🇰🇪 Kenya</option>
                                            <option value="Kiribati">🇰🇮 Kiribati</option>
                                            <option value="Kuwait">🇰🇼 Kuwait</option>
                                            <option value="Kyrgyzstan">🇰🇬 Kyrgyzstan</option>
                                            <option value="Laos">🇱🇦 Laos</option>
                                            <option value="Latvia">🇱🇻 Latvia</option>
                                            <option value="Lebanon">🇱🇧 Lebanon</option>
                                            <option value="Lesotho">🇱🇸 Lesotho</option>
                                            <option value="Liberia">🇱🇷 Liberia</option>
                                            <option value="Libya">🇱🇾 Libya</option>
                                            <option value="Liechtenstein">🇱🇮 Liechtenstein</option>
                                            <option value="Lithuania">🇱🇹 Lithuania</option>
                                            <option value="Luxembourg">🇱🇺 Luxembourg</option>
                                            <option value="Macedonia">🇲🇰 Macedonia</option>
                                            <option value="Madagascar">🇲🇬 Madagascar</option>
                                            <option value="Malawi">🇲🇼 Malawi</option>
                                            <option value="Malaysia">🇲🇾 Malaysia</option>
                                            <option value="Maldives">🇲🇻 Maldives</option>
                                            <option value="Mali">🇲🇱 Mali</option>
                                            <option value="Malta">🇲🇹 Malta</option>
                                            <option value="Marshall Islands">🇲🇭 Marshall Islands</option>
                                            <option value="Mauritania">🇲🇷 Mauritania</option>
                                            <option value="Mauritius">🇲🇺 Mauritius</option>
                                            <option value="Mexico">🇲🇽 Mexico</option>
                                            <option value="Micronesia">🇫🇲 Micronesia</option>
                                            <option value="Moldova">🇲🇩 Moldova</option>
                                            <option value="Monaco">🇲🇨 Monaco</option>
                                            <option value="Mongolia">🇲🇳 Mongolia</option>
                                            <option value="Montenegro">🇲🇪 Montenegro</option>
                                            <option value="Morocco">🇲🇦 Morocco</option>
                                            <option value="Mozambique">🇲🇿 Mozambique</option>
                                            <option value="Myanmar">🇲🇲 Myanmar</option>
                                            <option value="Namibia">🇳🇦 Namibia</option>
                                            <option value="Nauru">🇳🇷 Nauru</option>
                                            <option value="Nepal">🇳🇵 Nepal</option>
                                            <option value="Netherlands">🇳🇱 Netherlands</option>
                                            <option value="New Zealand">🇳🇿 New Zealand</option>
                                            <option value="Nicaragua">🇳🇮 Nicaragua</option>
                                            <option value="Niger">🇳🇪 Niger</option>
                                            <option value="Nigeria">🇳🇬 Nigeria</option>
                                            <option value="North Korea">🇰🇵 North Korea</option>
                                            <option value="Norway">🇳🇴 Norway</option>
                                            <option value="Oman">🇴🇲 Oman</option>
                                            <option value="Pakistan">🇵🇰 Pakistan</option>
                                            <option value="Palau">🇵🇼 Palau</option>
                                            <option value="Panama">🇵🇦 Panama</option>
                                            <option value="Papua New Guinea">🇵🇬 Papua New Guinea</option>
                                            <option value="Paraguay">🇵🇾 Paraguay</option>
                                            <option value="Peru">🇵🇪 Peru</option>
                                            <option value="Philippines">🇵🇭 Philippines</option>
                                            <option value="Poland">🇵🇱 Poland</option>
                                            <option value="Portugal">🇵🇹 Portugal</option>
                                            <option value="Qatar">🇶🇦 Qatar</option>
                                            <option value="Romania">🇷🇴 Romania</option>
                                            <option value="Russia">🇷🇺 Russia</option>
                                            <option value="Rwanda">🇷🇼 Rwanda</option>
                                            <option value="Saint Kitts and Nevis">🇰🇳 Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">🇱🇨 Saint Lucia</option>
                                            <option value="Saint Vincent and the Grenadines">🇻🇨 Saint Vincent and the
                                                Grenadines</option>
                                            <option value="Samoa">🇼🇸 Samoa</option>
                                            <option value="San Marino">🇸🇲 San Marino</option>
                                            <option value="Sao Tome and Principe">🇸🇹 Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">🇸🇦 Saudi Arabia</option>
                                            <option value="Senegal">🇸🇳 Senegal</option>
                                            <option value="Serbia">🇷🇸 Serbia</option>
                                            <option value="Seychelles">🇸🇨 Seychelles</option>
                                            <option value="Sierra Leone">🇸🇱 Sierra Leone</option>
                                            <option value="Singapore">🇸🇬 Singapore</option>
                                            <option value="Slovakia">🇸🇰 Slovakia</option>
                                            <option value="Slovenia">🇸🇮 Slovenia</option>
                                            <option value="Solomon Islands">🇸🇧 Solomon Islands</option>
                                            <option value="Somalia">🇸🇴 Somalia</option>
                                            <option value="South Africa">🇿🇦 South Africa</option>
                                            <option value="South Korea">🇰🇷 South Korea</option>
                                            <option value="South Sudan">🇸🇸 South Sudan</option>
                                            <option value="Spain">🇪🇸 Spain</option>
                                            <option value="Sri Lanka">🇱🇰 Sri Lanka</option>
                                            <option value="Sudan">🇸🇩 Sudan</option>
                                            <option value="Suriname">🇸🇷 Suriname</option>
                                            <option value="Sweden">🇸🇪 Sweden</option>
                                            <option value="Switzerland">🇨🇭 Switzerland</option>
                                            <option value="Syria">🇸🇾 Syria</option>
                                            <option value="Taiwan">🇹🇼 Taiwan</option>
                                            <option value="Tajikistan">🇹🇯 Tajikistan</option>
                                            <option value="Tanzania">🇹🇿 Tanzania</option>
                                            <option value="Thailand">🇹🇭 Thailand</option>
                                            <option value="Timor-Leste">🇹🇱 Timor-Leste</option>
                                            <option value="Togo">🇹🇬 Togo</option>
                                            <option value="Tonga">🇹🇴 Tonga</option>
                                            <option value="Trinidad and Tobago">🇹🇹 Trinidad and Tobago</option>
                                            <option value="Tunisia">🇹🇳 Tunisia</option>
                                            <option value="Turkey">🇹🇷 Turkey</option>
                                            <option value="Turkmenistan">🇹🇲 Turkmenistan</option>
                                            <option value="Tuvalu">🇹🇻 Tuvalu</option>
                                            <option value="Uganda">🇺🇬 Uganda</option>
                                            <option value="Ukraine">🇺🇦 Ukraine</option>
                                            <option value="UAE">🇦🇪 UAE</option>
                                            <option value="United Kingdom">🇬🇧 UK</option>
                                            <option value="United States">🇺🇸 USA</option>
                                            <option value="Uruguay">🇺🇾 Uruguay</option>
                                            <option value="Uzbekistan">🇺🇿 Uzbekistan</option>
                                            <option value="Vanuatu">🇻🇺 Vanuatu</option>
                                            <option value="Vatican City">🇻🇦 Vatican City</option>
                                            <option value="Venezuela">🇻🇪 Venezuela</option>
                                            <option value="Vietnam">🇻🇳 Vietnam</option>
                                            <option value="Yemen">🇾🇪 Yemen</option>
                                            <option value="Zambia">🇿🇲 Zambia</option>
                                            <option value="Zimbabwe">🇿🇼 Zimbabwe</option>
                                        </select>
                                    </div> --}}
                                </div>
                                <!-- Submit Button -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-whatsapp px-4 py-2 rounded-pill">
                                        <i class="fab fa-whatsapp me-2"></i>Submit Contact Info
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --whatsapp-btn: #25D366;
            --whatsapp-hover: #128C7E;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .bg-grey {
            background: linear-gradient(135deg, var(--whatsapp-btn), var(--whatsapp-hover));
        }

        .text-orange {
            color: var(--whatsapp-btn);
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.8rem;
            font-size: 1rem;
        }

        .form-select,
        .form-control {
            background: linear-gradient(145deg, #f8f9fa, #e9ecef);
            border: 2px solid #dee2e6;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.06);
        }

        .form-select:focus,
        .form-control:focus {
            border-color: var(--whatsapp-btn);
            box-shadow: 0 0 0 0.2rem rgba(37, 211, 102, 0.25);
            background: white;
            transform: translateY(-1px);
        }

        .input-group {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        .input-group .form-select {
            border-right: none;
            border-radius: 12px 0 0 12px;
            background: white;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
            background: white;
        }

        .btn-whatsapp {
            background: linear-gradient(135deg, var(--whatsapp-btn), var(--whatsapp-hover));
            border: none;
            border-radius: 12px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .btn-whatsapp:hover {
            background: linear-gradient(135deg, var(--whatsapp-hover), var(--whatsapp-btn));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
            color: white;
        }

        .btn-primary {
            background: var(--whatsapp-btn);
            border: none;
            transition: 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: var(--whatsapp-hover);
            transform: translateY(-2px);
        }

        .help-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }

        .invalid-feedback,
        .valid-feedback {
            display: none;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .invalid-feedback {
            color: #dc3545;
        }

        .valid-feedback {
            color: #28a745;
        }

        .is-invalid .form-select,
        .is-invalid .form-control {
            border-color: #dc3545;
        }

        .is-valid .form-select,
        .is-valid .form-control {
            border-color: #28a745;
        }

        .is-invalid~.invalid-feedback {
            display: block;
        }

        .is-valid~.valid-feedback {
            display: block;
        }

        .select2-container .select2-selection {
            height: 38px;
            border-radius: 10px !important;
            border: 1px solid #ced4da;
        }

        #icon {
            font-size: 100px;
            margin-bottom: 18px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        @media (max-width: 768px) {
            .card {
                margin: 1rem;
                border-radius: 15px;
            }

            .col-md-5,
            .col-md-7 {
                padding: 2rem 1.5rem;
            }

            #icon {
                font-size: 50px;
                margin-bottom: 10px;

            }

            .btn-whatsapp {
                width: 100%;
                padding: 1rem;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countrySelect = document.getElementById('country_code');
            const phoneInput = document.getElementById('whatsapp');
            const phoneError = document.getElementById('phoneError');
            const phoneSuccess = document.getElementById('phoneSuccess');
            const whatsappForm = document.getElementById('whatsappForm');

            if (countrySelect) {
                // Get the top-level domain
                const hostname = window.location.hostname.toLowerCase();
                const tld = hostname.split('.').pop();
                let countryCode = '+92'; // default Pakistan

                // Map TLDs to country codes
                switch (tld) {
                    case 'om':
                        countryCode = '+968'; // Oman
                        break;
                    case 'ae':
                        countryCode = '+971'; // UAE
                        break;
                    case 'qa':
                        countryCode = '+974'; // Qatar
                        break;
                    default:
                        countryCode = '+971'; // Pakistan or fallback
                }

                countrySelect.value = countryCode;
            }

            // Phone number validation function
            function validatePhoneNumber() {
                const phoneValue = phoneInput.value.trim();
                const countryCodeValue = countrySelect.value;

                // Remove invalid class first
                phoneInput.parentElement.classList.remove('is-invalid', 'is-valid');

                // Check if country code is selected
                if (!countryCodeValue) {
                    phoneError.textContent = 'Please select a country code first';
                    phoneInput.parentElement.classList.add('is-invalid');
                    return false;
                }

                // Check if phone starts with 0 when country code is selected
                if (countryCodeValue && phoneValue.startsWith('0')) {
                    phoneError.textContent =
                        'Do not include the leading 0. Country code already selected. (e.g., for +971, enter 3123456789 not 03123456789)';
                    phoneInput.parentElement.classList.add('is-invalid');
                    return false;
                }

                // Check if phone has only digits
                if (phoneValue && !/^\d+$/.test(phoneValue)) {
                    phoneError.textContent = 'Phone number should contain only digits';
                    phoneInput.parentElement.classList.add('is-invalid');
                    return false;
                }

                // Check minimum length
                if (phoneValue && phoneValue.length < 7) {
                    phoneError.textContent = 'Phone number is too short';
                    phoneInput.parentElement.classList.add('is-invalid');
                    return false;
                }

                // Check maximum length
                if (phoneValue.length > 15) {
                    phoneError.textContent = 'Phone number is too long';
                    phoneInput.parentElement.classList.add('is-invalid');
                    return false;
                }

                // If all validations pass
                if (phoneValue.length >= 7) {
                    phoneInput.parentElement.classList.add('is-valid');
                    return true;
                }

                return true;
            }

            // Real-time validation on input
            phoneInput.addEventListener('input', function(e) {
                // Only allow digits
                this.value = this.value.replace(/\D/g, '');

                validatePhoneNumber();
            });

            // Validation on blur (when user leaves the field)
            phoneInput.addEventListener('blur', validatePhoneNumber);

            // Validation when country code changes
            countrySelect.addEventListener('change', function() {
                if (phoneInput.value) {
                    validatePhoneNumber();
                }
            });

            // Form submission validation
            whatsappForm.addEventListener('submit', function(e) {
                if (!validatePhoneNumber()) {
                    e.preventDefault();
                    phoneInput.focus();
                    return false;
                }

                // Additional check for country selection
                if (!countrySelect.value) {
                    e.preventDefault();
                    alert('Please select a country code');
                    countrySelect.focus();
                    return false;
                }
            });

            // Initialize Select2 if available
            if (typeof $.fn.select2 !== 'undefined') {
                $('.select2').select2({
                    placeholder: "Search & select",
                    allowClear: true
                });
            }
        });
    </script>
@endsection
