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
                                Laporan
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
                        <x-company-sidebar :company="$company" active="laporan"/>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table card-table table-vcenter text-nowrap" style="font-size: .8rem">
                                                <thead>
                                                    <tr>
                                                        <th>Tahun/Triwulan</th>
                                                        <th>Versi</th>
                                                        <th>Contact Person</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($company->reports)>0)
                                                        @foreach ($company->reports as $report)
                                                        <tr>
                                                            <td>{{ $report->year }}/{{ $report->quarter }}</td>
                                                            <td>{{ $report->version }}</td>
                                                            <td>{{ $report->cp_name }} - {{ $report->cp_phone }}</td>
                                                            <td class="text-right">
                                                                <a class="icon mr-3" href="{{ route('show_report', ['report' => $report->id]) }}">
                                                                    <i class="fe fe-eye"></i>
                                                                </a>
                                                                <button class="btn btn-white btn-sm delete-modal-btn" data-id="{{ $report->id }}">
                                                                    <i class="fe fe-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                        
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <form action="{{ route('create_report') }}" method="POST" class="card-body">
                                        @csrf
                                        <div class="card-title">Buat Laporan Baru</div>
                                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama file</label>
                                            <input type="text" list="fileList" class="form-control" name="file" placeholder="Ketik nama file">
                                            <datalist id="fileList">
                                                @foreach ($company->files as $file)
                                                    <option value="{{ $file->name }}"></option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Tahun</label>
                                                    <input type="number" class="form-control" name="year" placeholder="Tahun">
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Triwulan</label>
                                                    <input type="number" class="form-control" name="quarter" placeholder="Triwulan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
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
<div class="modal modal-blur fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Laporan</h5>
                <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin menghapus laporan ini?</p>
                <form action="{{ route('delete_report') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="report_id">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light shadow-secondary me-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger text-light shadow-danger">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot-js')
    <script>
        let deleteMdlBtn = $('.delete-modal-btn');
        let deleteMdl = new bootstrap.Modal($('#deleteModal'))
        deleteMdlBtn.on('click', function() {
            $('input[name=report_id]').val($(this).data('id'))
            deleteMdl.show()
        })
    </script>
@endsection