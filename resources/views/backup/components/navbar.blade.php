<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}" style="text-decoration: underline; text-decoration-style:wavy; text-decoration-color:#e8505b">Excelyssa</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('all_company') }}">Perusahaan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Log</a>
        </li>
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item me-4">
          <a class="nav-link" aria-current="page" href="#">{{ auth()->user()->name }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link bg-danger shadow-danger text-light rounded" aria-current="page" href="{{ route('logout') }}">Keluar</a>
        </li>
      </ul>
    </div>
  </div>
</nav>