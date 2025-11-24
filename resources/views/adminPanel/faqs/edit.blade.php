@extends('adminPanel.layout.main')
@section('main-section')

<div class="container mt-4">
    <h2>Edit FAQ</h2>

    @if(session('success'))
        <script>
            swal("Success!", "{{ session('success') }}", "success");
        </script>
    @endif

<form action="{{ route('faqs.update', $faq->id) }}" method="POST">
    @csrf

    <input type="hidden" name="domain_id" value="{{ $faq->domain_id }}">

    <div class="mb-3">
        <label class="form-label">Question</label>
        <input type="text" name="question" class="form-control" value="{{ $faq->F_question }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Answer</label>
        <textarea name="answer" class="form-control" rows="4" required>{{ $faq->F_answer }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update FAQ</button>
    <a href="{{ route('addFAQs.faqs', $faq->domain_id) }}" class="btn btn-secondary">Cancel</a>
</form>
</div>

@endsection
