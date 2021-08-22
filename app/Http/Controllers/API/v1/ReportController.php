<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Report;

class ReportController extends Controller
{
    public function index(Company $company) {
        $reports = Report::where('company_id', $company->id)->get();
        return response()->json($reports, 200);
    }

    public function show(Company $company, Report $report, Request $request) {
        $company_report = CompanyReport::where('report_id', $report->id);
        
        if($request->has('account')) {
            $company_report = $company_report->where('account_code', $request->account);
        }
        
        $company_report = $company_report->first();
        return response()->json($company_report, 200);
    }
}
