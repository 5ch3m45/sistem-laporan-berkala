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
                            <li class="breadcrumb-item active" aria-current="page">UBAH CATATAN</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Ubah Catatan</h2>
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
                                <form action="{{ route('edit_note', ['company' => $company->id, 'note' => $note->id]) }}" method="post">
                                    @csrf
                                    <label for="">Catatan</label>
                                    <textarea name="note" class="resizable_textarea form-control mb-3" row="3" placeholder="{{ $note->note }}">{{ $note->note }}</textarea>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('note', ['company' => $company->id, 'note' => $note->id]) }}" class="btn btn-sm btn-light">Batal</a>
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </div>
                                </form>
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