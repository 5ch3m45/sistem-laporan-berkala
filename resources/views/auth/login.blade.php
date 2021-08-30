@extends('components.layout')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="d-flex justify-content-center mb-4">
            <a href="."><img src="/assets/images/logo.png" style="height: 6rem" alt=""></a>
        </div>
        <form class="card card-md" action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Masuk ke akun anda</h2>
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
                                <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="12" r="2"></circle>
                                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input">
                        <span class="form-check-label">Ingat saya</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            Belum punya akun? <a href="{{ route('register') }}" tabindex="-1">Daftar</a>
        </div>
    </div>
</div>
@endsection