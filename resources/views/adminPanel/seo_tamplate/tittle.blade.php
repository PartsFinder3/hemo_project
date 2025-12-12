@extends('adminPanel.layout.main')
@section('main-section')

<div class="container mt-4">
    <h2>SEO Templates Title</h2>

    <!-- Add SEO Template Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSEOModal">
        Add SEO Title
    </button>

    <!-- Modal (Large) -->
<!-- Modal (Large) -->
<div class="modal fade" id="addSEOModal" tabindex="-1" aria-labelledby="addSEOModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{route('tamplate.tittle.add')}}" method="POST">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="addSEOModalLabel">Add SEO Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">



                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter title">
                    </div>
                 <div class="mb-3">
                        <label for="template_type" class="form-label">Template Type</label>
                        <select name="template_description_type" id="template_type" class="form-control" required>
                            <option value="" selected disabled>Select Template Type</option>
                            <option value="makes">makes</option>
                            <option value="models">models</option>
                            <option value="parts">parts</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Template</button>
            </div>
            </form>
        </div>
    </div>
</div>

    <!-- SEO Templates Table -->
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>#</th>
             
                <th>title</th>
                   <th>type</th>
                <th width="130px">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example Row -->
@foreach ($titls as $index => $titl)
<tr>
    <td>{{ $index + 1 }}</td>

    <td style="word-break: break-word; white-space: normal;">{{ $titl->tittle }}</td>
    <td style="word-break: break-word; white-space: normal;">{{ $titl->type }}</td>
   
    <td>
    <a href="{{ route('tamplate.title.edit', $titl->id) }}" class="btn btn-sm btn-warning">Edit</a>
     @if (auth()->guard('admins')->user()->role == 'admin')
       <form action="{{ route('tamplate.tittle.destroy', $titl->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
    </form>
    @endif
    </td>
</tr>
@endforeach
        </tbody>
    </table>
</div>

@endsection
