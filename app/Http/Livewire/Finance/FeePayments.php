<?php

namespace App\Http\Livewire\Finance;

use App\Models\ClassRoom;
use App\Models\FeePayment;
use App\Models\Section;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FeePayments extends Component
{
    use WithPagination,LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $amount_collected, $students, $section_id, $class_rooms, 
           $balance_owed, $class_id, $student_id, $transaction_date, $search;
    public $buttonDisabled =  false;
    public function render()
    {
        $sections = Section::all();
        $fee_payments = FeePayment::search($this->search)
        ->with('student.class_room.section')
        ->latest()
        ->paginate(10);
        return view('livewire.finance.fee-payments', compact('fee_payments', 'sections'));
    }
    
    public function showFeePaymentModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('showFeePaymentModal');
    }
    public function updatedSectionId($section_id)
    {
        $this->class_rooms = ClassRoom::where('section_id', $section_id)->get();
    }
    public function updatedClassId($class_id)
    {
        $this->students = Student::where('class_room_id', $class_id)->get();
    }
    public function updatedStudentId($student_id)
    {
      $student = Student::where('id', $student_id)
                 ->with('class_room')
                 ->withSum('payments', 'amount')
                 ->first();
       $payable_fee = $student->class_room->payable_fee;
       $amount_paid = $student->payments_sum_amount;
       
       $this->balance_owed = $payable_fee - $amount_paid;
    }
    public function updatedAmountCollected()
    {
         if($this->amount_collected > $this->balance_owed ){
            $this->buttonDisabled = true;
         }else
         $this->buttonDisabled = false;
    }
    public function newFeePayment()
    {
        $payment =FeePayment::create([
             'student_id'          => $this->student_id,
             'transaction_date'    => $this->transaction_date,
             'amount'              => $this->amount_collected,
             'payment_mode'        => 'Cash',
             'user_id'             => auth()->user()->id
        ]);
        return \Redirect::route('fee.receipt', $payment->id);
    }
}
