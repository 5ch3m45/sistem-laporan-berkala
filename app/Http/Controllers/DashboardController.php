<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\File;
use App\Models\Report;

class DashboardController extends Controller
{
  public function index()
  {
    $company_total = Company::count();
    $last_companies = Company::orderByDesc('id')->limit(10)->get();
    $last_files = File::orderByDesc('id')->limit(10)->get();
    $last_reports = Report::orderByDesc('id')->limit(10)->get();
    return view('index', compact('company_total' ,'last_companies', 'last_files', 'last_reports'));
  }
}
