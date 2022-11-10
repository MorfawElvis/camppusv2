<?php

namespace App\Http\Livewire\Staff;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StaffList extends Component
{
    use WithPagination,LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $staffs = Employee::with('user')
                            ->whereHas('user', function($query){
                            $query->where('user_status', '=', '1');
                            })
                            ->paginate(10);
        return view('livewire.staff.staff-list', compact('staffs'));
    }
}
