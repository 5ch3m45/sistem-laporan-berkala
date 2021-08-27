<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Models\Company;
use App\Models\File;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ReportController extends Controller
{
    public function show(Report $report) {
        $company = Company::find($report->company_id);
        return view('report.show', compact('report', 'company'));
    }

    public function store(StoreReportRequest $request)
    {
        /**
         * kode berikut digunakan untuk menghindari duplikasi laporan di tahun dan triwulan yang sama
         */
        $report_exist = Report::where([
            'company_id' => $request->company_id,
            'year' => $request->year,
            'quarter' => $request->quarter
        ])->first();

        $company = Company::findOrFail($request->company_id);

        if( $report_exist ) {
            return back()->withFail(`Laporan Triwulan {$request->quarter} Tahun {$request->year} {$company->name} sudah ada.`);
        }

        /**
         * kode berikut digunakan untuk mendapatkan file berdasarkan nama
         */
        $file = File::where('name', $request->file)->first();

        /**
         * Jika file tidak ditemukan,
         * maka kembali ke form dengan pesan error
         */
        if (!$file) {
            return back()->withErrors(['file' => 'File is not found']);
        }
        /**
         * Kode berikut digunakan untuk mendapatkan alamat file
         */
        $uri = Storage::path($file->uri);
        /**
         * Kode berikut digunakan untuk memuat file kedalam bentuk spreadsheet
         */
        $spreadsheet = IOFactory::load($uri);
        
        /**
         * Kode berikut digunakan untuk menambahkan object
         * company_id dan reporter_id kedalam array $request
         */
        $sheet_0 = $spreadsheet->setActiveSheetIndex(0);
        $request['version'] = $sheet_0->getCell('D4')->getValue(); // versi laporan
        $request['periode'] = Date::excelToDateTimeObject($sheet_0->getCell('D11')->getValue()); // periode laporan
        $request['reported_at'] = Date::excelToDateTimeObject($sheet_0->getCell('D5')->getValue()); // tanggal pelaporan
        $sheet_6 = $spreadsheet->setActiveSheetIndex(6);
        $request['cp_name'] = $sheet_6->getCell('E16')->getValue(); // tanggal pelaporan
        $request['cp_phone'] = $sheet_6->getCell('E18')->getValue(); // tanggal pelaporan
        $request['cp_email'] = $sheet_6->getCell('E19')->getValue(); // tanggal pelaporan
        $request['cp_position'] = $sheet_6->getCell('E17')->getValue(); // tanggal pelaporan
        $request['company_id'] = $company->id; // menambahkan company_id ke $request
        $request['reporter_id'] = Auth::id(); // menambahkan reporter_id ke $request
        /**
         * Kode berikut ini digunakan untuk menyimpan report
         * dari $request ke database
         */
        $report = Report::create($request->all()); // menyimpan report dengan semua parameter di $request

        /**
         * Kode berikut ini digunakan untuk mapping cell
         * yang kemudian disimpan ke database dengan kode akun
         * yang telah ditentukan
         */

        $data_lpk = array(
            'LPK_A_AL_KSK' => 'E18', // Laporan Posisi Keuangan > Aset > Aset Lancar > Kas dan Setara kas
            'LPK_A_AL_I_D' => 'E20', // Laporan Posisi Keuangan > Aset > Aset Lancar > Investasi > Deposito
            'LPK_A_AL_I_SB' => 'E21', // Laporan Posisi Keuangan > Aset > Aset Lancar > Investasi > Surat berharga
            'LPK_A_AL_PD_G' => 'E23', // Laporan Posisi Keuangan > Aset > Aset Lancar > Pinjaman yang Diberikan > Gadai
            'LPK_A_AL_PD_F' => 'E24', // Laporan Posisi Keuangan > Aset > Aset Lancar > Pinjaman yang Diberikan > Fidusia
            'LPK_A_AL_PD_L' => 'E25', // Laporan Posisi Keuangan > Aset > Aset Lancar > Pinjaman yang Diberikan > Lainnya
            'LPK_A_AL_PMHD' => 'E26', // Laporan Posisi Keuangan > Aset > Aset Lancar > Pendapatan yang Masih Harus Diterima
            'LPK_A_AL_BDD' => 'E27', // Laporan Posisi Keuangan > Aset > Aset Lancar > Beban Dibayar Dimuka
            'LPK_A_AL_ALL' => 'E28', // Laporan Posisi Keuangan > Aset > Aset Lancar > Aset Lancar Lainnya
            'LPK_A_ATL_AT' => 'E29', // Laporan Posisi Keuangan > Aset > Aset Tidak Lancar > Aset Tetap
            'LPK_A_ATL_PPL' => 'E31', // Laporan Posisi Keuangan > Aset > Aset Tidak Lancar > Penyertaan pada Perusahaan Lain
            'LPK_A_ATL_ATLL' => 'E32', // Laporan Posisi Keuangan > Aset > Aset Tidak Lancar > Aset Tidak Lancar Lainnya
            'LPK_A_TOTAL' => 'E35', // Laporan Posisi Keuangan > Aset > Jumlah Aset
            'LPK_A_TOTAL_AL' => 'E33', // Laporan Posisi Keuangan > Aset > Jumlah Aset Lancar
            'LPK_A_TOTAL_ATL' => 'E34', // Laporan Posisi Keuangan > Aset > Jumlah Aset Tidak Lancar
            'LPK_L_LL_PD' => 'E38', // Laporan Posisi Keuangan > Liabilitas > Liabilitas Lancar > Pinjaman yang Diterima
            'LPK_L_LL_BMHD' => 'E39', // Laporan Posisi Keuangan > Liabilitas > Liabilitas Lancar > Beban yang Masih Harus Dibayar
            'LPK_L_LL_UKN' => 'E40', // Laporan Posisi Keuangan > Liabilitas > Liabilitas Lancar > Uang Kelebihan Nasabah
            'LPK_L_LL_LLL' => 'E41', // Laporan Posisi Keuangan > Liabilitas > Liabilitas Lancar > Liabilitas Lancar Lainnya
            'LPK_L_LTL_PD' => 'E43', // Laporan Posisi Keuangan > Liabilitas > Liabilitas Tidak Lancar > Pinjaman yang Diterima
            'LPK_L_LTL_LTLL' => 'E44', // Laporan Posisi Keuangan > Liabilitas > Liabilitas Tidak Lancar > Liabilitas Tidak Lancar Lainnya
            'LPK_L_TOTAL' => 'E47', // Laporan Posisi Keuangan > Liabilitas > Jumlah Liabilitas
            'LPK_L_TOTAL_LL' => 'E45', // Laporan Posisi Keuangan > Liabilitas > Jumlah Liabilitas Lancar
            'LPK_L_TOTAL_LTL' => 'E46', // Laporan Posisi Keuangan > Liabilitas > Jumlah Liabilitas Tidak Lancar
            'LPK_E_MD' => 'E49', // Laporan Posisi Keuangan > Ekuitas > Modal Disetor
            'LPK_E_C' => 'E50', // Laporan Posisi Keuangan > Ekuitas > Cadangan
            'LPK_E_SLR_SLRAT' => 'E52', // Laporan Posisi Keuangan > Ekuitas > Saldo Laba/(Rugi) > Saldo Laba/(Rugi) Awal Tahun
            'LPK_E_SLR_LRTB' => 'E53', // Laporan Posisi Keuangan > Ekuitas > Saldo Laba/(Rugi) > Laba/(Rugi) Tahun Berjalan
            'LPK_E_EL' => 'E54', // Laporan Posisi Keuangan > Ekuitas > Ekuitas Lainnya
            'LPK_E_TOTAL' => 'E55', // Laporan Posisi Keuangan > Ekuitas > Jumlah Ekuitas
            'LPK_TOTAL_LE' => 'E56', // Laporan Posisi Keuangan > Jumlah Liabilitas dan Ekuitas
            
        );
        $sheet_8 = $spreadsheet->setActiveSheetIndex(8); // aktivasi sheet ke-9, index dimulai dari 0 (keyword: setting spreadsheet active sheet)
        foreach ($data_lpk as $code => $cell) { // simpan data_lpk ke database, dengan fungsi create_company_report
            $this->create_company_report($report->id, $code, $sheet_8->getCell($cell)->getCalculatedValue());
        }

        $data_lrk = array(
            'LRK_P_PO_PBP_G' => 'E19', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Operasional > Pendapatan Bunga Pinjaman > Gadai
            'LRK_P_PO_PBP_F' => 'E20', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Operasional > Pendapatan Bunga Pinjaman > Fidusia
            'LRK_P_PO_PBP_L' => 'E21', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Operasional > Pendapatan Bunga Pinjaman > Lainnya
            'LRK_P_PO_PA_G' => 'E23', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Operasional > Pendapatan Administrasi > Gadai
            'LRK_P_PO_PA_F' => 'E24', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Operasional > Pendapatan Administrasi > Fidusia
            'LRK_P_PO_PA_L' => 'E25', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Operasional > Pendapatan Administrasi > Lainnya
            'LRK_P_PO_PJ_PJTI' => 'E27', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Operasional > Pendapatan Jasa > Pendapatan Jasa Titipan
            'LRK_P_PO_PJ_PJTA' => 'E28', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Operasional > Pendapatan Jasa > Pendapatan Jasa Taksiran
            'LRK_P_PO_PFBI' => 'E29', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Operasional > Pendapatan Fee Based Income
            'LRK_P_PO_POL' => 'E30', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Operasional > Pendapatan Operasional Lainnya
            'LRK_P_PNO_PBJG' => 'E32', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Non Operasional > Pendapatan Bunga/ Jasa Giro
            'LRK_P_PNO_PNOL' => 'E33', // Laporan Laba Rugi Komprehensif > Pendapatan > Pendapatan Non Operasional > Pendapatan Non Operasional Lainnya
            'LRK_P_TOTAL' => 'E36', // Laporan Laba Rugi Komprehensif > Pendapatan > Jumlah Pendapatan
            'LRK_P_TOTAL_PO' => 'E34', // Laporan Laba Rugi Komprehensif > Pendapatan > Jumlah Pendapatan Operasional
            'LRK_P_TOTAL_PNO' => 'E35', // Laporan Laba Rugi Komprehensif > Pendapatan > Jumlah Pendapatan Non Operasional
            'LRK_B_BO_B' => 'E39', // Laporan Laba Rugi Komprehensif > Beban > Beban Operasional > Bunga
            'LRK_B_BO_P' => 'E40', // Laporan Laba Rugi Komprehensif > Beban > Beban Operasional > Pegawai
            'LRK_B_BO_BPAT' => 'E41', // Laporan Laba Rugi Komprehensif > Beban > Beban Operasional > Beban Penyusutan Aset Tetap
            'LRK_B_BO_BAU' => 'E42', // Laporan Laba Rugi Komprehensif > Beban > Beban Operasional > Beban Administrasi dan Umum
            'LRK_B_BO_BOL' => 'E43', // Laporan Laba Rugi Komprehensif > Beban > Beban Operasional > Beban Operasional Lainnya
            'LRK_B_BNO' => 'E44', // Laporan Laba Rugi Komprehensif > Beban > Beban Non Operasional
            'LRK_B_TOTAL' => 'E46', // Laporan Laba Rugi Komprehensif > Beban > Jumlah Beban
            'LRK_B_TOTAL_BO' => 'E45', // Laporan Laba Rugi Komprehensif > Beban > Jumlah Beban Operasional
            'LRK_B_LRSP' => 'E47', // Laporan Laba Rugi Komprehensif > Beban > Laba Rugi Sebelum Pajak
            'LRK_TPP' => 'E48', // Laporan Laba Rugi Komprehensif > Taksiran Pajak Penghasilan
            'LRK_LRPB' => 'E49', // Laporan Laba Rugi Komprehensif > Laba Rugi Periode Berjalan
        );
        $sheet_9 = $spreadsheet->setActiveSheetIndex(9); // aktivasi sheet ke-10, index dimulai dari 0 (keyword: setting spreadsheet active sheet)
        foreach ($data_lrk as $code => $cell) { // simpan data_lpk ke database, dengan fungsi create_company_report
            $this->create_company_report($report->id, $code, $sheet_9->getCell($cell)->getCalculatedValue());
        }

        $data_lak = array(
            'LAK_AKDAO_PKD_PBP' => 'E18', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Peneirmaan Kas dari > Penerimaan Bunga Pinjaman
            'LAK_AKDAO_PKD_PA' => 'E19', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Peneirmaan Kas dari > Pendapatan Administrasi
            'LAK_AKDAO_PKD_PJ' => 'E20', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Peneirmaan Kas dari > Pendapatan Jasa
            'LAK_AKDAO_PKD_PFBI' => 'E21', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Peneirmaan Kas dari > Pendapatan Fee Based Income
            'LAK_AKDAO_PKD_PPPD' => 'E22', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Peneirmaan Kas dari > Pendapatan Pelunasan Pinjaman yang Diberikan
            'LAK_AKDAO_PKD_PUKN' => 'E23', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Peneirmaan Kas dari > Penerimaan Uang Kelebihan Nasabah
            'LAK_AKDAO_PKD_PL' => 'E24', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Peneirmaan Kas dari > Penerimaan Lainnya
            'LAK_AKDAO_PKD_TOTAL' => 'E25', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Peneirmaan Kas dari > Jumlah Penerimaan Kas dari Aktivitas Operasi
            'LAK_AKDAO_PKU_PBO' => 'E27', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Pengeluaran Kas Untuk > Pembayaran Biaya Operasional
            'LAK_AKDAO_PKU_PBNO' => 'E28', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Pengeluaran Kas Untuk > Pembayaran Biaya Non Operasional
            'LAK_AKDAO_PKU_PPD' => 'E29', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Pengeluaran Kas Untuk > Penyaluran Pinjaman yang Diberikan
            'LAK_AKDAO_PKU_PUKN' => 'E30', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Pengeluaran Kas Untuk > Pembayaran Uang Kelebihan Nasabah
            'LAK_AKDAO_PKU_PL' => 'E31', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Pengeluaran Kas Untuk > Pengeluaran Lainnya
            'LAK_AKDAO_PKU_TOTAL' => 'E32', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Pengeluaran Kas Untuk > Jumlah Pengeluaran Kas untuk Aktivitas Operasi
            'LAK_AKDAI_PKD_PAT' => 'E35', // Laporan Arus Kas > Arus Kas dari Aktivitas Investasi > Penerimaan Kas Dari > Penjualan Aset Tetap
            'LAK_AKDAI_PKD_PPPL' => 'E36', // Laporan Arus Kas > Arus Kas dari Aktivitas Investasi > Penerimaan Kas Dari > Penyertaan pada Perusahaan Lain
            'LAK_AKDAI_PKD_TOTAL' => 'E37', // Laporan Arus Kas > Arus Kas dari Aktivitas Investasi > Penerimaan Kas Dari > Jumlah Pengeluaran Kas untuk Aktivitas Investasi
            'LAK_AKDAI_PKU_PAT' => 'E39', // Laporan Arus Kas > Arus Kas dari Aktivitas Investasi > Penerimaan Kas Untuk > Pembelian Aset Tetap
            'LAK_AKDAI_PKU_PPL' => 'E40', // Laporan Arus Kas > Arus Kas dari Aktivitas Investasi > Penerimaan Kas Untuk > Penyertaan pada Perusahaan Lain
            'LAK_AKDAI_PKU_TOTAL' => 'E41', // Laporan Arus Kas > Arus Kas dari Aktivitas Operasi > Peneirmaan Kas dari > Penerimaan Bunga Pinjaman
            'LAK_AKDAP_PKD_P' => 'E44', // Laporan Arus Kas > Arus Kas dari Aktivitas Pendanaan > Penerimaan Kas Dari > Pinjaman
            'LAK_AKDAP_PKD_PSM' => 'E45', // Laporan Arus Kas > Arus Kas dari Aktivitas Pendanaan > Penerimaan Kas Dari > Penerimaan Setoran Modal
            'LAK_AKDAP_PKD_PL' => 'E46', // Laporan Arus Kas > Arus Kas dari Aktivitas Pendanaan > Penerimaan Kas Dari > Penerimaan Lainnya
            'LAK_AKDAP_PKD_TOTAL' => 'E47', // Laporan Arus Kas > Arus Kas dari Aktivitas Pendanaan > Penerimaan Kas Dari > Jumlah Penerimaan Kas dari Aktivitas Pendanaan
            'LAK_AKDAP_PKU_APP' => 'E49', // Laporan Arus Kas > Arus Kas dari Aktivitas Pendanaan > Pengeluaran Kas Untuk > Angsuran/ Pelunasan Pinjaman
            'LAK_AKDAP_PKU_PD' => 'E50', // Laporan Arus Kas > Arus Kas dari Aktivitas Pendanaan > Pengeluaran Kas Untuk > Pembayaran Dividen
            'LAK_AKDAP_PKU_PL' => 'E51', // Laporan Arus Kas > Arus Kas dari Aktivitas Pendanaan > Pengeluaran Kas Untuk > Pengeluaran Lainnya
            'LAK_AKDAP_PKU_TOTAL' => 'E52', // Laporan Arus Kas > Arus Kas dari Aktivitas Pendanaan > Pengeluaran Kas Untuk > Jumlah Pengeluaran Kas untuk Aktivitas Pendanaan
            'LAK_KPBKSK' => 'E53', // Laporan Arus Kas > Kenaikan/Penurunan Bersih Kas dan Setara Kas
            'LAK_SAWKSK' => 'E54', // Laporan Arus Kas > Saldo Awal Kas dan Setara Kas
            'LAK_SAKKSK' => 'E55', // Laporan Arus Kas > Saldo Akhir Kas dan Setara Kas
        );
        $sheet_10 = $spreadsheet->setActiveSheetIndex(10); // aktivasi sheet ke-11,index dimulai dari 0 (keyword: setting spreadsheet active sheet)
        foreach ($data_lak as $code => $cell) { // simpan data_lpk ke database, dengan fungsi create_company_report
            $this->create_company_report($report->id, $code, $sheet_10->getCell($cell)->getCalculatedValue());
        }

        $data_lo = array(
            'LO_PDG_BK_JUP' => 'E18', // Laporan Operasional > Pinjaman yang Diberikan - Gadai > Barang Kantor > Jumlah Uang Pinjaman
            'LO_PDG_BK_OP' => 'E19', // Laporan Operasional > Pinjaman yang Diberikan - Gadai > Barang Kantor > Outstanding Pinjaman
            'LO_PDG_BK_JN' => 'E20', // Laporan Operasional > Pinjaman yang Diberikan - Gadai > Barang Kantor > Jumlah Nasabah
            'LO_PDG_BG_JUP' => 'E22', // Laporan Operasional > Pinjaman yang Diberikan - Gadai > Barang Gudang > Jumlah Uang Pinjaman
            'LO_PDG_BG_OP' => 'E23', // Laporan Operasional > Pinjaman yang Diberikan - Gadai > Barang Gudang > Outstanding Pinjaman
            'LO_PDG_BG_JN' => 'E24', // Laporan Operasional > Pinjaman yang Diberikan - Gadai > Barang Gudang > Jumlah Nasabah
            'LO_PDG_TOTAL_UPG' => 'E25', // Laporan Operasional > Pinjaman yang Diberikan - Gadai > Jumlah Uang Pinjaman - Gadai
            'LO_PDG_TOTAL_OPG' => 'E26', // Laporan Operasional > Pinjaman yang Diberikan - Gadai > Jumlah Outstanding Pinjaman - Gadai
            'LO_PDG_TOTAL_N' => 'E27', // Laporan Operasional > Pinjaman yang Diberikan - Gadai > Jumlah Nasabah - Gadai (orang)
            'LO_PDF_JUP' => 'E29', // Laporan Operasional > Pinjaman yang Diberikan - Fidusia > Jumlah Uang Pinjaman
            'LO_PDF_OP' => 'E30', // Laporan Operasional > Pinjaman yang Diberikan - Fidusia > Outstanding Pinjaman
            'LO_PDF_JN' => 'E31', // Laporan Operasional > Pinjaman yang Diberikan - Fidusia > Jumlah Nasabah (orang)
            'LO_PDL_JUP' => 'E33', // Laporan Operasional > Pinjaman yang Diberikan - Lainnya > Jumlah Uang Pinjaman
            'LO_PDL_OP' => 'E34', // Laporan Operasional > Pinjaman yang Diberikan - Lainnya > Outstanding Pinjaman
            'LO_PDL_JN' => 'E35', // Laporan Operasional > Pinjaman yang Diberikan - Lainnya > Jumlah Nasabah (orang)
        );
        $sheet_12 = $spreadsheet->setActiveSheetIndex(12); // aktivasi sheet ke-13,index dimulai dari 0 (keyword: setting spreadsheet active sheet)
        foreach ($data_lo as $code => $cell) { // simpan data_lpk ke database, dengan fungsi create_company_report
            $this->create_company_report($report->id, $code, $sheet_12->getCell($cell)->getCalculatedValue());
        }

        return redirect()->route('report', ['company' => $company->id]); // redirect ke route report dengan parameter id laporan
    }

    public function destroy(Request $request) {
        if(Report::find($request->report_id)->delete()) {
            return back()->with('success', 'Laporan berhasil dihapus.');
        }
        return back()->with('error', 'Gagal. Coba lagi.');
    }
} 
