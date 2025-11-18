@extends('adminPanel.layout.main')
@section('main-section')
    <div class="container my-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <!-- Header -->
                <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                    <div class="d-flex align-items-center gap-3">
                        {{-- <div
                            class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center p-4">
                            <span class="fw-semibold">S</span>
                        </div> --}}
                        <div>
                            <h5 class="mb-1">{{ $supplier->name }}</h5>
                            <div class="text-muted small">Shop: <span class="text-body">
                                    @if ($supplier->shop)
                                        {{ $supplier->shop->name }}
                                    @endif
                                </span></div>
                            <div class="text-muted small">Email: <span class="text-body">{{ $supplier->email }}</span> ·
                                Phone: <span class="text-body">{{ $supplier->whatsapp }}</span></div>
                        </div>
                    </div>
                    @php
                        $inquiriesCount = $supplier->inquiries()->sum('used_inquiries');
                        $inquiriesopened = $supplier->inquiryUsages()->sum('is_open');
                        $invoicesCount = $supplier->invoices()->count();
                    @endphp
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge text-bg-primary">Inquiries: {{ $inquiriesCount }}</span>
                        <span class="badge text-bg-success">Inquires Open: {{ $inquiriesopened }}</span>
                        <span class="badge text-bg-secondary">Invoices Received: {{ $invoicesCount }}</span>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Inquiries Table -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Buyer Inquiries</h6>
                        <span class="text-muted small">Latest first</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Buyer</th>
                                    <th>Opened</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inquiryUsages as $inquiryUsage)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inquiryUsage->BuyerInquiry->buyer->whatsapp ?? 'N/A' }}</td>
                                        <td>
                                            @if ($inquiryUsage->is_open)
                                                <span class="badge text-bg-primary">Yes</span>
                                            @else
                                                <span class="badge text-bg-secondary">No</span>
                                            @endif
                                        </td>
                                        <td class="text-muted small">{{ $inquiryUsage->created_at->format('d M Y') }}</td>
                                        {{-- <td class="text-end"><button class="btn btn-sm btn-outline-primary">View</button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Payment Screenshots -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Payment Screenshots</h6>
                        {{-- <a href="#" class="link-primary small">View all</a> --}}
                    </div>
                    <div class="row g-3">
                        @foreach ($payments as $payment)
                            <div class="col-12 col-md-6 mb-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <img src="{{ $payment->image ? asset('storage/' . $payment->image) : asset('assets/static/images/samples/bg-mountain.jpg') }}"
                                        alt="Payment Screenshot" class="img-fluid rounded-top w-100">

                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <span class="badge text-bg-success">AED {{ $payment->amount }}</span>
                                            <span class="text-muted small">
                                                {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="text-muted small mt-1">Method: {{ $payment->method }}</div>
                                        <button type="button" class="btn btn-outline-primary mt-2" data-bs-toggle="modal"
                                            data-bs-target="#paymentModal{{ $payment->id }}">
                                            View Image
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1"
                                aria-labelledby="paymentModalLabel{{ $payment->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="paymentModalLabel{{ $payment->id }}">Payment
                                                Screenshot</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ $payment->image ? asset('storage/' . $payment->image) : asset('assets/static/images/samples/bg-mountain.jpg') }}"
                                                alt="Payment Screenshot" class="img-fluid rounded">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

                <hr class="my-4">

                <!-- Invoices -->
                <div class="row g-4">
                    <div class="col-12 col-lg-12">
                        <h6 class="mb-2">Invoices (Sent to Supplier By PartsFinder)</h6>
                        <ul class="list-group list-group-flush">
                            @foreach ($invoices as $invoice)
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                    <span>{{ $invoice->invoice_number }}</span>

                                    @if ($invoice->pdf_path)
                                        <a href="{{ asset('storage/' . $invoice->pdf_path) }}" target="_blank"
                                            class="btn btn-sm btn-primary">
                                            View PDF
                                        </a>
                                    @else
                                        <span class="text-muted">No PDF</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                    </div>

                    <div class="col-12 col-lg-12">
                        <h6 class="mb-2">Invoices (Sent to Buyers by Supplier)</h6>
                        <ul class="list-group list-group-flush">
                            @foreach ($buyerInvoices as $invoice)
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                    <span>{{ $invoice->invoice_number }}</span>

                                    @if ($invoice->pdf_path)
                                        <a href="{{ asset('storage/' . $invoice->pdf_path) }}" target="_blank"
                                            class="btn btn-sm btn-primary">
                                            View PDF
                                        </a>
                                    @else
                                        <span class="text-muted">No PDF</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
