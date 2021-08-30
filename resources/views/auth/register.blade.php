@extends('components.layout')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="d-flex justify-content-center mb-4">
            <a href="."><img src="/assets/images/logo.png" style="height: 6rem" alt=""></a>
        </div>
        <form class="card card-md" action="{{ route('register') }}" method="POST" autocomplete="off">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Daftar akun baru</h2>
                <div class="mb-4">
                    <label class="form-label">Nama</label>
                    <input name="name" type="name" class="form-control" placeholder="Masukkan nama">
                </div>
                <div class="mb-4">
                    <label class="form-label">Alamat email</label>
                    <input name="email" type="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label class="form-label d-flex justify-content-between">
                        Password
                        <span class="form-label-description">
                            <a href="./forgot-password.html">Lupa password</a>
                        </span>
                    </label>
                    <div class="input-group input-group-flat">
                        <input name="password" type="password" class="form-control" placeholder="Password" autocomplete="off">
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password">
                                <i class="fe fe-eye"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            Sudah punya akun? <a href="{{ route('login') }}" tabindex="-1">Login</a>
        </div>
    </div>
</div>
@endsection