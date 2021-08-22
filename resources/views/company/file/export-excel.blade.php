@extends('components.layout')

@section('title', 'Perusahaan')

@section('content')
<x-navbar />
<div class="container my-4">
  <div class="row">
    <div class="col-md-19">
      <div class="card border-0 shadow-secondary">
        <div class="card-body">
          <h6 class="card-title fw-bold">UNDUH LAPORAN</h6>
          <hr>
          <p class="fw-bold">Informasi perusahaan</p>
          <div class="row mb-4">
            <div class="col-md-6">
              <p>Nama perusahaan</p>
            </div>
            <div class="col-md-18">PT. JAYA ABADI</div>
          </div>
          <p class="fw-bold">Unduh laporan excel</p>
          <form action="/perusahaan-baru" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="inputName" class="form-label">Basis laporan:</label>
              <input type="text" name="name" id="inputName" class="form-control w-50">
            </div>
            <div class="mb-3">
              <label for="inputName" class="form-label">Format laporan:</label><br/>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                <label class="form-check-label" for="inlineCheckbox1">Ms Excel</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                <label class="form-check-label" for="inlineCheckbox2">Ms Work</label>
              </div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
              <a href="/perusahaan" class="btn btn-light shadow-secondary me-3">Batal</a>
              <input type="submit" class="btn btn-primary text-light shadow-primary" value="Unduh">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <x-company-sidebar />
    </div>
  </div>
</div>
@endsection