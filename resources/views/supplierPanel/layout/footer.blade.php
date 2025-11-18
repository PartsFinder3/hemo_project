
<style>
    .search-section {
        background-color: #fff;
        border-bottom: 1px solid #dee2e6;
        padding: 20px 0;
    }

    .listing-item {
        border: 1px solid #dee2e6;
        margin-bottom: 20px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .listing-header {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 8px;
    }

    .vehicle-title {
        color: #fd7e14;
        font-weight: bold;
        text-decoration: none;
        font-size: 1.2rem;
    }

    .vehicle-title:hover {
        color: #fd7e14;
        text-decoration: underline;
    }

    .part-description {
        color: #333;
        margin: 8px 0;
        font-weight: 500;
    }

    .part-condition {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .contact-buttons {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .create-ad-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #dc3545;
        color: white;
        border-radius: 50px;
        padding: 12px 20px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .create-ad-btn:hover {
        background-color: #c82333;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    /* Mobile responsive improvements */
    @media (max-width: 991.98px) {
        .search-section {
            padding: 15px 0;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #495057;
        }

        .listing-item {
            margin-bottom: 15px;
            padding: 15px;
        }

        .contact-buttons {
            flex-direction: column;
            gap: 8px;
        }

        .contact-buttons .btn {
            font-size: 0.8rem;
            padding: 8px 12px;
        }

        .vehicle-title {
            font-size: 1.1rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Make/Model dependency
        const makeSelect = document.getElementById('makeSelect');
        const modelSelect = document.getElementById('modelSelect');

        if (makeSelect && modelSelect) {
            makeSelect.addEventListener('change', function() {
                const makeId = this.value;

                // Reset model select
                modelSelect.innerHTML = '<option value="">Loading...</option>';
                modelSelect.disabled = true;

                if (makeId) {
                    // Add CSRF token if you're using it
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    const headers = {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    };

                    if (csrfToken) {
                        headers['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
                    }

                    fetch(`/get-models/${makeId}`, {
                            method: 'GET',
                            headers: headers
                        })
                        .then(response => {
                            console.log('Response status:', response.status);
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Received data:', data);
                            modelSelect.innerHTML = '<option value="">Select Model</option>';

                            if (Array.isArray(data) && data.length > 0) {
                                data.forEach(model => {
                                    const option = document.createElement('option');
                                    option.value = model.id;
                                    option.textContent = model.name;
                                    modelSelect.appendChild(option);
                                });
                            } else {
                                modelSelect.innerHTML = '<option value="">No models found</option>';
                            }

                            modelSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Error fetching models:', error);
                            modelSelect.innerHTML =
                                '<option value="">Error loading models</option>';
                            modelSelect.disabled = false;
                        });
                } else {
                    modelSelect.innerHTML = '<option value="">Select Model</option>';
                    modelSelect.disabled = false;
                }
            });
        }

        // Time range functionality
        const timeRangeSelect = document.querySelector('select[name="time_range"]');
        const customDateRange = document.getElementById('customDateRange');

        if (timeRangeSelect && customDateRange) {
            timeRangeSelect.addEventListener('change', function() {
                if (this.value === 'custom') {
                    customDateRange.style.display = 'flex';
                } else {
                    customDateRange.style.display = 'none';
                }
            });
        }

        // Update toggle button text
        const toggleButton = document.querySelector('[data-bs-target="#searchFilters"]');
        const searchFilters = document.getElementById('searchFilters');

        if (toggleButton && searchFilters) {
            searchFilters.addEventListener('shown.bs.collapse', function() {
                toggleButton.innerHTML =
                    '<i class="fas fa-search me-2"></i>Hide Search Filters<i class="fas fa-chevron-up ms-2"></i>';
            });

            searchFilters.addEventListener('hidden.bs.collapse', function() {
                toggleButton.innerHTML =
                    '<i class="fas fa-search me-2"></i>Show Search Filters<i class="fas fa-chevron-down ms-2"></i>';
            });
        }

        function updateClock() {
            let now = new Date();
            let options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            document.getElementById('liveClock').innerText =
                now.toLocaleString('en-GB', options).replace(',', '');
        }

        updateClock();
        setInterval(updateClock, 1000);

    });
</script>
<footer>
    {{-- <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi</a></p>
                    </div>
                </div> --}}
</footer>
</div>
</div>

<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/compiled/js/app.js') }}"></script>
<script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/date-picker.js') }}"></script>
</body>
</html>
