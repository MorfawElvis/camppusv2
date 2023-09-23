<div class="sidebar-mini">
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Camppus Logo -->
        <a href="" class="brand-link text-decoration-none text-start text-wrap">
            <img src="{{ asset('images/sabibi.JPG') }}" alt="Camppus Logo" class="brand-image img-circle elevation-3">
            <!--<img src="{{ asset('storage/logo/camppus-logo-transparent.png') }}" alt="Camppus Logo" class="brand-image img-circle elevation-3">-->
            @if($general_setting->school_name ?? '')
                <span class="fs-6">{{ $general_setting->school_name}}</span>
            @else
                <span class="fs-6">Camppus V2</span>
            @endif
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <!--<div class="image">-->
                <!--    <img src="{{asset('storage/images/user-male.svg')}}" class="img-circle elevation-2" alt="User Image">-->
                <!--</div>-->
                <div class="info">
                    @auth
                        <a href="#" class="d-block text-decoration-none">{{\Illuminate\Support\Facades\Auth::user()->user_code}}</a>
                    @endauth
                </div>
            </div>
            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <div id="sidebar-menu">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                            <a href="{{route('dashboard')}}" class="nav-link">
                                <span class="material-icons text-orange">dashboard</span>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <div class="first-level-menu my-1">
                            <li class="nav-item mt-2">
                                <a href="#" class="nav-link">
                            <span style="font-size: 16px; color:rgb(71, 212, 255);">
                            <i class="nav-icon fas fa-cogs"></i>
                            </span>
                                    <p>
                                        MANAGE STUDENTS
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item nav-item-submenu {{ request()->is('student-registration/create') ? 'active' : '' }} ">
                                        <a href="{{ route('admin.student-registration.create') }}" class="nav-link">
                                            <span class="orange"></span>
                                            <i class="fas fa-user-graduate"></i>
                                            <p>Register Student</p>
                                        </a>
                                    </li>
                                    <li class="nav-item nav-item-submenu {{ request()->is('student-list') ? 'active' : '' }} ">
                                        <a href="{{ route('admin.student.list') }}" class="nav-link">
                                            <span class="orange"></span>
                                            <i class="fas fa-user-graduate"></i>
                                            <p>View Students</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav nav-item">
                                <a href="#" class="nav-link">
                                <span style="font-size: 16px; color:rgb(255, 191, 71);">
                                <i class="nav-icon fas fa-cogs"></i>
                                </span>
                                    <p>
                                        MANAGE STAFF
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item nav-item-submenu {{ request()->is('staff-registration/create') ? 'active' : '' }}">
                                        <a href="{{ route('admin.staff-registration.create') }}" class="nav-link">
                                            <i class="fas fa-user-tie"></i>
                                            <p>Register Staff</p>
                                        </a>
                                    </li>
                                    <li class="nav-item nav-item-submenu {{ request()->is('staff-list') ? 'active' : '' }}">
                                        <a href="{{ route('admin.staff.list') }}" class="nav-link">
                                            <i class="fas fa-user-tie"></i>
                                            <p>View Staff List</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <span style="font-size: 16px; color:deeppink;">
                            <i class="nav-icon fas fa-list-alt"></i>
                            </span>
                                <p>
                                    FEE ITEMS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item nav-item-submenu {{ request()->is('manage-fee-items') ? 'active' : '' }}">
                                    <a href="{{ route('manage-fee-items') }}" class="nav-link">
                                        <span class="orange"></span>
                                        <i class="fas fa-coins"></i>
                                        <p>Class Fee Items</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('manage-student-fee-items') ? 'active' : '' }}">
                                    <a href="{{ route('manage-student-fee-items') }}" class="nav-link">
                                        <span class="orange"></span>
                                        <i class="fas fa-coins"></i>
                                        <p>Student Fee Items</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <span style="font-size: 16px; color:deepskyblue;">
                            <i class="nav-icon fas fa-money-check-alt"></i>
                            </span>
                                <p>
                                    FEE PAYMENT
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item nav-item-submenu {{ request()->is('manage-fee-payments') ? 'active' : '' }}">
                                    <a href="{{ route('fee_payments.manage') }}" class="nav-link">
                                        <i class="fas fa-hand-holding-usd"></i>
                                        <p>Collect Payment</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('view-payments') ? 'active' : '' }}">
                                    <a href="{{ route('view.payments') }}" class="nav-link">
                                        <i class="fas fa-receipt"></i>
                                        <p>View Payments/Invoices</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('fee-report') ? 'active' : '' }}">
                                    <a href="{{ route('fee.report') }}" class="nav-link">
                                        <i class="fas fa-file"></i>
                                        <p>Fee Reports</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item nav-item-submenu {{ request()->is('extra-fees') ? 'active' : '' }}">
                                   <a href="{{ route('extra_fee.create') }}" class="nav-link">
                                       <span class="orange"></span>
                                       <i class="fas fa-coins"></i>
                                       <p>Extra Fees</p>
                                   </a>
                               </li>
                               <li class="nav-item nav-item-submenu {{ request()->is('manage-extra-fees') ? 'active' : '' }}">
                                   <a href="{{ route('extra_fee.manage') }}" class="nav-link">
                                       <span class="orange"></span>
                                       <i class="fas fa-coins"></i>
                                       <p>Manage Extra Fees</p>
                                   </a>
                               </li> --}}
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <span style="font-size: 16px; color:coral;">
                            <i class="nav-icon fas fa-wallet"></i>
                            </span>
                                <p>
                                    EXPENSES
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item nav-item-submenu {{ request()->is('expense-category') ? 'active' : '' }}">
                                    <a href="{{ route('expense.category') }}" class="nav-link">
                                        <span class="orange"></span>
                                        <i class="fas fa-book-open"></i>
                                        <p>Expense Category</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('add-expense') ? 'active' : '' }}">
                                    <a href="{{ route('add.expense') }}" class="nav-link">
                                        <i class="fas fa-comments-dollar"></i>
                                        <p>Add Expense</p>
                                    </a>
                                </li>
                                <!-- TODO: Add expense report to expense module -->
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-warehouse"></i>
                                        <p>Expense Report</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- TODO: Payroll module not done -->
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                            <span style="font-size: 16px; color:indianred;">
                            <i class="nav-icon fas fa-credit-card"></i>
                            </span>
                                <p>
                                    PAYROLL
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item nav-item-submenu {{ request()->is('payroll-configurations') ? 'active' : '' }}">
                                    <a href="{{ route('payroll.configurations') }}" class="nav-link">
                                        <i class="fas fa-user-edit"></i>
                                        <p>Configure Payroll</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('employee-list') ? 'active' : '' }}">
                                    <a href="{{ route('payroll.employee-list') }}" class="nav-link">
                                        <i class="fas fa-user-edit"></i>
                                        <p>Employee List</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('payroll-list') ? 'active' : '' }}">
                                    <a href="{{ route('payroll-list') }}" class="nav-link">
                                        <i class="fas fa-user-edit"></i>
                                        <p>Payroll List</p>
                                    </a>
                                </li>
{{--                                <li class="nav-item nav-item-submenu">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <span class="orange"></span>--}}
{{--                                        <i class="fas fa-calendar-check"></i>--}}
{{--                                        <p>Staff Attendance</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item nav-item-submenu">--}}
{{--                                    <a href="#" class="nav-link">--}}
{{--                                        <i class="fas fa-suitcase-rolling"></i>--}}
{{--                                        <p>Staff Leave</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                            </ul>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                            <span style="font-size: 16px; color:yellowgreen;">
                            <i class="nav-icon fas fa-file-contract"></i>
                            </span>
                                <p>
                                    Academic Reports
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">
                                        <span class="orange"></span>
                                        <i class="fas fa-file-signature"></i>
                                        <p>Generate Reports</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-cog"></i>
                                        <p>Report Settings</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <span style="font-size: 16px; color:cyan;">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            </span>
                                <p>
                                    SCHOLARSHIPS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item nav-item-submenu {{ request()->is('create-scholarships') ? 'active' : '' }}">
                                    <a href="{{ route('create.scholarships') }}" class="nav-link">
                                        <span class="orange"></span>
                                        <i class="fas fa-cog"></i>
                                        <p>Create Scholarships</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('manage-scholarships') ? 'active' : '' }}">
                                    <a href="{{ route('manage.scholarships') }}" class="nav-link">
                                        <i class="fas fa-file-signature"></i>
                                        <p>Manage Scholarships</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-receipt"></i>
                                        <p>Reports</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        <!-- TODO: Facilities module not done -->
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                            <span style="font-size: 16px; color:violet;">
                            <i class="nav-icon fas fa-bus-alt"></i>
                            </span>
                                <p>
                                    Facilities
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">
                                        <span class="orange"></span>
                                        <i class="fas fa-coins"></i>
                                        <p>Manage Dormitory</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-building"></i>
                                        <p>Bus Transport</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-book-reader"></i>
                                        <p>Manage Library</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <span style="font-size: 16px; color:tomato;">
                            <i class="nav-icon fas fa-cogs"></i>
                            </span>
                                <p>
                                    SETTINGS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item nav-item-submenu {{ request()->is('general-settings') ? 'active' : '' }}">
                                    <a href="{{ route('admin.general.settings') }}" class="nav-link">
                                        <span class="orange"></span>
                                        <i class="fas fa-users-cog"></i>
                                        <p>General Settings</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('academic-years') ? 'active' : '' }}">
                                    <a href="{{ route('admin.academic.years') }}" class="nav-link">
                                        <i class="fas fa-calendar-check"></i>
                                        <p>Academic Years</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('academic-terms') ? 'active' : '' }}">
                                    <a href="{{ route('admin.academic.terms') }}" class="nav-link">
                                        <i class="fas fa-calendar-check"></i>
                                        <p>Academic Terms</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('manage-sections') ? 'active' : '' }}">
                                    <a href="{{ route('admin.manage.sections') }}" class="nav-link">
                                        <span class="orange"></span>
                                        <i class="fas fa-tasks"></i>
                                        <p>Sections</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('manage-levels') ? 'active' : '' }}">
                                    <a href="{{ route('admin.manage.levels') }}" class="nav-link">
                                        <i class="fas fa-tasks"></i>
                                        <p>Levels</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('manage-classes') ? 'active' : '' }}">
                                    <a href="{{ route('admin.manage.classes') }}" class="nav-link">
                                        <i class="fas fa-tasks"></i>
                                        <p>Classes</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('manage-departments') ? 'active' : '' }}">
                                    <a href="{{ route('admin.manage.departments') }}" class="nav-link">
                                        <i class="fas fa-tasks"></i>
                                        <p>Departments</p>
                                    </a>
                                </li>
                                <li class="nav-item nav-item-submenu {{ request()->is('manage-subjects') ? 'active' : '' }}">
                                    <a href="{{ route('admin.manage.subjects') }}" class="nav-link">
                                        <i class="fas fa-tasks"></i>
                                        <p>Subjects</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <span style="font-size: 16px; color:rgb(5, 145, 63);"><i class="nav-icon fas fa-folder-plus"></i></span>--}}
{{--                                <p>--}}
{{--                                    Extras--}}
{{--                                    <i class="right fas fa-angle-left"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <ul class="nav nav-treeview">--}}
{{--                                <li class="nav-item nav-item-submenu {{ request()->is('student-cards') ? 'active' : '' }}">--}}
{{--                                    <a href="{{ route('admin.student.cards') }}" class="nav-link">--}}
{{--                                        <i class="fas fa-id-card"></i>--}}
{{--                                        <p>Student Cards</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                --}}{{-- <li class="nav-item nav-item-submenu {{ request()->is('employee-cards') ? 'active' : '' }}">--}}
{{--                                    <a href="{{ route('admin.employee.cards') }}" class="nav-link">--}}
{{--                                        <i class="fas fa-id-card"></i>--}}
{{--                                        <p>Employee Cards</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                 <li class="nav-item nav-item-submenu {{ request()->is('student-category') ? 'active' : '' }} ">--}}
{{--                                    <a href="{{ route('admin.student.category') }}" class="nav-link">--}}
{{--                                        <span class="orange"></span>--}}
{{--                                        <i class="fas fa-plus-square"></i>--}}
{{--                                        <p>Student Category</p>--}}
{{--                                    </a>--}}
{{--                                 </li> --}}
{{--                            </ul>--}}
{{--                        </li>--}}
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
