<div>
    <form wire:submit.prevent="{{ $editMode ? 'updateFeeItem' : 'createFeeItem' }}" class="row g-3 d-flex justify-content-center mt-2">
        <div class="col-md-4">
            <label for="fee-item" class="visually-hidden">Fee Item</label>
            <input type="text" class="form-control text-capitalize @error('fee_item') is-invalid @enderror" wire:model.debounce.5000ms="fee_item" id="fee-item" placeholder="Fee Item">
            @error('fee_item')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><spn class="fas fa-plus me-2"></spn>{{ $editMode ? 'Save Changes' : 'Create' }}</button>
        </div>
    </form>
    <hr>
    <x-table.table :headers="['S/N','Name','Actions',]">
        @if($extra_fee_items)
            @forelse($extra_fee_items as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <button wire:click.prevent="editFeeItem({{ $item }})"><i class="fas fa-pen text-bold text-blue cursor-pointer"></i></button>
                        <button wire:click.prevent="deleteFeeItem({{ $item->id }})"><i class="fas fa-times-circle text-bold text-danger cursor-pointer"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No Record Found</td>
                </tr>
            @endforelse
        @endif
    </x-table.table>

</div>
