<div>
    @section('title', 'Employee List')
    @push('page-styles')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
    <x-card.card>
       <x-slot:header>Employee List</x-slot:header>
        <x-slot:body>
            <table class="table table-hover data-table mt-2">
                <caption class="mt-2">{{ $links }}</caption>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Employment Date</th>
                        <th class="text-center">Basic Salary</th>
                        <th class="text-center">Allowances</th>
                        <th class="text-center">Deductions</th>
                    </tr>
                </thead>
                <tbody>
                   <tr>
                   @forelse($employees  as $index  =>  $employee)
                       <tr>
                           <td class="text-bold">{{ $employee->matriculation }}</td>
                           <td>{{ $employee->full_name }}</td>
                           <td>{{ $employee->date_of_employment }}</td>
                           <td class="text-center table-active">
                               @if($editedEmployeeField === $employee->id . '.basic_salary')
                                   <div x-data="{}">
                                       <input
                                           @keyup.enter="$wire.editedEmployeeField === '{{ $employee->id }}.basic_salary' ? $wire.saveEmployeeSalary({{ $employee->id }}) : null"
                                           class="form-control-sm text-end font-weight-bolder" wire:model.defer="basic_salary">
                                       @if($errors->has('basic_salary'))
                                           <div class="text-danger">{{ $errors->first('basic_salary') }}</div>
                                       @endif
                                   </div>
                               @else
                                   <div class="cursor-pointer border-1 border border-dark" wire:click="editEmployeeField({{ $employee->id }}, 'basic_salary')">
                                       {{ number_format($employee['basic_salary']) }}
                                   </div>
                               @endif
                           </td>
                           <td class="text-center"><button  class="btn btn-outline-info btn-sm">Adjust Allowances</button></td>
                           <td class="text-center"><button class="btn btn-outline-danger btn-sm">Adjust Deductions</button></td>
                       </tr>
                   @empty
                       <tr  class="text-center">
                           <td colspan="6"><i class="fas fa-question-circle mr-2"></i>No record found</td>
                       </tr>
                   @endforelse
                </tbody>
            </table>
        </x-slot:body>
    </x-card.card>
</div>
@push('page-scripts')
    <script type="text/javascript">
        window.addEventListener('showEditModal', event => {
            $('#salaryModal').modal('show');
        })
    </script>
@endpush
