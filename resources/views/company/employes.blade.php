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
                        <x-company-sidebar :company="$company" active="dewan"/>
                    </div>
                    
                    <div class="col-6">
                        <div class="row">
                            @php
                                function nameAlias($name) {
                                    $alias = array();
                                    foreach (explode(' ', $name) as $string) {
                                        array_push($alias, strtoupper($string[0]));
                                    }
                                    return implode($alias);
                                }
                            @endphp
                            @if (count($company->employes) > 0)
                            @foreach ($company->employes as $employe)
                            <div class="col-12 col-md-4">
                                <div class="card" style="height: 90%">
                                    <div class="card-body px-6 pt-6 pb-2 text-center">
                                      <span class="avatar avatar-xl mb-3 avatar-rounded">{{ nameAlias($employe->name) }}</span>
                                      <h4 class="m-0 mb-1"><a href="#">{{ $employe->name }}</a></h4>
                                      <div class="text-muted">{{ $employe->position }}</div>
                                    </div>
                                    <div class="d-flex justify-content-center mb-3">
                                        <div>
                                            <button class="btn btn-white btn-sm edit-modal-btn" data-id="{{ $employe->id }}" data-name="{{ $employe->name }}" data-position="{{ $employe->position }}" data-email="{{ $employe->email }}" data-phone="{{ $employe->phone }}"><i class="fe fe-edit"></i></button>
                                            <button class="btn btn-white btn-sm delete-modal-btn" data-id="{{ $employe->id }}"><i class="fe fe-trash text-danger"></i></button>
                                        </div>
                                    </div>
                                    <div class="d-flex" style="font-size: .9rem">
                                      <a href="mailto:{{ $employe->email }}" class="card-btn"><i class="fe fe-mail"></i> Email</a>
                                      <a href="tel:{{ $employe->phone }}" class="card-btn"><i class="fe fe-phone"></i> Telefon</a>
                                    </div>
                                  </div>
                            </div>
                            @endforeach
                            @else
                                
                            @endif
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <form action="{{ route('create_employe') }}" method="POST" class="card-body">
                                        @csrf
                                        <div class="card-title">Anggota Baru</div>
                                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="name" required class="form-control" name="name" placeholder="Nama">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Jabatan</label>
                                            <input type="position" class="form-control" name="position" placeholder="Jabatan">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Telefon</label>
                                            <input type="numeric" class="form-control" name="phone" placeholder="Telefon">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary">Simpan</button>
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
<div class="modal modal-blur fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-primary">
                <h5 class="modal-title font-weight-bold" id="editModalLabel"><i class="fe fe-edit"></i> Ubah Informasi Dewan</h5>
                <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('update_employe') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="employe_id">
                    <div class="form-group mb-3">
                        <label class="form-label">Nama</label>
                        <input type="name" required class="form-control name" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="position" class="form-control position" name="position" placeholder="Jabatan">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Telefon</label>
                        <input type="numeric" class="form-control phone" name="phone" placeholder="Telefon">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light shadow-secondary mr-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary text-light shadow-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-danger">
                <h5 class="modal-title font-weight-bold" id="deleteModalLabel"><i class="fe fe-alert-triangle"></i> Hapus Dewan</h5>
                <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin menghapus dewan ini?</p>
                <form action="{{ route('delete_employe') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="employe_id">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light shadow-secondary mr-2" data-bs-dismiss="modal">Batal</button>
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
        let editMdlBtn = $('.edit-modal-btn');
        let editMdl = new bootstrap.Modal($('#editModal'))
        editMdlBtn.on('click', function() {
            $('.employe_id').val($(this).data('id'))
            $('.name').val($(this).data('name'))
            $('.position').val($(this).data('position'))
            $('.email').val($(this).data('email'))
            $('.phone').val($(this).data('phone'))
            editMdl.show()
        })

        let deleteMdlBtn = $('.delete-modal-btn');
        let deleteMdl = new bootstrap.Modal($('#deleteModal'))
        deleteMdlBtn.on('click', function() {
            $('input[name=employe_id]').val($(this).data('id'))
            deleteMdl.show()
        })
    </script>
@endsection