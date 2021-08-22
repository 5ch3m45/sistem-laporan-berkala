@extends('components.layout')

@section('title', 'Perusahaan')

@section('content')
<x-navbar />
<div class="container my-4">
  <div class="row">
    <div class="col-md-19">
      <x-session-alert />
      <div class="card border-0 shadow-secondary">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="card-title fw-bold">DATA LAPORAN PERUSAHAAN</h6>
            <a href="{{ route('create_report', ['company' => $company->id]) }}" class="btn btn-success text-light shadow-success">Data laporan baru</a>
          </div>
          <hr>
          <p class="fw-bold">Informasi perusahaan</p>
          <div>
            <div class="row mb-4">
              <div class="col-md-6">
                <p>Nama perusahaan</p>
              </div>
              <div class="col-md-18">{{ $company->name }}</div>
            </div>
            <p class="fw-bold">Data laporan</p>
            <div class="row mb-3">
              <div class="col-md-6">
                <p class="mb-0">ID Laporan</p>
              </div>
              <div class="col-md-18">
                {{ $report->id }}
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <p class="mb-0">Tanggal Rilis</p>
              </div>
              <div class="col-md-18">
                {{ $report->created_at }}
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <p class="mb-0">Tahun/Triwulan</p>
              </div>
              <div class="col-md-18">
                {{ $report->year }}/{{ $report->quarter }}
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <p class="mb-0">Pelapor</p>
              </div>
              <div class="col-md-18">
                {{ $report->reporter->name }}
              </div>
            </div>
          </div>
          <div>
            <table id="tree" class="table table-hover table-borderless" style="border: 0">
                <tbody>
                    @foreach (\App\Models\Account::get() as $account)
                        <tr data-tt-id="{{ $account->id }}" data-tt-parent-id="{{ $account->parent_id }}">
                            <td class="py-2">{{ Str::title($account->description) }}</td>
                            <td class="py-2">
                                @php
                                    $company_report = \App\Models\CompanyReport::where('report_id', $report->id)->where('account_code', $account->code)->first();
                                    if($company_report){
                                        echo number_format($company_report->value, 0, ',', '.');
                                    }
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <x-company-sidebar cid="{{ isset($company) ? $company->id : null }}" />
    </div>
  </div>
</div>
@endsection

@section('js')
    <script>
        $("#tree").treetable({ 
            expandable: true,
            initialState: 'expanded'
        });
    </script>
@endsection