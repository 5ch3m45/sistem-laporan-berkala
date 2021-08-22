@extends('components.layout')
@section('content')
<div class="container body">
    <div class="main_container">
        <x-sidenav companyid="{{ $company->id }}" active="dashboard" />
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
                            <li class="breadcrumb-item active" aria-current="page">STATISTIK</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Current Ratio</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="cr" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="cr2" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Debt to Asset Ratio</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="der1" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="der2" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Debt to Equity Ratio</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="dar1" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="dar2" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Return on Asset Ratio</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="roa1" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="roa2" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Return on Equity Ratio</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="roe1" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="roe2" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>BOPO</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="bopo1" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="bopo2" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Kinerja Keuangan</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12 col-sm-12 ">
                                <canvas id="kk1" width="400" height="100"></canvas>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h2>Kegiatan Operational Pergadaian</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="kop1" width="400" height="200"></canvas>
                            </div>
                            <div class="col-md-6 col-sm-12 ">
                                <canvas id="kop2" width="400" height="200"></canvas>
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const company_id = {{ $company->id }}
    const getReports = () => axios.get(`http://127.0.0.1:8000/api/v1/perusahaan/${company_id}/chart`).then(response => response.data)

    async function buildData() {
        let accounts = ['LPK_A_TOTAL_AL', 'LPK_L_TOTAL_LL', 'LPK_A_TOTAL', 'LPK_E_TOTAL', 'LPK_L_TOTAL', 'LPK_E_SLR_LRTB', 'LRK_B_TOTAL_BO', 'LRK_P_TOTAL_PO', 'LO_PDG_TOTAL_UPG', 'LO_PDG_TOTAL_OPG', 'LO_PDG_TOTAL_N']
        let reports = await getReports()
        let data = {
            'reports': null,
            'data': []
        };
        accounts.map(account => {
            let account_temp = {
                'account': account,
                'value': []
            }
            let report_temp = []
            reports.map(report => {
                let result = report.data.find(({
                    account_code
                }) => account_code == account)
                account_temp['value'].push(result.value)
                report_temp.push(report.year + '/' + report.quarter)
            })
            data.reports = report_temp
            data.data.push(account_temp)
        })
        return data
    }
    async function displayChart() {
        let {
            data,
            reports
        } = await buildData()
        let aset_lancar = data.find(({
            account
        }) => account == "LPK_A_TOTAL_AL").value
        let aset_total = data.find(({
            account
        }) => account == "LPK_A_TOTAL").value
        let liabilitas_lancar = data.find(({
            account
        }) => account == "LPK_L_TOTAL_LL").value
        let liabilitas_total = data.find(({
            account
        }) => account == "LPK_L_TOTAL").value
        let ekuitas_total = data.find(({
            account
        }) => account == "LPK_E_TOTAL").value
        let laba_rugi_tahun_berjalan = data.find(({
            account
        }) => account == "LPK_E_SLR_LRTB").value
        let beban_operasional = data.find(({
            account
        }) => account == "LRK_B_TOTAL_BO").value
        let pendapatan_operasional = data.find(({
            account
        }) => account == "LRK_P_TOTAL_PO").value
        let penyaluran_pinjaman_diberikan = data.find(({
            account
        }) => account == "LO_PDG_TOTAL_UPG").value
        let outstanding_pinjaman_gadai = data.find(({
            account
        }) => account == "LO_PDG_TOTAL_OPG").value
        let nasabah = data.find(({
            account
        }) => account == "LO_PDG_TOTAL_N").value

        let current_ratio = aset_lancar.map(function(v, i) {
            return v / liabilitas_lancar[i]
        })
        let debt_to_equity_ratio = liabilitas_total.map(function(v, i) {
            return v / ekuitas_total[i]
        })
        let debt_to_asset_ratio = liabilitas_total.map(function(v, i) {
            return v / aset_total[i]
        })
        let return_on_asset_ratio = laba_rugi_tahun_berjalan.map(function(v, i) {
            return v / aset_total[i]
        })
        let return_on_equity_ratio = laba_rugi_tahun_berjalan.map(function(v, i) {
            return v / ekuitas_total[i]
        })
        let beban_pendapatan_operasional = beban_operasional.map(function(v, i) {
            return v / pendapatan_operasional[i]
        })

        let cr = document.getElementById('cr').getContext('2d');
        let cr2 = document.getElementById('cr2').getContext('2d');
        let der1 = document.getElementById('der1').getContext('2d');
        let der2 = document.getElementById('der2').getContext('2d');
        let dar1 = document.getElementById('dar1').getContext('2d');
        let dar2 = document.getElementById('dar2').getContext('2d');
        let roa1 = document.getElementById('roa1').getContext('2d');
        let roa2 = document.getElementById('roa2').getContext('2d');
        let roe1 = document.getElementById('roe1').getContext('2d');
        let roe2 = document.getElementById('roe2').getContext('2d');
        let bopo1 = document.getElementById('bopo1').getContext('2d');
        let bopo2 = document.getElementById('bopo2').getContext('2d');
        let kk1 = document.getElementById('kk1').getContext('2d');
        let kop1 = document.getElementById('kop1').getContext('2d');

        new Chart(cr, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Aset Lancar',
                    data: aset_lancar,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                }, {
                    type: 'bar',
                    label: 'Liabilitas Lancar',
                    data: liabilitas_lancar,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(54, 162, 235)'
                }, ],
                labels: reports
            },
        });

        let mixedChart2 = new Chart(cr2, {
            data: {
                datasets: [{
                    type: 'line',
                    label: 'Current Ratio',
                    data: current_ratio,
                    borderColor: 'rgb(153, 102, 255)',
                }],
                labels: reports
            },
        });


        let der1Chart = new Chart(der1, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Total Liabilitas',
                    data: liabilitas_total,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                }, {
                    type: 'bar',
                    label: 'Total Aset',
                    data: aset_total,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(54, 162, 235)'
                }, ],
                labels: reports
            },
        });
        let der2Chart = new Chart(der2, {
            data: {
                datasets: [{
                    type: 'line',
                    label: 'Debt to Asset Ratio',
                    data: debt_to_asset_ratio,
                    borderColor: 'rgb(153, 102, 255)',
                }],
                labels: reports
            },
        });


        let dar1Chart = new Chart(dar1, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Total Liabilitas',
                    data: liabilitas_total,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                }, {
                    type: 'bar',
                    label: 'Total Aset',
                    data: aset_total,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(54, 162, 235)'
                }, ],
                labels: reports
            },
        });
        let dar2Chart = new Chart(dar2, {
            data: {
                datasets: [{
                    type: 'line',
                    label: 'Debt to Equity Ratio',
                    data: debt_to_equity_ratio,
                    borderColor: 'rgb(153, 102, 255)',
                }],
                labels: reports
            },
        });


        let roa1Chart = new Chart(roa1, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Laba/rugi Periode Berjalan',
                    data: laba_rugi_tahun_berjalan,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                }, {
                    type: 'bar',
                    label: 'Total Aset',
                    data: aset_total,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(54, 162, 235)'
                }, ],
                labels: reports
            },
        });
        let roa2Chart = new Chart(roa2, {
            data: {
                datasets: [{
                    type: 'line',
                    label: 'Return on Asset Ratio',
                    data: return_on_asset_ratio,
                    borderColor: 'rgb(153, 102, 255)',
                }],
                labels: reports
            },
        });


        let roe1Chart = new Chart(roe1, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Laba/rugi Periode Berjalan',
                    data: laba_rugi_tahun_berjalan,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                }, {
                    type: 'bar',
                    label: 'Total Ekuitas',
                    data: ekuitas_total,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(54, 162, 235)'
                }, ],
                labels: reports
            },
        });
        let roe2Chart = new Chart(roe2, {
            data: {
                datasets: [{
                    type: 'line',
                    label: 'Return on Equity Ratio',
                    data: return_on_equity_ratio,
                    borderColor: 'rgb(153, 102, 255)',
                }],
                labels: reports
            },
        });


        let bopo1Chart = new Chart(bopo1, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Beban Operasional',
                    data: beban_operasional,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                }, {
                    type: 'bar',
                    label: 'Pendapatan Operasional',
                    data: pendapatan_operasional,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(54, 162, 235)'
                }, ],
                labels: reports
            },
        });
        let bopo2Chart = new Chart(bopo2, {
            data: {
                datasets: [{
                    type: 'line',
                    label: 'BOPO',
                    data: beban_pendapatan_operasional,
                    borderColor: 'rgb(153, 102, 255)',
                }],
                labels: reports
            },
        });


        let kk1Chart = new Chart(kk1, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Total Aset',
                    data: aset_total,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                }, {
                    type: 'bar',
                    label: 'Total Liabilitas',
                    data: liabilitas_total,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(54, 162, 235)'
                }, {
                    type: 'bar',
                    label: 'Total Ekuitas',
                    data: ekuitas_total,
                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    borderColor: 'rgba(255, 206, 86, 1)'
                }],
                labels: reports
            },
        });


        let kop1Chart = new Chart(kop1, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Penyaluran Pinjaman yang Diberikan',
                    data: penyaluran_pinjaman_diberikan,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                }, {
                    type: 'bar',
                    label: 'Outstanding Pinjaman',
                    data: outstanding_pinjaman_gadai,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(54, 162, 235)'
                }],
                labels: reports
            },
        });
        let kop2Chart = new Chart(kop2, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Jumlah Nasabah',
                    data: nasabah,
                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    borderColor: 'rgba(255, 206, 86, 1)'
                }],
                labels: reports
            },
        });
    }

    displayChart();
</script>
@endsection