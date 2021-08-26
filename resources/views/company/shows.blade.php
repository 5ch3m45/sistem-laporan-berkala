@extends('components.layout')
@section('content')
<div class="container body">
    <div class="main_container">
        <x-sidenav companyid="1" active="informasi" />
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ $company->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">INFORMASI PERUSAHAAN</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Informasi Perusahaan</h2>
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
                            <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nama Perusahaan</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" readonly class="form-control" value="{{ $company->name }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="regional">Wilayah Operasional</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="regional" readonly name="regional" required="required" class="form-control" value="{{ $company->regional }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="outlet" class="col-form-label col-md-3 col-sm-3 label-align">Jumlah Unit Layanan</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="outlet" class="form-control" readonly type="text" name="outlet" value="{{ $company->outlet }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="address" class="col-form-label col-md-3 col-sm-3 label-align">Alamat</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea class="form-control" readonly name="" id="">{{ $company->add_road.', '.$company->add_village.', '.$company->add_subdistrict.', '.$company->add_regency.', '.$company->add_province.', '.$company->add_postalcode }}</textarea>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="email" class="form-control" readonly type="text" name="email" value="{{ $company->email }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="phone" class="col-form-label col-md-3 col-sm-3 label-align">Telefon</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="phone" class="form-control" readonly type="text" name="phone" value="{{ $company->phone }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="birthdate" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pendirian</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="birthdate" class="form-control" readonly type="text" name="birthdate" value="{{ $company->birthdate }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="license" class="col-form-label col-md-3 col-sm-3 label-align">Izin Usaha</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="license" class="form-control" readonly type="text" name="license" value="{{ $company->lic_number.' ('.$company->lic_date.')' }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="tax" class="col-form-label col-md-3 col-sm-3 label-align">NPWP</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="tax" class="form-control" readonly type="text" name="tax" value="{{ $company->tax_number }}">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <button class="btn btn-danger" type="reset">Hapus</button>
                                        <a href="{{ route('edit_company', ['company' => $company->id]) }}" class="btn btn-success">Ubah</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection