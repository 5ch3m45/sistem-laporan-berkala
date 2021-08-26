<div class="row">
    <div class="col-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Informasi Perusahaan</div>
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
</div>