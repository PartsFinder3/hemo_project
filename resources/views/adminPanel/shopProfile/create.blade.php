<!-- Cropper CSS -->
<link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

<!-- Cropper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

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
<div class="col-12">
    <div class="mb-3">
        <label for="cover" class="form-label">Cover Image</label>
        <input type="file" class="form-control" name="cover" id="cover" accept="image/*">
        @error('cover')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Hidden input to store cropped image -->
<input type="hidden" name="cover_cropped" id="cover_cropped">
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
    <!-- Crop Modal -->
<!-- Crop Modal -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Cover Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="crop-image" style="max-width: 100%;">
            </div>
            <div class="modal-footer">
                <button type="button" id="crop-button" class="btn btn-success">Crop & Use Image</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let cropper;
    const coverInput = document.getElementById('cover');
    const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
    const cropImage = document.getElementById('crop-image');
    const coverCroppedInput = document.getElementById('cover_cropped');

    coverInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if(file) {
            const url = URL.createObjectURL(file);
            cropImage.src = url;

            // Show modal
            cropModal.show();

            // Destroy previous cropper
            if(cropper) cropper.destroy();

            cropper = new Cropper(cropImage, {
                aspectRatio: 16/9, // Cover ratio
                viewMode: 1,
                movable: true,
                zoomable: true,
                cropBoxResizable: true,
            });
        }
    });

    document.getElementById('crop-button').addEventListener('click', function() {
        if(cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 1600,
                height: 900
            });

            // Save cropped image as base64 in hidden input
            coverCroppedInput.value = canvas.toDataURL('image/jpeg');

            // Optional: Show small preview below input
            let preview = document.getElementById('cover-preview');
            if(!preview){
                preview = document.createElement('img');
                preview.id = 'cover-preview';
                preview.style.maxWidth = '200px';
                preview.style.display = 'block';
                coverInput.parentNode.appendChild(preview);
            }
            preview.src = coverCroppedInput.value;

            // Close modal
            cropModal.hide();
        }
    });
});
</script>

@endsection
