@extends('supplierPanel.layout.main')
@section('main-section')
<style>
    /* Card very compact */
    .card {
        padding: 5px !important;
        margin: 5px 0 !important;
    }

    .card-body {
        padding: 8px !important;
    }

    /* Reduce text sizes */
    h5 {
        font-size: 15px !important;
    }
    h6 {
        font-size: 13px !important;
    }
    p, label, span {
        font-size: 12px !important;
    }

    /* Reduce all vertical spacing */
    h5, h6, p, label {
        margin-bottom: 2px !important;
        line-height: 1.2 !important;
    }

    /* Inputs very compact */
    .form-control, .form-select {
        padding: 4px 6px !important;
        height: 28px !important;
        font-size: 12px !important;
    }

    /* Form group spacing extremely small */
    .mb-3 {
        margin-bottom: 5px !important;
    }

    /* Radio buttons smaller */
    .form-check-input {
        width: 12px !important;
        height: 12px !important;
    }

    .form-check-label {
        font-size: 12px !important;
    }

    /* Gap very small */
    .d-flex.gap-3 {
        gap: 5px !important;
    }

    /* Buttons smaller */
    .btn-lg {
        padding: 4px !important;
        font-size: 13px !important;
    }
    .btn-sm {
        padding: 3px 6px !important;
        font-size: 11px !important;
    }

    /* Ask info buttons compact */
    .btn-outline-secondary {
        padding: 3px 7px !important;
    }

    /* Container padding very small */
    .container.py-4 {
        padding: 5px !important;
    }
    @media (max-width: 767px) {
    .condition-options .form-check {
        margin-left: 40px;
    }
}
</style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container py-4">
        <div class="row display-flex justify-content-center">
            <div class="col-lg-5 col-sm-12 mb-4">
                <div class="card shadow-lg border-0 rounded-4">
            <!-- Vehicle Detail -->
            @php
                $make = $buyerInquiry->carMake->name ?? 'Unknown';
                $model = $buyerInquiry->carModel->name ?? 'Unknown';
                $year = $buyerInquiry->year->year ?? 'Unknown';
                $parts = $buyerInquiry->partsList;
                $buyercontact = $buyerInquiry->buyer->whatsapp ?? 'N/A';
                $buyerCountryCode = $buyerInquiry->buyer->country_code ?? '';
                $buyerWhatsapp = $buyerCountryCode . ltrim($buyercontact, '0');
                $buyerCity = $buyerInquiry->buyer->city->name ?? 'City';
                $buyerCountry = $buyerInquiry->buyer->country->name ?? 'Country';

                $shopPartIds = Auth::guard('supplier')->user()->shop->parts->pluck('part_id')->toArray();
                $matchingParts = $buyerInquiry->partsList->whereIn('id', $shopPartIds)->pluck('name')->toArray();
            @endphp

            <div class="card-body">
                {{-- <h2>{{ $buyerWhatsapp }}</h2> --}}
                <h6 class="text-muted mb-1">Vehicle Detail:</h6>
                <h5 class="fw-bold">{{ $make }} {{ $model }} {{ $year }}
                    <h5 class="fw-bold">
                        {{ implode(', ', $matchingParts) }}
                    </h5>
                </h5>
                <p class="mb-3">
                    <i class="bi bi-geo-alt-fill text-primary"></i>
                    <span class="fw-semibold">{{ $buyerCity }}, {{ $buyerCountry }}</span>
                </p>

                <!-- Price Quote -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Price Quote</label>
                    <div class="input-group">
                        <select class="form-select">
                            <option>AED</option>
                            <option>USD</option>
                            <option>EUR</option>
                        </select>
                        <input type="number" class="form-control" placeholder="Enter amount">
                    </div>
                </div>

                <!-- Options -->
<!-- Options: VAT and Condition in same row -->
                    <div class="mb-3">
                        <div class="row">
                            <!-- VAT Included -->
                            <div class="col-6">
                                <label class="form-label fw-semibold">VAT Included?</label>
                                <div class="d-flex gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vat" id="vatYes">
                                        <label class="form-check-label" for="vatYes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="vat" id="vatNo">
                                        <label class="form-check-label" for="vatNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Condition -->
                            <div class="col-6">
                                <label class="form-label fw-semibold">Condition</label>
                            <div class="d-flex gap-2 condition-options">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="condition" id="used">
                                    <label class="form-check-label" for="used">Used</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="condition" id="recon">
                                    <label class="form-check-label" for="recon">Recon</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="condition" id="new">
                                    <label class="form-check-label" for="new">New</label>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

