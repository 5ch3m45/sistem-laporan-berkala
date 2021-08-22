@extends('components.layout')

@section('title', 'Perusahaan')

@section('content')
<x-navbar />
<div class="container my-4">
    <div class="row">
        <div class="col-md-19">
            <x-session-alert />
            <div class="card border-0 shadow-secondary">
                <div class="card-body">
                    <h6 class="card-title fw-bold">CATATAN PERUSAHAAN</h6>
                    <hr>
                    <p class="fw-bold">Informasi perusahaan</p>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p>Nama perusahaan</p>
                        </div>
                        <div class="col-md-18">{{ $company->name }}</div>
                    </div>
                    <p class="fw-bold">Semua catatan</p>
                    <div>
                        @if (count($notes) < 1)
                            <p class="mb-0">Belum ada catatan...</p>
                        @else
                            @foreach ($notes as $note)
                            <div class="mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <p class="fw-bold mb-0 text-uppercase">{{ $note->user->name }}</p>
                                        <small class="text-muted">{{ $note->created_at }}</small>
                                        <p class="mb-0">{{ $note->note }}</p>
                                        @if ($note->user_id == Auth::id())
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('edit_note', ['company' => $company->id, 'note' => $note->id]) }}" class="btn btn-warning text-light shadow-warning btn-sm rounded me-2">Ubah</a>
                                            <a href="{{ route('delete_note', ['company' => $company->id, 'note' => $note->id]) }}" class="btn btn-danger text-light shadow-danger btn-sm rounded">Hapus</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <x-company-sidebar cid="{{ isset($company) ? $company->id : null }}" active="company_notes" />
        </div>
    </div>
</div>
@endsection