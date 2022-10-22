<?php

namespace App\Http\Livewire\Academics;

use App\Models\Department;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Departments extends Component
{
    use WithPagination,LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $department_head, $departmentDeleted, $departmentName, $departmentEditedId;
    public $editMode = false;

    protected $listeners = [
       'deleteDepartment'
    ];

    public  function showDepartmentModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showDepartmentModal');
    }
    public function createDepartment()
    {
        $this->validate([
            'departmentName' => 'required|string|max:35|unique:departments,department_name'
        ]);
        Department::create([
            'department_name' => $this->departmentName,
            'user_id'         => $this->department_head
        ]);
        $this->dispatchBrowserEvent('hideDepartmentModal');
        $this->alert('success', 'Record has been saved successfully');
    }
    public function editModal($department)
    {
        $this->reset();
        $this->departmentName   = $department['department_name'];
        $this->departmentEditedId = $department['id'];
        $this->editMode = true;
        $this->dispatchBrowserEvent('showDepartmentModal');

    }
    public function editDepartment()
    {
        $this->validate([
            'departmentName' => 'required|string|max:35|unique:departments,department_name,'.$this->departmentEditedId
        ]);

        Department::findOrFail($this->departmentEditedId)->update([
            'department_name' => $this->departmentName,
            'user_id'         => $this->department_head
        ]);
        $this->dispatchBrowserEvent('hideDepartmentModal');
        $this->alert('success', 'Record has been deleted successfully');
    }
    public function confirmDelete($dep_id)
    {
        $this->departmentDeleted = $dep_id;
        $this->confirm('Are you sure you want to delete this record?', [
            'onConfirmed' => 'deleteDepartment',
        ]);
    }
    public function deleteDepartment()
    {
       Department::destroy($this->departmentDeleted);
       $this->alert('success', 'Record has been deleted successfully');
    }
    public function render()
    {
        $departments = Department::with('user')->paginate(5);
        return view('livewire.academics.departments', [
            'departments' => $departments
        ]);
    }
}
