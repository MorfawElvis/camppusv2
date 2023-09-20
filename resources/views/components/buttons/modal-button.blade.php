@props(['modal_id'])
<button type="button"  class="btn btn-outline-primary rounded-pill float-right mb-3" data-bs-target="{{ $modal_id }}" data-bs-toggle="modal">
    <i class="fas fa-plus-circle mr-2"></i>
    {{ $slot }}
</button>
