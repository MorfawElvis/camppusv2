<?php

namespace App\Http\Livewire\Payroll;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeList extends Component
{
    use WithPagination;

    public $editedEmployeeField = null;

    protected $paginationTheme = 'bootstrap';

    public $basic_salary;

    public $employees = [];

   protected $rules = [
         'basic_salary' => 'required|integer'
   ];
   public function saveEmployeeSalary($employeeId)
   {
           $this->validate();
           if (!is_null($employeeId))
           {
               Employee::find($employeeId)->update([
                   'basic_salary' => $this->basic_salary
               ]);
           }
       $this->editedEmployeeField = null;
   }
   public function editEmployeeField($employeeId, $fieldName)
   {
//       $employee = $this->employees[$employeeIndex] ?? NULL;
       $this->basic_salary = Employee::where('id', $employeeId )->pluck('basic_salary')->first();
       $this->editedEmployeeField = $employeeId . '.' . $fieldName;
   }

    public function render()
    {
         $employee_collections = Employee::where('is_retired', false)
                                    ->where('is_dismissed', false)
                                    ->orderBy('full_name', 'asc')
                                    ->paginate(10);

        $links =$employee_collections;

        //Converting the paginated results in a collection
        $this->employees = collect($employee_collections->items());

        return view('livewire.payroll.employee-list', [
            'employees' => $this->employees,
            'links'     => $links
        ]);
    }
}
