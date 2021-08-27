@extends('components.layout')

@section('content')
<div class="page">
    <div class="page-main">
        <x-header />
        <x-navbar />
        <div class="my-3 my-md-5">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Berkas
                            </div>
                            <h2 class="page-title">
                                {{ $company->name }}
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="ml-auto">
                        </div>
                    </div>
                </div>
                <div class="row row-cards row-deck">
                    <div class="col-3">
                        <x-company-sidebar :company="$company" active="" />
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('edit_company', ['company' => $company->id]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="inputName" class="form-label">Nama perusahaan</label>
                                                    <input type="text" name="name" id="inputName" class="form-control" value="{{ $company->name }}">
                                                    @error('name')
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                    <label for="inputRegional" class="form-label">Wil. Operasional</label>
                                                    <input type="text" name="regional" required id="inputRegional" class="form-control" value="{{ $company->regional }}">
                                                </div>
                                                <div class="col-md-5 mb-3">
                                                    <label for="inputOutlet" class="form-label">Jumlah Unit Layanan (outlet)</label>
                                                    <input type="number" name="outlet" required id="inputOutlet" class="form-control" value="{{ $company->outlet }}">
                                                </div>
                                                <div class="col-md-5 mb-3">
                                                    <label for="inputPostalcode" class="form-label">Kodepos</label>
                                                    <input type="text" name="add_postalcode" required id="inputPostalcode" class="form-control" value="{{ $company->add_postalcode }}">
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                    <label for="inputProvince" class="form-label">Provinsi</label>
                                                    <input type="text" name="add_province" required id="inputProvince" class="form-control" value="{{ $company->add_province }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputRegency" class="form-label">Kabupaten/Kota</label>
                                                    <input type="text" name="add_regency" required id="inputRegency" class="form-control" value="{{ $company->add_regency }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputSubdistrict" class="form-label">Kecamatan</label>
                                                    <input type="text" name="add_subdistrict" required id="inputSubdistrict" class="form-control" value="{{ $company->add_subdistrict }}">
                                                </div>
                                                <div class="col-md-5 mb-3">
                                                    <label for="inputVillage" class="form-label">Kelurahan/Desa</label>
                                                    <input type="text" name="add_village" required id="inputVillage" class="form-control" value="{{ $company->add_village }}">
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                    <label for="inputRoad" class="form-label">Alamat</label>
                                                    <input type="text" name="add_road" required id="inputRoad" class="form-control" value="{{ $company->add_road }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputEmail" class="form-label">Email</label>
                                                    <input type="text" name="email" required id="inputEmail" class="form-control" value="{{ $company->email }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputPhone" class="form-label">Telefon</label>
                                                    <input type="text" name="phone" required id="inputPhone" class="form-control" value="{{ $company->phone }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputBirthdate" class="form-label">Tanggal pendirian</label>
                                                    <input type="date" name="birthdate" required id="inputBirthdate" class="form-control" value="{{ $company->birthdate }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputTax" class="form-label">NPWP</label>
                                                    <input type="text" name="tax_number" required id="inputTax" class="form-control" value="{{ $company->tax_number }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputLicenseNumber" class="form-label">Nomor izin usaha</label>
                                                    <input type="text" name="lic_number" required id="inputLicenseNumber" class="form-control" value="{{ $company->lic_number }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="inputLicenseDate" class="form-label">Tanggal Izin usaha</label>
                                                    <input type="date" name="lic_date" required id="inputLicenseDate" class="form-control" value="{{ $company->lic_date }}">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">First link</a></li>
                                <li><a href="#">Second link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Third link</a></li>
                                <li><a href="#">Fourth link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Fifth link</a></li>
                                <li><a href="#">Sixth link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Other link</a></li>
                                <li><a href="#">Last link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    Premium and Open Source dashboard template with responsive and high quality UI. For Free!
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="./docs/index.html">Documentation</a></li>
                                <li class="list-inline-item"><a href="./faq.html">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <a href="https://github.com/tabler/tabler" class="btn btn-outline-primary btn-sm">Source code</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © 2018 <a href=".">Tabler</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection