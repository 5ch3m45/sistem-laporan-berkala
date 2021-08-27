<div class="row">
    <div class="col-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Informasi Laporan Triwulan</div>
                <div class="mb-2">
                    <i class="fe fe-briefcase"></i>
                    Perusahaan: <a class="text-dark" href="{{ route('show_company', ['company' => $report->company_id]) }}"><strong>{{ $report->company->name }}</strong></a>
                </div>
                <div class="mb-2">
                    <i class="fe fe-bookmark"></i>
                    Versi: <strong>{{ $report->version }}</strong>
                </div>
                <div class="mb-2">
                    <i class="fe fe-calendar"></i>
                    Tahun: <strong>{{ $report->year }}</strong>
                </div>
                <div class="mb-2">
                    <i class="fe fe-sun"></i>
                    Triwulan: <strong>{{ $report->quarter }}</strong>
                </div>
                <div class="mb-2">
                    <i class="fe fe-calendar"></i>
                    Periode: <strong>{{ $report->periode }}</strong>
                </div>
                <div class="mb-2">
                    <i class="fe fe-calendar"></i>
                    Tgl. Pelaporan: <strong>{{ $report->reported_at }}</strong>
                </div>
                <div class="mb-2">
                    <i class="fe fe-user"></i>
                    Contact Person: <strong>{{ $report->cp_name }}</strong>
                </div>
                <div class="mb-2">
                    <i class="fe fe-phone"></i>
                    Telefon: <strong>{{ $report->cp_phone }}</strong>
                </div>
                <div class="mb-2">
                    <i class="fe fe-mail"></i>
                    Email: <strong>{{ $report->cp_email }}</strong>
                </div>

            </div>
        </div>
    </div>
    {{-- <div class="col-12">
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
    </div> --}}
</div>