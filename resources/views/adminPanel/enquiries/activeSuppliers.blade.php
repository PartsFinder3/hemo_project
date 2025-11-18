@extends('adminPanel.layout.main')
@section('main-section')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Send Inquiries on WhatsApp</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-left">
                    {{-- <h5 class="card-title">
                        Total Domains
                    </h5> --}}
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @else
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        @endif
                        <form action="{{ route('inquiries.sendAll', $inquiry->id) }}" method="POST"
                        onsubmit="return confirm('Send this inquiry to ALL active suppliers?');">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fa-brands fa-whatsapp"></i> Send to All Suppliers
                        </button>
                    </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Supplier</th>
                                <th>City</th>
                                <th>WhatsApp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $make = $inquiry->carMake->name ?? 'N/A';
                                $model = $inquiry->carModel->name ?? 'N/A';
                                $year = $inquiry->year->year ?? 'N/A';

                                // ✅ Proper handling of spare_parts
                                $spareParts = $inquiry->parts;

                                if (is_string($spareParts)) {
                                    $decoded = json_decode($spareParts, true);
                                    $spareParts = is_array($decoded) ? $decoded : [$spareParts];
                                }

                                $spareParts = $inquiry->partsList->isNotEmpty()
                                    ? $inquiry->partsList->pluck('name')->join(', ')
                                    : 'N/A';

                                $condition = $inquiry->condition ?? 'N/A';
                                $vin = $inquiry->vin_num ?? 'N/A';
                                $oem = $inquiry->oem_num ?? 'N/A';
                            @endphp

                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->name ?? 'N/A' }}</td>
                                    <td>{{ $supplier->city->name ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $cleanPhone = preg_replace('/[^0-9]/', '', $supplier->whatsapp);

                                            $message = "Hello {$supplier->name}!\n\n";
                                            $message .= "Looking for parts:\n";
                                            $message .= "- $make $model ($year)\n";
                                            $message .= "- Parts: $spareParts\n";
                                            $message .= "- Condition: $condition\n";
                                            $message .= " $waQuote\n";

                                            if ($vin && $vin !== 'N/A') {
                                                $message .= "- VIN: $vin\n";
                                            }

                                            if ($oem && $oem !== 'N/A') {
                                                $message .= "- OEM: $oem\n";
                                            }

                                            $message .= "\nPlease share availability and pricing.";

                                            $encodedMessage = rawurlencode($message);
                                        @endphp

                                        @if ($supplier->whatsapp)
                                            <a href="#"
                                                onclick="
                            var isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
                            if (isMobile) {
                                window.open('https://wa.me/{{ $cleanPhone }}?text={{ $encodedMessage }}', '_blank');
                            } else {
                                window.open('https://web.whatsapp.com/send?phone={{ $cleanPhone }}&text={{ $encodedMessage }}', '_blank');
                            }
                            return false;
                        "
                                                class="btn btn-success btn-sm">
                                                <i class="fa-brands fa-whatsapp"></i> Send Inquiry
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
