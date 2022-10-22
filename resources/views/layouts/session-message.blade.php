<!-- session message -->
@if (Session::has('success') || Session::has('error') || Session::has('warning'))
<div class="alert alert-dismissible fade show @if (Session::has('success')) alert-success @elseif(Session::has('error')) alert-danger @else alert-warning @endif">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @if (Session::has('success'))
    <h5><i class="icon fa fa-check"></i>{!! Session::get('success') !!} </h5>
    @elseif(Session::has('error'))
    <h5><i class="icon fa fa-ban"></i>{!! Session::get('error') !!} </h5>
    @else
    <h5><i class="icon fa fa-warning"></i>{!!  Session::get('warning') !!} </h5>
    @endif
    </h5>
</div>
@endif
<!-- /.session message -->
