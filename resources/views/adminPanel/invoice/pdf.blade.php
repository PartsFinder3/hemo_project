<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; color: #333; margin:0; padding:20px; }
        .card { border:1px solid #ddd; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1); }
        .card-header { background:#0d6efd; color:#fff; padding:12px 20px; border-top-left-radius:10px; border-top-right-radius:10px; }
        .card-body { padding:20px; background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%); }
        .text-center { text-align:center; }
        .text-end { text-align:right; }
        .fw-bold { font-weight:bold; }
        .mb-0 { margin-bottom:0; }
        .mb-1 { margin-bottom:5px; }
        .mb-2 { margin-bottom:10px; }
        .mb-3 { margin-bottom:15px; }
        .mb-4 { margin-bottom:20px; }
        .p-3 { padding:15px; }
        .rounded { border-radius:8px; }
        .bg-light { background:#f8f9fa; }
        .border-bottom { border-bottom:1px solid #ddd; }
        table { width:100%; border-collapse:collapse; margin-top:10px; }
        th, td { border:1px solid #333; padding:8px; font-size:12px; }
        th { background:#212529; color:#fff; }
    </style>
</head>
<body>

    <div class="card">
        <div class="card-header">
            <h3 style="margin:0;">INVOICE</h3>
            <small>Professional Service Invoice</small>
        </div>
        <div class="card-body">

            <!-- Company Header -->
            <div class="text-center mb-4 border-bottom" style="padding-bottom:15px;">
                <img src="{{ public_path('assets/compiled/jpg/Logo.png') }}" alt="Company Logo" style="max-width: 150px; margin-bottom:10px;">
                <div>
                    <h4 class="fw-bold mb-1">Parts Finder</h4>
                    <p class="mb-1">Dubai, United Arab Emirates</p>
                    <p class="mb-0">+971 4 123 4567</p>
                </div>
            </div>

            <!-- Invoice Header -->
            <div class="mb-4">
                <div style="float:left; width:60%;">
                    <h3 style="color:#0d6efd; margin:0;">Invoice #: {{ $invoice->invoice_number }}</h3>
                    <p class="mb-0">Date: {{ $invoice->payment_date }}</p>
                </div>
                {{-- <div style="float:right; text-align:right; width:40%;">
                    <span style="background:#198754; color:#fff; padding:6px 12px; border-radius:5px; font-size:14px;">
                        PAID
                    </span>
                </div> --}}
                <div style="clear:both;"></div>
            </div>

            <!-- Supplier & Payment Info -->
            <div class="mb-4">
                <div style="width:48%; float:left;" class="bg-light rounded p-3">
                    <h4 class="fw-bold mb-2" style="color:#0d6efd;">Supplier Details</h4>
                    <p class="mb-1"><strong>Name:</strong> {{ $invoice->supplier->name ?? '' }}</p>
                    <p class="mb-0"><strong>Contact:</strong> {{ $invoice->supplier->whatsapp ?? '' }}</p>
                </div>
                <div style="width:48%; float:right;" class="bg-light rounded p-3">
                    <h4 class="fw-bold mb-2" style="color:#0d6efd;">Payment Info</h4>
                    <p class="mb-1"><strong>Method:</strong> {{ $invoice->payment_method }}</p>
                    <p class="mb-0"><strong>Date:</strong> {{ $invoice->payment_date }}</p>
                </div>
                <div style="clear:both;"></div>
            </div>

            <!-- Subscriptions -->
            <div class="mb-4">
                <h4 class="fw-bold mb-2" style="color:#0d6efd; border-bottom:1px solid #ddd; padding-bottom:5px;">Subscription Items</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">End Date</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoice->subscriptions as $sub)
                            <tr>
                                <td>{{ $sub->type }}</td>
                                <td class="text-center">{{ $sub->start_date }}</td>
                                <td class="text-center">{{ $sub->end_date }}</td>
                                <td class="text-end">{{ number_format($sub->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center" style="padding:15px; color:#888;">No items added</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Totals -->
            <div class="bg-light rounded p-3 mb-3">
                <div style="float:left; width:70%;">
                    <h4 class="fw-bold mb-0" style="color:#0d6efd;">Total Amount:</h4>
                </div>
                <div style="float:right; width:30%; text-align:right;">
                    <h4 class="fw-bold mb-0" style="color:#0d6efd;">{{ number_format($invoice->total_amount, 2) }}</h4>
                </div>
                <div style="clear:both;"></div>
            </div>

            <!-- Remarks -->
            <div class="bg-light rounded p-3">
                <h4 class="fw-bold mb-2" style="color:#0d6efd;">Remarks</h4>
                <p class="mb-0">{{ $invoice->remarks ?? 'No additional remarks' }}</p>
            </div>

        </div>
    </div>

</body>
</html>
