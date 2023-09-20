<div class="modal fade {{ $class ?? '' }}" id="{{ $id }}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}-title" aria-modal="true" wire:ignore.self>
    <div class="modal-dialog {{ $position ?? 'modal-dialog-centered' }}  {{ $size ?? '' }}" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $title ?? '' }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $body ?? '' }}
            </div>
            <div class="modal-footer">
                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
</div>
