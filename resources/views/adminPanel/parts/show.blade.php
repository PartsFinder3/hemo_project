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
              <form method="GET" action="{{ route('parts.search') }}" class="mb-3 d-flex justify-content-end gap-2">
    <input
        type="text"
        name="search"
        class="form-control w-25"
        placeholder="Search Spare Part..."
        value="{{ request('search') }}"
    >
    <button class="btn btn-primary">Search</button>
    <a href="{{ route('spareparts.show') }}" class="btn btn-secondary">Reset</a>
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
                <th>SEO Statuse</th>
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


    <a class="btn btn-warning btn-sm d-flex align-items-center justify-content-center" 
       style="height: 30px; min-width: 60px;" 
       href="{{ route('admin.parts.meta', $part->id) }}">
       <i class="fa-solid fa-chart-line me-1"></i> SEO
    </a>

                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{route('spareparts.edit',$part->id)}}"><i
                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                         @if (auth()->guard('admins')->user()->role == 'admin')
                    <a class="btn btn-danger btn-sm" href="{{route('spareparts.destroy',$part->id)}}"><i class="fa-solid fa-trash"></i> Delete</a>
                         @endif
            @php
            $seoExists = \App\Models\SparePartSeo::where('part_id', $part->id)->exists();
        @endphp
                        @if ($seoExists)
                            <span class="badge bg-warning">
                                <i class="fa-solid fa-check"></i>Generated
                            </span>
                        @else
                <a class="btn btn-warning btn-sm" href="{{ route('generate.seo.part', $part->id) }}">
                    <i class="fa-solid fa-chart-line"></i> Content Generate
                </a>
                        @endif
                        </td>
<td>

    @if ($part->tamp_id != null)
        <span class="badge bg-success me-1">
            <i class="fa-solid fa-file-lines"></i> Description
        </span>
    @endif

    @if ($part->tamp_title_id != null)
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
        <div class="mb-3">
    {{ $spareParts->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
                </div>
            </div>

        </section>
    </div>
    <style>
        .btn-seo {
    height: 30px;
    min-width: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}
    </style>
@endsection
