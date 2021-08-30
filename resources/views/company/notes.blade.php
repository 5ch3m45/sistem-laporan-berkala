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
                                Catatan
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
                        <x-company-sidebar :company="$company" active="catatan" />
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="divide-y">
                                            @php
                                                function nameAlias($name) {
                                                    $alias = array();
                                                    foreach (explode(' ', $name) as $string) {
                                                        array_push($alias, strtoupper($string[0]));
                                                    }
                                                    return implode($alias);
                                                }
                                            @endphp
                                            @if (count($company->notes) > 0)
                                            @foreach ($company->notes()->orderByDesc('id')->get() as $note)
                                            <div>
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class="avatar">{{ nameAlias($note->user->name) }}</span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-truncate">
                                                            <p class="mb-0"><strong>{{ $note->user->name }}</strong></p>
                                                            <p class="mb-0">{{ $note->note }}</p>
                                                        </div>
                                                        <div class="text-muted">{{ $note->created_at }}</div>
                                                    </div>
                                                    <div class="col-auto align-self-center">
                                                        <button class="btn btn-white btn-sm delete-modal-btn" data-id="{{ $note->id }}"><i class="fe fe-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
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
                                    <form action="{{ route('create_note') }}" class="card-body" method="POST">
                                        @csrf
                                        <div class="card-title">Buat Catatan Baru</div>
                                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Catatan</label>
                                            <textarea name="note" id="" rows="3" placeholder="Catatan baru..." class="form-control"></textarea>
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
            <div class="modal-header text-danger">
                <h5 class="modal-title font-weight-bold" id="deleteModalLabel"><i class="fe fe-alert-triangle"></i> Hapus Berkas</h5>
                <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin menghapus catatan ini?</p>
                <form action="{{ route('delete_note') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="note_id">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light shadow-secondary mr-3" data-bs-dismiss="modal">Batal</button>
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
            $('input[name=note_id]').val($(this).data('id'))
            deleteMdl.show()
        })
    </script>
@endsection