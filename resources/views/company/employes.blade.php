@extends('components.layout')

@section('content')
<div class="page">
    <div class="page-main">
        <x-header />
        <x-navbar />
        <div class="my-3 my-md-5">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Laporan
                            </div>
                            <h2 class="page-title">
                                {{ $company->name }}
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="ml-auto">
                        </div>
                    </div>
                </div>
                <div class="row row-cards row-deck">
                    <div class="col-3">
                        <x-company-sidebar :company="$company" active="dewan"/>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            @if (count($company->employes) > 0)
                            @foreach ($company->employes as $employe)
                            <div class="col-12 col-md-4">
                                <div class="card" style="height: 90%">
                                    <div class="card-body p-6 text-center">
                                      <span class="avatar avatar-xl mb-3 avatar-rounded">JL</span>
                                      <h4 class="m-0 mb-1"><a href="#">{{ $employe->name }}</a></h4>
                                      <div class="text-muted">{{ $employe->position }}</div>
                                    </div>
                                    <div class="d-flex" style="font-size: .9rem">
                                      <a href="mailto:{{ $employe->email }}" class="card-btn"><i class="fe fe-mail"></i> Email</a>
                                      <a href="tel:{{ $employe->phone }}" class="card-btn"><i class="fe fe-phone"></i> Telefon</a>
                                    </div>
                                  </div>
                            </div>
                            @endforeach
                            @else
                                
                            @endif
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <form action="{{ route('create_employe') }}" method="POST" class="card-body">
                                        @csrf
                                        <div class="card-title">Anggota Baru</div>
                                        {{-- <div class="form-group mb-2">
                                            <div class="form-label">Foto</div>
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" name="example-file-input-custom">
                                              <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div> --}}
                                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="name" required class="form-control" name="name" placeholder="Nama">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Jabatan</label>
                                            <input type="position" class="form-control" name="position" placeholder="Jabatan">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Telefon</label>
                                            <input type="numeric" class="form-control" name="phone" placeholder="Telefon">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">First link</a></li>
                                <li><a href="#">Second link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Third link</a></li>
                                <li><a href="#">Fourth link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Fifth link</a></li>
                                <li><a href="#">Sixth link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Other link</a></li>
                                <li><a href="#">Last link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    Premium and Open Source dashboard template with responsive and high quality UI. For Free!
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="./docs/index.html">Documentation</a></li>
                                <li class="list-inline-item"><a href="./faq.html">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <a href="https://github.com/tabler/tabler" class="btn btn-outline-primary btn-sm">Source code</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © 2018 <a href=".">Tabler</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection