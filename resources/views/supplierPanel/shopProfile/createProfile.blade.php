<!-- Cropper CSS -->
<link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

<!-- Cropper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

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
                                            <label for="" class="form-label">User Name</label>
                                            <input type="text" class="form-control" name="Sup_name" id=""
                                                value="{{ $Supplier->name ?? '' }}">
                                                <input type="hidden" name="suplier_id"
                                                value="{{ $Supplier->id ?? '' }}">
                                        </div>
                                         <div class="mb-3">
                                            <label for="" class="form-label">Businees Name</label>
                                            <input type="text" class="form-control" name="Businees_name" id=""
                                                value="{{ $shop->name ?? '' }}">
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
        <label for="cover" class="form-label">Cover Image</label>
          @if (isset($profile) && $profile->cover)
                                            <img src="{{ asset('storage/' . $profile->cover) }}" alt="Profile Image" style="max-width: 200px; display: block; margin-bottom: 10px;">
                                        @endif
        <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
        @error('cover')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>
<!-- Hidden input to store cropped image -->
<!-- Hidden input to store cropped image -->
<input type="hidden" name="cover_cropped" id="cover_cropped">
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
document.addEventListener('DOMContentLoaded', function () {

    let cropper;
    const coverInput = document.getElementById('cover');
    const cropImage = document.getElementById('crop-image');
    const cropModalEl = document.getElementById('cropModal');
    const cropModal = new bootstrap.Modal(cropModalEl);
    const coverCroppedInput = document.getElementById('cover_cropped');

    coverInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function () {
            cropImage.src = reader.result;
            cropModal.show();

            if (cropper) cropper.destroy();

            cropper = new Cropper(cropImage, {
                viewMode: 1,
                dragMode: 'move',        // ✅ only move
                cropBoxMovable: false,   // ❌ resize disable
                cropBoxResizable: false,
                zoomable: false,         // ❌ zoom disable
                scalable: false,
                rotatable: false,
                autoCropArea: 1,
                responsive: true,
                ready() {
                    const container = cropper.getContainerData();
                    cropper.setCropBoxData({
                        left: 0,
                        top: (container.height - 180) / 2,
                        width: container.width,
                        height: 180
                    });
                }
            });
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('crop-button').addEventListener('click', function () {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            height: 180,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });

        coverCroppedInput.value = canvas.toDataURL('image/jpeg', 0.95); // ✅ quality safe
        cropModal.hide();
    });
});
</script>

@endsection
