@extends('supplierPanel.layout.main')
@section('main-section')
<header class="mb-4">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 col-md-12 d-flex flex-column justify-content-center align-items-center">
            <h2 class="fw-bold">Account Settings</h2>
            <p class="text-muted">Manage your account information and password here.</p>
        </div>
    </div>

    {{-- Alerts --}}
    <div class="row mb-3">
        <div class="col-12 col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    {{-- Update Password --}}
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white text-center py-3">
                    <h5 class="mb-0 fw-bold">Update Password</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('supplier.password.edit', $supplier->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold">Current Password</label>
                            <input type="password" class="form-control form-control-lg rounded-3"
                                id="current_password" name="current_password" placeholder="Enter current password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label fw-semibold">New Password</label>
                            <input type="password" class="form-control form-control-lg rounded-3"
                                id="new_password" name="new_password" placeholder="Enter new password" required>
                        </div>
                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                            <input type="password" class="form-control form-control-lg rounded-3"
                                id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm new password" required>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary w-100 py-2 fw-bold shadow-sm">
                            <i class="bi bi-lock-fill me-2"></i>Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

</style>
@endsection
