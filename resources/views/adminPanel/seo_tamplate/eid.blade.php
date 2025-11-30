@extends('adminPanel.layout.main')
@section('main-section')

<div class="container mt-4">
    <h2>Update SEO Template</h2>

    <!-- Update Form -->
    <form action="{{ route('seo.update', $Tamplate->id) }}" method="POST">
        @csrf
     



    <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea id="description" name="description" class="form-control" rows="7" required>{{ $Tamplate->description }}</textarea>
</div>

<div class="mb-3">
    <label for="template_type" class="form-label">Template Type</label>
    <select name="template_description_type" id="template_type" class="form-control" required>
        <option value="" disabled>Select Template Type</option>

        <option value="makes" {{ $Tamplate->type == 'makes' ? 'selected' : '' }}>makes</option>

        <option value="models" {{ $Tamplate->type == 'models' ? 'selected' : '' }}>models</option>

        <option value="parts" {{ $Tamplate->type == 'parts' ? 'selected' : '' }}>parts</option>

    </select>
</div>


        <button type="submit" class="btn btn-success">Update Template</button>
        <a href="{{ route('SEO.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
