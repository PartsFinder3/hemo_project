@extends('supplierPanel.layout.main')
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
        @php
            $supplier = Auth::guard('supplier')->user();
        @endphp

        <div class="row g-4 p-5">
            <!-- Invoice Form -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-light border-0 py-3">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fas fa-edit me-2"></i>
                            Buyer Invoice Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('supplier.buyer.invoices.store') }}" id="invoiceForm" novalidate>
                            @csrf
                            <input type="hidden" name="total_amount" id="hiddenTotalAmount" value="0">
                            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">

                            <!-- Buyer Information -->
                            <div class="row mb-4 my-2">
                                <div class="col-12">
                                    <h6 class="text-secondary mb-3">
                                        <i class="fas fa-user me-2"></i>Buyer Information
                                    </h6>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Buyer Name</label>
                                    <input type="text" class="form-control" name="buyer_name" required>
                                    <div class="invalid-feedback">Please enter buyer name.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Buyer Phone</label>
                                    <input type="text" class="form-control" name="buyer_phone" required
                                           placeholder="Enter buyer phone number">
                                    <div class="invalid-feedback">Please enter buyer phone number.</div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-semibold">Buyer Address</label>
                                    <textarea class="form-control" name="buyer_address" rows="2" required
                                              placeholder="Enter buyer address"></textarea>
                                    <div class="invalid-feedback">Please enter buyer address.</div>
                                </div>
                            </div>

                            <!-- Supplier Information -->
                            <div class="row mb-4">
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
                                    <input type="text" class="form-control" id="invoiceNumber"
                                        placeholder="Will be generated automatically (BINV-)" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Invoice Date</label>
                                    <input type="date" class="form-control" name="invoice_date" required>
                                    <div class="invalid-feedback">Please select invoice date.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Tax Rate (%)</label>
                                    <input type="number" class="form-control" id="taxRate"
                                        value="5" min="0" max="100" step="0.01"
                                        placeholder="Enter tax rate">
                                    <small class="text-muted">Default: 5%</small>
                                </div>
                            </div>

                            <!-- Invoice Items Section -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="text-secondary mb-0">
                                        <i class="fas fa-list me-2"></i>Invoice Items
                                    </h6>
                                    <button type="button" class="btn btn-success btn-sm" id="addItem">
                                        <i class="fas fa-plus me-1"></i> Add Item
                                    </button>
                                </div>
                                <div id="itemsContainer">
                                    <div class="invoice-item card border-start border-primary border-4 mb-3" data-index="0">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <small class="text-muted fw-semibold">Item #1</small>
                                                <button type="button" class="btn btn-outline-danger btn-sm remove-item"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label fw-semibold">Description</label>
                                                    <textarea class="form-control item-description" rows="2" name="items[0][description]" required
                                                        placeholder="Enter item description"></textarea>
                                                    <div class="invalid-feedback">Please enter item description.</div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label fw-semibold">Quantity</label>
                                                    <input type="number" class="form-control item-quantity"
                                                        name="items[0][quantity]" required placeholder="1" min="1"
                                                        value="1">
                                                    <div class="invalid-feedback">Please enter valid quantity.</div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label fw-semibold">Price per Unit</label>
                                                    <input type="number" class="form-control item-price"
                                                        name="items[0][price]" required placeholder="0.00" step="0.01"
                                                        min="0">
                                                    <div class="invalid-feedback">Please enter valid price.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-secondary me-md-2" onclick="resetForm()">
                                    <i class="fas fa-redo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-1"></i> Generate Invoice
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Invoice Preview -->
            <div class="col-lg-6">
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
                            <!-- Shop Name -->
                            <h2 class="fw-bold text-primary mb-1">
                                {{ $supplier->shop->name }}
                            </h2>

                            <!-- Address / City -->
                            <h5 class="fw-semibold text-dark mb-1">
                                {{ $supplier->shop?->profile?->address
                                    ? $supplier->shop->profile->address . ' ' . $supplier->city?->name
                                    : $supplier->city?->name ?? 'N/A' }}
                            </h5>

                            <!-- WhatsApp -->
                            <h6 class="fw-bold text-success mb-0">
                                <i class="fab fa-whatsapp me-1"></i> {{ $supplier->whatsapp }}
                            </h6>
                        </div>

                        <!-- Invoice Header -->
                        <div class="row mb-4">
                            <div class="col-6">
                                <h3 class="text-primary fw-bold mb-0">INVOICE</h3>
                                <p class="text-muted small mb-0">Buyer Invoice</p>
                            </div>
                            <div class="col-6 text-end">
                                <div class="mt-2">
                                    <small class="text-muted">Date: <span id="previewDate">Not set</span></small>
                                </div>
                            </div>
                        </div>

                        <!-- Buyer & Supplier Info -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="bg-light rounded p-3">
                                    <h6 class="fw-bold text-primary mb-2">
                                        <i class="fas fa-user me-2"></i>Bill To
                                    </h6>
                                    <p class="mb-1"><strong>Name:</strong> <span id="previewBuyerName">Enter buyer name</span></p>
                                    <p class="mb-1"><strong>Phone:</strong> <span id="previewBuyerPhone">Enter buyer phone</span></p>
                                    <p class="mb-0"><strong>Address:</strong> <span id="previewBuyerAddress">Enter buyer address</span></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded p-3">
                                    <h6 class="fw-bold text-primary mb-2">
                                        <i class="fas fa-building me-2"></i>From
                                    </h6>
                                    <p class="mb-1"><strong>Supplier:</strong> <span id="previewSupplier">{{ $supplier->name }}</span></p>
                                    <p class="mb-0"><strong>Contact:</strong> <span id="previewSupplierContact">{{ $supplier->whatsapp }}</span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                <i class="fas fa-list-alt me-2"></i>Invoice Items
                            </h6>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Description</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Unit Price</th>
                                            <th class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="previewItems">
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
                            <div class="row mb-2">
                                <div class="col-8">
                                    <h6 class="mb-0">Subtotal:</h6>
                                </div>
                                <div class="col-4 text-end">
                                    <h6 class="mb-0"><span id="previewSubtotal">0.00</span></h6>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-8">
                                    <h6 class="mb-0 text-success">Tax (<span id="previewTaxRate">5</span>%):</h6>
                                </div>
                                <div class="col-4 text-end">
                                    <h6 class="mb-0 text-success"><span id="previewTaxAmount">0.00</span></h6>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="fw-bold text-primary mb-0">Total Amount:</h5>
                                </div>
                                <div class="col-4 text-end">
                                    <h5 class="fw-bold text-primary mb-0"><span id="previewTotal">0.00</span></h5>
                                </div>
                            </div>
                        </div>

                        {{-- Footer Section --}}
                        <div class="bg-white shadow-sm rounded p-4 mt-4">
                            <div class="row align-items-center">
                                <!-- Left Side -->
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-primary mb-1">
                                        <i class="fas fa-handshake me-2 text-success"></i>
                                        Thank you for your business!
                                    </h6>
                                    <small class="text-muted">We truly appreciate your trust in us.</small>
                                </div>

                                <!-- Right Side -->
                                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                    <p class="mb-0 text-muted">
                                        <i class="fas fa-calendar-alt me-1 text-secondary"></i>
                                        Generated on:
                                        <span class="fw-semibold">{{ date('Y-m-d') }}</span>
                                    </p>
                                </div>

                                <div class="col-12">
                                    <hr class="my-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <h5 class="fw-bold mb-2 text-dark">Powered By</h5>
                                        <img src="{{ asset('assets/compiled/jpg/Logo.png') }}" alt="Company Logo"
                                            style="max-width: 100px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.15));"
                                            class="mb-2">
                                        <small class="text-muted">Your Trusted Technology Partner</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .invoice-item {
            transition: all 0.3s ease;
        }

        .invoice-item:hover {
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
            0%, 100% {
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
        let itemIndex = 0;

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

            // Tax rate change listener
            const taxRateInput = document.getElementById("taxRate");
            if (taxRateInput) {
                taxRateInput.addEventListener("input", debounce(updatePreview, 300));
            }

            // Add item button
            document.getElementById("addItem").addEventListener("click", addItem);

            // Initial item remove button setup
            updateRemoveButtons();
        }

        function handleFormSubmit(event) {
            event.preventDefault();

            if (!validateForm()) {
                showAlert('Please fill in all required fields correctly.', 'danger');
                return;
            }

            // Update hidden total amount before submission (includes tax)
            const totals = calculateTotal();
            document.getElementById('hiddenTotalAmount').value = totals.total.toFixed(2);

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

            // Check if at least one item is properly filled
            const invoiceItems = document.querySelectorAll(".invoice-item");
            let hasValidItem = false;

            invoiceItems.forEach(item => {
                const description = item.querySelector(".item-description").value.trim();
                const quantity = parseFloat(item.querySelector(".item-quantity").value) || 0;
                const price = parseFloat(item.querySelector(".item-price").value) || 0;

                if (description && quantity > 0 && price >= 0) {
                    hasValidItem = true;
                }
            });

            if (!hasValidItem) {
                showAlert('Please add at least one valid invoice item.', 'danger');
                isValid = false;
            }

            return isValid;
        }

        function calculateTotal() {
            const invoiceItems = document.querySelectorAll(".invoice-item");
            let subtotal = 0;

            invoiceItems.forEach(item => {
                const quantity = parseFloat(item.querySelector(".item-quantity").value) || 0;
                const price = parseFloat(item.querySelector(".item-price").value) || 0;
                subtotal += quantity * price;
            });

            const taxRate = parseFloat(document.getElementById("taxRate")?.value) || 0;
            const taxAmount = (subtotal * taxRate) / 100;
            const total = subtotal + taxAmount;

            return {
                subtotal: subtotal,
                taxRate: taxRate,
                taxAmount: taxAmount,
                total: total
            };
        }

        function updatePreview() {
            // Update buyer info
            const buyerName = document.querySelector('input[name="buyer_name"]').value;
            const buyerPhone = document.querySelector('input[name="buyer_phone"]').value;
            const buyerAddress = document.querySelector('textarea[name="buyer_address"]').value;

            document.getElementById("previewBuyerName").textContent = buyerName || "Enter buyer name";
            document.getElementById("previewBuyerPhone").textContent = buyerPhone || "Enter buyer phone";
            document.getElementById("previewBuyerAddress").textContent = buyerAddress || "Enter buyer address";

            // Update invoice date
            const invoiceDate = document.querySelector('input[name="invoice_date"]').value;
            document.getElementById("previewDate").textContent = formatDate(invoiceDate) || "Not set";

            // Update items and calculate totals
            updateItemsPreview();
        }

        function updateItemsPreview() {
            const invoiceItems = document.querySelectorAll(".invoice-item");
            const tbody = document.getElementById("previewItems");
            tbody.innerHTML = "";

            let hasItems = false;

            invoiceItems.forEach((item, index) => {
                const description = item.querySelector(".item-description").value.trim();
                const quantity = parseFloat(item.querySelector(".item-quantity").value) || 0;
                const price = parseFloat(item.querySelector(".item-price").value) || 0;
                const itemTotal = quantity * price;

                if (description || quantity > 0 || price > 0) {
                    hasItems = true;

                    const row = document.createElement('tr');
                    row.className = 'fade-in';
                    row.innerHTML = `
                        <td class="fw-semibold">${description || 'No description'}</td>
                        <td class="text-center">${quantity}</td>
                        <td class="text-end">${price.toFixed(2)}</td>
                        <td class="text-end fw-bold">${itemTotal.toFixed(2)}</td>
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

            // Calculate totals with tax
            const totals = calculateTotal();

            // Update preview elements
            document.getElementById("previewSubtotal").textContent = totals.subtotal.toFixed(2);
            document.getElementById("previewTaxRate").textContent = totals.taxRate.toFixed(2);
            document.getElementById("previewTaxAmount").textContent = totals.taxAmount.toFixed(2);
            document.getElementById("previewTotal").textContent = totals.total.toFixed(2);

            // Update hidden total amount field (this will be stored in DB)
            document.getElementById('hiddenTotalAmount').value = totals.total.toFixed(2);

            // Add animation to total
            if (totals.total > 0) {
                document.getElementById("previewTotal").parentElement.classList.add('animate-pulse');
                setTimeout(() => {
                    document.getElementById("previewTotal").parentElement.classList.remove('animate-pulse');
                }, 1000);
            }
        }

        function addItem() {
            itemIndex++;
            const container = document.getElementById("itemsContainer");

            const newItem = document.createElement("div");
            newItem.className = "invoice-item card border-start border-primary border-4 mb-3 fade-in";
            newItem.setAttribute('data-index', itemIndex);

            newItem.innerHTML = `
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted fw-semibold">Item #${itemIndex + 1}</small>
                        <button type="button" class="btn btn-outline-danger btn-sm remove-item">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea class="form-control item-description" rows="2"
                                   name="items[${itemIndex}][description]" required
                                   placeholder="Enter item description"></textarea>
                            <div class="invalid-feedback">Please enter item description.</div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-semibold">Quantity</label>
                            <input type="number" class="form-control item-quantity"
                                   name="items[${itemIndex}][quantity]" required
                                   placeholder="1" min="1" value="1">
                            <div class="invalid-feedback">Please enter valid quantity.</div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label fw-semibold">Price per Unit</label>
                            <input type="number" class="form-control item-price"
                                   name="items[${itemIndex}][price]" required
                                   placeholder="0.00" step="0.01" min="0">
                            <div class="invalid-feedback">Please enter valid price.</div>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(newItem);

            // Add event listeners to new item
            newItem.addEventListener("input", debounce(updatePreview, 300));
            newItem.querySelector('.remove-item').addEventListener('click', function() {
                removeItem(newItem);
            });

            updateRemoveButtons();
            updatePreview();

            // Smooth scroll to new item
            newItem.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            // Focus on the description field of new item
            setTimeout(() => {
                newItem.querySelector('.item-description').focus();
            }, 100);
        }

        function removeItem(item) {
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
            const invoiceItems = document.querySelectorAll(".invoice-item");
            invoiceItems.forEach((item, index) => {
                const removeBtn = item.querySelector('.remove-item');
                if (invoiceItems.length > 1) {
                    removeBtn.style.display = 'inline-block';
                } else {
                    removeBtn.style.display = 'none';
                }
            });
        }

        function updateItemNumbers() {
            const invoiceItems = document.querySelectorAll(".invoice-item");
            invoiceItems.forEach((item, index) => {
                const itemNumber = item.querySelector('.text-muted.fw-semibold');
                if (itemNumber) {
                    itemNumber.textContent = `Item #${index + 1}`;
                }

                // Update input names to maintain correct array indexing
                const inputs = item.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name && name.includes('items[')) {
                        const newName = name.replace(/items\[\d+\]/, `items[${index}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });
        }

        function setDefaultDate() {
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.querySelector('input[name="invoice_date"]').value = formattedDate;
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

                // Reset to single item
                const container = document.getElementById("itemsContainer");
                container.innerHTML = `
                    <div class="invoice-item card border-start border-primary border-4 mb-3" data-index="0">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted fw-semibold">Item #1</small>
                                <button type="button" class="btn btn-outline-danger btn-sm remove-item" style="display: none;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control item-description" rows="2"
                                           name="items[0][description]" required
                                           placeholder="Enter item description"></textarea>
                                    <div class="invalid-feedback">Please enter item description.</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label fw-semibold">Quantity</label>
                                    <input type="number" class="form-control item-quantity"
                                           name="items[0][quantity]" required
                                           placeholder="1" min="1" value="1">
                                    <div class="invalid-feedback">Please enter valid quantity.</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label fw-semibold">Price per Unit</label>
                                    <input type="number" class="form-control item-price"
                                           name="items[0][price]" required
                                           placeholder="0.00" step="0.01" min="0">
                                    <div class="invalid-feedback">Please enter valid price.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Reset tax rate to default
                document.getElementById("taxRate").value = 5;

                itemIndex = 0;
                setDefaultDate();
                updateRemoveButtons();
                updatePreview();

                // Re-attach event listeners to new item
                const newItem = container.querySelector('.invoice-item');
                newItem.addEventListener("input", debounce(updatePreview, 300));

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

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById("invoiceForm").dispatchEvent(new Event('submit'));
            }

            // Ctrl/Cmd + N to add new item
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                addItem();
            }

            // Ctrl/Cmd + R to reset (with confirmation)
            if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
                e.preventDefault();
                resetForm();
            }
        });

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

        // Print functionality
        function printInvoice() {
            const printContent = document.querySelector('.col-lg-6:last-child .card-body').cloneNode(true);
            const printWindow = window.open('', '_blank');

            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Invoice - BINV-Auto Generate</title>
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
    </script>

    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endsection
