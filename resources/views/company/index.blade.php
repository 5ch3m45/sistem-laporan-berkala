@extends('components.layout')

@section('content')
<div class="page">
    <div class="page-main">
        <x-header />
        <x-navbar active="perusahaan" />
        <div class="my-3 my-md-5">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Semua
                            </div>
                            <h2 class="page-title">
                                Perusahaan
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="ml-auto">
                            <div class="btn-list">
                                <button type="button" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fe fe-plus"></i>
                                    Perusahaan Baru
                                </button>
                                <button type="button" class="btn btn-primary d-sm-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fe fe-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-cards row-deck">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form class="d-flex flex-row mt-2">
                                    <div class="form-group mr-2">
                                        <label class="form-label">Cari</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nama perusahaan">
                                    </div>
                                    <div class="form-group mr-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button class="btn btn-primary" type="submit">Terapkan</button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap" style="font-size: .8rem">
                                    <thead>
                                        <tr>
                                            <th class="w-1">Kode</th>
                                            <th>Nama</th>
                                            <th>Regional</th>
                                            <th>&nbsp;</th>
                                            <th>CR</th>
                                            <th>DER</th>
                                            <th>DAR</th>
                                            <th>RoA</th>
                                            <th>RoE</th>
                                            <th>BOPO</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($companies) > 0)
                                        @foreach ($companies as $company)
                                        <tr>
                                            <td><span class="text-muted">{{ $company->id }}</span></td>
                                            <td><a href="{{ route('show_company', ['company' => $company->id]) }}" class="text-inherit text-primary">{{ $company->name }}</a></td>
                                            <td>
                                                {{ $company->regional }}
                                            </td>
                                            <td>
                                                QtQ :<br/>YoY :
                                            </td>
                                            <td class="text-right">
                                                <abbr title="QtQ" style="text-decoration:none;">{{ $company->current_ratio['qtq'] }}%</abbr><br />
                                                <abbr title="YoY" style="text-decoration:none;">{{ $company->current_ratio['yoy'] }}%</abbr>
                                            </td>
                                            <td class="text-right">
                                                <abbr title="QtQ" style="text-decoration:none;">{{ $company->debt_to_equity['qtq'] }}%</abbr><br />
                                                <abbr title="YoY" style="text-decoration:none;">{{ $company->debt_to_equity['yoy'] }}%</abbr>
                                            </td>
                                            <td class="text-right">
                                                <abbr title="QtQ" style="text-decoration:none;">{{ $company->debt_to_asset['qtq'] }}%</abbr><br />
                                                <abbr title="YoY" style="text-decoration:none;">{{ $company->debt_to_asset['yoy'] }}%</abbr>
                                            </td>
                                            <td class="text-right">
                                                <abbr title="QtQ" style="text-decoration:none;">{{ $company->return_on_asset['qtq'] }}%</abbr><br />
                                                <abbr title="YoY" style="text-decoration:none;">{{ $company->return_on_asset['yoy'] }}%</abbr>
                                            </td>
                                            <td class="text-right">
                                                <abbr title="QtQ" style="text-decoration:none;">{{ $company->return_on_equity['qtq'] }}%</abbr><br />
                                                <abbr title="YoY" style="text-decoration:none;">{{ $company->return_on_equity['yoy'] }}%</abbr>
                                            </td>
                                            <td class="text-right">
                                                <abbr title="QtQ" style="text-decoration:none;">{{ $company->bopo['qtq'] }}%</abbr><br />
                                                <abbr title="YoY" style="text-decoration:none;">{{ $company->bopo['yoy'] }}%</abbr>
                                            </td>
                                            <td>
                                                <a href="{{ route('show_company', ['company' => $company]) }}" class="icon">
                                                    <i class="fe fe-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="11">Belum ada data..</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $companies->links() }}
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
<div class="modal modal-blur fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content px-4">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Perusahaan Baru</h5>
                <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create_company') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="inputName" class="form-label">Nama perusahaan</label>
                            <input type="text" name="name" id="inputName" class="form-control">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-7 mb-3">
                            <label for="inputRegional" class="form-label">Wil. Operasional</label>
                            <input type="text" name="regional" required id="inputRegional" class="form-control">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="inputOutlet" class="form-label">Jumlah Unit Layanan (outlet)</label>
                            <input type="number" name="outlet" required id="inputOutlet" class="form-control">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="inputPostalcode" class="form-label">Kodepos</label>
                            <input type="text" name="add_postalcode" required id="inputPostalcode" class="form-control">
                        </div>
                        <div class="col-md-7 mb-3">
                            <label for="inputProvince" class="form-label">Provinsi</label>
                            <input type="text" name="add_province" required id="inputProvince" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputRegency" class="form-label">Kabupaten/Kota</label>
                            <input type="text" name="add_regency" required id="inputRegency" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputSubdistrict" class="form-label">Kecamatan</label>
                            <input type="text" name="add_subdistrict" required id="inputSubdistrict" class="form-control">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="inputVillage" class="form-label">Kelurahan/Desa</label>
                            <input type="text" name="add_village" required id="inputVillage" class="form-control">
                        </div>
                        <div class="col-md-7 mb-3">
                            <label for="inputRoad" class="form-label">Alamat</label>
                            <input type="text" name="add_road" required id="inputRoad" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="text" name="email" required id="inputEmail" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputPhone" class="form-label">Telefon</label>
                            <input type="text" name="phone" required id="inputPhone" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputBirthdate" class="form-label">Tanggal pendirian</label>
                            <input type="date" name="birthdate" required id="inputBirthdate" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputTax" class="form-label">NPWP</label>
                            <input type="text" name="tax_number" required id="inputTax" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputLicenseNumber" class="form-label">Nomor izin usaha</label>
                            <input type="text" name="lic_number" required id="inputLicenseNumber" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputLicenseDate" class="form-label">Tanggal Izin usaha</label>
                            <input type="date" name="lic_date" required id="inputLicenseDate" class="form-control">
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
@endsection