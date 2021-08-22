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
            <h6 class="card-title fw-bold">DATA LAPORAN PERUSAHAAN</h6>
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
          <div>
            @if (count($company->reports) < 1)
            <p class="mb-0">Belum ada data laporan...</p>
            @else
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tgl Rilis</th>
                  <th>Tahun</th>
                  <th>Triwulan</th>
                  <th>Pelapor</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($company->reports as $report)
                <tr>
                  <td>{{ $report->id }}</td>
                  <td>{{ $report->created_at }}</td>
                  <td>{{ $report->year }}</td>
                  <td>{{ $report->quarter }}</td>
                  <td>{{ $report->reporter->name }}</td>
                  <td>
                    <a href="{{ route('show_report', ['company' => $company->id, 'report' => $report->id]) }}" class="btn btn-sm text-primary"><i class="bi bi-eye-fill"></i></a>
                    <button type="button" class="btn btn-danger btn-sm text-light btn-modal" data-company-id="{{ $company->id }}" data-report-id="{{ $report->id }}" data-report-year="{{ $report->year }}" data-report-quarter="{{ $report->quarter }}"><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <x-company-sidebar cid="{{ isset($company) ? $company->id : null }}" active="company_reports"/>
    </div>
    {{-- delete modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <form id="deleteForm" method="POST" class="modal-dialog modal-dialog-centered">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Hapus Laporan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p id="deleteModalMessage"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger text-light">Hapus</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script>
    // const deleteModal = $('#deleteModal')
    const deleteModalBtn = $('.btn-modal')
    const deleteModalMessage = $('#deleteModalMessage')
    const deleteModal = new bootstrap.Modal($('#deleteModal'))
    const deleteForm = $('#deleteForm')
    deleteModalBtn.click(function() {
      const companyID = $(this).data('company-id');
      const reportID = $(this).data('report-id');
      const reportYear = $(this).data('report-year');
      const reportQuarter = $(this).data('report-quarter');
      deleteModalMessage.text(`Hapus laporan tahun ${reportYear} triwulan ${reportQuarter}?`)
      deleteForm.attr('action', `/perusahaan/${companyID}/laporan/${reportID}/hapus`)
      deleteModal.show()
    })
  </script>
@endsection