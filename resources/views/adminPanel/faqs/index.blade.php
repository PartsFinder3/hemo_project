@extends('adminPanel.layout.main')
@section('main-section')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(session('success'))
    <script>
        swal("Success!", "{{ session('success') }}", "success");
    </script>
@endif
<div class="container">

    <h2 class="mb-3">FAQ Management</h2>

    <!-- Button Right Side -->
    <div class="text-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFaqModal">
            + Add FAQ
        </button>
    </div>

    <!-- Add FAQ Modal -->
    <div class="modal fade" id="addFaqModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add New FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

               <form id="addFaqForm" method="POST" action="{{ route('faqs.store_faqs') }}" onsubmit="submitForm(event, this)">

                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Question</label>
                            <input type="text" name="question" class="form-control" required>
                           <input type="hidden" name="domain_id" value="{{ $domain_id }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Answer</label>
                            <textarea name="answer" class="form-control" rows="4" required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Save FAQ</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- FAQ List -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($faqs as $faq)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $faq->F_question }}</td>
                <td>{{ $faq->F_answer }}</td>
                <td>
           <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-sm btn-warning" style="width: 80px;">Edit</a>

                <form action="{{ route('faq.delete', $faq->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" style="width: 80px;">
                        Delete
                    </button>
                </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script>
function submitForm(event, formElement) {
    event.preventDefault(); // Always pass event explicitly

    swal({
        title: "Confirmation!",
        text: "Are you sure you want to proceed?",
        icon: "warning",
        buttons: ["No", "Yes"],
        dangerMode: false,
    }).then((res) => {
        if (res) {
            let formData = new FormData(formElement);
            $("#mainLoader1").modal('show');

            $.ajax({
                url: $(formElement).attr('action'),
                type: $(formElement).attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#mainLoader1").modal('hide');
                    if (response.code == 1) {
                        $("#addFaqForm")[0].reset();
                        $("#addFaqModal").modal('hide');
                        swal("Success!", response.message, "success").then(() => {
                            location.reload(); // Reload to refresh FAQ list
                        });
                    } else if (response.code == 0) {
                        swal("Sorry!", response.message, "error");
                    } else {
                        swal("Sorry!", "Unexpected response", "error");
                    }
                },
                error: function(xhr) {
                    $("#mainLoader1").modal('hide');
                    let errorMessage = "Something went wrong.";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    swal("Error!", errorMessage, "error");
                }
            });
        }
    });
}


</script>

@endsection
