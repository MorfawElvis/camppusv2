<div>
    @section('title', 'Manage Fee Items')
    <x-card.card>
        <x-slot:header>Manage Fee Items</x-slot:header>
        <x-slot:body>
            <x-table.table :headers="['S/N','Class','Fee Items','Total Fee', '']">
               @forelse($class_rooms as $index => $class_room)
                    <tr>
                        <td>{{ $loop->index +1 }}</td>
                        <td>{{ $class_room->class_name }}</td>
                           <td>
                               @foreach($class_room->feeItems  as $fee_item)
                                   {{ $fee_item->name .',' ?? '--'}}
                               @endforeach
                           </td>
                        <td>{{ number_format($class_room->fee_items_sum_amount) . ' XAF' }}</td>
                        <td>
                            <button type="button" wire:click.prevent="showFeeItemModal({{ $class_room }})"  class="btn btn-outline-primary">
                                <i class="fas fa-plus-circle mr-2"></i>
                                Manage Fee Items
                            </button>
                        </td>
                    </tr>
                @empty
                 <x-table.record-not-found/>
                @endforelse
            </x-table.table>
            <x-modal.modal id="feeItemModal" size="modal-lg" position="">
                <x-slot:title>Managing Fee Items For : {{ $class_name }} </x-slot:title>
                <x-slot:body>
                    <form wire:submit.prevent="{{ $editMode ? 'updateFeeItem' : 'createFeeItem' }}" class="row g-3">
                        <div class="col-auto">
                            <label for="fee-item" class="visually-hidden">Fee Item</label>
                            <input type="text" class="form-control text-capitalize @error('name') is-invalid @enderror" wire:model.defer="name" id="fee-item" placeholder="Fee Item">
                            @error('name')
                              <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <label for="amount" class="visually-hidden">Amount</label>
                            <input type="text" class="form-control number-separator @error('amount') is-invalid @enderror" wire:model.defer="amount" id="amount" placeholder="Amount">
                            @error('amount')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3"><spn class="fas fa-plus me-2"></spn>{{ $editMode ? 'Save Changes' : 'Create' }}</button>
                        </div>
                    </form>
                    <hr>
                    <x-table.table :headers="['S/N','Fee Item','Amount','']">
                        @php
                            $payable_fee = 0;
                        @endphp
                        @forelse($class_fee_items as $fee_item)
                            <tr>
                                <td>{{ $loop->index + 1}}</td>
                                <td>{{ $fee_item->name }}</td>
                                <td>{{ number_format($fee_item->amount) }}</td>
                                <td>
                                    <button wire:click.prevent="editFeeItem({{ $fee_item }})"><i class="fas fa-pen text-bold text-blue cursor-pointer"></i></button>
                                    <button wire:click.prevent="deleteFeeItem({{ $fee_item->id }})"><i class="fas fa-times-circle text-bold text-danger cursor-pointer"></i></button>
                                </td>
                                @php
                                    $payable_fee += $fee_item->amount
                                @endphp
                            </tr>
                        @empty
                            <x-table.record-not-found/>
                        @endforelse
                        <caption class="text-dark text-right mt-2">Total Payable Fee: <span class="text-bold">{{ number_format($payable_fee) . ' XAF' }}</span></caption>
                    </x-table.table>
                </x-slot:body>
            </x-modal.modal>
        </x-slot:body>
    </x-card.card>
</div>
@push('page-scripts')
    <script>
        window.addEventListener('showFeeItemModal', event => {
            $('#feeItemModal').modal('show')
        })
    </script>
@endpush

