@extends('components.layout')

@section('title', 'Perusahaan')

@section('content')
<x-navbar/>
<div class="container my-4">
  <div class="row">
    <div class="col-md-19">
      <x-session-alert/>
      <div class="card border-0 shadow-secondary">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="card-title fw-bold">ANALISIS TAHUNAN PERUSAHAAN</h6>
            <a href="{{ route('create_report', ['company' => $company->id]) }}" class="btn btn-success text-light shadow-success">Data laporan baru</a>
          </div>
          <hr>
          <p class="fw-bold">Informasi perusahaan</p>
          <div class="row mb-4">
            <div class="col-md-6">
              <p>Nama perusahaan</p>
            </div>
            <div class="col-md-18">{{ $company->name }}</div>
          </div>
          <p class="fw-bold">Semua data laporan</p>
          <form action="" method="get">
              <div class="row">
                  <div class="col-md-6">
                      <p class="mb-0">Periode dimulai:</p>
                      
                  </div>
                  <div class="col-md-6">
                      <input type="text" class="form-control form-control-sm" name="" id="" placeholder="Tahun">
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <x-company-sidebar cid="{{ isset($company) ? $company->id : null }}" active="company_reports"/>
    </div>
  </div>
</div>
@endsection