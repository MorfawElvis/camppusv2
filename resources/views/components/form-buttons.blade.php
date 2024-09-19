<div class="float-right">
    <button type="button" wire:click="#" class="btn btn-warning rounded-pill mr-2" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <button type="submit" class="btn btn-primary rounded-pill">
        <span wire:loading.remove wire:target="{{ $method }}">{{ __('Save Record') }}</span>
        <span wire:loading wire:target="{{ $method }}">Processing...</span>
    </button>
</div>

