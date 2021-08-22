<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Report;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function companyStat(Company $company) {
        $reports = Report::with('data:report_id,account_code,value')->where('company_id', $company->id)->get();
        return response()->json($reports, 200);
    }
}