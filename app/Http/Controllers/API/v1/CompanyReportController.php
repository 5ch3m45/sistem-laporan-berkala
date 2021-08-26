<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;

use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Report;

use Illuminate\Http\Request;

class CompanyReportController extends Controller
{
    public function show(Request $request) {
        $callback_data = 'data';

        $report = Report::where('company_id', $request->company_id);

        if(isset($request->year)) {
            $report = $report->where('year', $request->year);
        }

        if(isset($request->quarter)) {
            $report = $report->where('quarter', $request->quarter);
        }

        if(isset($request->from_year)) {
            $report = $report->where('year', '>=', $request->from_year);
        }

        if(isset($request->from_quarter)) {
            $report = $report->where('quarter', '>=', $request->from_quarter);
        }

        if(isset($request->to_year)) {
            $report = $report->where('year', '<=', $request->to_year);
        }

        if(isset($request->to_quarter)) {
            $report = $report->where('quarter', '<=', $request->to_quarter);
        }

        if(isset($request->account_code)) {
            $callback_data = ['data' => function($q) use($request) {
                $q->where('account_code', $request->account_code);
            }];
        }

        $report = $report->orderByDesc('year')->orderByDesc('quarter')->with($callback_data);
        
        if(isset($request->limit)) {
            $report = $report->limit($request->limit);
        }
        
        $report = $report->get();
        return response()->json(compact('report'), 200);
        
    }
}
