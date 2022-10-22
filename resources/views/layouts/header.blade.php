<!-- Navbar -->
<nav class="main-header navbar navbar-expand">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item ml-3">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        {{-- Display of current school year --}}
        @if (current_school_year() ?? '')
            <li class="nav-item d-none d-sm-inline-block ml-5">
                <a  class="nav-link">Current School Year: <strong>{{ current_school_year()->year_name ?? ''}}</strong></a>
            </li>
        @else
            <li class="nav-item d-none d-sm-inline-block ml-5">
                <a href="{{ route('admin.academic.years') }}" class="nav-link"><span class="fw-bold text-warning">Current School Year:</span>  school year not set!</a>
            </li>
        @endif
        {{-- Display of current school term --}}
        @if (current_school_term() ?? '')
            <li class="nav-item d-none d-sm-inline-block ml-5">
                <a class="nav-link">Current Term: <strong>{{current_school_term()->term_name}}</strong></a>
            </li>
        @else
            <li class="nav-item d-none d-sm-inline-block ml-5">
                <a href="{{ route('admin.academic.terms') }}" class="nav-link"><span class="fw-bold text-warning">Current Term:</span>  school term not set!</a>
            </li>
        @endif
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-4">
            <button type="button" class="btn btn-primary rounded d-none d-md-block" data-bs-toggle="modal" data-bs-target="#supportModal">
                <i class="fas fa-tools h6"> Contact Support</i>
            </button>
        </li>
        <li class="nav-item ml-3">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#logout" href="#">
                <span class="h6 ml-1"><i class="fas fa-sign-out-alt"></i> Logout</span>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
{{--Logout Modal Form--}}
<div class="modal fade camppus-modal" id="logout" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <i class="fas fa-exclamation-circle fa-5x ml-3 text-warning"></i>
            </div>
            <div class="modal-body">
                <p class="text-center h2">Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-lg btn-info" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-lg btn-danger" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" href="{{route('logout')}}">Yes</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
{{--<-- /. Logout -->--}}
{{-- Support Modal--}}
<div  class="modal fade custom" tabindex="10" id="supportModal"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title border-left border-danger border-4 p-2">DO YOU NEED HELP?</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p><a href="" class="text-decoration-none"><i class="fas fa-book-open mr-3"></i>Visit our User Guide</a></p><hr>
                <p><i class="fas fa-phone mr-3"></i>Call or WhatsApp our Support Line: <strong>+237-663-9797-78</strong></p><hr>
                <p><i class="fas fa-envelope mr-3"></i>Report a Problem: <strong>support@ezylinx.com</strong></p>
            </div>
        </div>
    </div>
</div>
{{--<-- /. Support -->--}}
