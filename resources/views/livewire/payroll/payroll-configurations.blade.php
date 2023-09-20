<div>
{{--    <x-loading-indicator/>--}}
    @section('title', 'Payroll Configuration')
    <div class="row">
        <div class="col-md-3">
            <x-card.card>
                <x-slot:header>Payroll Configuration</x-slot:header>
                <x-slot:body>
                    <div class="nav flex-column nav-pills text-start">
                        <div wire:ignore>
                            <button class="nav-link active earnings"  data-bs-toggle="tab" data-bs-target="#earnings">
                                <i class="fas fa-money-bill me-2"></i>Allowances</button>
                            <button class="nav-link"  data-bs-toggle="tab" data-bs-target="#deductions">
                                <i class="fas fa-money-check me-2"></i>Deductions</button>
                        </div>
                    </div>
                </x-slot:body>
            </x-card.card>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="earnings" wire:ignore.self>
                    <x-card.card>
                        <x-slot:header>Add Allowances</x-slot:header>
                        <x-slot:body>
                            <x-table.table :headers="['S/N','Allowance','Type','Percentage','Actions']">
                                <captions>{{ $allowances->links() }}</captions>
                                <x-card.button-create event="showAllowanceModal">Create Allowance</x-card.button-create>
                                 @forelse($allowances as $index=>$allowance)
                                     <tr>
                                         <td>{{ $loop->iteration }}</td>
                                         <td>{{ $allowance->allowance_name }}</td>
                                         <td class="text-capitalize">{{ $allowance->allowance_type }}</td>
                                         <td>{{ $allowance->percentage ?? 'N/A' }}</td>
                                         <td>
                                             <span><a wire:click.prevent="editAllowanceModal({{ $allowance }})" class="btn btn-xs btn-primary" ><i class="fas fa-edit mr-1"></i>Edit</a></span>
                                             <span><a  wire:click.prevent="deleteAllowanceModal({{ $allowance->id }})"class="btn btn-xs btn-danger " ><i class="fas fa-trash mr-1"></i>Delete</a></span>
                                         </td>
                                     </tr>
                                @empty
                                    <x-table.record-not-found></x-table.record-not-found>
                                @endforelse
                            </x-table.table>
                        </x-slot:body>
                    </x-card.card>
                </div>
                <div class="tab-pane fade" id="deductions" wire:ignore.self>
                        <x-card.card>
                            <x-slot:header>Add Deductions</x-slot:header>
                            <x-slot:body>
                                <x-table.table :headers="['S/N','Deduction','Type','Percentage','Actions']">
                                    <captions>{{ $deductions->links() }}</captions>
                                    <x-card.button-create event="showDeductionModal">Create Deduction</x-card.button-create>
                                    @forelse($deductions as $index=>$deduction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $deduction->deduction_name }}</td>
                                            <td class="text-capitalize">{{ $deduction->deduction_type }}</td>
                                            <td>{{ $deduction->percentage ?? 'N/A' }}</td>
                                            <td>
                                                <span><a wire:click.prevent="editDeductionModal({{ $deduction }})" class="btn btn-xs btn-primary" ><i class="fas fa-edit mr-1"></i>Edit</a></span>
                                                <span><a  wire:click.prevent="deleteDeductionModal({{ $deduction->id }})" class="btn btn-xs btn-danger " ><i class="fas fa-trash mr-1"></i>Delete</a></span>
                                            </td>
                                        </tr>
                                    @empty
                                        <x-table.record-not-found/>
                                    @endforelse
                                </x-table.table>
                            </x-slot:body>
                        </x-card.card>
                    </div>
            </div>
        </div>
    </div>
    {{--Allowance Modal--}}
    <x-modal.modal id="allowance">
        <x-slot:title>{{ $editMode ? 'Edit Allowance' : 'Create Allowance' }}</x-slot:title>
        <x-slot:body>
            <form wire:submit.prevent="{{ $editMode ? 'updateAllowance' : 'createAllowance' }}">
                <x-forms.input field-name="allowance_name"  field-type="text" field-label="Allowance Name"></x-forms.input>
                <x-forms.input-select field-name="allowance_type" :selected_id="$allowance_type" :selected_value="$allowance_type"
                                      :edit-mode="$editMode"
                                      fiel-label="Allowance type" :options="\App\Models\Allowance::ALLOWANCE_TYPE"></x-forms.input-select>
                @if($allowance_type == 'percentage')
                    <div>
                        <div wire:loading.delay>
                            Please wait....
                        </div>
                        <x-forms.input field-name="allowance_percentage"  field-type="number" field-label="Percentage"></x-forms.input>
                    </div>
                @endif
                <x-modal-buttons :edit-mode="$editMode" action="createAllowance"></x-modal-buttons>
            </form>
        </x-slot:body>
    </x-modal.modal>
    {{--Deduction Modal--}}
    <x-modal.modal id="deduction">
        <x-slot:title>{{ $editMode ? 'Edit Deduction' : 'Create Deduction' }}</x-slot:title>
        <x-slot:body>
            <form wire:submit.prevent="{{ $editMode ? 'updateDeduction' : 'createDeduction' }}">
                <x-forms.input field-name="deduction_name"  field-type="text" field-label="Deduction Name"></x-forms.input>
                <x-forms.input-select field-name="deduction_type" fiel-label="Deduction type" :options="\App\Models\Deduction::DEDUCTION_TYPE"
                                      :edit-mode="$editMode" :selected_id="$deduction_type" :selected_value="$deduction_type"></x-forms.input-select>
                @if($deduction_type == 'percentage')
                    <div>
                        <div wire:loading.delay>
                            Please wait....
                        </div>
                        <x-forms.input field-name="deduction_percentage"  field-type="number" field-label="Percentage"></x-forms.input>
                    </div>
                @endif
                <x-modal-buttons :edit-mode="$editMode"></x-modal-buttons>
            </form>
        </x-slot:body>
    </x-modal.modal>
</div>
@push('page-scripts')
<script>
    window.addEventListener('showAllowanceModal', event => {
        $('#allowance').modal('show');
    })
    window.addEventListener('hideAllowanceModal', event => {
        $('#allowance').modal('hide');
    })
    window.addEventListener('showDeductionModal', event => {
        $('#deduction').modal('show');
    })
    window.addEventListener('hideDeductionModal', event => {
        $('#deduction').modal('hide');
    })
</script>
@endpush
