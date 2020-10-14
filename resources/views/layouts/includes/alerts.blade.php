@if( session('msg'))
  @php
    $mymessage=session('msg');
    $myalert=session('alert');
  @endphp
  <div class="alert alert-{{ $myalert }} alert-dismissible fade show mt-3" role="alert">
    <strong>Alert!</strong> {{ $mymessage }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @php
    session()->forget('msg');
    @endphp
@endif  