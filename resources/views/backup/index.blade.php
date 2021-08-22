@extends('components.layout')

@section('title', 'Dashboard')

@section('content')
  <x-navbar/>
  <div class="container my-4">
    <div class="row mb-4">
      <div class="col-md-6">
        <div class="card border-0 bg-danger shadow-danger text-light">
          <div class="card-body">
            <p class="mb-0"><i class="bi bi-building"></i> JML PERUSAHAAN</p>
            <p class="fs-1 mb-0">{{ $company_total }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card border-0 bg-secondary shadow-secondary text-light">
          <div class="card-body">
            <p class="mb-0"><i class="bi bi-person-fill"></i> JML USER AKTIF</p>
            <p class="fs-1 mb-0">{{ \App\Models\User::count() }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card border-0 bg-success shadow-success text-light">
          <div class="card-body">
            <p class="mb-0"><i class="bi bi-cloud-arrow-up-fill"></i> JML DATA DIUNGGAH</p>
            <p class="fs-1 mb-0">20</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card border-0 bg-primary shadow-primary text-light">
          <div class="card-body">
            <p class="mb-0"><i class="bi bi-cloud-arrow-down-fill"></i> JML DATA DIUNDUH</p>
            <p class="fs-1 mb-0">20</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-16">
        <div class="card border-0 shadow-secondary mb-4">
          <div class="card-body">
            <p class="fw-bold mb-0"><i class="bi bi-sort-down"></i> PERUSAHAAN TERAKHIR DITAMBAHKAN</p>
            <table class="table table-hover">
              <table class="table table-hover">
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
                  @if (count($last_companies) < 1)
                  <tr>
                    <td colspan="5">Belum ada data...</td>
                  </tr>
                  @else
                    @foreach ($last_companies as $company)
                      <tr>
                        <td>
                          <a href="{{ route('show_company', ['company' => $company->id]) }}">{{ $company->name }}</a>
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
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card border-0 shadow-secondary mb-4">
          <div class="card-body">
            <p class="fw-bold mb-3"><i class="bi bi-clock-fill"></i> AKTIVITAS TERAKHIR</p>
            <table class="table table-borderless table-hover">
              <thead></thead>
              <tbody>
                <tr>
                  <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex, incidunt.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection