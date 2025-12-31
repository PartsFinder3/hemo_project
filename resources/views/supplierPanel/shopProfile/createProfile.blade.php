@extends('supplierPanel.layout.main')
@section('main-section')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
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
                        <form action="{{ route('supplier.shops.profile.store', $shop->id) }}" method="POST"
                            class="form form-vertical" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="mb-3">
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="Sup_name" id=""
                                                value="{{ $Supplier->name ?? '' }}">
                                                <input type="hidden" name="suplier_id"
                                                value="{{ $Supplier->id ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="first-name-vertical">About</label>
                                            <textarea name="description" id="" class="form-control" rows="3">{{ $profile->description ?? '' }}</textarea>
                                        </div>
                                        @error('description')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" id=""
                                                value="{{ $profile->address ?? '' }}">
                                        </div>
                                        @error('address')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Cover Image</label>
                                            @if (isset($profile) && $profile->cover)
                                                <img src="{{ asset('storage/' . $profile->cover) }}" alt="Cover Image"
                                                    style="max-width: 200px; display: block; margin-bottom: 10px;">
                                            @endif
                                            <input type="file" class="form-control" name="cover" id="">
                                        </div>
                                        @error('cover')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Profile Image</label>
                                            @if (isset($profile) && $profile->profile_image)
                                                <img src="{{ asset('storage/' . $profile->profile_image) }}"
                                                    alt="Profile Image"
                                                    style="max-width: 200px; display: block; margin-bottom: 10px;">
                                            @endif
                                            <input type="file" class="form-control" name="profile_image" id="">
                                        </div>
                                        @error('profile_image')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-orange me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-red me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
