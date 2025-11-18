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
                    <h3>Spare Parts Meta</h3>
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
                                Add Meta
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
                                            <form action="{{route('admin.parts.meta.store',$parts->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <div class="mb-3">
                                                    <label>Domain</label>
                                                    <select name="domain_id" class="form-control" required>
                                                        <option value="">-- Select Domain --</option>
                                                        @foreach ($domains as $d)
                                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Meta Title</label>
                                                    <input type="text" name="title" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Meta Description</label>
                                                    <textarea name="description" id="content" class="form-control" cols="30" rows="10"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Focus Keywords</label>
                                                    <textarea name="focus_keywords" id="content" class="form-control" cols="30" rows="10"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Structure Data</label>
                                                    <textarea name="structure_data" id="content" class="form-control" cols="30" rows="10"></textarea>
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
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Domain</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Focus Keywords</th>
                                <th>Structure Data</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($metaParts as $meta)
                                <tr>
                                    <td>{{ $meta->domain->name }}</td>
                                    <td>{{ $meta->title }}</td>
                                    <td>{!! $meta->description !!}</td>
                                    <td>{!! $meta->focus_keywords !!}</td>
                                    <td>{!! $meta->structure_data !!}</td>
                                    <td>
                                        <a href="{{route('admin.parts.meta.edit',$meta->id)}}" class="btn btn-warning">Edit</a>
                                        <form action="{{route('admin.parts.meta.delete',$meta->id)}}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        </section>
    </div>
            <!-- jQuery (required by Summernote) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Summernote JS -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

        <script>
            $(document).ready(function() {
                $('textarea[id=content]').summernote({
                    placeholder: 'Write your content here...',
                    tabsize: 2,
                    height: 300,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                    ]

                });
            });
        </script>

@endsection
