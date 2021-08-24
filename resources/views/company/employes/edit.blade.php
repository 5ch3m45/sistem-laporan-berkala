@extends('components.layout')
@section('content')
<div class="container body">
    <div class="main_container">
        <x-sidenav companyid="{{ $company->id }}" active="informasi" />
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
                            <li class="breadcrumb-item active" aria-current="page">EDIT ANGGOTA</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Edit Anggota</h2>
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
                                <form method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="inputName" class="form-label">Nama</label>
                                            <input type="text" name="name" required id="inputName" class="form-control" value="{{ $employe->name }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputPosition" class="form-label">Posisi</label>
                                            <input type="text" name="position" required id="inputPosition" class="form-control" value="{{ $employe->position }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <label for="inputPhone" class="form-label">Nomor HP</label>
                                            <input type="number" name="phone" id="inputPhone" class="form-control" value="{{ $employe->phone }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputEmail" class="form-label">Email</label>
                                            <input type="email" name="email" id="inputEmail" class="form-control" value="{{ $employe->email }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="cp" {{ $employe->is_contact_person == 1 ? 'checked' : '' }}> <strong>Contact person</strong> *centang jika ya
                                            </label>
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
            </div>
        </div>
    </div>
</div>
@endsection