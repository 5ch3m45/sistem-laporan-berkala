@extends('components.layout')

@section('title', 'Perusahaan')

@section('content')
<x-navbar/>
<div class="container my-4">
  <div class="row">
    <div class="col-md-19">
      <div class="card border-0 shadow-secondary">
        <div class="card-body">
          <h6 class="card-title fw-bold">GENERATE DATA LAPORAN PERUSAHAAN BARU</h6>
          <hr>
          <p class="fw-bold">Informasi perusahaan</p>
          <div class="row mb-4">
            <div class="col-md-6">
              <p>Nama perusahaan</p>
            </div>
            <div class="col-md-18">{{ $company->name }}</div>
          </div>
          <p class="fw-bold">Sumber data laporan</p>
          <form method="post">
            @csrf
            <div class="mb-3">
              <label for="inputFile" class="form-label">Pilih file perusahaan</label>
              <input type="text" required name="file" id="inputFile" list="fileOptions" class="form-control w-50">
              <datalist id="fileOptions">
                @foreach ($company->file as $file)
                <option value="{{ $file->name }}">
                @endforeach
              </datalist>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="inputName" class="form-label">Tahun</label>
                <input type="number" required name="year" id="inputName" class="form-control w-100">
              </div>
              <div class="col-md-4">
                <label for="inputName" class="form-label">Triwulan</label>
                <input type="number" required name="quarter" id="inputName" class="form-control w-100">
              </div>
            </div>
            
            <hr>
            <div class="d-flex justify-content-end">
              <a href="/perusahaan" class="btn btn-light shadow-secondary me-3">Batal</a>
              <input type="submit" class="btn btn-primary text-light shadow-primary" value="Simpan">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <x-company-sidebar cid="{{ isset($company) ? $company->id : null }}"/>
    </div>
  </div>
</div>
@endsection