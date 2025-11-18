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
                    <h3>{{ $varients->first()->model->name ?? 'Car' }} Variants</h3>
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
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Variant</th>
                                <th>Fuel Type</th>
                                <th>Engine Szie</th>
                                <th>Transmission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($varients as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->fuel->type }}</td>
                                    <td>{{ $data->engineSize->size }}</td>
                                    <td>
                                        {{ $data->transmission }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-transparent dropdown-toggle me-1" type="button"
                                                id="dropdownMenuButtonIcon" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                More
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonIcon">
                                                <a class="dropdown-item" href="{{route('varient.edit',$data->id)}}"><i
                                                        class="fa-solid fa-pen-to-square"></i>
                                                    Edit</a>
                                                @if (auth()->guard('admins')->user()->role == 'admin')
                                                <a class="dropdown-item" href="{{route('varient.delete',$data->id)}}"><i class="fa-solid fa-trash"></i>
                                                    Delete</a>
                                                @endif
                                            </div>
                                        </div>
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
