<?php

namespace App\Http\Livewire\Finance;

use App\Models\ClassRoom;
use App\Models\Section;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ViewPayments extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $class_fees = ClassRoom::with('students' ,'students.payments')
                                 ->withCount('students')
                                 ->withSum('payments', 'amount')
                                 ->paginate(8);           
        $student_fees = Student::search($this->search)
        ->select(['full_name', 'matriculation','gender','class_room_id', 'id'])
        ->withSum('payments', 'amount')
        ->with(['class_room.section'])
        ->paginate($this->perPage);
        return view('livewire.finance.view-payments',compact('student_fees', 'class_fees'));
    }
}
