<div>
    @section('title', 'Payroll List')
    <x-card.card>
        <x-slot name="header">Payroll List</x-slot>
        <x-slot name="body">
            <x-buttons.modal-button modal_id="#createPayroll">Create Payroll</x-buttons.modal-button>
            <x-table.table :headers="['Ref.ID','Month','Year','Total','Status','Actions']">

            </x-table.table>
        </x-slot>
    </x-card.card>
    <x-modal.modal id="createPayroll">
        <x-slot name="title">Create Payroll</x-slot>
        <x-slot name="body"></x-slot>
    </x-modal.modal>
</div>
