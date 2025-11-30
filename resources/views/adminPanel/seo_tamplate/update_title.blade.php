@extends('adminPanel.layout.main')
@section('main-section')

<div class="container mt-4">
    <h2>Update SEO Template</h2>

    <!-- Update Form -->
    <form action="{{ route('seo.update.title', $Tamplate_title->id) }}" method="POST">
        @csrf
     



                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter title" value="{{$Tamplate_title->tittle}}">
                    </div>

                    <div class="mb-3">
                        <label for="template_type" class="form-label">Template Type</label>
                        <select name="template_description_type" id="template_type" class="form-control" required>
                            <option value="" disabled>Select Template Type</option>

                            <option value="makes" {{ $Tamplate_title->type == 'makes' ? 'selected' : '' }}>makes</option>

                            <option value="models" {{ $Tamplate_title->type == 'models' ? 'selected' : '' }}>models</option>

                            <option value="parts" {{ $Tamplate_title->type == 'parts' ? 'selected' : '' }}>parts</option>

                        </select>
                    </div>


        <button type="submit" class="btn btn-success">Update Template</button>
        <a href="{{ route('SEO.SeoTitles') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
