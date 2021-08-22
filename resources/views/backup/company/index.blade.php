@extends('components.layout')

@section('title', 'Perusahaan')

@section('content')
<x-navbar/>
<div class="container my-4">
  <div class="row">
    <div class="col-md-19">
      <div class="card border-0 shadow-secondary">
        <div class="card-body">
          <h6 class="card-title fw-bold">SEMUA PERUSAHAAN</h6>
          <hr>
          <table class="table table-hover mb-3">
            <thead class="bg-primary text-light">
              <tr>
                <th>Nama perusahaan</th>
                <th>Regional</th>
                <th>Jml Outlet</th>
                <th>Email</th>
                <th>Telefon</th>
              </tr>
            </thead>
            <tbody>
              @if (count($companies) < 1)
              <tr>
                <td colspan="5">Belum ada data...</td>
              </tr>
              @else
              @foreach ($companies as $company)
              <tr>
                <td>
                  <a href="{{ route('show_company', ['company' => $company->id]) }}">
                    {{ $company->name }}
                  </a>
                </td>
                <td>{{ $company->regional }}</td>
                <td>{{ $company->outlet }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->phone }}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
          {{ $companies->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <x-company-sidebar active="company_index"/>
    </div>
  </div>
</div>
@endsection

