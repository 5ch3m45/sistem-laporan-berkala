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
                    <div class="col-md-3 mb-4">
                        <x-company-sidebar :company="$company" active="analisis-tahunan" />
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6">
                                <div>
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <p class="mb-0 font-weight-bold">Analisis</p>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group mb-0 d-flex align-items-center">
                                                <input type="number" class="form-control" name="year" value="{{ $latest_report->year }}" placeholder="Tahun">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group mb-0 d-flex align-items-center">
                                                <input type="number" class="form-control" name="quarter" value="{{ $latest_report->quarter }}" placeholder="Triwulan">
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex align-items-center">
                                            <button class="btn btn-primary get-analysis-data"><i class="fe fe-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3 d-flex justify-content-end">
                                <input type="hidden" name="company_id" value="{{ $company->id }}">
                                <button class="btn btn-primary export-btn mr-2"><i class="fe fe-download"></i> Unduh Laporan (.docx)</button>
                                <button class="btn btn-primary export-excel-btn"><i class="fe fe-download"></i> Unduh Laporan (.xlsx)</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table card-table table-vcenter text-nowrap" style="font-size: .8rem">
                                                <thead>
                                                    <tr>
                                                        <th class="font-weight-bold">Keterangan</th>
                                                        <th class="font-weight-bold q-caption-1">Triwulan</th>
                                                        <th class="font-weight-bold q-caption-2">Triwulan</th>
                                                        <th class="font-weight-bold q-caption-3">Triwulan</th>
                                                        <th class="font-weight-bold q-caption-4">Triwulan</th>
                                                        <th class="font-weight-bold q-caption-5">Triwulan</th>
                                                        <th class="font-weight-bold">Y-o-Y</th>
                                                        <th class="font-weight-bold">q-t-q (1)</th>
                                                        <th class="font-weight-bold">q-t-q (2)</th>
                                                        <th class="font-weight-bold">q-t-q (3)</th>
                                                        <th class="font-weight-bold">q-t-q (4)</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="analysisContainer"></tbody>
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

