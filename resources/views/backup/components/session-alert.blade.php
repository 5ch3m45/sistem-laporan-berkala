<div>
  @if (\Session::has('success'))
  <div class="alert alert-success mb-4" role="alert">
    {{ \Session::get('success') }}
  </div>
  @endif
  @if (\Session::has('error'))
  <div class="alert alert-danger mb-4" role="alert">
    {{ \Session::get('error') }}
  </div>
  @endif
</div>