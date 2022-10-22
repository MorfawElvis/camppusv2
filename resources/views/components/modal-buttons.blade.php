<div class="float-right">
    <button type="button" class="btn btn-warning rounded-pill mr-2" data-bs-dismiss="modal">Cancel</button>
    <button type="submit"  class="btn btn-primary rounded-pill">
        <div wire:loading.delay wire:target="submit" class="spinner-border spinner-border-sm text-white"></div>
        {{$slot}}
    </button>
</div>


