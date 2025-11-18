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
                    <h3>Add Spare Parts</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-left">
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <h3>Spare Parts</h3>
                    <form action="{{ route('shops.parts.store', $shop->id) }}" method="POST" class="form form-vertical"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="parts">Select Spare Parts</label>

                                    <!-- Toggle All Checkbox -->
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="toggleAll">
                                        <label class="form-check-label fw-bold" for="toggleAll">
                                            Select / Deselect All
                                        </label>
                                    </div>

                                    <!-- Parts Checkboxes -->
                                    <div class="row">
                                        @foreach ($parts as $part)
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input part-checkbox" type="checkbox"
                                                        name="part_id[]" value="{{ $part->id }}"
                                                        id="part{{ $part->id }}">
                                                    <label class="form-check-label" for="part{{ $part->id }}">
                                                        {{ $part->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <a href="{{ route('shops.makes.create', $shop->id) }}" type="reset" class="btn btn-info me-1 mb-1">Add Makes</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        const toggleAll = document.getElementById('toggleAll');
                        const partCheckboxes = document.querySelectorAll('.part-checkbox');

                        toggleAll.addEventListener('change', function() {
                            partCheckboxes.forEach(cb => cb.checked = this.checked);
                        });

                        // Keep "toggleAll" in sync if user manually checks/unchecks
                        partCheckboxes.forEach(cb => {
                            cb.addEventListener('change', () => {
                                toggleAll.checked = [...partCheckboxes].every(c => c.checked);
                            });
                        });
                    </script>

                </div>
            </div>
        </section>
    </div>
@endsection
