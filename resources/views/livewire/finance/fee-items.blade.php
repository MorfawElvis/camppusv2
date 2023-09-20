<x-modal.modal id="feeItemModal" size="modal-lg" position="">
    <x-slot:title>Managing Fee Items For : {{ $class_name }} </x-slot:title>
    <x-slot:body>
        <form wire:click.prevent="createFeeItem" class="row g-3">
            <div class="col-auto">
                <label for="fee-item" class="visually-hidden">Fee Item</label>
                <input type="text" class="form-control text-capitalize" wire:model.defer="name" id="fee-item" placeholder="Fee Item">
            </div>
            <div class="col-auto">
                <label for="amount" class="visually-hidden">Amount</label>
                <input type="text" class="form-control number-separator" wire:model.defer="amount" id="amount" placeholder="Amount">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3"><spn class="fas fa-plus me-2"></spn>Save</button>
            </div>
        </form>
        <hr>
        <x-table.table :headers="['S/N','Fee Item','Amount','']">
            <caption class="text-dark text-right mt-2">Total Payable Fee: <span class="text-bold">{{ number_format($class_fee) . ' XAF' }}</span></caption>
            @forelse($class_fee_items as $fee_item)
                <tr>
                    <td>{{ $loop->index + 1}}</td>
                    <td>{{ $fee_item->name }}</td>
                    <td>{{ $fee_item->amount }}</td>
                    <td>
                        <button><i class="fas fa-pen text-bold text-blue cursor-pointer"></i></button>
                        <button wire:click="deleteFeeItem({{ $fee_item->id }})"><i class="fas fa-times-circle text-bold text-danger cursor-pointer"></i></button>
                    </td>
                </tr>
            @empty
                <x-table.record-not-found/>
            @endforelse
        </x-table.table>
    </x-slot:body>
</x-modal.modal>
