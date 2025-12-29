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
                    <h3>Cities</h3>
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
                        <!--Modal lg size -->
                        <div class="me-1 mb-1 d-inline-block">
                            <!-- Button trigger for large size modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#large">
                                Add City
                            </button>
                            <!--large size Modal -->
                            <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel17" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel17">Add City</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('city.create') }}" method="POST"
                                                class="form form-vertical" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-vertical">Country</label>
                                                                <select name="domain_id" class="form-control"
                                                                    id="">
                                                                    <option value="">Select Country</option>
                                                                    @foreach ($domains as $country)
                                                                        <option value="{{ $country->id }}">
                                                                            {{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="email-id-vertical">City</label>
                                                                <input type="text" id="email-id-vertical"
                                                                    class="form-control" name="name"
                                                                    placeholder="Enter City">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit"
                                                                class="btn btn-primary me-1 mb-1">Submit</button>
                                                            <button type="reset"
                                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
          <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>Country</th>
                    <th>City</th>
                    <th>Active</th>
                    <th>Action</th>
                    <th>SEO Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cities as $city)
                    <tr>
                        <td>{{ $city->domain->name ?? 'N/A' }}</td>
                        <td>{{ $city->name }}</td>

                        <td>
                            @if ($city->active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>

                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('city.active', $city->id) }}">
                                <i class="fa-solid fa-pen-to-square"></i> Active
                            </a>

                            @if (auth()->guard('admins')->user()->role == 'admin')
                                <a class="btn btn-danger btn-sm" href="{{ route('city.delete', $city->id) }}">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </a>
                            @endif

                            <a class="btn btn-warning btn-sm" href="{{ route('city.seo', $city->id) }}">
                                <i class="fa-solid fa-chart-line"></i> SEO
                            </a>

                            @if ($city->cityContent)
                                <span class="badge bg-warning">
                                    <i class="fa-solid fa-check"></i> Generated
                                </span>
                            @else
                                <a class="btn btn-success btn-sm" href="{{ route('city.seo.city', $city->id) }}">
                                    <i class="fa-solid fa-plus"></i> Generate
                                </a>
                            @endif
                        </td>

                        <td>
                            @if ($city->tamp_id)
                                <span class="badge bg-success me-1">
                                    <i class="fa-solid fa-file-lines"></i> Description
                                </span>
                            @endif

                            @if ($city->tamp_title_id)
                                <span class="badge bg-primary">
                                    <i class="fa-solid fa-heading"></i> Title
                                </span>
                            @endif

                            @if (!$city->tamp_id && !$city->tamp_title_id)
                                <span class="badge bg-danger">Not Generated</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
                </div>
            </div>

        </section>
    </div>
@endsection
