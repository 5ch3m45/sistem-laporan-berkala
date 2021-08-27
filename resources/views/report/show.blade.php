@extends('components.layout')

@section('head-js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-treetable/3.2.0/css/jquery.treetable.min.css" integrity="sha512-rzpvh46q/W37FDIdBxK79gy/fWoZWQiwUUQOCGm58XKsdVAjtYK1TZ4nSbLZWbqiS3hxsw3Dg/E67BOQbaEs5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-treetable/3.2.0/css/jquery.treetable.theme.default.min.css" integrity="sha512-+QlAY2+q9M7bP5NBnGKrBO5u/asZTHsHJ8yVvw/opoi50KZube+tfc3ojM5MHa0d+vTorqu3Mf/IKyTyxWWbzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

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
                                Laporan
                            </div>
                            <h2 class="page-title">
                                {{ $report->company->name }} Tahun {{ $report->year }} Triwulan {{ $report->quarter }}
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="ml-auto">
                        </div>
                    </div>
                </div>
                <div class="row row-cards row-deck">
                    <div class="col-3">
                        <x-report-sidebar :report="$report"/>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="d-flex justify-content-end">
                                                *dalam ribu rupiah
                                            </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">Laporan Lain</div>
                                        <div>
                                            @foreach ($report->company->reports()->orderByDesc('year')->orderByDesc('quarter')->limit(5)->get() as $other_report)
                                            <div class="mb-2 border-bottom py-1">
                                                <i class="fe fe-file-text"></i>
                                                <a href="" class="text-decoration-none text-dark">Tahun {{ $other_report->year }} Triwulan {{ $other_report->quarter }}</a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
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
@endsection

@section('foot-js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-treetable/3.2.0/jquery.treetable.min.js" integrity="sha512-2pYVakljd2zLnVvVC264Ib+XGvOvu3iFyKCIwLzn77mfbjuVi1dGJUxGjDAI8MjgPgTfSIM/vZirW04LCQmY2Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            $("#tree").treetable({ 
                expandable: true,
                initialState: 'expanded'
            });
        })
    </script>
@endsection