<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\FeePayment;
use App\Models\Student;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function printReceipt(int $payment_id)
    {
        $data = $this->get_payment_detail_per_student($payment_id);
        return view('prints.receipt', compact('data'));
    }

    public function viewReceipt(int $payment_id)
    {
        $data = $this->get_payment_detail_per_student($payment_id);
        return view('prints.view_receipt', compact('data'));
    }

    public function printFeeStatement(int $student_id)
    {
         $data = Student::where('id', $student_id)
                         ->with(['class_room.section','payments','class_room.academic_year'])
                         ->withSum('payments', 'amount')
                         ->first();
        return view('prints.fee_statement', compact('data'));
    }

    public function get_payment_detail_per_student($payment_id)
    {
        return FeePayment::where('id', $payment_id)
                            ->with('student.class_room.section', 'student.payments', 'student.class_room.academic_year')
                            ->first();
    }
}
