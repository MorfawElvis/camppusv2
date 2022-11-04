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
        .table thead tr th,.table tbody tr td, .table tr th{
            border-width: 1px !important;
            border-style: solid !important;
            border-color: black !important;
            font-size: 22px;
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
            SCHOOL FEE STATEMENT<br>
            <h5>ACADEMIC YEAR: {{ $data->class_room->academic_year->year_name ?? '' }}</h5>
        </div>
        </h2>
      </div>
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-8 invoice-col">
        <address>
          <h4>Student's Name: <strong>{{ $data->full_name }}</strong><br>
          Section: {{ $data->class_room->section->section_name }}<br>
          Class: {{ $data->class_room->class_name }}<br>
          Admission No: {{ $data->matriculation }}
        </h4>
        </address>
      </div>
      <div class="col-sm-4 invoice-col">
        {{-- <h4><b>Receipt No: {{ $data->receipt_number }} </b><br> --}}
      </h4>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-bordered" style="border-width:4px !important;">
          <thead>
          <tr>
            <th class="text-right">S/N</th>
            <th class="text-right">Transaction Date</th>
            <th class="text-right">Amount Paid</th>
          </tr>
          </thead>
          <tbody>
            @forelse ( $data->payments as $payment )
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $payment->transaction_date }}</td>
              <td>{{ number_format($payment->amount) . '  XAF'}}</td>
            </tr>
            @empty
              <tr>
                <td colspan="3" class="text-center">No payment history available for this student</td>
              </tr>
            @endforelse
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
        <p class="lead"><h5>Summary</h5></p>

        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <th style="width:50%">Total Payable Fee</th>
              <td style="font-weight: 600;">{{ number_format($data->class_room->payable_fee) . '  XAF'}}</td>
            </tr>
             <tr>
                <th>Total Paid</th>
                <td tyle="font-weight: 400;">{{ number_format($data->payments_sum_amount) . '  XAF'}}</td>
              </tr>
            <tr>
              <th>Balanced Owed:</th>
              <td>{{ number_format($data->class_room->payable_fee - $data->payments_sum_amount ) . '  XAF' }}</td>
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
        window.location.href = '/view-payments'
    };
  });
</script>
</body>
</html>