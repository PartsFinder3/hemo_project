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
                    <h3>Add Car Makes</h3>
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
                    <h3>Car Makes</h3>
                    <form action="{{ route('shops.makes.store', $shop->id) }}" method="POST" class="form form-vertical">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Select Car Makes</label>
                                        <div class="mb-2">
                                            <input type="checkbox" id="toggleAll">
                                            <label for="toggleAll" class="fw-bold">Select All</label>
                                        </div>

                                        @foreach ($makes as $make)
                                            <div class="form-check">
                                                <input type="checkbox"
                                                       name="make_id[]"
                                                       value="{{ $make->id }}"
                                                       class="form-check-input make-checkbox"
                                                       id="make{{ $make->id }}">
                                                <label class="form-check-label" for="make{{ $make->id }}">
                                                    {{ $make->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <a href="{{ route('shops.parts.create', $shop->id) }}" type="reset" class="btn btn-info me-1 mb-1">Add Parts</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        const toggleAll = document.getElementById('toggleAll');
                        const makeCheckboxes = document.querySelectorAll('.make-checkbox');

                        toggleAll.addEventListener('change', function() {
                            makeCheckboxes.forEach(cb => cb.checked = this.checked);
                        });

                        makeCheckboxes.forEach(cb => {
                            cb.addEventListener('change', () => {
                                toggleAll.checked = [...makeCheckboxes].every(c => c.checked);
                            });
                        });
                    </script>
                </div>
            </div>
        </section>
    </div>
@endsection
