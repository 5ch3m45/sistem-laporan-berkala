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
          <h6 class="card-title fw-bold">DATA PERUSAHAAN BARU</h6>
          <hr>
          <p class="fw-bold">Informasi perusahaan</p>
          <div class="row mb-4">
            <div class="col-md-6">
              <p>Nama perusahaan</p>
            </div>
            <div class="col-md-18">{{ $company->name }}</div>
          </div>
          <p class="fw-bold">Semua data</p>
          <div class="mb-3 d-flex flex-row">
            <form method="GET" class="d-flex flex-row me-auto">
              <input type="text" name="name" id="" placeholder="Nama file..." class="form-control form-control-sm rounded me-3" style="width: 300px">
              <input type="submit" value="Cari" class="btn btn-primary btn-sm text-light shadow-primary rounded">
            </form>
            <a href="{{ route('upload_file', ['company' => $company->id]) }}" class="btn btn-success text-light shadow-success">Unggah baru</a>
          </div>
          <div class="row">
            @if (count($files) < 1)
            <div class="col-md-24" style="display: grid; place-items: center">
              <div class="d-flex flex-column align-items-center" style="padding: 8rem 0">
                <img src="/images/undraw_counting_stars_rrnl.svg" alt="" style="width: 15rem" class="mb-3">
                <p class="mb-0 text-secondary">File tidak ditemukan...</p>
              </div>
            </div>
            @else
            <div class="p-3 table-responsive">
                <table class="table table-hover table-border table-sm">
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Diunggah oleh</th>
                            <th style="width: 80px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td>
                                <p class="mb-0">{{ $file->name }}</p>
                                <p class="mb-0 text-secondary" style="font-size: .7rem">{{ $file->description }}</p>
                            </td>
                            <td>{{ $file->uploader->name }}</td>
                            <td class="d-flex flex-row">
                                <a href="{{ route('edit_file', ['company' => $company->id, 'file' => $file->id]) }}" class="btn btn-sm btn-warning text-light"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('delete_file', ['company' => $company->id, 'file' => $file->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger text-light ms-1"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <x-company-sidebar cid="{{ isset($company) ? $company->id : null }}" active="company_files"/>
    </div>
  </div>
</div>
@endsection