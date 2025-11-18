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
                    <h3>Add Admins</h3>
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
                                Add <A>Admin</A>
                            </button>
                            <!--large size Modal -->
                            <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel17" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel17">Add Admin</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.admins.add') }}" method="POST"
                                                class="form form-vertical" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label for="name">Name</label>
                                                            <input type="text" id="name" class="form-control"
                                                                name="name" placeholder="Enter admin name">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="email">Email</label>
                                                            <input type="email" id="email" class="form-control"
                                                                name="email" placeholder="Enter admin email">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" id="phone" class="form-control"
                                                                name="phone" placeholder="Enter admin phone">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="role">Role</label>
                                                            <select id="role" class="form-control" name="role">
                                                                <option value="admin">Admin</option>
                                                                <option value="editor">Editor</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="password">Password</label>
                                                            <input type="password" id="password" class="form-control"
                                                                name="password" placeholder="Enter admin password">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="password_confirmation">Confirm Password</label>
                                                            <input type="password" id="password_confirmation"
                                                                class="form-control" name="password_confirmation"
                                                                placeholder="Confirm admin password">
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end gap-2">
                                                            <button type="submit" class="btn btn-primary">Add</button>
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
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
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ ucfirst($admin->role) }}</td>
                                    <td>
                                        <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.admins.delete', $admin->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            {{-- @method('DELETE') --}}
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
@endsection