@section('foot-js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $('.get-analysis-data').click(function() {
            $('#analysisContainer').html('')
            generateAnalysis()
        })
        function safeDivider($number, $divider) {
            if($divider == 0) {
                return 0;
            }
            return $number/$divider;
        }
        function qtqyoyCounter($array) {
            let nf = new Intl.NumberFormat()
            let yoy = (safeDivider($array[4] - $array[0], $array[0])*100).toLocaleString('id-ID')+"%";
            let qtq1 = (safeDivider($array[1] - $array[0], $array[0])*100).toLocaleString('id-ID')+"%";
            let qtq2 = (safeDivider($array[2] - $array[1], $array[1])*100).toLocaleString('id-ID')+"%";
            let qtq3 = (safeDivider($array[3] - $array[2], $array[2])*100).toLocaleString('id-ID')+"%";
            let qtq4 = (safeDivider($array[4] - $array[3], $array[3])*100).toLocaleString('id-ID')+"%";
            return [yoy, qtq1, qtq2, qtq3, qtq4];
        }
        function arrayDivider(base, divider) {
            return base.map(function(v, i) { return safeDivider(v*100, divider[i]) })
        }
        function arrayAdd(base, add) {
            return base.map(function(v, i) { return v + add[i] })
        }
        async function generateAnalysis() {
            let company_id = $('input[name=company_id]').val()
            let params = {
                company_id: company_id,
                to_year: $('input[name=year]').val(),
                to_quarter: $('input[name=quarter]').val(),
                limit: 5
            }
            let response = await axios.get('/api/report-data', {params: params})
            accounts = [
                {name: 'Kas dan Setara Kas', code: 'LPK_A_AL_KSK'}, //0
                {name: 'Pinjaman Yang Diberikan', code: 'LO_PDG_TOTAL_OPG'}, //1
                {name: 'Aset Lancar Lainnya', code: 'LPK_A_AL_ALL'}, //2
                {name: 'Aset Lancar', code: 'LPK_A_TOTAL_AL'}, //3
                {name: 'Aset Tidak Lancar', code: 'LPK_A_TOTAL_ATL'}, //4
                {name: 'Aset Total', code: 'LPK_A_TOTAL'}, //5
                {name: 'Liabilitas Lancar', code: 'LPK_L_TOTAL_LL'}, //6
                {name: 'Liabilitas Tidak Lancar', code: 'LPK_L_TOTAL_LTL'}, //7
                {name: 'Liabilitas Total', code: 'LPK_L_TOTAL'}, //8
                {name: 'Modal Disetor', code: 'LPK_E_MD'}, //9
                // {name: 'Saldo Laba/Rugi', code: ''}, // 10
                {name: 'Saldo Laba/Rugi Awal Tahun', code: 'LPK_E_SLR_SLRAT'}, //11
                {name: 'Saldo Laba/Rugi Tahun Berjalan', code: 'LPK_E_SLR_LRTB'}, //12
                {name: 'Ekuitas Total', code: 'LPK_E_TOTAL'}, //13
                {name: 'Pendapatan Imbal Jasa', code: 'LAK_AKDAO_PKD_PJ'}, //14
                {name: 'Pendapatan Administrasi', code: 'LAK_AKDAO_PKD_PA'}, //15
                {name: 'Pendapatan Operasional', code: 'LRK_P_TOTAL_PO'}, //16
                {name: 'Pendapatan Non Operasional', code: 'LRK_P_TOTAL_PNO'}, //17
                {name: 'Pendapatan Total', code: 'LRK_P_TOTAL'}, //18
                {name: 'Beban Operasional', code: 'LRK_B_TOTAL_BO'}, //19
                {name: 'Beban Non Operasional', code: 'LRK_B_BNO'}, //20
                {name: 'Beban Total', code: 'LRK_B_TOTAL'}, //21
                {name: 'Laba/Rugi Sebelum Pajak', code: 'LRK_B_LRSP'}, //22
                {name: 'Taksiran Pajak Penghasilan', code: 'LRK_TPP'}, //23
                {name: 'Laba/Rugi Periode Berjalan', code: 'LRK_LRPB'}, //24
                // {name: 'Pinjaman yang Diberikan', code: ''}, //25
                {name: 'Jumlah Pinjaman yang Diberikan', code: 'LO_PDG_TOTAL_UPG'}, //26
                {name: 'Jumlah Outstanding Gadai', code: 'LO_PDG_TOTAL_OPG'}, //27
                {name: 'Jumlah Nasabah', code: 'LO_PDG_TOTAL_N'}, //28
            ]
            
            let quarter_caption = response.data.report.map(data => `Triwulan ${data.quarter} ${data.year}`).reverse();
            quarter_caption.map((caption, index) => $(`.q-caption-${index+1}`).text(caption))
            // all accounts in q1 .. q5
            let report_data = accounts.map((account) => ({
                name: account.name,
                value: response.data.report.map(({data}) => data.find(({account_code}) => account_code == account.code).value).reverse()
            }))
            console.log(report_data);
            // tambah row Saldo laba rugi dan Pinjaman yang Diberikan
            report_data.splice(10, 0, {name: 'Saldo Laba/Rugi', value: arrayAdd(report_data[10].value, report_data[11].value)})
            report_data.splice(25, 0, {name: 'Pinjaman yang Diberikan', value: arrayAdd(report_data[25].value, arrayAdd(report_data[26].value, report_data[27].value))})
            // add ratio
            report_data.push({name: 'Current Ratio', value: arrayDivider(report_data[3].value, report_data[6].value)})
            report_data.push({name: 'Debt to Equity', value: arrayDivider(report_data[8].value, report_data[13].value)})
            report_data.push({name: 'Debt to Asset', value: arrayDivider(report_data[8].value, report_data[5].value)})
            report_data.push({name: 'Return on Asset', value: arrayDivider(report_data[24].value, report_data[5].value)})
            report_data.push({name: 'Return on Equity', value: arrayDivider(report_data[12].value, report_data[13].value)})
            report_data.push({name: 'BOPO', value: arrayDivider(report_data[19].value, report_data[16].value)})
            
            report_data.map(({value}) => value.push(...qtqyoyCounter(value)))

            return {report_data, quarter_caption}
        }
        async function renderAnalysis() {
            let {report_data} = await generateAnalysis();
            report_data.map((data, index) => {
                let name = data.name;
                let values = data.value;
                $('#analysisContainer').append(`<tr id="row-${index}"></tr>`);
                values.unshift(name)
                if(index < 29) {
                    values.map(value => $(`#row-${index}`).append(`<td>${value ? value.toLocaleString('id-ID') : 0}</td>`));
                } else {
                    values.map((value, j) => {
                        if(j > 0 && j < 6) {
                            $(`#row-${index}`).append(`<td>${value.toLocaleString('id-ID')}%</td>`)
                        } else {
                            $(`#row-${index}`).append(`<td>${value.toLocaleString('id-ID')}</td>`)
                        }
                    });
                }
            })
        }
        renderAnalysis()

        $('.export-btn').click(async function(){
            let data = await generateAnalysis()
            let params = ({
                company: $('input[name=company_id]').val(),
                report_year: $('input[name=year]').val(),
                report_quarter: $('input[name=quarter]').val(),
                quarter_caption: data.quarter_caption,
                data: data.report_data
            })
            let response = await axios.post('/api/export-data-word', params, {responseType: 'arraybuffer'})
            const type = response.headers['content-type']
            const blob = new Blob([response.data], { type: type, encoding: 'UTF-8' })
            const link = document.createElement('a')
            link.href = window.URL.createObjectURL(blob)
            link.download = 'file.docx'
            link.click()
        })

        $('.export-excel-btn').click(async function() {
            let data = await generateAnalysis()
            let params = ({
                company: $('input[name=company_id]')
            })
            let response = await axios.post('/api/export-data-excel', params);
            window.location.href = (response.data.url);
        })
    </script>
@endsection