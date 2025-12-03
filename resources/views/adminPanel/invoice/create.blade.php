@extends('adminPanel.layout.main')
@section('main-section')
    <div class="container-fluid py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                @if (session('pdf_path'))
                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ session('pdf_path') }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye me-1"></i> View PDF
                        </a>
                        <a href="{{ session('pdf_path') }}" download class="btn btn-success btn-sm">
                            <i class="fas fa-download me-1"></i> Download PDF
                        </a>
                    </div>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Invoice Form -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-light border-0 py-3">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fas fa-edit me-2"></i>
                            Invoice Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('invoices.store') }}" id="invoiceForm" novalidate>
                            @csrf
                            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                            <input type="hidden" name="total_amount" id="hiddenTotalAmount" value="0">

                            <!-- Supplier Information -->
                            <div class="row mb-4 my-2">
                                <div class="col-12">
                                    <h6 class="text-secondary mb-3">
                                        <i class="fas fa-building me-2"></i>Supplier Information
                                    </h6>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Supplier Name</label>
                                    <input type="text" class="form-control" id="supplierName"
                                        value="{{ $supplier->name }}" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Contact Number</label>
                                    <input type="text" class="form-control" id="supplierContact"
                                        value="{{ $supplier->whatsapp }}" disabled>
                                </div>
                            </div>

                            <!-- Invoice Information -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-secondary mb-3">
                                        <i class="fas fa-file-invoice me-2"></i>Invoice Information
                                    </h6>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Invoice Number</label>
                                    <input type="text" class="form-control" id="invoiceNumber" name="invoice_number"
                                        placeholder="Will be generated automatically" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Payment Method</label>
                                    <select class="form-select" id="paymentMethod" name="payment_method" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Check">Check</option>
                                        <option value="Online Payment">Online Payment</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a payment method.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Payment Date</label>
                                    <input type="date" class="form-control" id="paymentDate" name="payment_date"
                                        required>
                                    <div class="invalid-feedback">Please select a payment date.</div>
                                </div>
                            </div>

                            <!-- Subscriptions Section -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="text-secondary mb-0">
                                        <i class="fas fa-list me-2"></i>Subscriptions
                                    </h6>
                                    <button type="button" class="btn btn-success btn-sm" id="addSubscription">
                                        <i class="fas fa-plus me-1"></i> Add Item
                                    </button>
                                </div>
                                <div id="subscriptionsContainer">
                                    <div class="subscription-item card border-start border-primary border-4 mb-3"
                                        data-index="0">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <small class="text-muted fw-semibold">Item #1</small>
                                                <button type="button"
                                                    class="btn btn-outline-danger btn-sm remove-subscription"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label fw-semibold">Type</label>
                                                    <input type="text" class="form-control subscription-type"
                                                        name="subscriptions[0][type]" required
                                                        placeholder="e.g., Inquiry,Shop etc">
                                                    <div class="invalid-feedback">Please enter subscription type.</div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label fw-semibold">Amount</label>
                                                    <div class="input-group">
                                                        {{-- <span class="input-group-text"></span> --}}
                                                        <input type="number" class="form-control subscription-amount"
                                                            name="subscriptions[0][amount]" required placeholder="0.00"
                                                            step="0.01" min="0">
                                                        <div class="invalid-feedback">Please enter a valid amount.</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label fw-semibold">Start Date</label>
                                                    <input type="date" class="form-control subscription-start"
                                                        name="subscriptions[0][start_date]" required>
                                                    <div class="invalid-feedback">Please select start date.</div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label fw-semibold">End Date</label>
                                                    <input type="date" class="form-control subscription-end"
                                                        name="subscriptions[0][end_date]" required>
                                                    <div class="invalid-feedback">Please select end date.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Remarks -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-sticky-note me-2"></i>Remarks
                                </label>
                                <textarea class="form-control" id="remarks" name="remarks" rows="3"
                                    placeholder="Additional notes or comments..."></textarea>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-secondary me-md-2" onclick="resetForm()">
                                    <i class="fas fa-redo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-1"></i> Generate Invoice
                                </button>
                             @if ($supplier->shop)
                                <a href="{{ route('shops.create', $supplier->id) }}" class="btn btn-success me-md-2">
                                    <i class="fas fa-plus me-1"></i> Create Shop
                                </a>
                            @else
                                <a href="javascript:void(0)" class="btn btn-secondary me-md-2 disabled" aria-disabled="true">
                                    <i class="fas fa-check me-1"></i> Already Shop
                                </a>
                            @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Invoice Preview -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-header bg-primary text-white border-0 py-3">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-eye me-2"></i>
                            Live Preview
                        </h5>
                    </div>
                    <div class="card-body p-4" style="background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);">

                        <!-- Company Header -->
                        <div class="text-center mb-4 pb-3 border-bottom"
                            style="font-family: 'Segoe UI', Arial, sans-serif;">
                            <!-- Logo -->
                            <img src="{{ asset('assets/compiled/jpg/Logo.png') }}" alt="Company Logo"
                                style="max-width: 160px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.15));" class="mb-3">

                            <!-- Company Info -->
                            <div class="company-info">
                                <h4 class="fw-bold text-primary mb-1">Parts Finder</h4>

                                <p class="text-muted mb-1">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    Dubai, United Arab Emirates
                                </p>

                                <p class="text-muted mb-0">
                                    <i class="fas fa-phone text-success me-2"></i>
                                    +971 4 123 4567
                                </p>
                            </div>
                        </div>


                        <!-- Invoice Header -->
                        <div class="row mb-4">
                            <div class="col-6">
                                <h3 class="text-primary fw-bold mb-0">INVOICE</h3>
                                <p class="text-muted small mb-0">Professional Service Invoice</p>
                            </div>
                            <div class="col-6 text-end">
                                <div class="badge bg-success fs-6 px-3 py-2">
                                    <span id="previewNumber">Not Generated</span>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier & Payment Info -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="bg-light rounded p-3">
                                    <h6 class="fw-bold text-primary mb-2">
                                        <i class="fas fa-building me-2"></i>Supplier Details
                                    </h6>
                                    <p class="mb-1"><strong>Name:</strong> <span
                                            id="previewSupplier">{{ $supplier->name }}</span></p>
                                    <p class="mb-0"><strong>Contact:</strong> <span
                                            id="previewContact">{{ $supplier->whatsapp }}</span></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded p-3">
                                    <h6 class="fw-bold text-primary mb-2">
                                        <i class="fas fa-credit-card me-2"></i>Payment Info
                                    </h6>
                                    <p class="mb-1"><strong>Method:</strong> <span id="previewPayment"
                                            class="text-muted">Not selected</span></p>
                                    <p class="mb-0"><strong>Date:</strong> <span id="previewPaymentDate"
                                            class="text-muted">Not set</span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Subscriptions Table -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                <i class="fas fa-list-alt me-2"></i>Subscription Items
                            </h6>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Type</th>
                                            <th class="text-center">Start Date</th>
                                            <th class="text-center">End Date</th>
                                            <th class="text-end">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="previewSubscriptions">
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                No items added yet
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Totals Section -->
                        <div class="bg-light rounded p-3 mb-3">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="fw-bold text-primary mb-0">Total Amount:</h5>
                                </div>
                                <div class="col-4 text-end">
                                    <h5 class="fw-bold text-primary mb-0"><span id="previewTotal">0.00</span></h5>
                                </div>
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="bg-light rounded p-3">
                            <h6 class="fw-bold text-primary mb-2">
                                <i class="fas fa-comment-alt me-2"></i>Remarks
                            </h6>
                            <p class="mb-0 text-muted" id="previewRemarks">No additional remarks</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .subscription-item {
            transition: all 0.3s ease;
        }

        .subscription-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card {
            transition: all 0.3s ease;
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        let subscriptionIndex = 0;

        // Initialize the page
        document.addEventListener("DOMContentLoaded", function() {
            setDefaultDate();
            updatePreview();
            initializeEventListeners();
        });

        function initializeEventListeners() {
            // Form validation
            const form = document.getElementById("invoiceForm");
            form.addEventListener("submit", handleFormSubmit);

            // Real-time preview updates
            form.addEventListener("input", debounce(updatePreview, 300));
            form.addEventListener("change", updatePreview);

            // Add subscription button
            document.getElementById("addSubscription").addEventListener("click", addSubscription);

            // Initial subscription remove button setup
            updateRemoveButtons();
        }

        function handleFormSubmit(event) {
            event.preventDefault();

            if (!validateForm()) {
                showAlert('Please fill in all required fields correctly.', 'danger');
                return;
            }

            // Update hidden total amount before submission
            const total = calculateTotal();
            document.getElementById('hiddenTotalAmount').value = total.toFixed(2);

            // Show loading state
            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Generating...';
            submitBtn.disabled = true;

            // Submit form after a short delay for better UX
            setTimeout(() => {
                event.target.submit();
            }, 500);
        }

        function validateForm() {
            const form = document.getElementById("invoiceForm");
            let isValid = true;

            // Clear previous validation states
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

            // Required fields validation
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                }
            });

            // Check if at least one subscription item is properly filled
            const subscriptionItems = document.querySelectorAll(".subscription-item");
            let hasValidSubscription = false;

            subscriptionItems.forEach(item => {
                const type = item.querySelector(".subscription-type").value.trim();
                const amount = parseFloat(item.querySelector(".subscription-amount").value) || 0;
                const startDate = item.querySelector(".subscription-start").value;
                const endDate = item.querySelector(".subscription-end").value;

                if (type && amount > 0 && startDate && endDate) {
                    hasValidSubscription = true;
                }
            });

            if (!hasValidSubscription) {
                showAlert('Please add at least one valid subscription item.', 'danger');
                isValid = false;
            }

            // Date validation
            const startDates = form.querySelectorAll('.subscription-start');
            const endDates = form.querySelectorAll('.subscription-end');

            for (let i = 0; i < startDates.length; i++) {
                if (startDates[i].value && endDates[i].value) {
                    if (new Date(startDates[i].value) >= new Date(endDates[i].value)) {
                        startDates[i].classList.add('is-invalid');
                        endDates[i].classList.add('is-invalid');
                        isValid = false;
                        showAlert('End date must be after start date for all subscription items.', 'danger');
                    }
                }
            }

            return isValid;
        }

        function calculateTotal() {
            const subscriptionItems = document.querySelectorAll(".subscription-item");
            let total = 0;

            subscriptionItems.forEach(item => {
                const amount = parseFloat(item.querySelector(".subscription-amount").value) || 0;
                total += amount;
            });

            return total;
        }

        function updatePreview() {
            // Update supplier info
            document.getElementById("previewSupplier").textContent =
                document.getElementById("supplierName").value || "Not specified";
            document.getElementById("previewContact").textContent =
                document.getElementById("supplierContact").value || "Not specified";

            // Update invoice info
            const invoiceNumber = document.getElementById("invoiceNumber").value;
            document.getElementById("previewNumber").textContent =
                invoiceNumber || "Auto-generated";
            document.getElementById("previewPayment").textContent =
                document.getElementById("paymentMethod").value || "Not selected";
            document.getElementById("previewPaymentDate").textContent =
                formatDate(document.getElementById("paymentDate").value) || "Not set";

            // Update remarks
            const remarks = document.getElementById("remarks").value.trim();
            document.getElementById("previewRemarks").textContent =
                remarks || "No additional remarks";

            // Update subscriptions and calculate totals
            updateSubscriptionsPreview();
        }

        function updateSubscriptionsPreview() {
            const subscriptionItems = document.querySelectorAll(".subscription-item");
            const tbody = document.getElementById("previewSubscriptions");
            tbody.innerHTML = "";

            let total = 0;
            let hasItems = false;

            subscriptionItems.forEach((item, index) => {
                const type = item.querySelector(".subscription-type").value.trim();
                const start = item.querySelector(".subscription-start").value;
                const end = item.querySelector(".subscription-end").value;
                const amount = parseFloat(item.querySelector(".subscription-amount").value) || 0;

                if (type || start || end || amount > 0) {
                    hasItems = true;
                    total += amount;

                    const row = document.createElement('tr');
                    row.className = 'fade-in';
                    row.innerHTML = `
                        <td class="fw-semibold">${type || 'Untitled'}</td>
                        <td class="text-center">${formatDate(start) || '-'}</td>
                        <td class="text-center">${formatDate(end) || '-'}</td>
                        <td class="text-end fw-bold">${amount.toFixed(2)}</td>
                    `;
                    tbody.appendChild(row);
                }
            });

            if (!hasItems) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            No items added yet
                        </td>
                    </tr>
                `;
            }

            // Update total amount
            document.getElementById("previewTotal").textContent = total.toFixed(2);

            // Update hidden total amount field
            document.getElementById('hiddenTotalAmount').value = total.toFixed(2);

            // Add animation to total
            if (total > 0) {
                document.getElementById("previewTotal").parentElement.classList.add('animate-pulse');
                setTimeout(() => {
                    document.getElementById("previewTotal").parentElement.classList.remove('animate-pulse');
                }, 1000);
            }
        }

        function addSubscription() {
            subscriptionIndex++;
            const container = document.getElementById("subscriptionsContainer");

            const newItem = document.createElement("div");
            newItem.className = "subscription-item card border-start border-primary border-4 mb-3 fade-in";
            newItem.setAttribute('data-index', subscriptionIndex);

            newItem.innerHTML = `
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted fw-semibold">Item #${subscriptionIndex + 1}</small>
                        <button type="button" class="btn btn-outline-danger btn-sm remove-subscription">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-semibold">Type</label>
                            <input type="text" class="form-control subscription-type"
                                   name="subscriptions[${subscriptionIndex}][type]" required
                                   placeholder="e.g., Premium Plan">
                            <div class="invalid-feedback">Please enter subscription type.</div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-semibold">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control subscription-amount"
                                       name="subscriptions[${subscriptionIndex}][amount]" required
                                       placeholder="0.00" step="0.01" min="0">
                                <div class="invalid-feedback">Please enter a valid amount.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-semibold">Start Date</label>
                            <input type="date" class="form-control subscription-start"
                                   name="subscriptions[${subscriptionIndex}][start_date]" required>
                            <div class="invalid-feedback">Please select start date.</div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-semibold">End Date</label>
                            <input type="date" class="form-control subscription-end"
                                   name="subscriptions[${subscriptionIndex}][end_date]" required>
                            <div class="invalid-feedback">Please select end date.</div>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(newItem);

            // Add event listeners to new item
            newItem.addEventListener("input", debounce(updatePreview, 300));
            newItem.querySelector('.remove-subscription').addEventListener('click', function() {
                removeSubscription(newItem);
            });

            updateRemoveButtons();
            updatePreview();

            // Smooth scroll to new item
            newItem.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            // Focus on the type field of new item
            setTimeout(() => {
                newItem.querySelector('.subscription-type').focus();
            }, 100);
        }

        function removeSubscription(item) {
            item.style.transition = 'all 0.3s ease';
            item.style.transform = 'scale(0.95)';
            item.style.opacity = '0';

            setTimeout(() => {
                item.remove();
                updateRemoveButtons();
                updateItemNumbers();
                updatePreview();
            }, 300);
        }

        function updateRemoveButtons() {
            const subscriptionItems = document.querySelectorAll(".subscription-item");
            subscriptionItems.forEach((item, index) => {
                const removeBtn = item.querySelector('.remove-subscription');
                if (subscriptionItems.length > 1) {
                    removeBtn.style.display = 'inline-block';
                } else {
                    removeBtn.style.display = 'none';
                }
            });
        }

        function updateItemNumbers() {
            const subscriptionItems = document.querySelectorAll(".subscription-item");
            subscriptionItems.forEach((item, index) => {
                const itemNumber = item.querySelector('.text-muted.fw-semibold');
                if (itemNumber) {
                    itemNumber.textContent = `Item #${index + 1}`;
                }

                // Update input names to maintain correct array indexing
                const inputs = item.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name && name.includes('subscriptions[')) {
                        const newName = name.replace(/subscriptions\[\d+\]/, `subscriptions[${index}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });
        }

        // Remove unused functions (invoice number generation and tax-related functions)
        // These functions are no longer needed since invoice number comes from backend
        // and there's no tax calculation required

        function setDefaultDate() {
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.getElementById("paymentDate").value = formattedDate;
        }

        function formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        function resetForm() {
            if (confirm('Are you sure you want to reset the form? All data will be lost.')) {
                document.getElementById("invoiceForm").reset();

                // Reset to single subscription item
                const container = document.getElementById("subscriptionsContainer");
                container.innerHTML = `
                    <div class="subscription-item card border-start border-primary border-4 mb-3" data-index="0">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted fw-semibold">Item #1</small>
                                <button type="button" class="btn btn-outline-danger btn-sm remove-subscription" style="display: none;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label fw-semibold">Type</label>
                                    <input type="text" class="form-control subscription-type"
                                           name="subscriptions[0][type]" required
                                           placeholder="e.g., Premium Plan">
                                    <div class="invalid-feedback">Please enter subscription type.</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label fw-semibold">Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control subscription-amount"
                                               name="subscriptions[0][amount]" required
                                               placeholder="0.00" step="0.01" min="0">
                                        <div class="invalid-feedback">Please enter a valid amount.</div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label fw-semibold">Start Date</label>
                                    <input type="date" class="form-control subscription-start"
                                           name="subscriptions[0][start_date]" required>
                                    <div class="invalid-feedback">Please select start date.</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label fw-semibold">End Date</label>
                                    <input type="date" class="form-control subscription-end"
                                           name="subscriptions[0][end_date]" required>
                                    <div class="invalid-feedback">Please select end date.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                subscriptionIndex = 0;
                setDefaultDate();
                updateRemoveButtons();
                updatePreview();

                // Re-attach event listeners to new subscription item
                const newSubscriptionItem = container.querySelector('.subscription-item');
                newSubscriptionItem.addEventListener("input", debounce(updatePreview, 300));

                showAlert('Form has been reset successfully!', 'info', 3000);
            }
        }

        function showAlert(message, type = 'info', duration = 5000) {
            // Remove existing alerts
            const existingAlerts = document.querySelectorAll('.temp-alert');
            existingAlerts.forEach(alert => alert.remove());

            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show temp-alert`;
            alertDiv.style.position = 'fixed';
            alertDiv.style.top = '20px';
            alertDiv.style.right = '20px';
            alertDiv.style.zIndex = '9999';
            alertDiv.style.minWidth = '300px';

            const iconMap = {
                'success': 'fas fa-check-circle',
                'danger': 'fas fa-exclamation-triangle',
                'warning': 'fas fa-exclamation-circle',
                'info': 'fas fa-info-circle'
            };

            alertDiv.innerHTML = `
                <i class="${iconMap[type]} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(alertDiv);

            // Auto remove after duration
            setTimeout(() => {
                if (alertDiv && alertDiv.parentNode) {
                    alertDiv.classList.remove('show');
                    setTimeout(() => alertDiv.remove(), 150);
                }
            }, duration);
        }

        // Utility function for debouncing
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Auto-save simulation (using in-memory storage)
        let autoSaveData = {};

        function autoSave() {
            const form = document.getElementById("invoiceForm");
            const formData = new FormData(form);
            autoSaveData = {};

            for (let [key, value] of formData.entries()) {
                autoSaveData[key] = value;
            }

            // Visual indication of auto-save
            const saveIndicator = document.createElement('div');
            saveIndicator.className = 'text-muted small text-end mt-2';
            saveIndicator.innerHTML = '<i class="fas fa-save me-1"></i>Auto-saved';
            saveIndicator.style.opacity = '0';

            const form_container = document.querySelector('.card-body');
            const existingIndicator = form_container.querySelector('.auto-save-indicator');
            if (existingIndicator) existingIndicator.remove();

            saveIndicator.classList.add('auto-save-indicator');
            form_container.appendChild(saveIndicator);

            // Fade in and out
            setTimeout(() => saveIndicator.style.opacity = '1', 100);
            setTimeout(() => saveIndicator.style.opacity = '0', 2000);
            setTimeout(() => saveIndicator.remove(), 2500);
        }

        // Auto-save every 30 seconds
        setInterval(autoSave, 30000);

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById("invoiceForm").dispatchEvent(new Event('submit'));
            }

            // Ctrl/Cmd + N to add new subscription
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                addSubscription();
            }

            // Ctrl/Cmd + R to reset (with confirmation)
            if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
                e.preventDefault();
                resetForm();
            }
        });

        // Print functionality
        function printInvoice() {
            const printContent = document.querySelector('.col-lg-6:last-child .card-body').cloneNode(true);
            const printWindow = window.open('', '_blank');

            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Invoice - ${document.getElementById("previewNumber").textContent}</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
                    <style>
                        @media print {
                            body { margin: 0; }
                            .no-print { display: none !important; }
                        }
                        body { font-family: Arial, sans-serif; }
                    </style>
                </head>
                <body class="p-4">
                    ${printContent.outerHTML}
                </body>
                </html>
            `);

            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 500);
        }

        // Add print button functionality
        function addPrintButton() {
            const previewHeader = document.querySelector('.col-lg-6:last-child .card-header');
            if (previewHeader && !previewHeader.querySelector('.btn-print')) {
                const printBtn = document.createElement('button');
                printBtn.type = 'button';
                printBtn.className = 'btn btn-outline-light btn-sm btn-print float-end';
                printBtn.innerHTML = '<i class="fas fa-print me-1"></i> Print';
                printBtn.onclick = printInvoice;
                previewHeader.appendChild(printBtn);
            }
        }

        // Initialize print button
        setTimeout(addPrintButton, 100);
    </script>

    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endsection
