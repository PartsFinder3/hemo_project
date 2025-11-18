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
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('buyer.inquiry.send') }}" method="post">
                        @csrf

                        <div class="form-group" id="make-group">
                            <select class="dropdown" id="car_make_id" name="car_make_id">
                                <option disabled selected value="">Select Your Make</option>
                                @foreach ($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="model-group">
                            <select class="dropdown" id="car_model_id" name="car_model_id">
                                <option value="">Select Your Model</option>
                                @foreach ($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="year-group">
                            <select class="dropdown" id="year_id" name="year_id">
                                <option value="">Select Your Model Year</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="parts-group">
                            <label for="parts-dropdown">Select Parts</label>
                            <select id="parts-dropdown" class="dropdown">
                                <option disabled selected value="">Select a part to add</option>
                                @foreach ($parts as $part)
                                    <option value="{{ $part->id }}">{{ $part->name }}</option>
                                @endforeach
                            </select>
                            <!-- Selected Parts Tags + Hidden Inputs -->
                            <div id="parts-tags" class="mt-2"></div>
                            {{-- <input type="hidden" name="parts" id="parts-input"> --}}
                        </div>

                        <script>
                            let selectedParts = [];

                            document.getElementById('parts-dropdown').addEventListener('change', function() {
                                const value = this.value;
                                const text = this.options[this.selectedIndex].text;

                                if (!selectedParts.includes(value)) {
                                    selectedParts.push(value);

                                    // Hidden Input
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = 'parts[]';
                                    hiddenInput.value = value;
                                    document.getElementById('parts-tags').appendChild(hiddenInput);

                                    // UI Tag
                                    const tag = document.createElement('span');
                                    tag.classList.add('badge', 'bg-primary', 'm-1');
                                    tag.innerText = text;

                                    // Remove button (×)
                                    const removeBtn = document.createElement('span');
                                    removeBtn.innerHTML = ' &times;';
                                    removeBtn.style.cursor = 'pointer';
                                    removeBtn.onclick = function() {
                                        // Remove from array
                                        selectedParts = selectedParts.filter(id => id !== value);
                                        // Remove hidden input
                                        hiddenInput.remove();
                                        // Remove tag
                                        tag.remove();
                                    };

                                    tag.appendChild(removeBtn);
                                    document.getElementById('parts-tags').appendChild(tag);
                                }
                            });
                       
                       </script>

                        <div class="form-group hidden" id="condition-group">
                            <div class="condition-section">
                                <div class="condition-title">Condition Required ?</div>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" id="used" name="condition" value="used">
                                        <label for="used">Used</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="new" name="condition" value="new" checked>
                                        <label for="new">New</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" id="doesnt-matter" name="condition" value="does_not_matter">
                                        <label for="doesnt-matter">Doesn't matter</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>

        </section>
    </div>
@endsection
