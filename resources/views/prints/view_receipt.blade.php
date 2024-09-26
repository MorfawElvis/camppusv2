<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .receipt { width: 60mm; margin: auto; }
        .header { text-align: center; }
        .content { margin-top: 20px; }
        .total { margin-top: 20px; text-align: right; }
    </style>
</head>
<body>
<div class="receipt">
    <div class="header">
        <img class="me-4" src="{{ asset('images/sabibi.JPG') }}" style="width:60px; height:60px;">
        <h5><span class="fw-bold">SABIBI COMPREHENSIVE COLLEGE - TIKO</span></br>
            P.O Box 289</br>
            Telephone: (237) 6 73 36 77 68
        </h5>
        <h5>
            SCHOOL FEE RECEIPT<br>
            ACADEMIC YEAR: {{ $data->student->class_room->academic_year->year_name ?? '' }}
        </h5>
    </div>
    <div class="content">
        <p>
            <strong>Student's Name:</strong> {{ $data->student->full_name }}
        </p>
        <p>
            <strong>Section:</strong> {{ $data->student->class_room->section->section_name }}
        </p>
        <p>
            <strong>Class:</strong> {{ $data->student->class_room->class_name }}
        </p>
        <p>
            <strong>Receipt No:</strong> {{ $data->receipt_number }}
        </p>
        <hr><br>
        <p><strong>Amount Paid:</strong> {{ number_format($data->amount) . '  XAF'}}</p>
        <p><strong>Transaction Date:</strong> {{ $data->transaction_date }}</p>
        <p><strong>Payment Method:</strong>CASH</p>
        <hr><br>
        <stron>Payment Summary</stron><br>
        @php
            $total_paid = 0;
        @endphp
        @foreach ($data->student->payments as $payment)
            @php
                $total_paid += $payment->amount
            @endphp
        @endforeach
        <p><strong>Total Payable Fee:</strong> {{ number_format($data->student->class_room->feeItems->sum('amount')
                                + $data->student->extra_fees->sum('pivot.amount')) . '  XAF'}}</p>
        <p><strong>Total Amount Paid:</strong> {{ number_format($total_paid) . '  XAF' }}</p>
        @php
            $discount = $data->student->scholarship->scholarship_category->discount ?? '0';
        @endphp
        <p><strong>Discount/Scholarship:</strong> {{ number_format($discount) . ' XAF' }}</p>
        <p><strong>Balanced Owed:</strong> {{ number_format(($data->student->class_room->feeItems->sum('amount')
                                + $data->student->extra_fees->sum('pivot.amount')) - ($total_paid + $discount) ) . '  XAF' }}</p><br>
    </div>
    {{--    <div class="total">--}}
    {{--        <p><strong>Thank you for your purchase!</strong></p>--}}
    {{--    </div>--}}
</div>
<script type="text/javascript">
    window.addEventListener("load", function(){
        window.print();
        window.onafterprint = function(event) {
            window.location.href = '/manage-fee-payments'
        };
    });
</script>
</body>
</html>
