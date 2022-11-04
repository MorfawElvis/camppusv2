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
        $data = FeePayment::where('id', $payment_id)
                            ->with('student.class_room.section', 'student.payments', 'student.class_room.academic_year')
                            ->first();
        return view('prints.receipt', compact('data'));
    }

    public function printFeeStatement(int $student_id)
    {
         $data = Student::where('id', $student_id)
                         ->with(['class_room.section','payments','class_room.academic_year'])
                         ->withSum('payments', 'amount')
                         ->first();
        return view('prints.fee_statement', compact('data'));
    }
}
