@extends('components.layout')

@section('title', 'Perusahaan')

@section('content')
<x-navbar/>
<div class="container my-4">
  <div class="row">
    <div class="col-md-19">
      <div class="card border-0 shadow-secondary">
        <div class="card-body">
          <h6 class="card-title fw-bold">DATA PERUSAHAAN BARU</h6>
          <hr>
          <p class="fw-bold">Informasi perusahaan</p>
          <div class="row mb-4">
            <div class="col-md-6">
              <p>Nama perusahaan</p>
            </div>
            <div class="col-md-18">{{ $company->name }}</div>
          </div>
          <p class="fw-bold">Unggah data baru</p>
          <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="inputFile" class="form-label">Telusuri file [xlsx]</label>
              <input type="file" required name="file" id="inputFile" class="form-control w-50" accept=".xlsx">
              <small class="text-secondary">*Data yang diunggah harus menggunakan format yang berlaku. <a href="">Download format</a></small>
              @error('file')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="mb-3">
              <label for="inputName" class="form-label">Nama file</label>
              <input type="text" name="name" id="inputName" class="form-control w-50">
              <small class="text-secondary">*Biarkan kosong untuk nama default</small>
            </div>
            <div class="mb-3">
              <label for="inputRegional" class="form-label">Deskripsi file</label>
              <textarea name="description" id="" rows="3" class="form-control"></textarea>
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
      <x-company-sidebar cid="{{ isset($company) ? $company->id : null }}" active="company_file_upload"/>
    </div>
  </div>
</div>
@endsection