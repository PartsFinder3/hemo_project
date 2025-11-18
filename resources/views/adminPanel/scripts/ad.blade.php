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
                    <h3>Add Ads Unit</h3>
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
                        <!--Modal lg size -->
                        <div class="me-1 mb-1 d-inline-block">
                            <!-- Button trigger for large size modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#large">
                                Add Unit
                            </button>
                            <!--large size Modal -->
                            <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel17" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel17">Add</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.scripts.adunit.store') }}" method="POST"
                                                class="form form-vertical" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <!-- Location -->
                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="location" class="form-label">Location</label>
                                                                <select name="location" id="location" class="form-control"
                                                                    required>
                                                                    <option value="" disabled selected>Select Location
                                                                    </option>
                                                                    <option value="header">Header</option>
                                                                    <option value="sidebar">Sidebar</option>
                                                                    <option value="footer">Footer</option>
                                                                    <option value="article-top">Article Top</option>
                                                                    <option value="article-bottom">Article Bottom</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Client ID -->
                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="client_id" class="form-label">AdSense Client
                                                                    ID</label>
                                                                <input type="text" id="client_id" name="client_id"
                                                                    class="form-control"
                                                                    placeholder="ca-pub-XXXXXXXXXXXXXXXX" required>
                                                            </div>
                                                        </div>

                                                        <!-- Slot ID -->
                                                        <div class="col-12">
                                                            <div class="form-group mb-3">
                                                                <label for="slot_id" class="form-label">AdSense Slot
                                                                    ID</label>
                                                                <input type="text" id="slot_id" name="slot_id"
                                                                    class="form-control" placeholder="1234567890" required>
                                                            </div>
                                                        </div>

                                                        <!-- Buttons -->
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit"
                                                                class="btn btn-primary me-2">Submit</button>
                                                            <button type="reset"
                                                                class="btn btn-light-secondary">Reset</button>
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
                                <th>Location</th>
                                <th>Slot ID</th>
                                <th>Client ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adunits as $adunit)
                                <tr>
                                    <td>{{ $adunit->location }}</td>
                                    <td>{{ $adunit->slot_id }}</td>
                                    <td>{{ $adunit->client_id }}</td>
                                    <td>
                                        <a href="{{ route('admin.scripts.adunit.edit', $adunit->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>

                                        <form action="{{ route('admin.scripts.adunit.delete', $adunit->id) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this ad unit?')">Delete</button>
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
    {{--
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('textarea[id=content]').summernote({
                placeholder: 'Write your about content here...',
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
        }); --}}
    </script>
@endsection
