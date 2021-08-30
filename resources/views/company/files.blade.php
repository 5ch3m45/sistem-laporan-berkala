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
                        <x-company-sidebar :company="$company" active="berkas" />
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
                                                        <th>Nama</th>
                                                        <th>Tgl Diunggah</th>
                                                        <th>Pengunggah</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($company->files) > 0)
                                                    @foreach ($company->files()->orderBy('name')->get() as $file)
                                                    <tr>
                                                        <td>{{ $file->name }}</td>
                                                        <td>{{ $file->created_at }}</td>
                                                        <td>{{ $file->uploader->name }}</td>
                                                        <td class="text-right">
                                                            <button class="btn btn-white btn-sm delete-modal-btn" data-id="{{ $file->id }}">
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
                                    <form action="{{ route('upload_file') }}" method="POST" class="card-body" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-title">Unggah Berkas Baru</div>
                                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                                        <div class="form-group mb-3">
                                            <div class="form-label">Telusuri Berkas</div>
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" name="file">
                                              <label class="custom-file-label">Choose file</label>
                                            </div>
                                            @error('file')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama file</label>
                                            <input type="text" class="form-control" name="example-text-input" placeholder="Text..">
                                            <small class="text-secondary">*Biarkan kosong untuk nama default</small>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Unggah</button>
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
            <div class="modal-header text-danger">
                <h5 class="modal-title font-weight-bold" id="deleteModalLabel"><i class="fe fe-alert-triangle"></i> Hapus Berkas</h5>
                <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin menghapus berkas ini?</p>
                <form action="{{ route('delete_file') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="file_id">
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
            $('input[name=file_id]').val($(this).data('id'))
            deleteMdl.show()
        })
    </script>
@endsection