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
                            <li class="breadcrumb-item active" aria-current="page">SEMUA ANGGOTA</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                {{ \Session::get('success') }}
            </div>
            @endif
            @if (\Session::has('error'))
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                {{ \Session::get('error') }}
            </div>
            @endif
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Tambah Anggota</h2>
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
                            <div>
                                <form action="{{ route('create_employe', ['company' => $company->id]) }}" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="inputName" class="form-label">Nama</label>
                                            <input type="text" name="name" required id="inputName" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputPosition" class="form-label">Posisi</label>
                                            <input type="text" name="position" required id="inputPosition" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <label for="inputPhone" class="form-label">Nomor HP</label>
                                            <input type="number" name="phone" id="inputPhone" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputEmail" class="form-label">Email</label>
                                            <input type="email" name="email" id="inputEmail" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="cp"> <strong>Contact person</strong> *centang jika ya
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
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Semua Anggota</h2>
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
                                        <th>Posisi</th>
                                        <th>Nomor HP</th>
                                        <th>Email</th>
                                        <th style="width: 12rem">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($company->employes) < 1)
                                    <tr>
                                        <td colspan="5">Belum ada data</td>
                                    </tr>
                                    @else
                                        @foreach ($company->employes as $employe)
                                        <tr>
                                            <th scope="row">{{ $employe->name }} <span class="text-primary">{{ $employe->is_contact_person == 1 ? '*CP' : '' }}</span></th>
                                            <td>{{ $employe->position }}</td>
                                            <td>{{ $employe->phone }}</td>
                                            <td>{{ $employe->email }}</td>
                                            <td id="Employe{{ $employe->id }}">
                                                <p class="mb-0">
                                                    <a class="mr-1" href="{{ route('update_employe', ['company' => $company->id, 'employe' => $employe->id]) }}"><i class="fa fa-pencil"></i> Ubah</a> | 
                                                    <span name="delete" class="delete-button text-danger" data-id="{{ $employe->id }}" type="button"><i class="fa fa-trash"></i> Hapus</span>
                                                    <span name="cancel" class="delete-button d-none" data-id="{{ $employe->id }}" type="button"><i class="fa fa-times"></i> Batal</>
                                                </p>
                                                <form class="mt-2 d-none" data-id="{{ $employe->id }}" action="{{ route('delete_employe', ['company' => $company->id, 'employe' => $employe->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger text-light w-100" type="submit"><i class="fa fa-trash"></i> Hapus sekarang</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <hr>
                            <div class="d-flex justify-content-end">
                                {{-- {{ $employe->links('pagination::bootstrap-4') }} --}}
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
        let deleteBtn = $('.delete-button');
        deleteBtn.click(function() {
            let id = $(this).data('id');
            $(`td[id=Employe${id}] > p > span[name=delete]`).toggleClass('d-none')
            $(`td[id=Employe${id}] > p > span[name=cancel]`).toggleClass('d-none')
            $(`td[id=Employe${id}] > form`).toggleClass('d-none')
        })


    </script>
@endsection