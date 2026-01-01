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
                    <h3>Create Shop Profile</h3>
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
                    <form action="{{ route('admin.shops.profile.store', $shop->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
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
                                        <input type="text" class="form-control" name="address" id="" value="{{ $profile->address ?? '' }}">
                                    </div>
                                    @error('address')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                             <div class="col-12">
   <div class="mb-3">
        <label for="cover" class="form-label">Cover Image</label>
        <img id="cover-preview" 
             src="{{ isset($profile) && $profile->cover ? asset('storage/' . $profile->cover) : '' }}" 
             alt="Cover Image" 
             style="max-width: 200px; display: {{ isset($profile) && $profile->cover ? 'block' : 'none' }}; margin-bottom:10px;">
        <input type="file" class="form-control" name="cover" id="cover">
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
                                            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Image" style="max-width: 200px; display: block; margin-bottom: 10px;">
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
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </section>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const coverInput = document.getElementById('cover');
    const coverPreview = document.getElementById('cover-preview');

    coverInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            coverPreview.src = URL.createObjectURL(file);
            coverPreview.style.display = 'block';
        }
    });
});
</script>

@endsection
