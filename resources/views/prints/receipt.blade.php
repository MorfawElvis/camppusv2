<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Receipt-{{ $data->receipt_number }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
      * {
          margin: 0;
          padding: 1px;
          box-sizing: border-box;
      }
      @page {
          size: 8.5cm 5.5cm;  /* width height */
      }
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
         .table thead tr th,.table tbody tr td, .table tr th{
            border-width: 1px !important;
            border-style: solid !important;
            border-color: black !important;
            font-size: 28px;
            -webkit-print-color-adjust:exact ;
        }
        .table tr td{
            text-align: right;
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
                <img class="me-4" src="{{ asset('images/sabibi.JPG') }}" style="width:100px; height:100px;">
                <h2><span class="fw-bold">SABIBI COMPREHENSIVE COLLEGE - TIKO</span></br>
                    P.O Box 289</br>
                    Telephone: (237) 6 73 36 77 68
                </h2>
                <img class="me-4" src="{{ asset('images/sabibi.JPG') }}" style="width:100px; height:100px;">
            </div>
            </div>
          <div class="center my-4">
            SCHOOL FEE RECEIPT<br>
            <h5>ACADEMIC YEAR: {{ $data->student->class_room->academic_year->year_name ?? '' }}</h5>
        </div>
        </h2>
      </div>
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-8 invoice-col">
        <address>
          <h4>Student's Name: <strong>{{ $data->student->full_name }}</strong><br>
          Section: {{ $data->student->class_room->section->section_name }}<br>
          Class: {{ $data->student->class_room->class_name }}<br>
          Admission No: {{ $data->student->matriculation }}
        </h4>
        </address>
      </div>
      <div class="col-sm-4 invoice-col">
        <h4><b>Receipt No: {{ $data->receipt_number }} </b><br></h4>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-bordered" style="border-width:4px !important;">
          <thead>
          <tr>
            <th>S/N</th>
            <th>Amount Paid</th>
            <th>Transaction Date</th>
          </tr>
          </thead>
          <tbody>
            <tr>
                <td>1</td>
                <td>{{ number_format($data->amount) . '  XAF'}}</td>
                <td>{{ $data->transaction_date }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        {{-- <h5><p class="lead">Payment Method:<strong> Cash</strong></p></h5> --}}
        <p class="text-muted well well-sm shadow-none" style="margin-top: 60px;">
            <strong><h5>Signature / Stamp of Bursar:</h5></strong><br><br><br><br>
            ..........................................................................................
          </p>
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead"><h5>Payment Summary</h5></p>

        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <th style="width:50%">Total Payable Fee</th>
                <td style="font-weight: 600;">{{ number_format($data->student->class_room->feeItems->sum('amount') + $data->student->extra_fees->sum('pivot.amount')) . '  XAF'}}</td>
            </tr>
            @php
                $total_paid = 0;
            @endphp
            @foreach ($data->student->payments as $payment)
              @php
                  $total_paid += $payment->amount
              @endphp
            @endforeach
            <tr>
              <th>Total Amount Paid</th>
              <td>{{ number_format($total_paid) . '  XAF' }}</td>
            </tr>
            <tr>
              @php
              $discount = 0;
              @endphp
              <th>Discount/Scholarship</th>
              @if ($data->student->scholarship->scholarship_category->discount ?? '')
                  @php
                    $discount = ($data->student->class_room->feeItems->sum('amount') + $data->student->extra_fees->sum('pivot.amount'))
                                * ($data->student->scholarship->scholarship_category->discount / 100);
                  @endphp
                  <td>{{ number_format($discount) . '  XAF' }}</td>
                  @else
                  <td>{{ '0' }}</td>
              @endif
            </tr>
            <tr>
              <th>Balanced Owed:</th>
                <td>{{ number_format(($data->student->class_room->feeItems->sum('amount') + $data->student->extra_fees->sum('pivot.amount')) - ($total_paid + $discount) ) . '  XAF' }}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <h4>***************************************************************************************************************************</h4>
    <!-- title row -->
    <div class="row mb-4">
      <div class="col-12">
        <h2 class="page-header">
            <div class="header">
              <div class="d-flex d-inline-flex header">
                <img class="me-4" src="{{ asset('images/sabibi.JPG') }}" style="width:100px; height:100px;">
                <h2><span class="fw-bold">SABIBI COMPREHENSIVE COLLEGE - TIKO</span></br>
                    P.O Box 289</br>
                    Telephone: (237) 6 73 36 77 68
                </h2>
                <img class="me-4" src="{{ asset('images/sabibi.JPG') }}" style="width:100px; height:100px;">
            </div>
            </div>
          <div class="center my-4">
            SCHOOL FEE RECEIPT<br>
            <h5>ACADEMIC YEAR: {{ $data->student->class_room->academic_year->year_name ?? '' }}</h5>
        </div>
        </h2>
      </div>
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-8 invoice-col">
        <address>
          <h4>Student's Name: <strong>{{ $data->student->full_name }}</strong><br>
          Section: {{ $data->student->class_room->section->section_name }}<br>
          Class: {{ $data->student->class_room->class_name }}<br>
          Admission No: {{ $data->student->matriculation }}
        </h4>
        </address>
      </div>
      <div class="col-sm-4 invoice-col">
        <h4><b>Receipt No: {{ $data->receipt_number }} </b><br></h4>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-bordered" style="border-width:4px !important;">
          <thead>
          <tr>
            <th>S/N</th>
            <th>Amount Paid</th>
            <th>Transaction Date</th>
          </tr>
          </thead>
          <tbody>
            <tr>
                <td>1</td>
                <td>{{ number_format($data->amount) . '  XAF'}}</td>
                <td>{{ $data->transaction_date }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        {{-- <h5><p class="lead">Payment Method:<strong> Cash</strong></p></h5> --}}
        <p class="text-muted well well-sm shadow-none" style="margin-top: 60px;">
            <strong><h5>Signature / Stamp of Bursar:</h5></strong><br><br><br><br>
            ..........................................................................................
          </p>
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead"><h5>Payment Summary</h5></p>

          <div class="table-responsive">
              <table class="table table-bordered">
                  <tr>
                      <th style="width:50%">Total Payable Fee</th>
                      <td style="font-weight: 600;">{{ number_format($data->student->class_room->feeItems->sum('amount') + $data->student->extra_fees->sum('pivot.amount')) . '  XAF'}}</td>
                  </tr>
                  @php
                      $total_paid = 0;
                  @endphp
                  @foreach ($data->student->payments as $payment)
                      @php
                          $total_paid += $payment->amount
                      @endphp
                  @endforeach
                  <tr>
                      <th>Total Amount Paid</th>
                      <td>{{ number_format($total_paid) . '  XAF' }}</td>
                  </tr>
                  <tr>
                      @php
                          $discount = 0;
                      @endphp
                      <th>Discount/Scholarship</th>
                      @if ($data->student->scholarship->scholarship_category->discount ?? '')
                          @php
                              $discount = ($data->student->class_room->feeItems->sum('amount') + $data->student->extra_fees->sum('pivot.amount'))
                                          * ($data->student->scholarship->scholarship_category->discount / 100);
                          @endphp
                          <td>{{ number_format($discount) . '  XAF' }}</td>
                      @else
                          <td>{{ '0' }}</td>
                      @endif
                  </tr>
                  <tr>
                      <th>Balanced Owed:</th>
                      <td>{{ number_format(($data->student->class_room->feeItems->sum('amount') + $data->student->extra_fees->sum('pivot.amount')) - ($total_paid + $discount) ) . '  XAF' }}</td>
                  </tr>
              </table>
          </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
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
