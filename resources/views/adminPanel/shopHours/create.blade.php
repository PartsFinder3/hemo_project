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
                    <h3>Shop Hours</h3>
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
                    <h3>Shop Hours</h3>
                    <form action="{{ route('shops.hours.store', $shop->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="monday">Monday</label>
                                        <input type="text" id="monday" name="monday" class="form-control" placeholder="9:00 AM - 5:00 PM">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tuesday">Tuesday</label>
                                        <input type="text" id="tuesday" name="tuesday" class="form-control" placeholder="9:00 AM - 5:00 PM">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="wednesday">Wednesday</label>
                                        <input type="text" id="wednesday" name="wednesday" class="form-control" placeholder="9:00 AM - 5:00 PM">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="thursday">Thursday</label>
                                        <input type="text" id="thursday" name="thursday" class="form-control" placeholder="9:00 AM - 5:00 PM">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="friday">Friday</label>
                                        <input type="text" id="friday" name="friday" class="form-control" placeholder="9:00 AM - 5:00 PM">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="saturday">Saturday</label>
                                        <input type="text" id="saturday" name="saturday" class="form-control" placeholder="9:00 AM - 5:00 PM">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="sunday">Sunday</label>
                                        <input type="text" id="sunday" name="sunday" class="form-control" placeholder="9:00 AM - 5:00 PM">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
