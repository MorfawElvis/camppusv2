  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <div class="alert alert-{{ $msg }} alert-dismissible fade show">
       <strong>{{ Session::get('alert-' .$msg) }}</strong>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  @endforeach