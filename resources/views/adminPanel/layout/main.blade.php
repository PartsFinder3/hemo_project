@include('adminPanel.layout.head')
@include('adminPanel.layout.side')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('success'))
    <script>
        swal("Success!", "{{ session('success') }}", "success");
    </script>
@endif

@if(session('error'))
    <script>
        swal("Error!", "{{ session('error') }}", "error");
    </script>
@endif
<div class="content-wrapper">
    @yield('main-section')
</div>

@include('adminPanel.layout.footer')
