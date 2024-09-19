<div class="float-right">
    <button type="button" class="btn btn-warning rounded-pill mr-2" data-bs-dismiss="modal">Cancel</button>
    <button type="submit" value="submit" class="btn btn-primary rounded-pill">
        <span wire:loading.remove wire:target="storeData">
            {{$editMode ? 'Save Changes' : 'Save Record'}}
        </span>
        <span wire:loading wire:target="storeData">Processing...</span>
    </button>
</div>


