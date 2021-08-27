@extends('components.layout')

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
                                Berkas
                            </div>
                            <h2 class="page-title">
                                {{ $company->name }}
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="ml-auto">
                        </div>
                    </div>
                </div>
                <div class="row row-cards row-deck">
                    <div class="col-3">
                        <x-company-sidebar :company="$company" active="berkas" />
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table card-table table-vcenter text-nowrap" style="font-size: .8rem">
                                                <thead>
                                                    <tr>
                                                        <th class="font-weight-bold">Keterangan</th>
                                                        <th class="font-weight-bold">Triwulan 1 2020</th>
                                                        <th class="font-weight-bold">Triwulan 2 2020</th>
                                                        <th class="font-weight-bold">Triwulan 3 2020</th>
                                                        <th class="font-weight-bold">Triwulan 4 2020</th>
                                                        <th class="font-weight-bold">Triwulan 1 2021</th>
                                                        <th class="font-weight-bold">Y-o-Y</th>
                                                        <th class="font-weight-bold">q-t-q (1)</th>
                                                        <th class="font-weight-bold">q-t-q (2)</th>
                                                        <th class="font-weight-bold">q-t-q (3)</th>
                                                        <th class="font-weight-bold">q-t-q (4)</th>
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