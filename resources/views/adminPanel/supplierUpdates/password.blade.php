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
                <div class="col-12 col-md-6">
                    <h3>Account Settings</h3>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Update Password --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Update Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('supplier.password.update.post', $supplier->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Password</button>
                        </form>

                    </div>
                </div>
            </div>

            {{-- Update Profile Info --}}
            {{-- Update Profile Info --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Update Profile Info</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('supplier.profile.update', $supplier->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Supplier Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $supplier->name ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="business_name" class="form-label">Business Name</label>
                                <input type="text" class="form-control" id="business_name" name="business_name"
                                    value="{{ old('business_name', $supplier->business_name ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                    value="{{ old('whatsapp', $supplier->whatsapp ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $supplier->email ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <select name="city_id" id="city" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ old('city_id', $supplier->city_id ?? '') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
