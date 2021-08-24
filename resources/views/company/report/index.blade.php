@extends('components.layout')
@section('content')
<div class="container body">
    <div class="main_container">
        <x-sidenav companyid="{{ $company->id }}" active="laporan" />
        <x-topnav />
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="text-wrap">
                        <h4>{{ $company->name }}</h4>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">DASHBOARD</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('show_company', ['company' => $company->id]) }}">{{ $company->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">LAPORAN TRIWULAN</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                {{ \Session::get('success') }}
            </div>
            @endif
            @if (\Session::has('fail'))
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                {{ \Session::get('fail') }}
                Lol
            </div>
            @endif
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Laporan Triwulan Baru</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li>
                                    <a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div>
                                <form action="{{ route('create_report', ['company' => $company->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="inputFile" class="form-label">Pilih file perusahaan</label>
                                        <input type="text" required name="file" id="inputFile" list="fileOptions" class="form-control w-50">
                                        <datalist id="fileOptions">
                                            @foreach ($company->file as $file)
                                            <option value="{{ $file->name }}">
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="inputName" class="form-label">Tahun</label>
                                            <input type="number" required name="year" id="inputName" class="form-control w-100" value="">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputName" class="form-label">Triwulan</label>
                                            <input type="number" required name="quarter" id="inputName" class="form-control w-100" value="">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-sm btn-light">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Semua Laporan Triwulan</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li>
                                    <a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-stripped table-hover">
                                <thead style="background-color: #2A3F54">
                                    <tr class="text-light">
                                        <th>ID</th>
                                        <th>Tanggal Rilis</th>
                                        <th>Tahun</th>
                                        <th>Triwulan</th>
                                        <th>Pelapor</th>
                                        <th style="width: 12rem">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($company->reports as $report)
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->created_at }}</td>
                                        <td>{{ $report->year }}</td>
                                        <td>{{ $report->quarter }}</td>
                                        <td>{{ $report->reporter->name }}</td>
                                        <td>
                                            <p class="mb-0"><a class="btn btn-sm btn-link text-secondary m-0 py-0" href="{{ route('show_report', ['company' => $company->id, 'report' => $report->id]) }}"><i class="fa fa-eye"></i> Detail</a> | <button class="btn btn-link btn-sm text-danger m-0 py-0 delete-report-modal-button" data-company-id="{{ $company->id }}" data-report-id="{{ $report->id }}" data-report-periode="{{ $report->year.'/'.$report->quarter }}"><i class="fa fa-trash"></i> Delete</button></p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <div class="d-flex justify-content-end">
                                {{-- {{ $file->links('pagination::bootstrap-4') }} --}}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="delete_report_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form id="delete_report_modal_form" class="modal-content" method="POST">
                <div class="modal-header bg-danger text-light">
                    <h4 class="modal-title">Hapus laporan triwulan <span class="report_name"></span></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <p>Apakah Anda yakin menghapus laporan triwulan <span class="report_name"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // delete file modal logic
    let delete_report_modal = $('#delete_report_modal')
    let delete_report_modal_button = $('.delete-report-modal-button')
    let delete_report_modal_form = $('#delete_report_modal_form')
    let delete_report_modal_title = $('#delete_report_modal_title')
    let delete_report_name = $('.report_name')
    delete_report_modal_button.click(function() {
        let company_id = $(this).data('company-id')
        let report_id = $(this).data('report-id')
        let report_name = $(this).data('report-periode')

        delete_report_name.text(report_name)
        delete_report_modal_form.attr('action', `/perusahaan/${company_id}/laporan/${report_id}/hapus`)
        delete_report_modal.modal('show')
    })
</script>
@endsection