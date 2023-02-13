<?php

namespace App\Http\Livewire\Reports;

use App\Models\ClassRoom;
use Livewire\Component;
use App\Models\FeePayment;
use App\Models\Student;
use Livewire\WithPagination;

class FeeCollectedReport extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $date_to, $date_from;

    public function printReport()
    {
        return \Redirect::route('print.fee-report', [$this->date_from, $this->date_to]);
    }

    public function render()
    { 
       
        $fee_payments = FeePayment::whereBetween('transaction_date', [$this->date_from, $this->date_to])
                                    ->with('student.class_room.section')
                                    ->orderBy(Student::select('full_name')->whereColumn('students.id', 'fee_payments.student_id'))
                                    ->paginate(10);

        return view('livewire.reports.fee-collected-report', compact('fee_payments'));
    }
}
