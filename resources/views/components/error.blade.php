<div class="border-left border-3 border-danger mt-2">
    @if (session()->has('message'))
        <div class="alert text-danger fw-bold">
            <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('message') }}
        </div>
    @endif
</div>
