<div class="float-right">
    <button type="button" class="btn btn-info rounded-pill mr-2" wire:click="resetForm"><i class="fas fa-times mr-2"></i>Cancel</button>
    <button type="submit"  class="btn btn-primary rounded-pill"><i class="fas fa-save mr-1"></i>
        <div wire:loading.delay class="spinner-border spinner-border-sm text-white"></div>
       {{$slot}}
    </button>
</div>

