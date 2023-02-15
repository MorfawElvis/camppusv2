<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }} - 'Receipt'</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .center {
        margin: auto;
        width: 80%;
        text-align: center;
        border: 3px solid black;
        padding: 10px;
        }
    .header{
        margin: auto;
        text-align: center;
        padding: 5px;
      }
        @media print{
            @page {size: landscape}
            body {
              font: Georgia, "Times New Roman", Times, serif;
              font-size: 11pt;
            }
        .table thead tr th,.table tbody tr td, .table tr th{
            border-width: 1px !important;
            border-style: solid !important;
            border-color: black !important;
            -webkit-print-color-adjust:exact ;
        }
        .table tr td{
            text-align: left;
        }
    }
  </style>
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row mb-4">
      <div class="col-12">
        <h2 class="page-header">
            <div class="header">
              <div class="d-flex d-inline-flex header">
                <img class="me-3" src="{{ asset('images/sabibi.JPG') }}" style="width:100px; height:100px;">
                <h5><span class="fw-bold">SABIBI COMPREHENSIVE COLLEGE - TIKO</span></br>
                    P.O Box 289</br>
                    Telephone: (237) 6 73 36 77 68
                    <hr>
                </h5>
                <img class="ms-3" src="{{ asset('images/sabibi.JPG') }}" style="width:100px; height:100px;">
            </div> 
            </div>
            <div class="row">
                <div class="col-md-4 fs-5 text-center">Fee Collected: <span class="fw-bold">
                  @if ($date_from === $date_to)
                      {{ \Carbon\Carbon::parse($date_to)->format('d M Y') }}
                  @else
                  {{ \Carbon\Carbon::parse($date_from)->format('d M Y') }} - {{ \Carbon\Carbon::parse($date_to)->format('d M Y') }}
                  @endif
                </span></div>
                <div class="col-md-4 fs-5 text-center">{{ current_school_year()->year_name }} Academic Year</div>
            </div>
        </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-bordered" style="border-width:4px !important;">
          <thead>
          <tr>
            <th>S/N</th>
            <th>Student's Name</th>
            <th>Class</th>
            <th>Section</th>
            <th class="text-center">Transaction Date</th> 
            <th class="text-center">Amount Paid</th>
          </tr>
          </thead>
          <tbody>
            @php
              $total = 0;
            @endphp
           @foreach ($fee_payments as $fee_payment)
              <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $fee_payment->student->full_name ?? 'Student deleted or Dismissed' }}</td>
                <td>{{ $fee_payment->student->class_room->class_name ?? '' }}</td>
                <td>{{ $fee_payment->student->class_room->section->section_name ?? '' }}</td>
                <td class="text-center">{{ $fee_payment->transaction_date }}</td>
                <td class="text-center">{{ number_format($fee_payment->amount) . ' XAF'}}</td>
              </tr>
              @php
                $total += $fee_payment->amount
              @endphp
           @endforeach
                <tr>
                  <td class="text-center fw-bold" colspan="5">Total Collected</td>
                  <td class="text-center fw-bold">{{ number_format($total) . ' XAF'}}</td>
                </tr> 
          </tbody>
        </table>
      </div>
    </div>
  </section>
  </div>
<script type="text/javascript"> 
  window.addEventListener("load", function(){
    window.print();
    window.onafterprint = function(event) {
        window.location.href = '/fee-report'
    };
  });
</script>
</body>
</html>