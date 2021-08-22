<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{
    public function companyAnalysis(Company $company, Request $request) {
        // dapatkan laporan terakhir perusahaan dengan id $company->id
        $latest_report = Report::where('company_id', $company->id)
            ->orderByDesc('year')
            ->orderByDesc('quarter')
            ->first();
        // jika tidak ada request->year maka laporan terakhir adalah laporan tahun $latest_report->year
        // jika tidak ada request->quarter maka laporan terakhir adalah laporan triwulan $latest_report->quarter
        $request->year = $request->year ?? $latest_report->year;
        $request->quarter = $request->quarter ?? $latest_report->quarter;
        // dapatkan 4 terakhir laporan sebelum tahun $request->year triwulan $request->quarter
        $latest_four_report = Report::with('data')->select(DB::raw('id, year, quarter, year + quarter/10 as periode'))
            ->whereRaw('year + quarter/10 <= '.$request->year.'.'.$request->quarter)
            ->orderByDesc('year')
            ->orderByDesc('quarter')
            ->limit(5)->get();
        // jika jumlah laporan tidak sama dengan 5 (tidak terjadi analisis tahunan) maka error
        if(count($latest_four_report) != 5) {
            return response()->json(['error' => 'Data is not enough'], 400);
        }
        return response()->json($latest_four_report, 200);
    }
}
