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
          <h6 class="card-title fw-bold">PERUSAHAAN BARU</h6>
          <hr>
          <div>
            <div class="mb-3">
              <label for="inputName" class="form-label">Nama perusahaan</label>
              <input type="text" value="{{ $company->name }}" readonly id="inputName" class="form-control-plaintext fw-bold w-50">
            </div>
            <div class="mb-3">
              <label for="inputRegional" class="form-label">Lingkup Wilayah Operasional</label>
              <input type="text" value="{{ $company->regional }}" readonly id="inputRegional" class="form-control-plaintext fw-bold w-25">
            </div>
            <div class="mb-3">
              <label for="inputOutlet" class="form-label">Jumlah Unit Layanan (outlet)</label>
              <input type="number" value="{{ $company->outlet }}" readonly id="inputOutlet" class="form-control-plaintext fw-bold w-25">
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="inputPostalcode" class="form-label">Kodepos</label>
                <input type="text" value="{{ $company->add_postalcode }}" readonly id="inputPostalcode" class="form-control-plaintext fw-bold">
              </div>
              <div class="col-md-9 mb-3">
                <label for="inputProvince" class="form-label">Provinsi</label>
                <input type="text" value="{{ $company->add_province }}" readonly id="inputProvince" class="form-control-plaintext fw-bold">
              </div>
              <div class="col-md-9 mb-3">
                <label for="inputRegency" class="form-label">Kabupaten/Kota</label>
                <input type="text" value="{{ $company->add_regency }}" readonly id="inputRegency" class="form-control-plaintext fw-bold">
              </div>
              <div class="col-md-6 mb-3">
                <label for="inputSubdistrict" class="form-label">Kecamatan</label>
                <input type="text" value="{{ $company->add_subdistrict }}" readonly id="inputSubdistrict" class="form-control-plaintext fw-bold">
              </div>
              <div class="col-md-6 mb-3">
                <label for="inputVillage" class="form-label">Kelurahan/Desa</label>
                <input type="text" value="{{ $company->add_village }}" readonly id="inputVillage" class="form-control-plaintext fw-bold">
              </div>
              <div class="col-md-12 mb-3">
                <label for="inputRoad" class="form-label">Alamat</label>
                <input type="text" value="{{ $company->add_road }}" readonly id="inputRoad" class="form-control-plaintext fw-bold">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="text" value="{{ $company->email }}" readonly id="inputEmail" class="form-control-plaintext fw-bold">
              </div>
              <div class="col-md-6 mb-3">
                <label for="inputPhone" class="form-label">Telefon</label>
                <input type="text" value="{{ $company->phone }}" readonly id="inputPhone" class="form-control-plaintext fw-bold">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="inputBirthdate" class="form-label">Tanggal pendirian</label>
                <input type="date" value="{{ $company->birthdate }}" readonly id="inputBirthdate" class="form-control-plaintext fw-bold">
              </div>
            </div>
            <div class="row">
              <div class="col-md-8 mb-3">
                <label for="inputLicenseNumber" class="form-label">Nomor izin usaha</label>
                <input type="text" value="{{ $company->lic_number }}" readonly id="inputLicenseNumber" class="form-control-plaintext fw-bold">
              </div>
              <div class="col-md-6 mb-3">
                <label for="inputLicenseDate" class="form-label">Tanggal Izin usaha</label>
                <input type="date" value="{{ $company->lic_date }}" readonly id="inputLicenseDate" class="form-control-plaintext fw-bold">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="inputTax" class="form-label">NPWP</label>
                <input type="text" value="{{ $company->tax_number }}" readonly id="inputTax" class="form-control-plaintext fw-bold">
              </div>
            </div>
          </div>
          <hr>
          <div class="d-flex justify-content-end">
            <a href="" class="btn btn-danger shadow-danger text-light me-3">Hapus</a>
            <a href="{{ route('edit_company', ['company' => $company->id]) }}" class="btn btn-warning shadow-warning text-light">Ubah</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <x-company-sidebar cid="{{ isset($company) ? $company->id : null }}" active="company_index"/>
    </div>
  </div>
</div>
@endsection