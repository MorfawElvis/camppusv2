<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\FeePayment;
use App\Models\Student;

class FinanceController extends Controller
{
    public function printReceipt(int $payment_id)
    {
        $data = $this->get_payment_detail_per_student($payment_id);

        return view('prints.receipt', compact('data', ));
    }

    public function viewReceipt(int $payment_id)
    {
        $data = $this->get_payment_detail_per_student($payment_id);

        return view('prints.view_receipt', compact('data'));
    }

    public function printFeeStatement(int $student_id)
    {
        $data = Student::where('id', $student_id)
            ->with(['class_room.section', 'payments', 'class_room.academic_year', 'scholarship.scholarship_category', 'extra_fees'])
            ->withSum('payments', 'amount')
            ->first();

        return view('prints.fee_statement', compact('data'));
    }

    public function printBulkFeeStatement($class_id)
    {
        $data = $this->get_class_fee_payment($class_id);

        return view('prints.bulk_fee_statement', compact('data'));
    }

    public function classFeeSummary($class_id)
    {
        $selected_class = ClassRoom::where('id', $class_id)->first();
        $data = $this->get_class_fee_payment($class_id);

        return view('prints.class_fee_summary', compact( 'data', 'selected_class'));
    }

    public function get_payment_detail_per_student($payment_id)
    {
        return FeePayment::where('id', $payment_id)
            ->with('student.class_room.section', 'student.payments', 'student.class_room.academic_year')
            ->first();
    }

    private function get_class_fee_payment(int $class_id)
    {
        return Student::where('class_room_id', $class_id)
            ->with(['class_room.section', 'payments', 'class_room.academic_year'])
            ->withSum('payments', 'amount')
            ->orderBy('full_name', 'asc')
            ->get();
    }

    public function printFeeReport($from, $to)
    {
        $date_from = $from;
        $date_to = $to;
        $fee_payments = FeePayment::with('student.class_room.section')
            ->whereBetween('transaction_date', [$date_from, $date_to])
            ->orderBy(Student::select('full_name')->whereColumn('students.id', 'fee_payments.student_id'))
            ->get();

        return view('reports.fees.printable-fee-report', compact('fee_payments', 'date_from', 'date_to'));
    }
}
