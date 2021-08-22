<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;

use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Report;

use Illuminate\Http\Request;

class CompanyReportController extends Controller
{
    public function index(Company $company, Request $request) {
        $company_report = CompanyReport::query();
        
        if($request->has('account')) {
            $company_report = $company_report->where('account_code', $request->account);
        }
        
        $company_report = $company_report->get();
        return response()->json($company_report, 200);
    }
}
