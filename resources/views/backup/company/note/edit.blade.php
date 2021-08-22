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
          <h6 class="card-title fw-bold">UBAH CATATAN PERUSAHAAN</h6>
          <hr>
          <p class="fw-bold">Informasi perusahaan</p>
          <div class="row mb-4">
            <div class="col-md-6">
              <p>Nama perusahaan</p>
            </div>
            <div class="col-md-18">{{ $company->name }}</div>
          </div>
          <p class="fw-bold">Unggah catatan baru</p>
          <form method="post">
            @csrf
            <div class="mb-3">
              <label for="inputRegional" class="form-label">Catatan</label>
              <textarea name="note" id="" rows="3" class="form-control">{{ $note->note }}</textarea>
            </div>
            
            <hr>
            <div class="d-flex justify-content-end">
              <a href="{{ route('note', ['company' => $company->id]) }}" class="btn btn-light shadow-secondary me-3">Batal</a>
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