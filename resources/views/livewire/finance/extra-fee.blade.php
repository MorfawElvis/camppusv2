<div>
    @section('title', 'Extra Fees')
    <div class="card mt-4 mx-auto shadow-lg">
        <div class="card-header bg-primary">
            <i class="fas fa-arrow-alt-circle-down mr-2"></i>Extra Fees
        </div>
        <div class="card-body">
            <a wire:click.prevent="showExtraFeeModal"  class="btn btn-outline-primary rounded-pill float-right mb-2" 
            wire:ignore>
                <i class="fas fa-plus-circle mr-2"></i>
                Create Extra Fees
            </a>
            <table class="table table-striped table-hover table-responsive-lg mt-4">
                <caption class="mt-2"></caption>
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Fee Type</th>
                    <th>Amount</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                   @forelse ($extra_fees as $extra_fee)
                       <tr>
                           <td>{{ $loop->index+1  }}</td>
                           <td>{{ $extra_fee->fee_type }}</td>
                           <td>{{ number_format($extra_fee->amount) . ' XAF' }}</td>
                           <td class="text-center">
                                <span><a wire:click.prevent="editModal({{ $extra_fee }})" class="btn btn-xs btn-primary" ><i class="fas fa-edit mr-1"></i>Edit</a></span>
                                <span><a wire:click.prevent="deleteFee({{ $extra_fee->id }})" class="btn btn-xs btn-danger " ><i class="fas fa-trash mr-1"></i>Delete</a></span>
                           </td>
                       </tr>
                   @empty
                     <td colspan="4"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                   @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Subject Modal --}}
    <div class="modal fade" id="extraFeeModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>{{ $editMode ? 'Edit Extra Fee' : 'Create Extra Fee' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{$editMode ? 'editFee' : 'createFee'}}" class="form-floating">
                        <div class="form-floating mb-4">
                            <select class="form-select @error('fee_type') is-invalid @enderror" wire:model.lazy="fee_type">
                                    <option value=" {{ $editMode ? $editedFeeId : '' }}" selected>{{ $editMode ? $fee_type : 'Open this select menu' }}</option>
                                @foreach(\App\Models\ExtraFee::EXTRA_FEE_TYPE as $key => $fee_type)
                                    <option value="{{ $fee_type }}">{{ $fee_type }}</option>
                                @endforeach
                            </select>
                            @error('fee_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label class="required">Select Fee Type</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.lazy="amount" class="form-control number-separator @error('amount') is-invalid @enderror"
                                   placeholder="Enter Amount">
                            @error('amount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <label  class="required">Amount</label>
                        </div>
                        <x-modal-buttons>{{$editMode ? 'Save Changes' : 'Save Record'}}</x-modal-buttons>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('page-scripts')
    <script>
        window.addEventListener('showExtraFeeModal', event => {
            $('#extraFeeModal').modal('show');
        });
        window.addEventListener('hideExtraFeeModal', event => {
            $('#extraFeeModal').modal('hide');
        });
    </script>
@endpush

