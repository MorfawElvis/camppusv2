@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ get_total_students() }}</h3>

                            <p>Students</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <a href="{{ route('admin.student-registration.create') }}" class="small-box-footer">Manage students <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Staff</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <a href="#" class="small-box-footer">Manage staff <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ get_total_subjects() }}</h3>

                            <p>Subjects</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <a href="{{ route('admin.manage.subjects') }}" class="small-box-footer">Manage subjects <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ get_total_classes() }}</h3>

                            <p>Classes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chalkboard"></i>
                        </div>
                        <a href="{{ route('admin.manage.classes') }}" class="small-box-footer">Manage classes<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
           <div class="row mt-2">
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-bill-wave"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Expected Fees</span>
                            <span class="info-box-number">
{{--                                {{ total_fees_expected() . ' XAF' }}--}}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
               <div class="col-lg-3 col-6">
                   <div class="info-box">
                       <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check"></i></span>

                       <div class="info-box-content">
                           <span class="info-box-text">Fees Collected Today</span>
{{--                           <span class="info-box-number">{{ get_total_fees_paid_today() .' XAF' }}</span>--}}
                   </div>
                       <!-- /.info-box-content -->
                   </div>
               </div>
               <div class="col-lg-3 col-6">
                   <div class="info-box">
                       <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hand-holding-usd"></i></span>

                       <div class="info-box-content">
                           <span class="info-box-text">Total Fees Collected</span>
{{--                           <span class="info-box-number"> {{ get_total_fees_paid() .' XAF' }}</span>--}}
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </div>
               <div class="col-lg-3 col-6">
                   <div class="info-box">
                       <span class="info-box-icon bg-info elevation-1"><i class="fas fa-coins"></i></span>

                       <div class="info-box-content">
                           <span class="info-box-text">Total Monthly Payroll</span>
                           <span class="info-box-number">
                  0
                  <small>FCFA</small>
                </span>
                       </div>
                       <!-- /.info-box-content -->
                   </div>
               </div>
           </div>
          {{--Charts--}}
           <div class="row mt-5">
               <div class="col-sm-9">
                   <div class="card">
                       <div class="card-header bg-primary">
                           <h3 class="card-title">Enrollment Analyses</h3>
                           <div class="card-tools">
                               <button type="button" class="btn btn-tool text-white" data-card-widget="collapse"><i class="fas fa-minus"></i>
                               </button>
                               <button type="button" class="btn btn-tool text-white" data-card-widget="remove"><i class="fas fa-times"></i></button>
                           </div>
                       </div>
                       <div class="card-body">
                        {!! $enrollment_chart->container() !!}
                       </div>
                       <!-- /.card-body -->
                   </div>
               </div>
               <div class="col-sm-3">
                   <div class="card card-secondary card-outline">
                       <div class="card-header">
                           <h3 class="card-title">
                               <i class="far fa-chart-bar"></i>
                               Gender Analyses
                           </h3>
                           <div class="card-tools">
                               <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                               </button>
                               <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                               </button>
                           </div>
                       </div>
                       <div class="card-body">
                        {!! $gender_chart->container() !!}
                       </div>
                       <!-- /.card-body-->
                   </div>
               </div>
           </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
@push('page-scripts')
{!! $enrollment_chart->script() !!}
{!! $gender_chart->script() !!}
@endpush
