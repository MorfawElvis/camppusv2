<?php

Namespace App\Repositories\Employee;

use App\Models\Employee;

class EmployeeRepo {

    public function getAllEmployees() : object
    {
          return  Employee::orderBy('full_name', 'asc')->paginate(10);
    }

    public function getBasicSalary() : object
    {
        return  Employee::where('is_dismissed', false)
                          ->where('is_retired', false)
                          ->pluck('basic_salary');
    }

    public function getSelectedEmployee(int $employee_id) : object
    {
         return  Employee::where('id', $employee_id)->get();
    }
}

