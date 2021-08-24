@extends('components.layout')
@section('content')
<div class="container body">
    <div class="main_container">
        <x-sidenav companyid="{{ $company->id }}" active="analisis" />
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
                            <li class="breadcrumb-item active" aria-current="page">ANALISIS TAHUNAN</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Laporan Triwulan</h2>
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
                            <div id="dataNotEnoughAlert" class="alert alert-danger alert-dismissible d-none" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <p class="mb-0">Data tidak mencukupi</p>
                            </div>
                            <div>
                                <div>
                                    <div class="row mb-3">
                                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                                        <div class="col-md-4">
                                            <label for="inputYear" class="form-label">Tahun</label>
                                            <input type="number" name="year" id="inputYear" class="form-control w-100" value="{{ $latest_report->year }}">
                                            <small>*Pilih periode akhir analisa</small>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputQuarter" class="form-label">Triwulan</label>
                                            <input type="number" name="quarter" id="inputQuarter" class="form-control w-100" value="{{ $latest_report->quarter }}">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" id="quarterSelect" class="btn btn-sm btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Analisis Tahunan</h2>
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
                            <div class="table-responsive">
                                <table class="table table-border table-hover" style="font-size:.7rem;">
                                    @php
                                        $quarter_to_analyze = [17, 18, 19, 20, 21];
                                    @endphp
                                    <thead style="background-color: #2A3F54">
                                        <tr class="text-light">
                                            <th>Keterangan</th>
                                            <th>Triwulan 1 2020</th>
                                            <th>Triwulan 2 2020</th>
                                            <th>Triwulan 3 2020</th>
                                            <th>Triwulan 4 2020</th>
                                            <th>Triwulan 1 2021</th>
                                            <th>Y-o-Y</th>
                                            <th>q-t-q (1)</th>
                                            <th>q-t-q (2)</th>
                                            <th>q-t-q (3)</th>
                                            <th>q-t-q (4)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kas dan setara kas</td>
                                            <td id="ksk_q1"></td>
                                            <td id="ksk_q2"></td>
                                            <td id="ksk_q3"></td>
                                            <td id="ksk_q4"></td>
                                            <td id="ksk_q5"></td>
                                            <td id="ksk_yoy"></td>
                                            <td id="ksk_qtq1"></td>
                                            <td id="ksk_qtq2"></td>
                                            <td id="ksk_qtq3"></td>
                                            <td id="ksk_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Pinjaman yang diberikan</td>
                                            <td class="pdg_q1"></td>
                                            <td class="pdg_q2"></td>
                                            <td class="pdg_q3"></td>
                                            <td class="pdg_q4"></td>
                                            <td class="pdg_q5"></td>
                                            <td class="pdg_yoy"></td>
                                            <td class="pdg_qtq1"></td>
                                            <td class="pdg_qtq2"></td>
                                            <td class="pdg_qtq3"></td>
                                            <td class="pdg_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Aset lancar lainnya</td>
                                            <td id="all_q1"></td>
                                            <td id="all_q2"></td>
                                            <td id="all_q3"></td>
                                            <td id="all_q4"></td>
                                            <td id="all_q5"></td>
                                            <td id="all_yoy"></td>
                                            <td id="all_qtq1"></td>
                                            <td id="all_qtq2"></td>
                                            <td id="all_qtq3"></td>
                                            <td id="all_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Aset lancar</td>
                                            <td id="al_q1"></td>
                                            <td id="al_q2"></td>
                                            <td id="al_q3"></td>
                                            <td id="al_q4"></td>
                                            <td id="al_q5"></td>
                                            <td id="al_yoy"></td>
                                            <td id="al_qtq1"></td>
                                            <td id="al_qtq2"></td>
                                            <td id="al_qtq3"></td>
                                            <td id="al_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Aset tidak lancar</td>
                                            <td id="atl_q1"></td>
                                            <td id="atl_q2"></td>
                                            <td id="atl_q3"></td>
                                            <td id="atl_q4"></td>
                                            <td id="atl_q5"></td>
                                            <td id="atl_yoy"></td>
                                            <td id="atl_qtq1"></td>
                                            <td id="atl_qtq2"></td>
                                            <td id="atl_qtq3"></td>
                                            <td id="atl_qtq4"></td>
                                        </tr>
                                        <tr style="background-color: #eee" class="font-weight-bold">
                                            <td>Total Aset</td>
                                            <td id="ta_q1"></td>
                                            <td id="ta_q2"></td>
                                            <td id="ta_q3"></td>
                                            <td id="ta_q4"></td>
                                            <td id="ta_q5"></td>
                                            <td id="ta_yoy"></td>
                                            <td id="ta_qtq1"></td>
                                            <td id="ta_qtq2"></td>
                                            <td id="ta_qtq3"></td>
                                            <td id="ta_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Liabilitas lancar</td>
                                            <td id="ll_q1"></td>
                                            <td id="ll_q2"></td>
                                            <td id="ll_q3"></td>
                                            <td id="ll_q4"></td>
                                            <td id="ll_q5"></td>
                                            <td id="ll_yoy"></td>
                                            <td id="ll_qtq1"></td>
                                            <td id="ll_qtq2"></td>
                                            <td id="ll_qtq3"></td>
                                            <td id="ll_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Liabilitas tidak lancar</td>
                                            <td id="ltl_q1"></td>
                                            <td id="ltl_q2"></td>
                                            <td id="ltl_q3"></td>
                                            <td id="ltl_q4"></td>
                                            <td id="ltl_q5"></td>
                                            <td id="ltl_yoy"></td>
                                            <td id="ltl_qtq1"></td>
                                            <td id="ltl_qtq2"></td>
                                            <td id="ltl_qtq3"></td>
                                            <td id="ltl_qtq4"></td>
                                        </tr>
                                        <tr style="background-color: #eee" class="font-weight-bold">
                                            <td>Total Liabilitas</td>
                                            <td id="tl_q1"></td>
                                            <td id="tl_q2"></td>
                                            <td id="tl_q3"></td>
                                            <td id="tl_q4"></td>
                                            <td id="tl_q5"></td>
                                            <td id="tl_yoy"></td>
                                            <td id="tl_qtq1"></td>
                                            <td id="tl_qtq2"></td>
                                            <td id="tl_qtq3"></td>
                                            <td id="tl_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Modal disetor</td>
                                            <td id="md_q1"></td>
                                            <td id="md_q2"></td>
                                            <td id="md_q3"></td>
                                            <td id="md_q4"></td>
                                            <td id="md_q5"></td>
                                            <td id="md_yoy"></td>
                                            <td id="md_qtq1"></td>
                                            <td id="md_qtq2"></td>
                                            <td id="md_qtq3"></td>
                                            <td id="md_qtq4"></td>
                                        </tr>
                                        <tr class="text-nowrap">
                                            <td>Saldo laba/(rugi)</td>
                                            <td id="slr_q1"></td>
                                            <td id="slr_q2"></td>
                                            <td id="slr_q3"></td>
                                            <td id="slr_q4"></td>
                                            <td id="slr_q5"></td>
                                            <td id="slr_yoy"></td>
                                            <td id="slr_qtq1"></td>
                                            <td id="slr_qtq2"></td>
                                            <td id="slr_qtq3"></td>
                                            <td id="slr_qtq4"></td>
                                        </tr>
                                        <tr class="text-nowrap">
                                            <td>Saldo laba/(rugi) awal tahun</td>
                                            <td id="slrat_q1"></td>
                                            <td id="slrat_q2"></td>
                                            <td id="slrat_q3"></td>
                                            <td id="slrat_q4"></td>
                                            <td id="slrat_q5"></td>
                                            <td id="slrat_yoy"></td>
                                            <td id="slrat_qtq1"></td>
                                            <td id="slrat_qtq2"></td>
                                            <td id="slrat_qtq3"></td>
                                            <td id="slrat_qtq4"></td>
                                        </tr>
                                        <tr class="text-nowrap">
                                            <td>Laba/(rugi) tahun berjalan</td>
                                            <td id="lrtb_q1"></td>
                                            <td id="lrtb_q2"></td>
                                            <td id="lrtb_q3"></td>
                                            <td id="lrtb_q4"></td>
                                            <td id="lrtb_q5"></td>
                                            <td id="lrtb_yoy"></td>
                                            <td id="lrtb_qtq1"></td>
                                            <td id="lrtb_qtq2"></td>
                                            <td id="lrtb_qtq3"></td>
                                            <td id="lrtb_qtq4"></td>
                                        </tr>
                                        <tr style="background-color: #eee" class="font-weight-bold">
                                            <td>Total Ekuitas</td>
                                            <td id="te_q1"></td>
                                            <td id="te_q2"></td>
                                            <td id="te_q3"></td>
                                            <td id="te_q4"></td>
                                            <td id="te_q5"></td>
                                            <td id="te_yoy"></td>
                                            <td id="te_qtq1"></td>
                                            <td id="te_qtq2"></td>
                                            <td id="te_qtq3"></td>
                                            <td id="te_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Pendapatan imbal jasa/imbal hasil</td>
                                            <td id="pijih_q1"></td>
                                            <td id="pijih_q2"></td>
                                            <td id="pijih_q3"></td>
                                            <td id="pijih_q4"></td>
                                            <td id="pijih_q5"></td>
                                            <td id="pijih_yoy"></td>
                                            <td id="pijih_qtq1"></td>
                                            <td id="pijih_qtq2"></td>
                                            <td id="pijih_qtq3"></td>
                                            <td id="pijih_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Pendapatan administrasi</td>
                                            <td id="pa_q1"></td>
                                            <td id="pa_q2"></td>
                                            <td id="pa_q3"></td>
                                            <td id="pa_q4"></td>
                                            <td id="pa_q5"></td>
                                            <td id="pa_yoy"></td>
                                            <td id="pa_qtq1"></td>
                                            <td id="pa_qtq2"></td>
                                            <td id="pa_qtq3"></td>
                                            <td id="pa_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Pendapatan operasional</td>
                                            <td id="po_q1"></td>
                                            <td id="po_q2"></td>
                                            <td id="po_q3"></td>
                                            <td id="po_q4"></td>
                                            <td id="po_q5"></td>
                                            <td id="po_yoy"></td>
                                            <td id="po_qtq1"></td>
                                            <td id="po_qtq2"></td>
                                            <td id="po_qtq3"></td>
                                            <td id="po_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Pendapatan non operasional</td>
                                            <td id="pno_q1"></td>
                                            <td id="pno_q2"></td>
                                            <td id="pno_q3"></td>
                                            <td id="pno_q4"></td>
                                            <td id="pno_q5"></td>
                                            <td id="pno_yoy"></td>
                                            <td id="pno_qtq1"></td>
                                            <td id="pno_qtq2"></td>
                                            <td id="pno_qtq3"></td>
                                            <td id="pno_qtq4"></td>
                                        </tr>
                                        <tr style="background-color: #eee" class="font-weight-bold">
                                            <td>Jumlah pendapatan</td>
                                            <td id="jp_q1"></td>
                                            <td id="jp_q2"></td>
                                            <td id="jp_q3"></td>
                                            <td id="jp_q4"></td>
                                            <td id="jp_q5"></td>
                                            <td id="jp_yoy"></td>
                                            <td id="jp_qtq1"></td>
                                            <td id="jp_qtq2"></td>
                                            <td id="jp_qtq3"></td>
                                            <td id="jp_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Beban operasional</td>
                                            <td id="bo_q1"></td>
                                            <td id="bo_q2"></td>
                                            <td id="bo_q3"></td>
                                            <td id="bo_q4"></td>
                                            <td id="bo_q5"></td>
                                            <td id="bo_yoy"></td>
                                            <td id="bo_qtq1"></td>
                                            <td id="bo_qtq2"></td>
                                            <td id="bo_qtq3"></td>
                                            <td id="bo_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Beban non operasional</td>
                                            <td id="bno_q1"></td>
                                            <td id="bno_q2"></td>
                                            <td id="bno_q3"></td>
                                            <td id="bno_q4"></td>
                                            <td id="bno_q5"></td>
                                            <td id="bno_yoy"></td>
                                            <td id="bno_qtq1"></td>
                                            <td id="bno_qtq2"></td>
                                            <td id="bno_qtq3"></td>
                                            <td id="bno_qtq4"></td>
                                        </tr>
                                        <tr style="background-color: #eee" class="font-weight-bold">
                                            <td>Jumlah Beban</td>
                                            <td id="jb_q1"></td>
                                            <td id="jb_q2"></td>
                                            <td id="jb_q3"></td>
                                            <td id="jb_q4"></td>
                                            <td id="jb_q5"></td>
                                            <td id="jb_yoy"></td>
                                            <td id="jb_qtq1"></td>
                                            <td id="jb_qtq2"></td>
                                            <td id="jb_qtq3"></td>
                                            <td id="jb_qtq4"></td>
                                        </tr>
                                        <tr style="background-color: #eee" class="font-weight-bold">
                                            <td>Laba/(rugi) Sebelum Pajak</td>
                                            <td id="lrsp_q1"></td>
                                            <td id="lrsp_q2"></td>
                                            <td id="lrsp_q3"></td>
                                            <td id="lrsp_q4"></td>
                                            <td id="lrsp_q5"></td>
                                            <td id="lrsp_yoy"></td>
                                            <td id="lrsp_qtq1"></td>
                                            <td id="lrsp_qtq2"></td>
                                            <td id="lrsp_qtq3"></td>
                                            <td id="lrsp_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Taksiran pajak penghasilan</td>
                                            <td id="tpp_q1"></td>
                                            <td id="tpp_q2"></td>
                                            <td id="tpp_q3"></td>
                                            <td id="tpp_q4"></td>
                                            <td id="tpp_q5"></td>
                                            <td id="tpp_yoy"></td>
                                            <td id="tpp_qtq1"></td>
                                            <td id="tpp_qtq2"></td>
                                            <td id="tpp_qtq3"></td>
                                            <td id="tpp_qtq4"></td>
                                        </tr>
                                        <tr style="background-color: #eee" class="font-weight-bold">
                                            <td>Laba/(rugi) Periode Berjalan</td>
                                            <td id="lrpb_q1"></td>
                                            <td id="lrpb_q2"></td>
                                            <td id="lrpb_q3"></td>
                                            <td id="lrpb_q4"></td>
                                            <td id="lrpb_q5"></td>
                                            <td id="lrpb_yoy"></td>
                                            <td id="lrpb_qtq1"></td>
                                            <td id="lrpb_qtq2"></td>
                                            <td id="lrpb_qtq3"></td>
                                            <td id="lrpb_qtq4"></td>
                                        </tr>
                                        <tr style="background-color: #eee" class="font-weight-bold">
                                            <td>Pinjaman yang Diberikan</td>
                                            <td id="pd_q1"></td>
                                            <td id="pd_q2"></td>
                                            <td id="pd_q3"></td>
                                            <td id="pd_q4"></td>
                                            <td id="pd_q5"></td>
                                            <td id="pd_yoy"></td>
                                            <td id="pd_qtq1"></td>
                                            <td id="pd_qtq2"></td>
                                            <td id="pd_qtq3"></td>
                                            <td id="pd_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah pinjaman yang diberikan</td>
                                            <td id="jpd_q1"></td>
                                            <td id="jpd_q2"></td>
                                            <td id="jpd_q3"></td>
                                            <td id="jpd_q4"></td>
                                            <td id="jpd_q5"></td>
                                            <td id="jpd_yoy"></td>
                                            <td id="jpd_qtq1"></td>
                                            <td id="jpd_qtq2"></td>
                                            <td id="jpd_qtq3"></td>
                                            <td id="jpd_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah outstanding gadai</td>
                                            <td class="pdg_q1"></td>
                                            <td class="pdg_q2"></td>
                                            <td class="pdg_q3"></td>
                                            <td class="pdg_q4"></td>
                                            <td class="pdg_q5"></td>
                                            <td class="pdg_yoy"></td>
                                            <td class="pdg_qtq1"></td>
                                            <td class="pdg_qtq2"></td>
                                            <td class="pdg_qtq3"></td>
                                            <td class="pdg_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah nasabah</td>
                                            <td id="jn_q1"></td>
                                            <td id="jn_q2"></td>
                                            <td id="jn_q3"></td>
                                            <td id="jn_q4"></td>
                                            <td id="jn_q5"></td>
                                            <td id="jn_yoy"></td>
                                            <td id="jn_qtq1"></td>
                                            <td id="jn_qtq2"></td>
                                            <td id="jn_qtq3"></td>
                                            <td id="jn_qtq4"></td>
                                        </tr>
                                        <tr class="text-light" style="background-color: #2A3F54">
                                            <td>Rasio-rasio</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><em>Current ratio</em></td>
                                            <td id="cr_q1"></td>
                                            <td id="cr_q2"></td>
                                            <td id="cr_q3"></td>
                                            <td id="cr_q4"></td>
                                            <td id="cr_q5"></td>
                                            <td id="cr_yoy"></td>
                                            <td id="cr_qtq1"></td>
                                            <td id="cr_qtq2"></td>
                                            <td id="cr_qtq3"></td>
                                            <td id="cr_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td><em>Debt to Equity Ratio (DER)</em></td>
                                            <td id="der_q1"></td>
                                            <td id="der_q2"></td>
                                            <td id="der_q3"></td>
                                            <td id="der_q4"></td>
                                            <td id="der_q5"></td>
                                            <td id="der_yoy"></td>
                                            <td id="der_qtq1"></td>
                                            <td id="der_qtq2"></td>
                                            <td id="der_qtq3"></td>
                                            <td id="der_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td><em>Debt to Asset Ratio (DAR)</em></td>
                                            <td id="dar_q1"></td>
                                            <td id="dar_q2"></td>
                                            <td id="dar_q3"></td>
                                            <td id="dar_q4"></td>
                                            <td id="dar_q5"></td>
                                            <td id="dar_yoy"></td>
                                            <td id="dar_qtq1"></td>
                                            <td id="dar_qtq2"></td>
                                            <td id="dar_qtq3"></td>
                                            <td id="dar_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td><em>Return on Asset (RoA)</em></td>
                                            <td id="roa_q1"></td>
                                            <td id="roa_q2"></td>
                                            <td id="roa_q3"></td>
                                            <td id="roa_q4"></td>
                                            <td id="roa_q5"></td>
                                            <td id="roa_yoy"></td>
                                            <td id="roa_qtq1"></td>
                                            <td id="roa_qtq2"></td>
                                            <td id="roa_qtq3"></td>
                                            <td id="roa_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td><em>Return on Equity (RoE)</em></td>
                                            <td id="roe_q1"></td>
                                            <td id="roe_q2"></td>
                                            <td id="roe_q3"></td>
                                            <td id="roe_q4"></td>
                                            <td id="roe_q5"></td>
                                            <td id="roe_yoy"></td>
                                            <td id="roe_qtq1"></td>
                                            <td id="roe_qtq2"></td>
                                            <td id="roe_qtq3"></td>
                                            <td id="roe_qtq4"></td>
                                        </tr>
                                        <tr>
                                            <td><em>BOPO</em></td>
                                            <td id="bopo_q1"></td>
                                            <td id="bopo_q2"></td>
                                            <td id="bopo_q3"></td>
                                            <td id="bopo_q4"></td>
                                            <td id="bopo_q5"></td>
                                            <td id="bopo_yoy"></td>
                                            <td id="bopo_qtq1"></td>
                                            <td id="bopo_qtq2"></td>
                                            <td id="bopo_qtq3"></td>
                                            <td id="bopo_qtq4"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                {{-- {{ $file->links('pagination::bootstrap-4') }} --}}
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
        function formatCurrency(number) {
            return new Intl.NumberFormat('id-ID', {style: 'currency', currency: "IDR"}).format(number)
        }
        function formatNumber(number) {
            return (number).toLocaleString('id-ID', {maximumFractionDigits: 2})
        }

        function extractData(data, account) {
            return data.map(({data}) => {
                return data.find(({account_code}) => account_code == account).value
            })
        }

        function addIndicatorStyle(value) {
            if(value > 30) {
                return {'background-color': '#00c853', 'color': 'white'}
            } else if (value > 5) {
                return {'background-color': '#69f0ae', 'color': 'black'}
            } else if (value < -30) {
                return {'background-color': '#d50000', 'color': 'white'}
            } else if (value < -5) {
                return {'background-color': '#ff5252', 'color': 'white'}
            } else {
                return {'background-color': '#fff'}
            }
        }

        async function getData(company_id, year, quarter) {
            try {
                let response = await axios.get(`http://127.0.0.1:8000/api/v1/perusahaan/${company_id}/analyze`, {
                    params: {
                        'year': year,
                        'quarter': quarter
                    }
                });
                return response.data
            } catch (error) {
                $('#dataNotEnoughAlert').toggleClass('d-none')
            }
        }

        function renderTable(data) {
            let ksk = extractData(data, 'LPK_A_AL_KSK')
            let pdg = extractData(data, 'LO_PDG_TOTAL_OPG')
            let all = extractData(data, 'LPK_A_AL_ALL')
            let al = extractData(data, 'LPK_A_TOTAL_AL')
            let atl = extractData(data, 'LPK_A_TOTAL_ATL')
            let ta = extractData(data, 'LPK_A_TOTAL')
            let ll = extractData(data, 'LPK_L_TOTAL_LL')
            let ltl = extractData(data, 'LPK_L_TOTAL_LTL')
            let tl = extractData(data, 'LPK_L_TOTAL')
            let md = extractData(data, 'LPK_E_MD')
            let slrat = extractData(data, 'LPK_E_SLR_SLRAT')
            let lrtb = extractData(data, 'LPK_E_SLR_LRTB')
            let te = extractData(data, 'LPK_E_TOTAL')
            let pijih = extractData(data, 'LAK_AKDAO_PKD_PJ')
            let pa = extractData(data, 'LAK_AKDAO_PKD_PA')
            let po = extractData(data, 'LRK_P_TOTAL_PO')
            let pno = extractData(data, 'LRK_P_TOTAL_PNO')
            let jp = extractData(data, 'LRK_P_TOTAL')
            let bo = extractData(data, 'LRK_B_TOTAL_BO')
            let bno = extractData(data, 'LRK_B_BNO')
            let jb = extractData(data, 'LRK_B_TOTAL')
            let lrsp = extractData(data, 'LRK_B_LRSP')
            let tpp = extractData(data, 'LRK_TPP')
            let lrpb = extractData(data, 'LRK_LRPB')
            let jpd = extractData(data, 'LO_PDG_TOTAL_UPG')
            let jn = extractData(data, 'LO_PDG_TOTAL_N')
            let slr = slrat.map(function(v, i) { return v + lrtb[i] })
            let pd = pdg.map(function(v, i){ return v + jpd[i]})
            let cr = al.map(function(v, i){return v / ll[i]})
            let der = tl.map(function(v, i){return v / te[i]})
            let dar = tl.map(function(v, i){return v / ta[i]})
            let roa = lrpb.map(function(v, i) {return v / ta[i]})
            let roe = lrtb.map(function(v, i){ return v / te[i]})
            let bopo = bo.map(function(v, i){ return v / po[i]})

            $('#ksk_q1').text(formatCurrency(ksk[4]*1000))
            $('#ksk_q2').text(formatCurrency(ksk[3]*1000))
            $('#ksk_q3').text(formatCurrency(ksk[2]*1000))
            $('#ksk_q4').text(formatCurrency(ksk[1]*1000))
            $('#ksk_q5').text(formatCurrency(ksk[0]*1000))
            $('#ksk_yoy').text(formatNumber(((ksk[0]-ksk[4])/ksk[4])*100)+'%').css(addIndicatorStyle(((ksk[0]-ksk[4])/ksk[4])*100))
            $('#ksk_qtq1').text(formatNumber(((ksk[3]-ksk[4])/ksk[4])*100)+'%').css(addIndicatorStyle(((ksk[3]-ksk[4])/ksk[4])*100))
            $('#ksk_qtq2').text(formatNumber(((ksk[2]-ksk[3])/ksk[3])*100)+'%').css(addIndicatorStyle(((ksk[2]-ksk[3])/ksk[3])*100))
            $('#ksk_qtq3').text(formatNumber(((ksk[1]-ksk[2])/ksk[2])*100)+'%').css(addIndicatorStyle(((ksk[1]-ksk[2])/ksk[2])*100))
            $('#ksk_qtq4').text(formatNumber(((ksk[0]-ksk[1])/ksk[1])*100)+'%').css(addIndicatorStyle(((ksk[0]-ksk[1])/ksk[1])*100))

            $('.pdg_q1').text(formatCurrency(pdg[4]*1000))
            $('.pdg_q2').text(formatCurrency(pdg[3]*1000))
            $('.pdg_q3').text(formatCurrency(pdg[2]*1000))
            $('.pdg_q4').text(formatCurrency(pdg[1]*1000))
            $('.pdg_q5').text(formatCurrency(pdg[0]*1000))
            $('.pdg_yoy').text(formatNumber(((pdg[0]-pdg[4])/pdg[4])*100)+'%').css(addIndicatorStyle(((pdg[0]-pdg[4])/pdg[4])*100))
            $('.pdg_qtq1').text(formatNumber(((pdg[3]-pdg[4])/pdg[4])*100)+'%').css(addIndicatorStyle(((pdg[3]-pdg[4])/pdg[4])*100))
            $('.pdg_qtq2').text(formatNumber(((pdg[2]-pdg[3])/pdg[3])*100)+'%').css(addIndicatorStyle(((pdg[2]-pdg[3])/pdg[3])*100))
            $('.pdg_qtq3').text(formatNumber(((pdg[1]-pdg[2])/pdg[2])*100)+'%').css(addIndicatorStyle(((pdg[1]-pdg[2])/pdg[2])*100))
            $('.pdg_qtq4').text(formatNumber(((pdg[0]-pdg[1])/pdg[1])*100)+'%').css(addIndicatorStyle(((pdg[0]-pdg[1])/pdg[1])*100))

            $('#all_q1').text(formatCurrency(all[4]*1000))
            $('#all_q2').text(formatCurrency(all[3]*1000))
            $('#all_q3').text(formatCurrency(all[2]*1000))
            $('#all_q4').text(formatCurrency(all[1]*1000))
            $('#all_q5').text(formatCurrency(all[0]*1000))
            $('#all_yoy').text(formatNumber(((all[0]-all[4])/all[4])*100)+'%').css(addIndicatorStyle(((all[0]-all[4])/all[4])*100))
            $('#all_qtq1').text(formatNumber(((all[3]-all[4])/all[4])*100)+'%').css(addIndicatorStyle(((all[3]-all[4])/all[4])*100))
            $('#all_qtq2').text(formatNumber(((all[2]-all[3])/all[3])*100)+'%').css(addIndicatorStyle(((all[2]-all[3])/all[3])*100))
            $('#all_qtq3').text(formatNumber(((all[1]-all[2])/all[2])*100)+'%').css(addIndicatorStyle(((all[1]-all[2])/all[2])*100))
            $('#all_qtq4').text(formatNumber(((all[0]-all[1])/all[1])*100)+'%').css(addIndicatorStyle(((all[0]-all[1])/all[1])*100))

            $('#al_q1').text(formatCurrency(al[4]*1000))
            $('#al_q2').text(formatCurrency(al[3]*1000))
            $('#al_q3').text(formatCurrency(al[2]*1000))
            $('#al_q4').text(formatCurrency(al[1]*1000))
            $('#al_q5').text(formatCurrency(al[0]*1000))
            $('#al_yoy').text(formatNumber(((al[0]-al[4])/al[4])*100)+'%').css(addIndicatorStyle(((al[0]-al[4])/al[4])*100))
            $('#al_qtq1').text(formatNumber(((al[3]-al[4])/al[4])*100)+'%').css(addIndicatorStyle(((al[3]-al[4])/al[4])*100))
            $('#al_qtq2').text(formatNumber(((al[2]-al[3])/al[3])*100)+'%').css(addIndicatorStyle(((al[2]-al[3])/al[3])*100))
            $('#al_qtq3').text(formatNumber(((al[1]-al[2])/al[2])*100)+'%').css(addIndicatorStyle(((al[1]-al[2])/al[2])*100))
            $('#al_qtq4').text(formatNumber(((al[0]-al[1])/al[1])*100)+'%').css(addIndicatorStyle(((al[0]-al[1])/al[1])*100))

            $('#atl_q1').text(formatCurrency(atl[4]*1000))
            $('#atl_q2').text(formatCurrency(atl[3]*1000))
            $('#atl_q3').text(formatCurrency(atl[2]*1000))
            $('#atl_q4').text(formatCurrency(atl[1]*1000))
            $('#atl_q5').text(formatCurrency(atl[0]*1000))
            $('#atl_yoy').text(formatNumber(((atl[0]-atl[4])/atl[4])*100)+'%').css(addIndicatorStyle(((atl[0]-atl[4])/atl[4])*100))
            $('#atl_qtq1').text(formatNumber(((atl[3]-atl[4])/atl[4])*100)+'%').css(addIndicatorStyle(((atl[3]-atl[4])/atl[4])*100))
            $('#atl_qtq2').text(formatNumber(((atl[2]-atl[3])/atl[3])*100)+'%').css(addIndicatorStyle(((atl[2]-atl[3])/atl[3])*100))
            $('#atl_qtq3').text(formatNumber(((atl[1]-atl[2])/atl[2])*100)+'%').css(addIndicatorStyle(((atl[1]-atl[2])/atl[2])*100))
            $('#atl_qtq4').text(formatNumber(((atl[0]-atl[1])/atl[1])*100)+'%').css(addIndicatorStyle(((atl[0]-atl[1])/atl[1])*100))

            $('#ta_q1').text(formatCurrency(ta[4]*1000))
            $('#ta_q2').text(formatCurrency(ta[3]*1000))
            $('#ta_q3').text(formatCurrency(ta[2]*1000))
            $('#ta_q4').text(formatCurrency(ta[1]*1000))
            $('#ta_q5').text(formatCurrency(ta[0]*1000))
            $('#ta_yoy').text(formatNumber(((ta[0]-ta[4])/ta[4])*100)+'%').css(addIndicatorStyle(((ta[0]-ta[4])/ta[4])*100))
            $('#ta_qtq1').text(formatNumber(((ta[3]-ta[4])/ta[4])*100)+'%').css(addIndicatorStyle(((ta[3]-ta[4])/ta[4])*100))
            $('#ta_qtq2').text(formatNumber(((ta[2]-ta[3])/ta[3])*100)+'%').css(addIndicatorStyle(((ta[2]-ta[3])/ta[3])*100))
            $('#ta_qtq3').text(formatNumber(((ta[1]-ta[2])/ta[2])*100)+'%').css(addIndicatorStyle(((ta[1]-ta[2])/ta[2])*100))
            $('#ta_qtq4').text(formatNumber(((ta[0]-ta[1])/ta[1])*100)+'%').css(addIndicatorStyle(((ta[0]-ta[1])/ta[1])*100))

            $('#ll_q1').text(formatCurrency(ll[4]*1000))
            $('#ll_q2').text(formatCurrency(ll[3]*1000))
            $('#ll_q3').text(formatCurrency(ll[2]*1000))
            $('#ll_q4').text(formatCurrency(ll[1]*1000))
            $('#ll_q5').text(formatCurrency(ll[0]*1000))
            $('#ll_yoy').text(formatNumber(((ll[0]-ll[4])/ll[4])*100)+'%').css(addIndicatorStyle(((ll[0]-ll[4])/ll[4])*100))
            $('#ll_qtq1').text(formatNumber(((ll[3]-ll[4])/ll[4])*100)+'%').css(addIndicatorStyle(((ll[3]-ll[4])/ll[4])*100))
            $('#ll_qtq2').text(formatNumber(((ll[2]-ll[3])/ll[3])*100)+'%').css(addIndicatorStyle(((ll[2]-ll[3])/ll[3])*100))
            $('#ll_qtq3').text(formatNumber(((ll[1]-ll[2])/ll[2])*100)+'%').css(addIndicatorStyle(((ll[1]-ll[2])/ll[2])*100))
            $('#ll_qtq4').text(formatNumber(((ll[0]-ll[1])/ll[1])*100)+'%').css(addIndicatorStyle(((ll[0]-ll[1])/ll[1])*100))

            $('#ltl_q1').text(formatCurrency(ltl[4]*1000))
            $('#ltl_q2').text(formatCurrency(ltl[3]*1000))
            $('#ltl_q3').text(formatCurrency(ltl[2]*1000))
            $('#ltl_q4').text(formatCurrency(ltl[1]*1000))
            $('#ltl_q5').text(formatCurrency(ltl[0]*1000))
            $('#ltl_yoy').text(formatNumber(((ltl[0]-ltl[4])/ltl[4])*100)+'%').css(addIndicatorStyle(((ltl[0]-ltl[4])/ltl[4])*100))
            $('#ltl_qtq1').text(formatNumber(((ltl[3]-ltl[4])/ltl[4])*100)+'%').css(addIndicatorStyle(((ltl[3]-ltl[4])/ltl[4])*100))
            $('#ltl_qtq2').text(formatNumber(((ltl[2]-ltl[3])/ltl[3])*100)+'%').css(addIndicatorStyle(((ltl[2]-ltl[3])/ltl[3])*100))
            $('#ltl_qtq3').text(formatNumber(((ltl[1]-ltl[2])/ltl[2])*100)+'%').css(addIndicatorStyle(((ltl[1]-ltl[2])/ltl[2])*100))
            $('#ltl_qtq4').text(formatNumber(((ltl[0]-ltl[1])/ltl[1])*100)+'%').css(addIndicatorStyle(((ltl[0]-ltl[1])/ltl[1])*100))

            $('#tl_q1').text(formatCurrency(tl[4]*1000))
            $('#tl_q2').text(formatCurrency(tl[3]*1000))
            $('#tl_q3').text(formatCurrency(tl[2]*1000))
            $('#tl_q4').text(formatCurrency(tl[1]*1000))
            $('#tl_q5').text(formatCurrency(tl[0]*1000))
            $('#tl_yoy').text(formatNumber(((tl[0]-tl[4])/tl[4])*100)+'%').css(addIndicatorStyle(((tl[0]-tl[4])/tl[4])*100))
            $('#tl_qtq1').text(formatNumber(((tl[3]-tl[4])/tl[4])*100)+'%').css(addIndicatorStyle(((tl[3]-tl[4])/tl[4])*100))
            $('#tl_qtq2').text(formatNumber(((tl[2]-tl[3])/tl[3])*100)+'%').css(addIndicatorStyle(((tl[2]-tl[3])/tl[3])*100))
            $('#tl_qtq3').text(formatNumber(((tl[1]-tl[2])/tl[2])*100)+'%').css(addIndicatorStyle(((tl[1]-tl[2])/tl[2])*100))
            $('#tl_qtq4').text(formatNumber(((tl[0]-tl[1])/tl[1])*100)+'%').css(addIndicatorStyle(((tl[0]-tl[1])/tl[1])*100))

            $('#md_q1').text(formatCurrency(md[4]*1000))
            $('#md_q2').text(formatCurrency(md[3]*1000))
            $('#md_q3').text(formatCurrency(md[2]*1000))
            $('#md_q4').text(formatCurrency(md[1]*1000))
            $('#md_q5').text(formatCurrency(md[0]*1000))
            $('#md_yoy').text(formatNumber(((md[0]-md[4])/md[4])*100)+'%').css(addIndicatorStyle(((md[0]-md[4])/md[4])*100))
            $('#md_qtq1').text(formatNumber(((md[3]-md[4])/md[4])*100)+'%').css(addIndicatorStyle(((md[3]-md[4])/md[4])*100))
            $('#md_qtq2').text(formatNumber(((md[2]-md[3])/md[3])*100)+'%').css(addIndicatorStyle(((md[2]-md[3])/md[3])*100))
            $('#md_qtq3').text(formatNumber(((md[1]-md[2])/md[2])*100)+'%').css(addIndicatorStyle(((md[1]-md[2])/md[2])*100))
            $('#md_qtq4').text(formatNumber(((md[0]-md[1])/md[1])*100)+'%').css(addIndicatorStyle(((md[0]-md[1])/md[1])*100))

            $('#slrat_q1').text(formatCurrency(slrat[4]*1000))
            $('#slrat_q2').text(formatCurrency(slrat[3]*1000))
            $('#slrat_q3').text(formatCurrency(slrat[2]*1000))
            $('#slrat_q4').text(formatCurrency(slrat[1]*1000))
            $('#slrat_q5').text(formatCurrency(slrat[0]*1000))
            $('#slrat_yoy').text(formatNumber(((slrat[0]-slrat[4])/slrat[4])*100)+'%').css(addIndicatorStyle(((slrat[0]-slrat[4])/slrat[4])*100))
            $('#slrat_qtq1').text(formatNumber(((slrat[3]-slrat[4])/slrat[4])*100)+'%').css(addIndicatorStyle(((slrat[3]-slrat[4])/slrat[4])*100))
            $('#slrat_qtq2').text(formatNumber(((slrat[2]-slrat[3])/slrat[3])*100)+'%').css(addIndicatorStyle(((slrat[2]-slrat[3])/slrat[3])*100))
            $('#slrat_qtq3').text(formatNumber(((slrat[1]-slrat[2])/slrat[2])*100)+'%').css(addIndicatorStyle(((slrat[1]-slrat[2])/slrat[2])*100))
            $('#slrat_qtq4').text(formatNumber(((slrat[0]-slrat[1])/slrat[1])*100)+'%').css(addIndicatorStyle(((slrat[0]-slrat[1])/slrat[1])*100))

            $('#lrtb_q1').text(formatCurrency(lrtb[4]*1000))
            $('#lrtb_q2').text(formatCurrency(lrtb[3]*1000))
            $('#lrtb_q3').text(formatCurrency(lrtb[2]*1000))
            $('#lrtb_q4').text(formatCurrency(lrtb[1]*1000))
            $('#lrtb_q5').text(formatCurrency(lrtb[0]*1000))
            $('#lrtb_yoy').text(formatNumber(((lrtb[0]-lrtb[4])/lrtb[4])*100)+'%').css(addIndicatorStyle(((lrtb[0]-lrtb[4])/lrtb[4])*100))
            $('#lrtb_qtq1').text(formatNumber(((lrtb[3]-lrtb[4])/lrtb[4])*100)+'%').css(addIndicatorStyle(((lrtb[3]-lrtb[4])/lrtb[4])*100))
            $('#lrtb_qtq2').text(formatNumber(((lrtb[2]-lrtb[3])/lrtb[3])*100)+'%').css(addIndicatorStyle(((lrtb[2]-lrtb[3])/lrtb[3])*100))
            $('#lrtb_qtq3').text(formatNumber(((lrtb[1]-lrtb[2])/lrtb[2])*100)+'%').css(addIndicatorStyle(((lrtb[1]-lrtb[2])/lrtb[2])*100))
            $('#lrtb_qtq4').text(formatNumber(((lrtb[0]-lrtb[1])/lrtb[1])*100)+'%').css(addIndicatorStyle(((lrtb[0]-lrtb[1])/lrtb[1])*100))

            $('#slr_q1').text(formatCurrency(slr[4]*1000))
            $('#slr_q2').text(formatCurrency(slr[3]*1000))
            $('#slr_q3').text(formatCurrency(slr[2]*1000))
            $('#slr_q4').text(formatCurrency(slr[1]*1000))
            $('#slr_q5').text(formatCurrency(slr[0]*1000))
            $('#slr_yoy').text(formatNumber(((slr[0]-slr[4])/slr[4])*100)+'%').css(addIndicatorStyle(((slr[0]-slr[4])/slr[4])*100))
            $('#slr_qtq1').text(formatNumber(((slr[3]-slr[4])/slr[4])*100)+'%').css(addIndicatorStyle(((slr[3]-slr[4])/slr[4])*100))
            $('#slr_qtq2').text(formatNumber(((slr[2]-slr[3])/slr[3])*100)+'%').css(addIndicatorStyle(((slr[2]-slr[3])/slr[3])*100))
            $('#slr_qtq3').text(formatNumber(((slr[1]-slr[2])/slr[2])*100)+'%').css(addIndicatorStyle(((slr[1]-slr[2])/slr[2])*100))
            $('#slr_qtq4').text(formatNumber(((slr[0]-slr[1])/slr[1])*100)+'%').css(addIndicatorStyle(((slr[0]-slr[1])/slr[1])*100))

            $('#te_q1').text(formatCurrency(te[4]*1000))
            $('#te_q2').text(formatCurrency(te[3]*1000))
            $('#te_q3').text(formatCurrency(te[2]*1000))
            $('#te_q4').text(formatCurrency(te[1]*1000))
            $('#te_q5').text(formatCurrency(te[0]*1000))
            $('#te_yoy').text(formatNumber(((te[0]-te[4])/te[4])*100)+'%').css(addIndicatorStyle(((te[0]-te[4])/te[4])*100))
            $('#te_qtq1').text(formatNumber(((te[3]-te[4])/te[4])*100)+'%').css(addIndicatorStyle(((te[3]-te[4])/te[4])*100))
            $('#te_qtq2').text(formatNumber(((te[2]-te[3])/te[3])*100)+'%').css(addIndicatorStyle(((te[2]-te[3])/te[3])*100))
            $('#te_qtq3').text(formatNumber(((te[1]-te[2])/te[2])*100)+'%').css(addIndicatorStyle(((te[1]-te[2])/te[2])*100))
            $('#te_qtq4').text(formatNumber(((te[0]-te[1])/te[1])*100)+'%').css(addIndicatorStyle(((te[0]-te[1])/te[1])*100))

            $('#pijih_q1').text(formatCurrency(pijih[4]*1000))
            $('#pijih_q2').text(formatCurrency(pijih[3]*1000))
            $('#pijih_q3').text(formatCurrency(pijih[2]*1000))
            $('#pijih_q4').text(formatCurrency(pijih[1]*1000))
            $('#pijih_q5').text(formatCurrency(pijih[0]*1000))
            $('#pijih_yoy').text(formatNumber(((pijih[0]-pijih[4])/pijih[4])*100)+'%').css(addIndicatorStyle(((pijih[0]-pijih[4])/pijih[4])*100))
            $('#pijih_qtq1').text(formatNumber(((pijih[3]-pijih[4])/pijih[4])*100)+'%').css(addIndicatorStyle(((pijih[3]-pijih[4])/pijih[4])*100))
            $('#pijih_qtq2').text(formatNumber(((pijih[2]-pijih[3])/pijih[3])*100)+'%').css(addIndicatorStyle(((pijih[2]-pijih[3])/pijih[3])*100))
            $('#pijih_qtq3').text(formatNumber(((pijih[1]-pijih[2])/pijih[2])*100)+'%').css(addIndicatorStyle(((pijih[1]-pijih[2])/pijih[2])*100))
            $('#pijih_qtq4').text(formatNumber(((pijih[0]-pijih[1])/pijih[1])*100)+'%').css(addIndicatorStyle(((pijih[0]-pijih[1])/pijih[1])*100))

            $('#pa_q1').text(formatCurrency(pa[4]*1000))
            $('#pa_q2').text(formatCurrency(pa[3]*1000))
            $('#pa_q3').text(formatCurrency(pa[2]*1000))
            $('#pa_q4').text(formatCurrency(pa[1]*1000))
            $('#pa_q5').text(formatCurrency(pa[0]*1000))
            $('#pa_yoy').text(formatNumber(((pa[0]-pa[4])/pa[4])*100)+'%').css(addIndicatorStyle(((pa[0]-pa[4])/pa[4])*100))
            $('#pa_qtq1').text(formatNumber(((pa[3]-pa[4])/pa[4])*100)+'%').css(addIndicatorStyle(((pa[3]-pa[4])/pa[4])*100))
            $('#pa_qtq2').text(formatNumber(((pa[2]-pa[3])/pa[3])*100)+'%').css(addIndicatorStyle(((pa[2]-pa[3])/pa[3])*100))
            $('#pa_qtq3').text(formatNumber(((pa[1]-pa[2])/pa[2])*100)+'%').css(addIndicatorStyle(((pa[1]-pa[2])/pa[2])*100))
            $('#pa_qtq4').text(formatNumber(((pa[0]-pa[1])/pa[1])*100)+'%').css(addIndicatorStyle(((pa[0]-pa[1])/pa[1])*100))

            $('#po_q1').text(formatCurrency(po[4]*1000))
            $('#po_q2').text(formatCurrency(po[3]*1000))
            $('#po_q3').text(formatCurrency(po[2]*1000))
            $('#po_q4').text(formatCurrency(po[1]*1000))
            $('#po_q5').text(formatCurrency(po[0]*1000))
            $('#po_yoy').text(formatNumber(((po[0]-po[4])/po[4])*100)+'%').css(addIndicatorStyle(((po[0]-po[4])/po[4])*100))
            $('#po_qtq1').text(formatNumber(((po[3]-po[4])/po[4])*100)+'%').css(addIndicatorStyle(((po[3]-po[4])/po[4])*100))
            $('#po_qtq2').text(formatNumber(((po[2]-po[3])/po[3])*100)+'%').css(addIndicatorStyle(((po[2]-po[3])/po[3])*100))
            $('#po_qtq3').text(formatNumber(((po[1]-po[2])/po[2])*100)+'%').css(addIndicatorStyle(((po[1]-po[2])/po[2])*100))
            $('#po_qtq4').text(formatNumber(((po[0]-po[1])/po[1])*100)+'%').css(addIndicatorStyle(((po[0]-po[1])/po[1])*100))

            $('#pno_q1').text(formatCurrency(pno[4]*1000))
            $('#pno_q2').text(formatCurrency(pno[3]*1000))
            $('#pno_q3').text(formatCurrency(pno[2]*1000))
            $('#pno_q4').text(formatCurrency(pno[1]*1000))
            $('#pno_q5').text(formatCurrency(pno[0]*1000))
            $('#pno_yoy').text(formatNumber(((pno[0]-pno[4])/pno[4])*100)+'%').css(addIndicatorStyle(((pno[0]-pno[4])/pno[4])*100))
            $('#pno_qtq1').text(formatNumber(((pno[3]-pno[4])/pno[4])*100)+'%').css(addIndicatorStyle(((pno[3]-pno[4])/pno[4])*100))
            $('#pno_qtq2').text(formatNumber(((pno[2]-pno[3])/pno[3])*100)+'%').css(addIndicatorStyle(((pno[2]-pno[3])/pno[3])*100))
            $('#pno_qtq3').text(formatNumber(((pno[1]-pno[2])/pno[2])*100)+'%').css(addIndicatorStyle(((pno[1]-pno[2])/pno[2])*100))
            $('#pno_qtq4').text(formatNumber(((pno[0]-pno[1])/pno[1])*100)+'%').css(addIndicatorStyle(((pno[0]-pno[1])/pno[1])*100))

            $('#jp_q1').text(formatCurrency(jp[4]*1000))
            $('#jp_q2').text(formatCurrency(jp[3]*1000))
            $('#jp_q3').text(formatCurrency(jp[2]*1000))
            $('#jp_q4').text(formatCurrency(jp[1]*1000))
            $('#jp_q5').text(formatCurrency(jp[0]*1000))
            $('#jp_yoy').text(formatNumber(((jp[0]-jp[4])/jp[4])*100)+'%').css(addIndicatorStyle(((jp[0]-jp[4])/jp[4])*100))
            $('#jp_qtq1').text(formatNumber(((jp[3]-jp[4])/jp[4])*100)+'%').css(addIndicatorStyle(((jp[3]-jp[4])/jp[4])*100))
            $('#jp_qtq2').text(formatNumber(((jp[2]-jp[3])/jp[3])*100)+'%').css(addIndicatorStyle(((jp[2]-jp[3])/jp[3])*100))
            $('#jp_qtq3').text(formatNumber(((jp[1]-jp[2])/jp[2])*100)+'%').css(addIndicatorStyle(((jp[1]-jp[2])/jp[2])*100))
            $('#jp_qtq4').text(formatNumber(((jp[0]-jp[1])/jp[1])*100)+'%').css(addIndicatorStyle(((jp[0]-jp[1])/jp[1])*100))

            $('#bo_q1').text(formatCurrency(bo[4]*1000))
            $('#bo_q2').text(formatCurrency(bo[3]*1000))
            $('#bo_q3').text(formatCurrency(bo[2]*1000))
            $('#bo_q4').text(formatCurrency(bo[1]*1000))
            $('#bo_q5').text(formatCurrency(bo[0]*1000))
            $('#bo_yoy').text(formatNumber(((bo[0]-bo[4])/bo[4])*100)+'%').css(addIndicatorStyle(((bo[0]-bo[4])/bo[4])*100))
            $('#bo_qtq1').text(formatNumber(((bo[3]-bo[4])/bo[4])*100)+'%').css(addIndicatorStyle(((bo[3]-bo[4])/bo[4])*100))
            $('#bo_qtq2').text(formatNumber(((bo[2]-bo[3])/bo[3])*100)+'%').css(addIndicatorStyle(((bo[2]-bo[3])/bo[3])*100))
            $('#bo_qtq3').text(formatNumber(((bo[1]-bo[2])/bo[2])*100)+'%').css(addIndicatorStyle(((bo[1]-bo[2])/bo[2])*100))
            $('#bo_qtq4').text(formatNumber(((bo[0]-bo[1])/bo[1])*100)+'%').css(addIndicatorStyle(((bo[0]-bo[1])/bo[1])*100))

            $('#bno_q1').text(formatCurrency(bno[4]*1000))
            $('#bno_q2').text(formatCurrency(bno[3]*1000))
            $('#bno_q3').text(formatCurrency(bno[2]*1000))
            $('#bno_q4').text(formatCurrency(bno[1]*1000))
            $('#bno_q5').text(formatCurrency(bno[0]*1000))
            $('#bno_yoy').text(formatNumber(((bno[0]-bno[4])/bno[4])*100)+'%').css(addIndicatorStyle(((bno[0]-bno[4])/bno[4])*100))
            $('#bno_qtq1').text(formatNumber(((bno[3]-bno[4])/bno[4])*100)+'%').css(addIndicatorStyle(((bno[3]-bno[4])/bno[4])*100))
            $('#bno_qtq2').text(formatNumber(((bno[2]-bno[3])/bno[3])*100)+'%').css(addIndicatorStyle(((bno[2]-bno[3])/bno[3])*100))
            $('#bno_qtq3').text(formatNumber(((bno[1]-bno[2])/bno[2])*100)+'%').css(addIndicatorStyle(((bno[1]-bno[2])/bno[2])*100))
            $('#bno_qtq4').text(formatNumber(((bno[0]-bno[1])/bno[1])*100)+'%').css(addIndicatorStyle(((bno[0]-bno[1])/bno[1])*100))

            $('#jb_q1').text(formatCurrency(jb[4]*1000))
            $('#jb_q2').text(formatCurrency(jb[3]*1000))
            $('#jb_q3').text(formatCurrency(jb[2]*1000))
            $('#jb_q4').text(formatCurrency(jb[1]*1000))
            $('#jb_q5').text(formatCurrency(jb[0]*1000))
            $('#jb_yoy').text(formatNumber(((jb[0]-jb[4])/jb[4])*100)+'%').css(addIndicatorStyle(((jb[0]-jb[4])/jb[4])*100))
            $('#jb_qtq1').text(formatNumber(((jb[3]-jb[4])/jb[4])*100)+'%').css(addIndicatorStyle(((jb[3]-jb[4])/jb[4])*100))
            $('#jb_qtq2').text(formatNumber(((jb[2]-jb[3])/jb[3])*100)+'%').css(addIndicatorStyle(((jb[2]-jb[3])/jb[3])*100))
            $('#jb_qtq3').text(formatNumber(((jb[1]-jb[2])/jb[2])*100)+'%').css(addIndicatorStyle(((jb[1]-jb[2])/jb[2])*100))
            $('#jb_qtq4').text(formatNumber(((jb[0]-jb[1])/jb[1])*100)+'%').css(addIndicatorStyle(((jb[0]-jb[1])/jb[1])*100))

            $('#lrsp_q1').text(formatCurrency(lrsp[4]*1000))
            $('#lrsp_q2').text(formatCurrency(lrsp[3]*1000))
            $('#lrsp_q3').text(formatCurrency(lrsp[2]*1000))
            $('#lrsp_q4').text(formatCurrency(lrsp[1]*1000))
            $('#lrsp_q5').text(formatCurrency(lrsp[0]*1000))
            $('#lrsp_yoy').text(formatNumber(((lrsp[0]-lrsp[4])/lrsp[4])*100)+'%').css(addIndicatorStyle(((lrsp[0]-lrsp[4])/lrsp[4])*100))
            $('#lrsp_qtq1').text(formatNumber(((lrsp[3]-lrsp[4])/lrsp[4])*100)+'%').css(addIndicatorStyle(((lrsp[3]-lrsp[4])/lrsp[4])*100))
            $('#lrsp_qtq2').text(formatNumber(((lrsp[2]-lrsp[3])/lrsp[3])*100)+'%').css(addIndicatorStyle(((lrsp[2]-lrsp[3])/lrsp[3])*100))
            $('#lrsp_qtq3').text(formatNumber(((lrsp[1]-lrsp[2])/lrsp[2])*100)+'%').css(addIndicatorStyle(((lrsp[1]-lrsp[2])/lrsp[2])*100))
            $('#lrsp_qtq4').text(formatNumber(((lrsp[0]-lrsp[1])/lrsp[1])*100)+'%').css(addIndicatorStyle(((lrsp[0]-lrsp[1])/lrsp[1])*100))

            $('#tpp_q1').text(formatCurrency(tpp[4]*1000))
            $('#tpp_q2').text(formatCurrency(tpp[3]*1000))
            $('#tpp_q3').text(formatCurrency(tpp[2]*1000))
            $('#tpp_q4').text(formatCurrency(tpp[1]*1000))
            $('#tpp_q5').text(formatCurrency(tpp[0]*1000))
            $('#tpp_yoy').text(formatNumber(((tpp[0]-tpp[4])/tpp[4])*100)+'%').css(addIndicatorStyle(((tpp[0]-tpp[4])/tpp[4])*100))
            $('#tpp_qtq1').text(formatNumber(((tpp[3]-tpp[4])/tpp[4])*100)+'%').css(addIndicatorStyle(((tpp[3]-tpp[4])/tpp[4])*100))
            $('#tpp_qtq2').text(formatNumber(((tpp[2]-tpp[3])/tpp[3])*100)+'%').css(addIndicatorStyle(((tpp[2]-tpp[3])/tpp[3])*100))
            $('#tpp_qtq3').text(formatNumber(((tpp[1]-tpp[2])/tpp[2])*100)+'%').css(addIndicatorStyle(((tpp[1]-tpp[2])/tpp[2])*100))
            $('#tpp_qtq4').text(formatNumber(((tpp[0]-tpp[1])/tpp[1])*100)+'%').css(addIndicatorStyle(((tpp[0]-tpp[1])/tpp[1])*100))

            $('#lrpb_q1').text(formatCurrency(lrpb[4]*1000))
            $('#lrpb_q2').text(formatCurrency(lrpb[3]*1000))
            $('#lrpb_q3').text(formatCurrency(lrpb[2]*1000))
            $('#lrpb_q4').text(formatCurrency(lrpb[1]*1000))
            $('#lrpb_q5').text(formatCurrency(lrpb[0]*1000))
            $('#lrpb_yoy').text(formatNumber(((lrpb[0]-lrpb[4])/lrpb[4])*100)+'%').css(addIndicatorStyle(((lrpb[0]-lrpb[4])/lrpb[4])*100))
            $('#lrpb_qtq1').text(formatNumber(((lrpb[3]-lrpb[4])/lrpb[4])*100)+'%').css(addIndicatorStyle(((lrpb[3]-lrpb[4])/lrpb[4])*100))
            $('#lrpb_qtq2').text(formatNumber(((lrpb[2]-lrpb[3])/lrpb[3])*100)+'%').css(addIndicatorStyle(((lrpb[2]-lrpb[3])/lrpb[3])*100))
            $('#lrpb_qtq3').text(formatNumber(((lrpb[1]-lrpb[2])/lrpb[2])*100)+'%').css(addIndicatorStyle(((lrpb[1]-lrpb[2])/lrpb[2])*100))
            $('#lrpb_qtq4').text(formatNumber(((lrpb[0]-lrpb[1])/lrpb[1])*100)+'%').css(addIndicatorStyle(((lrpb[0]-lrpb[1])/lrpb[1])*100))

            $('#jpd_q1').text(formatCurrency(jpd[4]*1000))
            $('#jpd_q2').text(formatCurrency(jpd[3]*1000))
            $('#jpd_q3').text(formatCurrency(jpd[2]*1000))
            $('#jpd_q4').text(formatCurrency(jpd[1]*1000))
            $('#jpd_q5').text(formatCurrency(jpd[0]*1000))
            $('#jpd_yoy').text(formatNumber(((jpd[0]-jpd[4])/jpd[4])*100)+'%').css(addIndicatorStyle(((jpd[0]-jpd[4])/jpd[4])*100))
            $('#jpd_qtq1').text(formatNumber(((jpd[3]-jpd[4])/jpd[4])*100)+'%').css(addIndicatorStyle(((jpd[3]-jpd[4])/jpd[4])*100))
            $('#jpd_qtq2').text(formatNumber(((jpd[2]-jpd[3])/jpd[3])*100)+'%').css(addIndicatorStyle(((jpd[2]-jpd[3])/jpd[3])*100))
            $('#jpd_qtq3').text(formatNumber(((jpd[1]-jpd[2])/jpd[2])*100)+'%').css(addIndicatorStyle(((jpd[1]-jpd[2])/jpd[2])*100))
            $('#jpd_qtq4').text(formatNumber(((jpd[0]-jpd[1])/jpd[1])*100)+'%').css(addIndicatorStyle(((jpd[0]-jpd[1])/jpd[1])*100))

            $('#pd_q1').text(formatCurrency(pd[4]*1000))
            $('#pd_q2').text(formatCurrency(pd[3]*1000))
            $('#pd_q3').text(formatCurrency(pd[2]*1000))
            $('#pd_q4').text(formatCurrency(pd[1]*1000))
            $('#pd_q5').text(formatCurrency(pd[0]*1000))
            $('#pd_yoy').text(formatNumber(((pd[0]-pd[4])/pd[4])*100)+'%').css(addIndicatorStyle(((pd[0]-pd[4])/pd[4])*100))
            $('#pd_qtq1').text(formatNumber(((pd[3]-pd[4])/pd[4])*100)+'%').css(addIndicatorStyle(((pd[3]-pd[4])/pd[4])*100))
            $('#pd_qtq2').text(formatNumber(((pd[2]-pd[3])/pd[3])*100)+'%').css(addIndicatorStyle(((pd[2]-pd[3])/pd[3])*100))
            $('#pd_qtq3').text(formatNumber(((pd[1]-pd[2])/pd[2])*100)+'%').css(addIndicatorStyle(((pd[1]-pd[2])/pd[2])*100))
            $('#pd_qtq4').text(formatNumber(((pd[0]-pd[1])/pd[1])*100)+'%').css(addIndicatorStyle(((pd[0]-pd[1])/pd[1])*100))

            $('#jn_q1').text(jn[4]+' orang')
            $('#jn_q2').text(jn[3]+' orang')
            $('#jn_q3').text(jn[2]+' orang')
            $('#jn_q4').text(jn[1]+' orang')
            $('#jn_q5').text(jn[0]+' orang')
            $('#jn_yoy').text(formatNumber(((jn[0]-jn[4])/jn[4])*100)+'%').css(addIndicatorStyle(((jn[0]-jn[4])/jn[4])*100))
            $('#jn_qtq1').text(formatNumber(((jn[3]-jn[4])/jn[4])*100)+'%').css(addIndicatorStyle(((jn[3]-jn[4])/jn[4])*100))
            $('#jn_qtq2').text(formatNumber(((jn[2]-jn[3])/jn[3])*100)+'%').css(addIndicatorStyle(((jn[2]-jn[3])/jn[3])*100))
            $('#jn_qtq3').text(formatNumber(((jn[1]-jn[2])/jn[2])*100)+'%').css(addIndicatorStyle(((jn[1]-jn[2])/jn[2])*100))
            $('#jn_qtq4').text(formatNumber(((jn[0]-jn[1])/jn[1])*100)+'%').css(addIndicatorStyle(((jn[0]-jn[1])/jn[1])*100))

            $('#cr_q1').text(formatNumber(cr[4] * 100) + '%')
            $('#cr_q2').text(formatNumber(cr[3] * 100) + '%')
            $('#cr_q3').text(formatNumber(cr[2] * 100) + '%')
            $('#cr_q4').text(formatNumber(cr[1] * 100) + '%')
            $('#cr_q5').text(formatNumber(cr[0] * 100) + '%')
            $('#cr_yoy').text(formatNumber(((cr[0]-cr[4])/cr[4])*100)+'%').css(addIndicatorStyle(((cr[0]-cr[4])/cr[4])*100))
            $('#cr_qtq1').text(formatNumber(((cr[3]-cr[4])/cr[4])*100)+'%').css(addIndicatorStyle(((cr[3]-cr[4])/cr[4])*100))
            $('#cr_qtq2').text(formatNumber(((cr[2]-cr[3])/cr[3])*100)+'%').css(addIndicatorStyle(((cr[2]-cr[3])/cr[3])*100))
            $('#cr_qtq3').text(formatNumber(((cr[1]-cr[2])/cr[2])*100)+'%').css(addIndicatorStyle(((cr[1]-cr[2])/cr[2])*100))
            $('#cr_qtq4').text(formatNumber(((cr[0]-cr[1])/cr[1])*100)+'%').css(addIndicatorStyle(((cr[0]-cr[1])/cr[1])*100))

            $('#der_q1').text(formatNumber(der[4] * 100) + '%')
            $('#der_q2').text(formatNumber(der[3] * 100) + '%')
            $('#der_q3').text(formatNumber(der[2] * 100) + '%')
            $('#der_q4').text(formatNumber(der[1] * 100) + '%')
            $('#der_q5').text(formatNumber(der[0] * 100) + '%')
            $('#der_yoy').text(formatNumber(((der[0]-der[4])/der[4])*100)+'%').css(addIndicatorStyle(((der[0]-der[4])/der[4])*100))
            $('#der_qtq1').text(formatNumber(((der[3]-der[4])/der[4])*100)+'%').css(addIndicatorStyle(((der[3]-der[4])/der[4])*100))
            $('#der_qtq2').text(formatNumber(((der[2]-der[3])/der[3])*100)+'%').css(addIndicatorStyle(((der[2]-der[3])/der[3])*100))
            $('#der_qtq3').text(formatNumber(((der[1]-der[2])/der[2])*100)+'%').css(addIndicatorStyle(((der[1]-der[2])/der[2])*100))
            $('#der_qtq4').text(formatNumber(((der[0]-der[1])/der[1])*100)+'%').css(addIndicatorStyle(((der[0]-der[1])/der[1])*100))

            $('#dar_q1').text(formatNumber(dar[4] * 100) + '%')
            $('#dar_q2').text(formatNumber(dar[3] * 100) + '%')
            $('#dar_q3').text(formatNumber(dar[2] * 100) + '%')
            $('#dar_q4').text(formatNumber(dar[1] * 100) + '%')
            $('#dar_q5').text(formatNumber(dar[0] * 100) + '%')
            $('#dar_yoy').text(formatNumber(((dar[0]-dar[4])/dar[4])*100)+'%').css(addIndicatorStyle(((dar[0]-dar[4])/dar[4])*100))
            $('#dar_qtq1').text(formatNumber(((dar[3]-dar[4])/dar[4])*100)+'%').css(addIndicatorStyle(((dar[3]-dar[4])/dar[4])*100))
            $('#dar_qtq2').text(formatNumber(((dar[2]-dar[3])/dar[3])*100)+'%').css(addIndicatorStyle(((dar[2]-dar[3])/dar[3])*100))
            $('#dar_qtq3').text(formatNumber(((dar[1]-dar[2])/dar[2])*100)+'%').css(addIndicatorStyle(((dar[1]-dar[2])/dar[2])*100))
            $('#dar_qtq4').text(formatNumber(((dar[0]-dar[1])/dar[1])*100)+'%').css(addIndicatorStyle(((dar[0]-dar[1])/dar[1])*100))

            $('#roa_q1').text(formatNumber(roa[4] * 100) + '%')
            $('#roa_q2').text(formatNumber(roa[3] * 100) + '%')
            $('#roa_q3').text(formatNumber(roa[2] * 100) + '%')
            $('#roa_q4').text(formatNumber(roa[1] * 100) + '%')
            $('#roa_q5').text(formatNumber(roa[0] * 100) + '%')
            $('#roa_yoy').text(formatNumber(((roa[0]-roa[4])/roa[4])*100)+'%').css(addIndicatorStyle(((roa[0]-roa[4])/roa[4])*100))
            $('#roa_qtq1').text(formatNumber(((roa[3]-roa[4])/roa[4])*100)+'%').css(addIndicatorStyle(((roa[3]-roa[4])/roa[4])*100))
            $('#roa_qtq2').text(formatNumber(((roa[2]-roa[3])/roa[3])*100)+'%').css(addIndicatorStyle(((roa[2]-roa[3])/roa[3])*100))
            $('#roa_qtq3').text(formatNumber(((roa[1]-roa[2])/roa[2])*100)+'%').css(addIndicatorStyle(((roa[1]-roa[2])/roa[2])*100))
            $('#roa_qtq4').text(formatNumber(((roa[0]-roa[1])/roa[1])*100)+'%').css(addIndicatorStyle(((roa[0]-roa[1])/roa[1])*100))

            $('#roe_q1').text(formatNumber(roe[4] * 100) + '%')
            $('#roe_q2').text(formatNumber(roe[3] * 100) + '%')
            $('#roe_q3').text(formatNumber(roe[2] * 100) + '%')
            $('#roe_q4').text(formatNumber(roe[1] * 100) + '%')
            $('#roe_q5').text(formatNumber(roe[0] * 100) + '%')
            $('#roe_yoy').text(formatNumber(((roe[0]-roe[4])/roe[4])*100)+'%').css(addIndicatorStyle(((roe[0]-roe[4])/roe[4])*100))
            $('#roe_qtq1').text(formatNumber(((roe[3]-roe[4])/roe[4])*100)+'%').css(addIndicatorStyle(((roe[3]-roe[4])/roe[4])*100))
            $('#roe_qtq2').text(formatNumber(((roe[2]-roe[3])/roe[3])*100)+'%').css(addIndicatorStyle(((roe[2]-roe[3])/roe[3])*100))
            $('#roe_qtq3').text(formatNumber(((roe[1]-roe[2])/roe[2])*100)+'%').css(addIndicatorStyle(((roe[1]-roe[2])/roe[2])*100))
            $('#roe_qtq4').text(formatNumber(((roe[0]-roe[1])/roe[1])*100)+'%').css(addIndicatorStyle(((roe[0]-roe[1])/roe[1])*100))

            $('#bopo_q1').text(formatNumber(bopo[4] * 100) + '%')
            $('#bopo_q2').text(formatNumber(bopo[3] * 100) + '%')
            $('#bopo_q3').text(formatNumber(bopo[2] * 100) + '%')
            $('#bopo_q4').text(formatNumber(bopo[1] * 100) + '%')
            $('#bopo_q5').text(formatNumber(bopo[0] * 100) + '%')
            $('#bopo_yoy').text(formatNumber(((bopo[0]-bopo[4])/bopo[4])*100)+'%').css(addIndicatorStyle(((bopo[0]-bopo[4])/bopo[4])*100))
            $('#bopo_qtq1').text(formatNumber(((bopo[3]-bopo[4])/bopo[4])*100)+'%').css(addIndicatorStyle(((bopo[3]-bopo[4])/bopo[4])*100))
            $('#bopo_qtq2').text(formatNumber(((bopo[2]-bopo[3])/bopo[3])*100)+'%').css(addIndicatorStyle(((bopo[2]-bopo[3])/bopo[3])*100))
            $('#bopo_qtq3').text(formatNumber(((bopo[1]-bopo[2])/bopo[2])*100)+'%').css(addIndicatorStyle(((bopo[1]-bopo[2])/bopo[2])*100))
            $('#bopo_qtq4').text(formatNumber(((bopo[0]-bopo[1])/bopo[1])*100)+'%').css(addIndicatorStyle(((bopo[0]-bopo[1])/bopo[1])*100))
        }

        
        $(document).ready(async function() {
            let company_id = $('input[name=company_id]').val()
            let data = await getData(company_id, null, null);
            return renderTable(data);
        })

        $('#quarterSelect').click(async function () {
            let company_id = $('input[name=company_id]').val()
            let year = $('input[name=year]').val()
            let quarter = $('input[name=quarter]').val()
            let data = await getData(company_id, year, quarter);
            return renderTable(data);
        })
    </script>
@endsection