@extends('components.layout')
@section('content')
<div class="container body">
    <div class="main_container">
        <x-sidenav companyid="1" active="catatan" />
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
                            <li class="breadcrumb-item active" aria-current="page">SEMUA CATATAN</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Semua Catatan</h2>
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
                                <form action="{{ route('create_note', ['company' => $company->id]) }}" method="post">
                                    @csrf
                                    <label for="">Catatan baru</label>
                                    <textarea name="note" class="resizable_textarea form-control mb-3" row="3" placeholder="Isi catatan baru..."></textarea>
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-sm btn-light">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                            <hr>
                            <ul class="messages">
                                @foreach ($notes as $note)
                                <li>
                                    <img src="/images/user.png" class="avatar" alt="Avatar">
                                    <div class="message_date">
                                        <h3 class="date text-info">{{ date('j', strtotime($note->created_at)) }}</h3>
                                        <p class="month">{{ date('F', strtotime($note->created_at)) }}</p>
                                    </div>
                                    <div class="message_wrapper">
                                        <h4 class="heading">{{ $note->user->name }}</h4>
                                        <blockquote class="message mb-3 text-dark">{{ $note->note }}</blockquote>
                                        <div>
                                            @if($note->user_id == \Auth::id())
                                            <div>
                                                <a href="{{ route('edit_note', ['company' => $company->id, 'note' => $note->id]) }}" class="btn btn-link btn-sm text-muted"><i class="fa fa-pencil"></i> Ubah Catatan</a> | <button class="btn btn-link btn-sm text-danger note-delete-button" data-note-id="{{ $note->id }}"><i class="fa fa-trash"></i> Hapus catatan</bu>
                                            </div>
                                            <div class="mt-3 note-delete-confirmation-{{ $note->id }} d-none">
                                                <div class="alert alert-danger" role="alert">
                                                    <p class="mb-0">Apakah Anda yakin? <a href="{{ route('delete_note', ['company' => $company->id, 'note' => $note->id]) }}" class="btn btn-link btn-sm my-0 text-light">Ya</a> | <button class="btn btn-link btn-sm my-0 text-light note-cancel-delete-button" data-note-id="{{ $note->id }}">Tidak</button></p>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                </li>
                                @endforeach
                            </ul>
                            <hr>
                            <div class="d-flex justify-content-end">
                                {{ $notes->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    let note_delete_button = $('.note-delete-button')
    let note_cancel_delete_button = $('.note-cancel-delete-button')

    function toggleView(note_id) {
        return $(`.note-delete-confirmation-${note_id}`).toggleClass('d-none')
    }

    note_delete_button.click(function() {
        let note_id = $(this).data('note-id');
        toggleView(note_id);
    });

    note_cancel_delete_button.click(function() {
        let note_id = $(this).data('note-id');
        toggleView(note_id);
    });
</script>
@endsection