<!-- Offers Fitting in new line -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Offers Fitting?</label>
                <div class="d-flex gap-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="fitting" id="fitYes">
                        <label class="form-check-label" for="fitYes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="fitting" id="fitNo">
                        <label class="form-check-label" for="fitNo">No</label>
                    </div>
                </div>
            </div>

            

                <div class="d-grid mb-3">
                    <button type="button" class="btn btn-success btn-lg p-2 rounded-3" onclick="sendQuote()">
                        <i class="bi bi-whatsapp"></i> Send Price Quote
                    </button>
                </div>
                @php
                    $shop = Auth::guard('supplier')->user()->shop->name;
                @endphp

                <script>
                    // Pass PHP value into JS
                    let shop = @json($shop);

                    function sendQuote() {
                        let number = "{{ $buyerWhatsapp }}";
                        let make = "{{ $make }}";
                        let model = "{{ $model }}";
                        let year = "{{ $year }}";
                        let parts = "{{ implode(', ', $matchingParts) }}";

                        // Get form values
                        let price = document.querySelector('input[type=number]').value || 'N/A';
                        let currency = document.querySelector('select').value || 'AED';
                        let vat = document.querySelector('input[name=vat]:checked')?.nextElementSibling.innerText || 'N/A';
                        let condition = document.querySelector('input[name=condition]:checked')?.nextElementSibling.innerText || 'N/A';
                        let fitting = document.querySelector('input[name=fitting]:checked')?.nextElementSibling.innerText || 'N/A';

                        let message = `Hi, I'm from ${shop}. I'm contacting you regarding your enquiry on *Partsfinder UAE* for ${make} ${model} ${year} ${parts}.

Here is the price quote:
Price: *${currency} ${price}*
VAT Included: *${vat}*
Condition: *${condition}*
Offers Fitting: *${fitting}*`;

                        openWhatsApp(number, message);
                    }

                    function askInfo(extraText) {
                        let number = "{{ $buyerWhatsapp }}";
                        let make = "{{ $make }}";
                        let model = "{{ $model }}";
                        let year = "{{ $year }}";
                        let parts = "{{ implode(', ', $matchingParts) }}";

                        let message = `Hi, I'm from ${shop}. I'm contacting you regarding your enquiry on *Partsfinder UAE* for ${make} ${model} ${year} ${parts}.

${extraText}`;

                        openWhatsApp(number, message);
                    }

                    function openWhatsApp(number, message) {
                        let text = encodeURIComponent(message);
                        let isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);

                        let url = isMobile ?
                            `whatsapp://send?phone=${number}&text=${text}` :
                            `https://web.whatsapp.com/send?phone=${number}&text=${text}`;

                        window.open(url, "_blank");
                    }
                </script>



                <!-- Divider -->
                <div class="text-center my-3 text-muted">OR</div>

                <!-- Ask for More Info -->
                <h6 class="fw-bold mb-3">Ask for More Information</h6>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <button class="btn btn-outline-secondary btn-sm"
                        onclick="askInfo('Can you please *send your vehicle VIN/Chassis Number* so we can quote you the exact part price?')">
                        Send Your VIN/Chassis
                    </button>
                    <button class="btn btn-outline-secondary btn-sm"
                        onclick="askInfo('Can you please *send your Engine Code* so we can quote you the exact part price?')">
                        Send Your Engine Code
                    </button>
                    <button class="btn btn-outline-secondary btn-sm"
                        onclick="askInfo('Can you please *send a photo of your required part* so we can quote you the exact part price?')">
                        Send Your Part Photo
                    </button>
                    <button class="btn btn-outline-secondary btn-sm"
                        onclick="askInfo('Can you please *send your vehicle Registration (Mulkya)* so we can quote you the exact part price?')">
                        Send Registration (Mulkya)
                    </button>
                    <button class="btn btn-outline-secondary btn-sm"
                        onclick="askInfo('Can you please provide *more details about your requirement* so we can assist you better?')">
                        Other
                    </button>
                </div>

                <script>
                    function askInfo(extraText) {
                        let number = "{{ $buyerWhatsapp }}";
                        let make = "{{ $make }}";
                        let model = "{{ $model }}";
                        let year = "{{ $year }}";
                        let parts = "{{ implode(', ', $matchingParts) }}";

                        let message = `Hi, I'm from ${shop}. I'm contacting you regarding your enquiry on *Partsfinder UAE* for ${make} ${model} ${year} ${parts}.

                        ${extraText}`;

                        openWhatsApp(number, message);
                    }
                </script>


                <div class="d-grid">
                    <a href="" style="text-decoration: none; text-align: center;" class="btn-red rounded-3 p-2">Send
                        Message</a>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        function openWhatsApp(number, message) {
            // Encode the message
            let text = encodeURIComponent(message);

            // Detect if mobile or desktop
            let isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);

            // Mobile → whatsapp:// , Desktop → web.whatsapp.com
            let url = isMobile ?
                `whatsapp://send?phone=${number}&text=${text}` :
                `https://web.whatsapp.com/send?phone=${number}&text=${text}`;

            window.open(url, "_blank");
        }
    </script>
@endsection
