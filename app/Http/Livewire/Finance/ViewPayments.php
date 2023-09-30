<?php

namespace App\Http\Livewire\Finance;

use App\Models\ClassRoom;
use App\Models\FeePayment;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ViewPayments extends Component
{
    use WithPagination;

    public $search;

    public $student_id;

    public $balance_owed;

    public $amount_collected;

    public $transaction_date;

    public $class_id;

    public $perPage = 10;

    public $buttonDisabled = false;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $classRoom = new ClassRoom();
        $class_fees = $classRoom->classFees();

        $student_fees = Student::classrooms(current_school_year()->id, $this->class_id)
            ->search($this->search)->paginate($this->perPage);

        return view('livewire.finance.view-payments', compact('student_fees', 'class_fees'));
    }

    public function showFeePaymentModal($student_id, $current_page)
    {
        //TODO: Make a service class to query balance owed by a student - same query in feepayment component
        $this->reset();
        $this->gotoPage($current_page);
        $this->student_id = $student_id;
        $student = Student::where('id', $student_id)
            ->with('class_room', 'scholarship', 'extra_fees')
            ->withSum('payments', 'amount')
            ->first();
        if (isset($student->scholarship->scholarship_category->discount)) {
            $discount = $student->scholarship->scholarship_category->discount;
        }
        $payable_fee = $student->class_room->feeItems->sum('amount') + $student->extra_fees->sum('pivot.amount');
        $amount_paid = $student->payments_sum_amount;

        $this->balance_owed = $payable_fee - ($amount_paid + ($discount ?? 0));

        $this->dispatchBrowserEvent('showFeePaymentModal');

    }

    public function updatedAmountCollected()
    {
        $amount_collected = str_replace(',', '', $this->amount_collected);
        if ($amount_collected > $this->balance_owed) {
            $this->buttonDisabled = true;
        } else {
            $this->buttonDisabled = false;
        }
    }

    public function updatingClassId()
    {
        $this->gotoPage(1);
    }

    public function newFeePayment()
    {
        $this->validate([
            'amount_collected' => 'required',
            'transaction_date' => 'required',
        ],
            ['amount_collected.required' => 'Please enter amount',
                'transaction_date.required' => 'Please enter transaction date']
        );
        //TODO: Make a service class for this query - query is in feepayment component
        $payment = FeePayment::create([
            'student_id' => $this->student_id,
            'transaction_date' => $this->transaction_date,
            'amount' => $this->amount_collected,
            'payment_mode' => 'Cash',
            'user_id' => auth()->user()->id,
            'school_year_id' => current_school_year()->id
        ]);

        return \Redirect::route('view.receipt', $payment->id);
    }
}
