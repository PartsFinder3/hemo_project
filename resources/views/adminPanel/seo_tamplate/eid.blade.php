@extends('adminPanel.layout.main')
@section('main-section')

<div class="container mt-4">
    <h2>Update SEO Template</h2>

    <!-- Update Form -->
    <form action="{{ route('seo.update', $Tamplate->id) }}" method="POST">
        @csrf
     

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $Tamplate->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="7" required>{{ $Tamplate->description }}</textarea>
        </div>



        <button type="submit" class="btn btn-success">Update Template</button>
        <a href="{{ route('SEO.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
