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
        <input type="file" class="form-control"  id="cover" accept="image/*">
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
                viewMode: 1,
                movable: true,
                zoomable: true,
                scalable: false,
                autoCropArea: 1,
                aspectRatio: NaN, // width flexible
                cropBoxResizable: true,
                ready() {
                    // Set crop box fixed height 180px, full width
                    const containerData = cropper.getContainerData();
                    cropper.setCropBoxData({
                        width: containerData.width,
                        height: 180
                    });
                }
            });
        }
    });

    document.getElementById('crop-button').addEventListener('click', function() {
        if(cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: cropper.getContainerData().width, // full width
                height: 180 // fixed height
            });

            // Save cropped image as base64 in hidden input
            coverCroppedInput.value = canvas.toDataURL('image/jpeg');

            // Optional: Show preview below input
            let preview = document.getElementById('cover-preview');
            if(!preview){
                preview = document.createElement('img');
                preview.id = 'cover-preview';
                preview.style.maxWidth = '100%';
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
