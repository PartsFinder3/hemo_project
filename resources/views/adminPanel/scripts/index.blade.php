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
                    <h3>Add Site Scripts</h3>
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
                                Add Site Script
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
                                            <form action="{{ route('admin.scripts.store') }}" method="POST"
                                                class="form form-vertical" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-vertical">Type</label>
                                                                <select name="type" class="form-control" id="">
                                                                    <option value="" selected disabled>Select</option>
                                                                    <option value="adsence">Adsence</option>
                                                                    <option value="analytics">Analytics</option>
                                                                    <option value="google_search_console">Google Search
                                                                        Console</option>
                                                                    <option value="bing_webmaster_tools">Bing Webmaster
                                                                        Tools</option>
                                                                    <option value="baidu_search_console">Baidu Search
                                                                        Console</option>
                                                                    <option value="yandex_webmaster">Yandex Webmaster
                                                                    </option>
                                                                    <option value="duckduckgo_webmaster">DuckDuckGo
                                                                        Webmaster</option>
                                                                    <option value="seznam_webmaster">Seznam Webmaster
                                                                    </option>
                                                                    <option value="naver_webmaster">Naver Webmaster Tools
                                                                    </option>
                                                                    <option value="sogou_webmaster">Sogou Webmaster</option>
                                                                    <option value="yahoo_webmaster">Yahoo Webmaster Tools
                                                                    </option>
                                                                    <option value="qwant_webmaster">Qwant Webmaster Tools
                                                                    </option>
                                                                    <option value="ecosia_webmaster">Ecosia Webmaster Tools
                                                                    </option>
                                                                    <option value="archive_org_webmaster">Internet Archive
                                                                        (Archive.org)</option>
                                                                    <option value="aol_webmaster">AOL Search Webmaster Tools
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Script</label>
                                                                <textarea class="form-control" name="script_content" id="content" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit"
                                                                class="btn btn-primary me-1 mb-1">Submit</button>
                                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1"
                                                                data-bs-dismiss="modal">Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span>
                            <a href="{{ route('admin.scripts.adunit') }}" class="btn btn-info">Ad Units</a>
                        </span>
                        <span>
                            <a href="{{ route('sitemap.xml') }}" class="btn btn-warning">Generate XML</a>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scripts as $script)
                                <tr>
                                    <td>{{ $script->type }}</td>
                                    <td>
                                        <a href="{{ route('admin.scripts.edit', $script->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.scripts.delete', $script->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            {{-- @method('DELETE') --}}
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
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
