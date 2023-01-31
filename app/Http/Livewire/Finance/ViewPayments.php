<?php

namespace App\Http\Livewire\Finance;

use App\Models\Section;
use App\Models\Student;
use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\FeePayment;
use Livewire\WithPagination;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ViewPayments extends Component
{
    use WithPagination;

    public $search, $student_id, $balance_owed, $amount_collected, $transaction_date;
    public $perPage = 10;
    public $buttonDisabled = false;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $get_boarding_fee = get_boarding_fee();
        $class_fees = ClassRoom::with('students' ,'students.payments')
                                 ->withCount('students')
                                 ->withSum('payments', 'amount')
                                 ->paginate(8);           
        $student_fees = Student::search($this->search)
        ->select(['full_name', 'matriculation','gender','class_room_id', 'id', 'is_boarding'])
        ->withSum('payments', 'amount')
        ->with(['class_room.section'])
        ->paginate($this->perPage);
        return view('livewire.finance.view-payments',compact('student_fees', 'class_fees', 'get_boarding_fee'));
    }

    public function showFeePaymentModal($student_id)
    {
        $this->reset();
        $this->student_id = $student_id;
        $student = Student::where('id', $student_id)
                 ->with('class_room')
                 ->withSum('payments', 'amount')
                 ->first();
        if($student->is_boarding){
        $payable_fee = $student->class_room->payable_fee + get_boarding_fee()->boarding_fee;
        }else
        $payable_fee = $student->class_room->payable_fee;
        
        $amount_paid = $student->payments_sum_amount;
        
         $this->balance_owed = $payable_fee - $amount_paid;
         $this->dispatchBrowserEvent('showFeePaymentModal');

    }
    
    public function updatedAmountCollected()
    {
        $amount_collected = str_replace(',', '', $this->amount_collected);
         if($amount_collected > $this->balance_owed ){
            $this->buttonDisabled = true;
         }else
         $this->buttonDisabled = false;
    }

    public function newFeePayment()
    {
        $this->validate([
            'amount_collected'    => 'required',
            'transaction_date'    => 'required'
        ],
        ['amount_collected.required' => 'Please enter amount',
         'transaction_date.required' => 'Please enter transaction date']
    );
        //TODO: Make a service class for this query - query is in feepayment component
        $payment =FeePayment::create([
             'student_id'          => $this->student_id,
             'transaction_date'    => $this->transaction_date,
             'amount'              => $this->amount_collected,
             'payment_mode'        => 'Cash',
             'user_id'             => auth()->user()->id
        ]);
        return \Redirect::route('view.receipt', $payment->id);
    }
}
