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
                    <h3>Spare Parts</h3>
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
                                Add Part
                            </button>
                            <!--large size Modal -->
                            <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel17" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel17">Add Spare Part</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('spareparts.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="mb-3">
                                                    <label>Category</label>
                                                    <select name="category_id" class="form-control" required>
                                                        <option value="">-- Select Category --</option>
                                                        @foreach ($categories as $cat)
                                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Part Name</label>
                                                    <input type="text" name="name" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>OEM Number</label>
                                                    <input type="text" name="oem_number" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label>Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>

                                                <button type="submit" class="btn btn-success">Save</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="card-body">
        <div class="mb-3">
    {{ $spareParts->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
         <div class="card-body table-responsive" style="max-height: 500px; overflow-y: auto;">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>OEM Number</th>
                <th>Category</th>
                <th>Image</th>
                <th>SEO</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($spareParts as $part)
            <tr>
                <td>{{ $part->name }}</td>
                <td>{{ $part->oem_number }}</td>
                <td>{{ $part->category->name ?? 'N/A' }}</td>
                <td>
                    @if ($part->image)
                    <img src="{{ asset('storage/' . $part->image) }}" alt="Spare Part" width="80">
                    @endif
                </td>
                <td>
                    <a href="{{route('admin.parts.meta',$part->id)}}" class="btn btn-warning btn-sm">SEO</a>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{route('spareparts.edit',$part->id)}}"><i
                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                    <a class="btn btn-danger btn-sm" href="{{route('spareparts.destroy',$part->id)}}"><i class="fa-solid fa-trash"></i> Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
        <div class="mb-3">
    {{ $spareParts->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
                </div>
            </div>

        </section>
    </div>
@endsection
