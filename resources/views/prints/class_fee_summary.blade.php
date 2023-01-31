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
        .table thead tr th,.table tbody tr td, .table tr th{
            border-width: 1px !important;
            border-style: solid !important;
            border-color: black !important;
            font-size: 18px;
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
                <img class="me-4" src="{{ asset('images/sabibi.JPG') }}" style="width:100px; height:100px;">
                <h2><span class="fw-bold">SABIBI COMPREHENSIVE COLLEGE - TIKO</span></br>
                    P.O Box 289</br>
                    Telephone: (237) 6 73 36 77 68
                    <hr>
                </h2>
                <img class="me-4" src="{{ asset('images/sabibi.JPG') }}" style="width:100px; height:100px;">
            </div> 
            </div>
            <div class="row">
                <div class="col-md-4 fs-4 text-center">Fee Statement <span class="font-italic">For</span> <span class="fw-bold">{{ $selected_class->class_name }}</span></div>
                <div class="col-md-4 fs-4 text-center">{{ current_school_year()->year_name }} Academic Year</div>
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
            <th>Name</th>
            <th>Total Payable</th>
            <th>Total Paid</th>
            <th>Balance Owed</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($data as $student )
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $student->full_name }}</td>
                <span class="text-right">
                    @if ($student->is_boarding)
                    <td style="font-weight: 600;">{{ number_format($student->class_room->payable_fee + $get_boarding_fee->boarding_fee)}}</td>
                    @else
                    <td style="font-weight: 600;">{{ number_format($student->class_room->payable_fee)}}</td>
                    @endif
                    <td>{{ $student->payments_sum_amount }}</td>
                    @if ($student->is_boarding)
                    <td>{{ number_format(($student->class_room->payable_fee + $get_boarding_fee->boarding_fee) - $student->payments_sum_amount )}}</td>
                    @else
                    <td>{{ number_format($student->class_room->payable_fee - $student->payments_sum_amount )}}</td>
                    @endif
                </span>
            </tr>
            @endforeach
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
        window.location.href = '/view-payments'
    };
  });
</script>
</body>
</html>