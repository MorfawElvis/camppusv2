<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SABIBI | SCHOOL MANAGEMENT SYSTEMS</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
        }
        .navbar-toggler{
            display: none;
        }   
    </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="../../index3.html" class="navbar-brand">
                <img src="{{ asset('images/sabibi.JPG') }}" alt="Sabibi Logo" 
                     style="opacity: 1; width: 60px; height: 60px;">
                <span class="text-white">SABIBI COMPREHENSIVE COLLEGE - TIKO</span>
            </a>
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                      <div class="float-right text-bold">
                          @php
                              $date = date('d/m/Y h:i:s a', time());
                              echo $date;
                          @endphp
                      </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="content">
            <div class="container">
                <div class="row p-5 m-5">
                    <div class="col-sm-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <span class="fs-2">ADMIN</span>

                                <p>Manage Academics / Discipline </p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-graduate text-white"></i>
                            </div>
                            <a href="https://sabibi.camppus.cc" class="small-box-footer">Click to login  <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <span class="fs-2">BURSARY</span>

                                <p>Manage Finances / School Fees</p>
                            </div>
                            <div class="icon">
                                <i class="fas  fa-money-check-alt text-dark"></i>
                            </div>
                            <a href="{{ route('login') }}" class="small-box-footer">Click to login <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
           <i> Improving the capacity of schools, through IT</i>
        </div>
        <strong>Copyright &copy; @php
                   echo date('Y');
                @endphp <a href="https://ezylinx.com/">Ezylinx Technologies</a>.</strong> All rights reserved.
    </footer>
</div>
</body>
</html>
