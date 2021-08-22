@extends('components.layout')

@section('title', 'Perusahaan')

@section('content')
<x-navbar/>
<div class="container my-4">
  <div class="row">
    <div class="col-md-19">
      <div class="card border-0 shadow-secondary">
        <div class="card-body">
          <h6 class="card-title fw-bold">UBAH PROFIL PERUSAHAAN</h6>
          <hr>
          <form method="POST">
            @csrf
            <div class="mb-3">
              <label for="inputName" class="form-label">Nama perusahaan</label>
              <input type="text" name="name" required id="inputName" class="form-control w-50" value="{{ $company->name }}">
            </div>
            <div class="mb-3">
              <label for="inputRegional" class="form-label">Lingkup Wilayah Operasional</label>
              <input type="text" name="regional" required id="inputRegional" class="form-control w-25" value="{{ $company->regional }}">
            </div>
            <div class="mb-3">
              <label for="inputOutlet" class="form-label">Jumlah Unit Layanan (outlet)</label>
              <input type="number" name="outlet" required id="inputOutlet" class="form-control w-25" value="{{ $company->outlet }}">
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="inputPostalcode" class="form-label">Kodepos</label>
                <input type="text" name="add_postalcode" required id="inputPostalcode" class="form-control" value="{{ $company->add_postalcode }}">
              </div>
              <div class="col-md-9 mb-3">
                <label for="inputProvince" class="form-label">Provinsi</label>
                <input type="text" name="add_province" required id="inputProvince" class="form-control" value="{{ $company->add_province }}">
              </div>
              <div class="col-md-9 mb-3">
                <label for="inputRegency" class="form-label">Kabupaten/Kota</label>
                <input type="text" name="add_regency" required id="inputRegency" class="form-control" value="{{ $company->add_regency }}">
              </div>
              <div class="col-md-6 mb-3">
                <label for="inputSubdistrict" class="form-label">Kecamatan</label>
                <input type="text" name="add_subdistrict" required id="inputSubdistrict" class="form-control" value="{{ $company->add_subdistrict }}">
              </div>
              <div class="col-md-6 mb-3">
                <label for="inputVillage" class="form-label">Kelurahan/Desa</label>
                <input type="text" name="add_village" required id="inputVillage" class="form-control" value="{{ $company->add_village }}">
              </div>
              <div class="col-md-12 mb-3">
                <label for="inputRoad" class="form-label">Alamat</label>
                <input type="text" name="add_road" required id="inputRoad" class="form-control" value="{{ $company->add_road }}">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="text" name="email" required id="inputEmail" class="form-control" value="{{ $company->email }}">
              </div>
              <div class="col-md-6 mb-3">
                <label for="inputPhone" class="form-label">Telefon</label>
                <input type="text" name="phone" required id="inputPhone" class="form-control" value="{{ $company->phone }}">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="inputBirthdate" class="form-label">Tanggal pendirian</label>
                <input type="date" name="birthdate" required id="inputBirthdate" class="form-control" value="{{ $company->birthdate }}">
              </div>
            </div>
            <div class="row">
              <div class="col-md-8 mb-3">
                <label for="inputLicenseNumber" class="form-label">Nomor izin usaha</label>
                <input type="text" name="lic_number" required id="inputLicenseNumber" class="form-control" value="{{ $company->lic_number }}">
              </div>
              <div class="col-md-6 mb-3">
                <label for="inputLicenseDate" class="form-label">Tanggal Izin usaha</label>
                <input type="date" name="lic_date" required id="inputLicenseDate" class="form-control" value="{{ $company->lic_date }}">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="inputTax" class="form-label">NPWP</label>
                <input type="text" name="tax_number" required id="inputTax" class="form-control" value="{{ $company->tax_number }}">
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
      <x-company-sidebar/>
    </div>
  </div>
</div>
@endsection