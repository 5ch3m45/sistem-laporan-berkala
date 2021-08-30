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

    public function safeDivider($number, $divider) {
        if($divider == 0) {
            return 0;
        }
        return $number/$divider;
    }

    public function percentageCounter($base, $to_calculate) {
        return $this->safeDivider(($to_calculate - $base), $base);
    }

    public function generateAnalysisArray($collection, $account_code) {
        $data = [];
        // q1 ... q5
        for ($i=0; $i < 5; $i++) { 
            if($collection[$i]) {
                $to_push = $collection[$i]->data()->where('account_code', $account_code)->first()->value;
            } else {
                $to_push = 0;
            }
            array_push($data, $to_push);
        }
        array_push($data, $this->percentageCounter($data[0], $data[4])); // yoy
        array_push($data, $this->percentageCounter($data[0], $data[1])); // qtq1
        array_push($data, $this->percentageCounter($data[1], $data[2])); // qtq2
        array_push($data, $this->percentageCounter($data[2], $data[3])); // qtq3
        array_push($data, $this->percentageCounter($data[3], $data[4])); // qtq4

        return $data;
    }

    public function generateAnalysisData(Request $request) {
        $data = [];
        $latest_reports = $company->reports()->orderByDesc('year')->orderByDesc('quarter')->limit(5)->get();
        return $this->generateAnalysisArray($latest_reports);
    }
}
