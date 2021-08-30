<div>
    <div class="row">
        <div class="col-12 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Informasi Perusahaan</div>
                    <div class="mb-2">
                        <i class="fe fe-hash"></i>
                        Kode: <strong>{{ $company->code }}</strong>
                    </div>
                    <div class="mb-2">
                        <i class="fe fe-map"></i>
                        Regional: <strong>{{ $company->regional }}</strong>
                    </div>
                    <div class="mb-2">
                        <i class="fe fe-mail"></i>
                        Email: <strong>{{ $company->email }}</strong>
                    </div>
                    <div class="mb-2">
                        <i class="fe fe-phone"></i>
                        Telefon: <strong>{{ $company->phone }}</strong>
                    </div>
                    <div class="mb-2">
                        <i class="fe fe-flag"></i>
                        Tgl. Pendirian: <strong>{{ $company->birthdate }}</strong>
                    </div>
                    <div class="mb-2">
                        <i class="fe fe-shield"></i>
                        Izin Usaha: <strong>{{ $company->lic_number }}</strong>
                    </div>
                    <div class="mb-2">
                        <i class="fe fe-shield"></i>
                        Tgl. Izin: <strong>{{ $company->lic_date }}</strong>
                    </div>
                    <div class="mb-2">
                        <i class="fe fe-percent"></i>
                        NPWP: <strong>{{ $company->tax_number }}</strong>
                    </div>
    
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="list-group list-group-transparent mb-3">
                            <a class="list-group-item list-group-item-action d-flex justify-content-between {{ $active == 'analisis-tahunan' ? 'active' : '' }}" href="/perusahaan/1/analisis-tahunan">
                                Analisis Tahunan
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between {{ $active == 'berkas' ? 'active' : '' }}" href="/perusahaan/1/berkas">
                                Berkas
                                <small class="text-muted ms-auto">{{ $file_count }}</small>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between {{ $active == 'catatan' ? 'active' : '' }}" href="/perusahaan/1/catatan">
                                Catatan
                                <small class="text-muted ms-auto">{{ $note_count }}</small>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between {{ $active == 'dewan' ? 'active' : '' }}" href="/perusahaan/1/dewan">
                                Dewan Direksi & Komisaris
                                <small class="text-muted ms-auto">{{ $employe_count }}</small>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between {{ $active == 'laporan' ? 'active' : '' }}" href="/perusahaan/1/laporan">
                                Laporan
                                <small class="text-muted ms-auto">{{ $report_count }}</small>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between {{ $active == 'statistik' ? 'active' : '' }}" href="/perusahaan/1">
                                Statistik
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary w-100 edit-modal-btn"><i class="fe fe-edit-2"></i> Ubah Informasi Perusahaan</button>
        </div>
    </div>
    <div class="modal modal-blur fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-primary">
                    <h5 class="modal-title font-weight-bold" id="editModalLabel"><i class="fe fe-edit"></i> Ubah Informasi Dewan</h5>
                    <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('edit_company', ['company' => $company->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <label for="inputCode" class="form-label">Kode Perusahaan</label>
                                <input type="text" name="code" required id="inputCode" class="form-control" value="{{ $company->code }}">
                            </div>
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
    <script>
        let editMdlBtn = $('.edit-modal-btn');
        let editMdl = new bootstrap.Modal($('#editModal'))
        editMdlBtn.on('click', function() {
            editMdl.show()
        })
    </script>
</div>