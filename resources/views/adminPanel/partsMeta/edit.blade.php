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
                    <h3>Edit Spare Parts Meta</h3>
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
                    <form action="{{ route('admin.parts.meta.update', $metaParts->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Domain</label>
                            <select name="domain_id" class="form-control" required>
                                <option value="">-- Select Domain --</option>
                                @foreach ($domains as $d)
                                    <option value="{{ $d->id }}" {{ $metaParts->domain_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="title" class="form-control" required
                                value="{{ $metaParts->title }}">
                        </div>

                        <div class="mb-3">
                            <label>Meta Description</label>
                            <textarea name="description" id="content" class="form-control" cols="30" rows="10">
                                {!! $metaParts->description !!}
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <label>Focus Keywords</label>
                            <textarea name="focus_keywords" id="content" class="form-control" cols="30" rows="10">
                                {!! $metaParts->focus_keywords !!}
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <label>Structure Data</label>
                            <textarea name="structure_data" id="content" class="form-control" cols="30" rows="10">
                                {!! $metaParts->structure_data !!}
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>

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
