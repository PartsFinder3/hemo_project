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
                                        <div class="mb-3">
                                            @if (isset($profile) && $profile->cover)
                                                <img src="{{ asset('storage/' . $profile->cover) }}" alt="Cover Image" style="max-width: 100%; height: 180px; object-fit: cover; margin-bottom: 10px; border-radius: 8px;">
                                            @endif
                                        </div>
                                        <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
                                        <small class="text-muted">Recommended size: 1200x300px or similar aspect ratio. Max 5MB</small>
                                        @error('cover')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Preview container for cropped image -->
                                    <div id="cover-preview-container"></div>
                                </div>
                                
                                <!-- Hidden inputs for cropped data -->
                                <input type="hidden" name="cover_cropped" id="cover_cropped">
                                <input type="hidden" name="crop_data" id="crop_data">
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
<!-- Enhanced Crop Modal -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Crop Cover Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="crop-container" style="background: #f8f9fa; min-height: 400px; border-radius: 8px; overflow: hidden;">
                            <img id="crop-image" style="max-width: 100%; display: block;">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Preview</h6>
                                <div class="ratio ratio-4x1 mb-3" style="background: #f8f9fa; overflow: hidden; border-radius: 6px;">
                                    <div id="crop-preview" style="overflow: hidden;"></div>
                                </div>
                                
                                <h6 class="card-title mt-3">Tools</h6>
                                <div class="d-grid gap-2 mb-3">
                                    <button type="button" id="move" class="btn btn-outline-primary btn-sm active">
                                        <i class="bi bi-arrows-move"></i> Move
                                    </button>
                                    <div class="btn-group" role="group">
                                        <button type="button" id="zoom-in" class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-zoom-in"></i>
                                        </button>
                                        <button type="button" id="zoom-out" class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-zoom-out"></i>
                                        </button>
                                        <button type="button" id="rotate-left" class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                        <button type="button" id="rotate-right" class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                        <button type="button" id="reset" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-arrow-clockwise"></i> Reset
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <label class="form-label">Aspect Ratio</label>
                                    <select class="form-select form-select-sm" id="aspectRatio">
                                        <option value="4">4:1 (Wide Banner)</option>
                                        <option value="3">3:1 (Standard Banner)</option>
                                        <option value="2">2:1 (Header)</option>
                                        <option value="0" selected>Free</option>
                                    </select>
                                </div>
                                
                                <div class="mt-3">
                                    <label class="form-label">Image Quality</label>
                                    <div class="d-flex align-items-center">
                                        <input type="range" class="form-range" id="qualityRange" min="0.5" max="1" step="0.1" value="0.9">
                                        <span class="ms-2" id="qualityValue">90%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="cancel-crop">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
                <button type="button" id="crop-button" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Apply Crop
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Cropped Image Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Delete Cropped Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                <h5 class="mt-3">Are you sure?</h5>
                <p>This will remove the cropped image. You'll need to upload a new image.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirm-delete" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let cropper = null;
    let currentFile = null;
    const coverInput = document.getElementById('cover');
    const cropImage = document.getElementById('crop-image');
    const cropModalEl = document.getElementById('cropModal');
    const cropModal = new bootstrap.Modal(cropModalEl, {
        keyboard: false
    });
    const deleteModalEl = document.getElementById('deleteModal');
    const deleteModal = new bootstrap.Modal(deleteModalEl);
    const coverCroppedInput = document.getElementById('cover_cropped');
    const cropDataInput = document.getElementById('crop_data');
    const previewElement = document.getElementById('crop-preview');
    const qualityRange = document.getElementById('qualityRange');
    const qualityValue = document.getElementById('qualityValue');
    const aspectRatioSelect = document.getElementById('aspectRatio');
    const previewContainer = document.getElementById('cover-preview-container');

    // File validation
    const validateFile = (file) => {
        const maxSize = 5 * 1024 * 1024; // 5MB
        const validTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        
        if (!validTypes.includes(file.type)) {
            alert('Please upload a valid image file (JPEG, PNG, WebP, or GIF)');
            return false;
        }
        
        if (file.size > maxSize) {
            alert('File size must be less than 5MB');
            return false;
        }
        
        return true;
    };

    // Function to show cropped image preview
    function showCroppedPreview(imageData) {
        const previewHTML = `
            <div class="preview-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0"><i class="bi bi-check-circle-fill text-success"></i> Cropped Image Ready</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger" id="delete-cropped">
                        <i class="bi bi-trash"></i> Remove
                    </button>
                </div>
                <div class="text-center">
                    <img src="${imageData}" alt="Cropped Preview" class="img-fluid mb-2" style="max-width: 100%; height: 150px; object-fit: cover;">
                    <p class="text-muted mb-0">This image will be saved when you submit the form.</p>
                </div>
            </div>
        `;
        
        previewContainer.innerHTML = previewHTML;
        
        // Add event listener to delete button
        document.getElementById('delete-cropped').addEventListener('click', function() {
            deleteModal.show();
        });
    }

    // Function to clear cropped image
    function clearCroppedImage() {
        coverCroppedInput.value = '';
        cropDataInput.value = '';
        previewContainer.innerHTML = '';
        coverInput.value = '';
        
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }

    coverInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        
        if (!validateFile(file)) {
            this.value = '';
            return;
        }
        
        currentFile = file;
        const reader = new FileReader();
        
        reader.onload = function (e) {
            cropImage.src = e.target.result;
            
            // Clean up previous cropper instance
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            
            cropModal.show();
            
            // Initialize cropper after modal is shown
            setTimeout(() => {
                initializeCropper();
            }, 300);
        };
        
        reader.readAsDataURL(file);
    });

    function initializeCropper() {
        cropper = new Cropper(cropImage, {
            viewMode: 2,
            dragMode: 'move',
            initialAspectRatio: 4,
            aspectRatio: 4,
            autoCropArea: 1,
            responsive: true,
            restore: true,
            guides: true,
            center: true,
            highlight: false,
            cropBoxMovable: true,
            cropBoxResizable: true,
            toggleDragModeOnDblclick: true,
            zoomOnWheel: true,
            ready: function () {
                // Set initial crop box to cover image aspect ratio (4:1)
                const containerData = cropper.getContainerData();
                const cropBoxWidth = containerData.width;
                const cropBoxHeight = cropBoxWidth / 4;
                
                cropper.setCropBoxData({
                    width: cropBoxWidth,
                    height: cropBoxHeight,
                    left: 0,
                    top: (containerData.height - cropBoxHeight) / 2
                });
                
                updatePreview();
            },
            crop: function (event) {
                updatePreview();
            }
        });

        // Setup preview
        updatePreview();
        
        // Setup tool buttons
        setupTools();
    }

    function setupTools() {
        // Move tool
        document.getElementById('move').addEventListener('click', function () {
            cropper.setDragMode('move');
            this.classList.add('active');
            document.getElementById('crop')?.classList.remove('active');
        });

        // Zoom in/out
        document.getElementById('zoom-in').addEventListener('click', function () {
            cropper.zoom(0.1);
        });

        document.getElementById('zoom-out').addEventListener('click', function () {
            cropper.zoom(-0.1);
        });

        // Rotate
        document.getElementById('rotate-left').addEventListener('click', function () {
            cropper.rotate(-45);
        });

        document.getElementById('rotate-right').addEventListener('click', function () {
            cropper.rotate(45);
        });

        // Reset
        document.getElementById('reset').addEventListener('click', function () {
            cropper.reset();
            aspectRatioSelect.value = 4;
            cropper.setAspectRatio(4);
        });

        // Aspect ratio change
        aspectRatioSelect.addEventListener('change', function () {
            const ratio = parseFloat(this.value);
            if (ratio === 0) {
                cropper.setAspectRatio(NaN);
            } else {
                cropper.setAspectRatio(ratio);
            }
        });

        // Quality slider
        qualityRange.addEventListener('input', function () {
            qualityValue.textContent = Math.round(this.value * 100) + '%';
        });

        // Cancel crop button
        document.getElementById('cancel-crop').addEventListener('click', function() {
            clearCroppedImage();
            cropModal.hide();
        });
    }

    function updatePreview() {
        if (!cropper) return;
        
        const canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 100
        });
        
        if (canvas) {
            // Clear previous preview
            previewElement.innerHTML = '';
            
            // Create new preview image
            const previewImg = document.createElement('img');
            previewImg.src = canvas.toDataURL('image/jpeg', 0.9);
            previewImg.style.width = '100%';
            previewImg.style.height = '100%';
            previewImg.style.objectFit = 'cover';
            previewElement.appendChild(previewImg);
        }
    }

    // Apply crop button
    document.getElementById('crop-button').addEventListener('click', function () {
        if (!cropper) return;
        
        const quality = parseFloat(qualityRange.value);
        
        // Get cropped canvas with high quality
        const canvas = cropper.getCroppedCanvas({
            width: 1200, // Higher resolution for better quality
            height: 300,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
            fillColor: '#fff'
        });
        
        if (!canvas) {
            alert('Error creating cropped image');
            return;
        }
        
        // Get crop data for potential server-side processing
        const cropData = cropper.getData();
        cropDataInput.value = JSON.stringify(cropData);
        
        // Convert to high-quality JPEG
        const croppedImage = canvas.toDataURL('image/jpeg', quality);
        
        // Store in hidden input
        coverCroppedInput.value = croppedImage;
        
        // Show preview of cropped image
        showCroppedPreview(croppedImage);
        
        // Hide modal
        cropModal.hide();
        
        // Clean up cropper
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    });

    // Confirm delete button
    document.getElementById('confirm-delete').addEventListener('click', function() {
        clearCroppedImage();
        deleteModal.hide();
    });

    // Clean up when crop modal is hidden
    cropModalEl.addEventListener('hidden.bs.modal', function () {
        // Only clear if user closed modal without cropping
        if (cropper && !coverCroppedInput.value) {
            coverInput.value = ''; // Clear the file input
        }
        
        if (cropper && !coverCroppedInput.value) {
            cropper.destroy();
            cropper = null;
        }
    });
    
    // Clean up when delete modal is hidden
    deleteModalEl.addEventListener('hidden.bs.modal', function () {
        // Nothing to do here
    });
});
</script>
@endsection
