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
                    <h3>Edit</h3>
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
                    <form action="" method="POST" class="form form-vertical"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Enter admin name" value="{{ $admin->name }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="email"
                                        placeholder="Enter admin email" value="{{ $admin->email }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" class="form-control" name="phone"
                                        placeholder="Enter admin phone" value="{{ $admin->phone }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="role">Role</label>
                                    <select id="role" class="form-control" name="role">
                                        <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="editor" {{ $admin->role == 'editor' ? 'selected' : '' }}>Editor</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Enter admin password">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" id="password_confirmation" class="form-control"
                                        name="password_confirmation" placeholder="Confirm admin password">
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-light-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
