@if (session()->has('message'))
<p class="alert alert-success alert-dismissible fade show">
        <strong>{{ session('message') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</p>
@endif
