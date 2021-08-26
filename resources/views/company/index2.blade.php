@extends('components.layout')
@section('content')
<div class="container body">
    <div class="main_container">
        <x-sidenav active="perusahaan" />
        <x-topnav />
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <div class="text-wrap">
                        <h4>SEMUA PERUSAHAAN</h4>
                    </div>
                </div>
                <div class="col-md-4 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">DASHBOARD</a></li>
                            <li class="breadcrumb-item active" aria-current="page">SEMUA PERUSAHAAN</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="x_panel tile">
                <div class="x_title">
                    <h2>Halaman {{ $companies->currentPage() }}/{{ $companies->lastPage() }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-12 col-sm-12 ">
                        <table class="table table-striped table-hover">
                            <thead style="background-color: #2A3F54">
                                <tr class="text-light">
                                    <th>Nama perusahaan</th>
                                    <th>Regional</th>
                                    <th>Jml Outlet</th>
                                    <th>Email</th>
                                    <th>Telefon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($companies) < 1) <tr>
                                    <td colspan="5">Belum ada data...</td>
                                    </tr>
                                    @else
                                    @foreach ($companies as $company)
                                    <tr>
                                        <td>
                                            <a href="{{ route('show_company', ['company' => $company->id]) }}">
                                                {{ $company->name }}
                                            </a>
                                        </td>
                                        <td>{{ $company->regional }}</td>
                                        <td>{{ $company->outlet }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->phone }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                            </tbody>
                        </table>
                        {{ $companies->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@endsection