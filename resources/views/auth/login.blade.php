@extends('components.layout')

@section('title', 'Perusahaan')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-16 d-flex align-items-center" style="min-height: 100vh;">
      <img src="/images/undraw_Online_learning_re_qw08.svg" style="width: 80%" alt="">
    </div>
    <div class="col-md-8 d-flex align-items-center" style="min-height: 100vh;">
      <div>
        @if (\Session::has('failed_login'))
        <div class="alert alert-danger shadow-danger mb-4" role="alert">
          <p class="mb-0">Masuk gagal. Internal server error. Silahkan hubungi admin.</p>
        </div>
        @endif
        <div class="card border-0 shadow-secondary mb-4">
          <div class="card-body">
            <h2>Masuk platform</h2>
            <p>Masukkan email dan password untuk masuk ke dalam platform</p>
            <hr>
            <form action="" method="post">
              @csrf
              <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror">
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
        <p class="text-center mb-0">Belum memiliki akun? <a href="/daftar">Daftar</a></p>
      </div>
    </div>
  </div>
</div>
@endsection