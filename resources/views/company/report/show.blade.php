@extends('components.layout')
@section('content')
<div class="container body">
    <div class="main_container">
        <x-sidenav companyid="{{ $company->id }}" active="laporan" />
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
                            <li class="breadcrumb-item"><a href="{{ route('report', ['company' => $company->id]) }}">LAPORAN TRIWULAN</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ 'TRIWULAN '.$report->quarter.' TAHUN '.$report->year }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Laporan Triwulan {{ $report->quarter }} Tahun {{ $report->year }}</h2>
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
                            <table id="tree" class="table table-hover table-borderless" style="font-size: .9rem; border:0">
                                <tbody>
                                    @foreach (\App\Models\Account::get() as $account)
                                        <tr data-tt-id="{{ $account->id }}" data-tt-parent-id="{{ $account->parent_id }}">
                                            <td class="py-2">{{ Str::title($account->description) }}</td>
                                            <td class="py-2">
                                                @php
                                                    $company_report = \App\Models\CompanyReport::where('report_id', $report->id)->where('account_code', $account->code)->first();
                                                    if($company_report){
                                                        echo number_format($company_report->value, 0, ',', '.');
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        $("#tree").treetable({ 
            expandable: true,
            initialState: 'expanded'
        });
    </script>
@endsection