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
                <h3>Car Makes</h3>
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Add Car Make Modal -->
                    <div class="me-1 mb-1 d-inline-block">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#large">
                            Add Car Make
                        </button>
    <a href="{{route('generate.seo.make')}}"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#generateAI">
        Generate AI Content
    </button></a>
                        <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel17" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel17">Add Car Make</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('makes.create') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" name="name" class="form-control" placeholder="Car Make Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Logo</label>
                                                            <input type="file" name="logo" class="form-control">
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
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>
            </div>

            <!-- Per Page Selection -->
            <form method="GET" class="mb-3">
                <label class="me-2 fw-bold">Show</label>
                <select name="per_page" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
                    <option value="50"  {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    <option value="200" {{ $perPage == 200 ? 'selected' : '' }}>200</option>
                    <option value="300" {{ $perPage == 300 ? 'selected' : '' }}>300</option>
                </select>
                <span class="ms-2">records</span>
            </form>
            <div class="mt-3">
                {{ $carMakes->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
            <div class="card-body table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Logo</th>
                            <th>Action</th>
                            <th>SEO Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carMakes as $make)
                            <tr>
                                <td>{{ $make->name }}</td>
                                <td>
                                    @if ($make->logo)
                                        <img style="width: 50px" src="{{ asset('storage/' . $make->logo) }}" alt="Logo" />
                                    @else
                                        <span>No logo</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('makes.update', $make->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                     @if (auth()->guard('admins')->user()->role == 'admin')
                                    <a class="btn btn-danger btn-sm" href="{{ route('makes.delete', $make->id) }}">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </a>
                                    @endif
                                    <a class="btn btn-warning btn-sm" href="{{ route('makes.seo', $make->id) }}">
                                        <i class="fa-solid fa-chart-line"></i> SEO
                                    </a>
                                </td>
                                <td>
    @if ($make->tamp_id != null)
        <span class="badge bg-success me-1">
            <i class="fa-solid fa-file-lines"></i> Description
        </span>
    @endif

    @if ($make->tamp_title_id != null)
        <span class="badge bg-primary">
            <i class="fa-solid fa-heading"></i> Title
        </span>
    @endif
</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $carMakes->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>
</div>
@endsection
