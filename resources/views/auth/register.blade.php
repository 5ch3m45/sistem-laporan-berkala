@extends('components.layout')

@section('title', 'Perusahaan')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-16 d-flex align-items-center" style="min-height: 100vh;">
      <img src="/images/undraw_Airport_re_oqk1.svg" style="width: 80%" alt="">
    </div>
    <div class="col-md-8 d-flex align-items-center" style="min-height: 100vh;">
      <div>
        @if (\Session::has('success_register'))
        <div class="alert alert-success shadow-success mb-4" role="alert">
          <p class="mb-0">Registrasi berhasil. Silahkan <a href='/masuk'>masuk</a>.</p>
        </div>
        @endif
        @if (\Session::has('failed_register'))
        <div class="alert alert-danger shadow-danger mb-4" role="alert">
          <p class="mb-0">Registrasi gagal. Internal server error. Silahkan hubungi admin.</p>
        </div>
        @endif
        <div class="card border-0 shadow-secondary mb-4 w-100">
          <div class="card-body">
            <h2>Buat akun</h2>
            <p>Masukkan informasi berikut secara lengkap untuk mendaftar</p>
            <hr>
            <form action="" method="post">
              @csrf
              <div class="mb-3">
                <label for="inputName" class="form-label">Nama</label>
                <input type="text" name="name" id="inputName" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror">
                  <button id="SeePass" type="button" class="input-group-text"><i class="bi bi-eye"></i></button>
                </div>
                @error('password')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <hr>
              <div class="d-flex justify-content-end">
                <input type="submit" value="Masuk" class="btn btn-primary shadow-primary text-light">
              </div>
            </form>
          </div>
        </div>
        <p class="text-center mb-0">Sudah memiliki akun? <a href="/masuk">Masuk</a></p>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script>  
    let seePassBtn = $('#SeePass')
    let passField = $('input[name=password]')
    let passSeen = false
    seePassBtn.on('click', function() {
      passSeen ? passField.attr('type', 'password') : passField.attr('type', 'text')
      passSeen = !passSeen
      seePassBtn.toggleClass('bg-danger text-light')
    })
  </script>
@endsection