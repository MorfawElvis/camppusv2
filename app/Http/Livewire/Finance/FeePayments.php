<?php

namespace App\Http\Livewire\Finance;

use App\Models\ClassRoom;
use App\Models\FeePayment;
use App\Models\Section;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class FeePayments extends Component
{
    use WithPagination,LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'deleteConfirmed',
    ];

    public $amount_collected;

    public $students;

    public $section_id;

    public $class_rooms;

    public $balance_owed;

    public $class_id;

    public $student_id;

    public $transaction_date;

    public $search;

    public $deletedPayment;

    public $buttonDisabled = 10;

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
        //TODO: Make a service class to query balance owed by a student - same query in viewpayment component
        $student = Student::where('id', $student_id)
            ->with('class_room')
            ->withSum('payments', 'amount')
            ->first();
        if (isset($student->scholarship->scholarship_category->discount)) {
            $discount = $student->scholarship->scholarship_category->discount;
        }
        if ($student->is_boarding) {
            $payable_fee = $student->class_room->payable_fee + get_boarding_fee()->boarding_fee;
        } else {
            $payable_fee = $student->class_room->payable_fee;
        }

        $amount_paid = $student->payments_sum_amount;

        $this->balance_owed = $payable_fee - ($amount_paid + ($discount ?? 0));
    }

    public function updatedAmountCollected()
    {
        if ($this->amount_collected > $this->balance_owed) {
            $this->buttonDisabled = true;
        } else {
            $this->buttonDisabled = false;
        }
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
        $payment = FeePayment::create([
            'student_id' => $this->student_id,
            'transaction_date' => $this->transaction_date,
            'amount' => $this->amount_collected,
            'payment_mode' => 'Cash',
            'user_id' => auth()->user()->id,
        ]);

        return \Redirect::route('fee.receipt', $payment->id);
    }

    public function deletePayment($payment_id)
    {
        $this->deletedPayment = $payment_id;
        $this->confirm('', [
            'onConfirmed' => 'deleteConfirmed',
        ]);
    }

    public function deleteConfirmed()
    {
        FeePayment::destroy($this->deletedPayment);
        $this->alert('success', 'Record has been deleted successfully');
    }
}
