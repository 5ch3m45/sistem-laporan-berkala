@extends('components.layout')
@section('content')
<div class="container body">
    <div class="main_container">
        <x-sidenav companyid="{{ $company->id }}" active="file" />
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
                            <li class="breadcrumb-item active" aria-current="page">SEMUA FILE</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Tambah File</h2>
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
                            @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible " role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                {{ \Session::get('success') }}
                            </div>
                            @endif
                            <div>
                                <form action="{{ route('upload_file', ['company' => $company->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="inputFile" class="form-label">Telusuri file [xlsx]</label>
                                        <input type="file" required name="file" id="inputFile" class="form-control w-50" accept=".xlsx">
                                        <small class="text-secondary">*Data yang diunggah harus menggunakan format yang berlaku. <a href="">Download format</a></small>
                                        @error('file')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputName" class="form-label">Nama file</label>
                                        <input type="text" name="name" id="inputName" class="form-control w-50">
                                        <small class="text-secondary">*Biarkan kosong untuk nama default</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputRegional" class="form-label">Deskripsi file</label>
                                        <textarea name="description" id="" rows="3" class="form-control"></textarea>
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
                            <h2>Semua File</h2>
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
                                        <th>Name</th>
                                        <th>Tanggal diunggah</th>
                                        <th>Pengunggah</th>
                                        <th style="width: 12rem">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                    <tr>
                                        <th scope="row">{{ $file->name }}</th>
                                        <td>{{ $file->created_at }}</td>
                                        <td>{{ $file->uploader->name }}</td>
                                        <td>
                                            <p class="mb-0"><button class="btn btn-link btn-sm text-secondary py-0 edit-file-modal-button" data-company-id="{{ $company->id }}" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}" data-file-description="{{ $file->description }}"><i class="fa fa-pencil"></i> Edit</button> | <button class="btn btn-link btn-sm text-danger py-0 delete-file-modal-button" data-company-id="{{ $company->id }}" data-file-id="{{ $file->id }}" data-file-name="{{ $file->name }}"><i class="fa fa-trash"></i> Hapus</button></p>
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
    <div class="modal fade bs-example-modal-lg" id="edit_file_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form id="edit_file_modal_form" class="modal-content" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus <span id="edit_file_modal_title"></span></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <textarea name="description" id="file_description" rows="3" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </div>

            </form>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="delete_file_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form id="delete_file_modal_form" class="modal-content" method="POST">
                <div class="modal-header bg-danger text-light">
                    <h4 class="modal-title">Hapus <span class="file_name"></span></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <p>Apakah Anda yakin menghapus file <span class="file_name"></span>?</p>
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
    // edit file modal logic
    let edit_file_modal = $('#edit_file_modal')
    let edit_file_modal_button = $('.edit-file-modal-button')
    let edit_file_modal_form = $('#edit_file_modal_form')
    let edit_file_modal_title = $('#edit_file_modal_title')
    let edit_file_modal_form_input = $('#file_description')
    edit_file_modal_button.click(function() {
        let company_id = $(this).data('company-id')
        let file_id = $(this).data('file-id')
        let file_name = $(this).data('file-name')
        let file_description = $(this).data('file-description')
        
        edit_file_modal_title.text(file_name)
        edit_file_modal_form.attr('action', `/perusahaan/${company_id}/file/${file_id}/ubah`)
        edit_file_modal_form_input.val(file_description)
        edit_file_modal.modal('show')
    })
    // delete file modal logic
    let delete_file_modal = $('#delete_file_modal')
    let delete_file_modal_button = $('.delete-file-modal-button')
    let delete_file_modal_form = $('#delete_file_modal_form')
    let delete_file_modal_title = $('#delete_file_modal_title')
    let delete_file_name = $('.file_name')
    delete_file_modal_button.click(function() {
        let company_id = $(this).data('company-id')
        let file_id = $(this).data('file-id')
        let file_name = $(this).data('file-name')

        delete_file_name.text(file_name)
        delete_file_modal_form.attr('action', `/perusahaan/${company_id}/file/${file_id}/hapus`)
        delete_file_modal.modal('show')
    })
</script>
@endsection