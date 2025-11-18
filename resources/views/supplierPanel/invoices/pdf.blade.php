<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .card {
            border: 0;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #0d6efd;
            color: #fff;
            padding: 15px 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 25px;
            background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        .fw-semibold {
            font-weight: 600;
        }

        .text-muted {
            color: #6c757d;
        }

        .text-success {
            color: #198754;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-1 {
            margin-bottom: 5px;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        .p-3 {
            padding: 15px;
        }

        .p-4 {
            padding: 20px;
        }

        .rounded {
            border-radius: 8px;
        }

        .bg-light {
            background: #f8f9fa;
        }

        .border-bottom {
            border-bottom: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background: #212529;
            color: #fff;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .totals-divider {
            border-top: 1px solid #ddd;
            margin: 8px 0;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="card-header">
            <h3 style="margin:0;">Invoice</h3>
            <small>Buyer Invoice</small>
        </div>
        @php
            $supplier = Auth::guard('supplier')->user();

            // Calculate subtotal from items
            $subtotal = 0;
            foreach(($invoice->items ?? []) as $item) {
                $subtotal += $item->price * $item->quantity;
            }

            // Calculate tax (5% default rate)
            $taxRate = 5; // Default 5% tax rate
            $taxAmount = ($subtotal * $taxRate) / 100;

            // Total should match the stored total_amount
            // If there's a small difference due to rounding, use the stored value
            $calculatedTotal = $subtotal + $taxAmount;
        @endphp
        <div class="card-body">

            <!-- Company Header -->
            <div class="text-center mb-4 pb-3 border-bottom" style="font-family: 'Segoe UI', Arial, sans-serif;">
                <h2 class="fw-bold" style="color:#0d6efd; margin:0;">
                    {{ $supplier->shop->name }}
                </h2>
                <h5 class="fw-semibold text-dark mb-1">
                    {{ $supplier->shop?->profile?->address
                        ? $supplier->shop->profile->address . ' ' . $supplier->city?->name
                        : $supplier->city?->name ?? 'N/A' }}
                </h5>
                <h6 class="fw-bold" style="color:#198754; margin:0;">
                    {{ $supplier->whatsapp }}
                </h6>
            </div>

            <!-- Invoice Header -->
            <div class="mb-4" style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                    <h3 style="color:#0d6efd; margin:0;">INVOICE</h3>
                    <p class="text-muted mb-0">Invoice #: {{ $invoice->invoice_number }}</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">Date: {{ $invoice->invoice_date }}</small>
                </div>
            </div>

            <!-- Buyer & Supplier Info -->
            <div class="mb-4" style="display:flex; gap:20px;">
                <div style="flex:1;" class="bg-light rounded p-3">
                    <h6 class="fw-bold mb-2" style="color:#0d6efd;">Bill To</h6>
                    <p class="mb-1"><strong>Name:</strong> {{ $invoice->buyer_name }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $invoice->buyer_phone }}</p>
                    <p class="mb-0"><strong>Address:</strong> {{ $invoice->buyer_address }}</p>
                </div>
                <div style="flex:1;" class="bg-light rounded p-3">
                    <h6 class="fw-bold mb-2" style="color:#0d6efd;">From</h6>
                    <p class="mb-1"><strong>Supplier:</strong> {{ $supplier->name }}</p>
                    <p class="mb-0"><strong>Contact:</strong> {{ $supplier->whatsapp }}</p>
                </div>
            </div>

            <!-- Items Table -->
            <div class="mb-4">
                <h6 class="fw-bold mb-2" style="color:#0d6efd; border-bottom:1px solid #ddd; padding-bottom:5px;">
                    Invoice Items
                </h6>
                <table>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($invoice->items ?? []) as $item)
                            <tr>
                                <td>{{ $item->description }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">{{ number_format($item->price, 2) }}</td>
                                @php
                                    $itemTotal = $item->price * $item->quantity;
                                @endphp
                                <td class="text-end">{{ number_format($itemTotal, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center" style="padding:15px; color:#888;">
                                    No items added yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Totals Section with Tax Breakdown -->
            <div class="bg-light rounded p-3 mb-3">
                <div class="totals-row">
                    <h6 class="mb-0">Subtotal:</h6>
                    <h6 class="mb-0">{{ number_format($subtotal, 2) }}</h6>
                </div>
                <div class="totals-row">
                    <h6 class="mb-0 text-success">Tax ({{ $taxRate }}%):</h6>
                    <h6 class="mb-0 text-success">{{ number_format($taxAmount, 2) }}</h6>
                </div>
                <div class="totals-divider"></div>
                <div class="totals-row">
                    <h5 class="fw-bold mb-0" style="color:#0d6efd;">Total Amount:</h5>
                    <h5 class="fw-bold mb-0" style="color:#0d6efd;">{{ number_format($invoice->total_amount, 2) }}</h5>
                </div>
            </div>

            <!-- Remarks (if you have this field) -->
            @if(isset($invoice->remarks) && $invoice->remarks)
                <div class="bg-light rounded p-3 mb-3">
                    <h6 class="fw-bold mb-2" style="color:#0d6efd;">Remarks</h6>
                    <p class="mb-0">{{ $invoice->remarks }}</p>
                </div>
            @endif

            <!-- Footer -->
            <div class="bg-white rounded p-4 mt-4" style="box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                <div style="display:flex; justify-content:space-between; flex-wrap:wrap; align-items:center;">
                    <div>
                        <h6 class="fw-bold mb-1" style="color:#0d6efd;">
                            Thank you for your business!
                        </h6>
                        <small class="text-muted">We truly appreciate your trust in us.</small>
                    </div>
                    <div class="text-end">
                        <p class="mb-0 text-muted">Generated on: {{ date('Y-m-d') }}</p>
                    </div>
                </div>
                <hr class="my-3">
                <div class="text-center">
                    <h5 class="fw-bold mb-2">Powered By</h5>
                    <img src="{{ public_path('assets/compiled/jpg/Logo.png') }}" alt="Company Logo"
                        style="max-width: 100px; margin-bottom:8px;">
                    <br>
                    <small class="text-muted">Your Trusted Technology Partner</small>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
