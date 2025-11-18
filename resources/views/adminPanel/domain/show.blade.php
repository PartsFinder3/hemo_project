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
                    <h3>Domains</h3>
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
                                Add Domain
                            </button>
                            <!--large size Modal -->
                            <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel17" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel17">Add Domain</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('domain.create') }}" method="POST"
                                                class="form form-vertical" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-vertical">Country</label>
                                                                <input type="text" id="first-name-vertical"
                                                                    class="form-control" name="name"
                                                                    placeholder="Country Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="email-id-vertical">Domain URL</label>
                                                                <input type="text" id="email-id-vertical"
                                                                    class="form-control" name="domain_url"
                                                                    placeholder="Domain URL">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">About</label>
                                                                <textarea class="form-control" name="about" id="" rows="3"></textarea>
                                                            </div>

                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="password-vertical">Logo</label>
                                                                <input type="file" id="password-vertical"
                                                                    class="form-control" name="logo" placeholder="Logo">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group
                                                                <label for="password-vertical">Map Image</label>
                                                                <input type="file" id="password-vertical"
                                                                    class="form-control" name="map_img" placeholder="Map Image">
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
                                <th>Domain</th>
                                <th>Logo</th>
                                <th>About</th>
                                <th>FAQs</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($domains as $domain)
                                <tr>
                                    <td>{{ $domain->name }}</td>
                                    <td>{{ $domain->domain_url }}</td>
                                    <td>
                                        @if ($domain->logo)
                                            <img style="width: 50px" src="{{ asset('' . $domain->logo) }}"
                                                alt="Domain Logo" />
                                        @else
                                            <span>No logo</span>
                                        @endif
                                    </td>
                                    <td>{{ mb_strlen($domain->about) > 20 ? substr($domain->about, 0, 20) . '...' : $domain->about }}
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-secondary">+Add</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('domain.update', $domain->id) }}"><i
                                                class="fa-solid fa-pen-to-square"></i>
                                            Edit</a>
                                        <a class="btn btn-danger" href="{{ route('domain.delete', $domain->id) }}"><i
                                                class="fa-solid fa-trash"></i>
                                            Delete</a>
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
            $('textarea[name=about]').summernote({
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
        });
    </script>
@endsection
