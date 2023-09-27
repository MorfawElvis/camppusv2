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
{{--          Admission No: {{ $data->matriculation }}--}}
        </h4>
        </address>
      </div>
      <div class="col-sm-4 invoice-col">
        <h4><b>Printed:</b> {{ date("d/m/Y") }} <br></h4>
{{--        <h4><b>Dormitory: {{ $data->is_boarding ? 'YES' : 'NO' }} </b></h4>--}}
      </div>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <h5 class="fw-bolder fs-4">Fee Items</h5>
            <table class="table table-bordered" style="border-width:4px !important;">
                <thead>
                <tr>
                    <th class="text-left">Fee Item</th>
                    <th class="text-right">Amount</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalClassFee = 0;
                    $totalExtraFee = 0;
                @endphp
                @foreach( $data->class_room->feeItems as $feeItem )
                    <tr>
                        <td class="text-left">{{ $feeItem->name }}</td>
                        <td>{{ number_format($feeItem->amount)}}</td>
                    </tr>
                    @php
                        $totalClassFee += $feeItem->amount
                    @endphp
                @endforeach
                @foreach($data->extra_fees as $extraFee)
                    <tr>
                        <td class="text-left">{{ $extraFee->name }}</td>
                        <td>{{ number_format($extraFee->pivot->amount) }}</td>
                    </tr>
                    @php
                        $totalExtraFee += $extraFee->pivot->amount
                    @endphp
                @endforeach
                </tbody>
                <tr>
                    <th class="text-center">Total Payable Fee</th>
                    <th class="text-right">{{ number_format($totalExtraFee + $totalClassFee) }}</th>
                </tr>
            </table>
        </div>
      <div class="col-12 table-responsive">
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
        <h5 class="font-weight-bolder fs-4">Payment Summary</h5>
        <div class="table-responsive">
          <table class="table table-bordered">
             <tr>
                <th>Total Amount Paid</th>
                <td tyle="font-weight: 400;">{{ number_format($data->payments_sum_amount) . '  XAF'}}</td>
             </tr>
             <tr>
              @php
                $discount = 0;
              @endphp
              <th>Discount/Scholarship</th>
                @if ($data->scholarship->scholarship_category->discount ?? '')
                  @php
                    $discount = $data->class_room->payable_fee * ($data->scholarship->scholarship_category->discount / 100);
                  @endphp
                  <td>{{ number_format($discount) . '  XAF' }}</td>
                  @else
                  <td>{{ '0' }}</td>
                @endif
             </tr>
            <tr>
              <th>Balanced Owed:</th>
                  <td>{{ number_format(($totalClassFee + $totalExtraFee) - $data->payments_sum_amount) . '  XAF' }}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
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
