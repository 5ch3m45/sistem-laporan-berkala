@extends('components.layout')

@section('head-js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
                                Informasi
                            </div>
                            <h2 class="page-title">
                                PT PERGADAIAN DANA SENTOSA
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="ml-auto">
                        </div>
                    </div>
                </div>
                <div class="row row-cards row-deck">
                    <div class="col-3">
                        <x-company-sidebar :company="$company" active="statistik"/>
                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Current Ratio</h3>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-current-ratio-bar" style="height: 24rem; width:;" class="c3 mb-3"></div>
                                        <div id="chart-current-ratio-line" style="height: 24rem; width:;" class="c3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-12 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Current Ratio</h3>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-debt-to-equity-bar" style="height: 24rem; width:;" class="c3 mb-3"></div>
                                        <div id="chart-debt-to-equity-line" style="height: 24rem; width:;" class="c3"></div>
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let option = (dataset, series) => ({
        title: {},
        tooltip: {},
        legend: {},
        dataset: dataset,
        xAxis: [{
            type: 'category',
            gridIndex: 0
        }],
        yAxis: [{gridIndex: 0}],
        series: series,
    });
    async function renderCharts() {
        let company_id = document.querySelector('input[name=company_id]').value;
        let params = {
            company_id: company_id
        }
        let response = await axios.get(`http://127.0.0.1:8000/api/report-data`, {params: params});
        let quarter = response.data.report.map(data => data.year+'/'+data.quarter).reverse()
        let aset_lancar = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code == 'LPK_A_TOTAL_AL' }).value).reverse()
        let aset_total = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code == 'LPK_A_TOTAL' }).value).reverse()
        let liabilitas_lancar = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code = 'LPK_L_TOTAL_LL' }).value).reverse()
        let liabilitas_total = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code = 'LPK_L_TOTAL' }).value).reverse()
        let ekuitas_total = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code = 'LPK_E_TOTAL' }).value).reverse()
        let laba_rugi_tahun_berjalan = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code = 'LPK_E_SLR_LRTB' }).value).reverse()
        let beban_operasional = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code = 'LRK_B_TOTAL_BO' }).value).reverse()
        let pendapatan_operasional = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code = 'LRK_P_TOTAL_PO' }).value).reverse()
        let penyaluran_pinjaman_diberikan = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code = 'LO_PDG_TOTAL_UPG' }).value).reverse()
        let outstanding_pinjaman_gadai = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code = 'LO_PDG_TOTAL_OPG' }).value).reverse()
        let nasabah = response.data.report.map(({ data }) => data.find(({ account_code }) => { return account_code = 'LO_PDG_TOTAL_N' }).value).reverse()
        let current_ratio = aset_lancar.map(function(v, i) { return v*100 / liabilitas_lancar[i] })
        let debt_to_equity_ratio = liabilitas_total.map(function(v, i) { return v*100 / ekuitas_total[i] })
        let debt_to_asset_ratio = liabilitas_total.map(function(v, i) { return v*100 / aset_total[i] })
        let return_on_asset_ratio = laba_rugi_tahun_berjalan.map(function(v, i) { return v*100 / aset_total[i] })
        let return_on_equity_ratio = laba_rugi_tahun_berjalan.map(function(v, i) { return v*100 / ekuitas_total[i] })
        let beban_pendapatan_operasional = beban_operasional.map(function(v, i) { return v*100 / pendapatan_operasional[i] })
        
        // current ratio bar
        let current_ratio_bar = echarts.init(document.getElementById('chart-current-ratio-bar'))
        let current_ratio_bar_option = option(
            {
                source: [
                    ['Triwulan', ...quarter],
                    ['Aset Lancar', ...aset_lancar],
                    ['Liabilitas Lancar', ...liabilitas_lancar],
                ]
            },
            [
                {type: 'bar', seriesLayoutBy: 'row'},
                {type: 'bar', seriesLayoutBy: 'row'}
            ]
        )
        current_ratio_bar.setOption(current_ratio_bar_option)

        // current ratio line
        let current_ratio_line = echarts.init(document.getElementById('chart-current-ratio-line'))
        let current_ratio_line_option = option(
            {
                source: [
                    ['Triwulan', ...quarter],
                    ['Current Ratio %', ...current_ratio],
                ]
            },
            [
                {type: 'line', seriesLayoutBy: 'row'}
            ]
        )
        current_ratio_line.setOption(current_ratio_line_option)
        
        // debt to equity bar
        let debt_to_equity_bar = echarts.init(document.getElementById('chart-debt-to-equity-bar'))
        let debt_to_equity_bar_option = option(
            {
                source: [
                    ['Triwulan', ...quarter],
                    ['Liabilitas', ...aset_lancar],
                    ['Total Ekuitas', ...liabilitas_lancar],
                ]
            },
            [
                {type: 'bar', seriesLayoutBy: 'row'},
                {type: 'bar', seriesLayoutBy: 'row'}
            ]
        )
        debt_to_equity_bar.setOption(debt_to_equity_bar_option)

        // debt to equity line
        let debt_to_equity_line = echarts.init(document.getElementById('chart-debt-to-equity-line'))
        let debt_to_equity_line_option = option(
            {
                source: [
                    ['Triwulan', ...quarter],
                    ['Debt to Equity %', ...debt_to_asset_ratio],
                ]
            },
            [
                {type: 'line', seriesLayoutBy: 'row'}
            ]
        )
        debt_to_equity_line.setOption(debt_to_equity_line_option)


    }

    renderCharts()
  </script>
@endsection