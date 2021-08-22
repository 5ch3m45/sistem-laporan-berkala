@extends('components.layout')
@section('content')
<div class="container body">
  <div class="main_container">
    <x-sidenav companyid="1" />
    <x-topnav/>
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ $company->name }}</h3>
            </div>
          </div>
      <div class="x_panel tile">
        <div class="x_content">
            <form action="{{ route('edit_company', ['company' => $company->id]) }}" method="POST" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                @csrf
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nama Perusahaan</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="name" name="name" class="form-control" value="{{ $company->name }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="regional">Wilayah Operasional</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="regional" name="regional" required="required" class="form-control" value="{{ $company->regional }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label for="outlet" class="col-form-label col-md-3 col-sm-3 label-align">Jumlah Unit Layanan</label>
                    <div class="col-md-2 col-sm-6 ">
                        <input id="outlet" class="form-control" type="number" name="outlet" value="{{ $company->outlet }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">Alamat</label>
                    <div class="col-md-2 col-sm-2 ">
                        <input id="add_postalcode" class="form-control" type="number" name="add_postalcode" value="{{ $company->add_postalcode }}" placeholder="Kodepos">
                    </div>
                    <div class="col-md-4 col-sm-4 ">
                        <input id="add_province" class="form-control" type="text" name="add_province" value="{{ $company->add_province }}" placeholder="Provinsi">
                    </div>
                </div>
                <div class="item form-group">
                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 ">
                        <input id="add_regency" class="form-control" type="text" name="add_regency" value="{{ $company->add_regency }}" placeholder="Kabupaten">
                    </div>
                    <div class="col-md-2 col-sm-2 ">
                        <input id="add_subdistrict" class="form-control" type="text" name="add_subdistrict" value="{{ $company->add_subdistrict }}" placeholder="Provinsi">
                    </div>
                    <div class="col-md-2 col-sm-2 ">
                        <input id="add_village" class="form-control" type="text" name="add_village" value="{{ $company->add_village }}" placeholder="Provinsi">
                    </div>
                </div>
                <div class="item form-group">
                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">&nbsp;</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input id="add_road" class="form-control" type="text" name="add_road" value="{{ $company->add_road }}" placeholder="Alamat">
                    </div>
                </div>

                <div class="item form-group">
                    <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input id="email" class="form-control" type="email" name="email" value="{{ $company->email }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label for="phone" class="col-form-label col-md-3 col-sm-3 label-align">Telefon</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input id="phone" class="form-control" type="text" name="phone" value="{{ $company->phone }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label for="birthdate" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pendirian</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input id="birthdate" class="form-control" type="date" name="birthdate" value="{{ $company->birthdate }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label for="" class="col-form-label col-md-3 col-sm-3 label-align">Izin Usaha</label>
                    <div class="col-md-3 col-sm-3 ">
                        <input id="lic_number" class="form-control" type="text" name="lic_number" value="{{ $company->lic_number }}">
                    </div>
                    <div class="col-md-3 col-sm-3 ">
                        <input id="lic_date" class="form-control" type="date" name="lic_date" value="{{ $company->lic_date }}">
                    </div>
                </div>
                <div class="item form-group">
                    <label for="tax_number" class="col-form-label col-md-3 col-sm-3 label-align">NPWP</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input id="tax_number" class="form-control" type="text" name="tax_number" value="{{ $company->tax_number }}">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <a href="{{ route('show_company', ['company' => $company->id]) }}" class="btn btn-danger" type="reset">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
@endsection