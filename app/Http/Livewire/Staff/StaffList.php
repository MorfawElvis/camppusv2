<?php

namespace App\Http\Livewire\Staff;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class StaffList extends Component
{
    use WithPagination,LivewireAlert;

    public $deletedEmployee;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'deleteEmployee'
    ];
    public function deleteConfirmation($staff_id)
    {
        $this->deletedEmployee=$staff_id;
        $this->confirm('',[
            'onConfirmed' => 'deleteEmployee'
        ]);
    }
    public function deleteEmployee()
    {
        $employee = User::findOrFail($this->deletedEmployee);
        $employee->employee()->delete();
        $this->alert('success', 'Record has been successfully deleted!');
    }
    public function render()
    {
        $employees = User::with('employee')
                  ->whereHas('employee', function ($q) {
                      $q->where('is_dismissed', false);
                      $q->where('is_retired', false);
                  })
                 ->paginate(10);
        return view('livewire.staff.staff-list', compact('employees'));
    }
}
