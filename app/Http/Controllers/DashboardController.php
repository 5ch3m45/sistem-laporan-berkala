<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\File;
use App\Models\Report;
use App\Models\User;

class DashboardController extends Controller
{
  public function index()
  {
    $company_count = Company::count();
    $file_count = File::count();
    $report_count = Report::count();
    $user_count = User::count();

    $last_companies = Company::orderByDesc('id')->limit(10)->get();
    return view('index', compact('company_count', 'file_count', 'report_count', 'user_count', 'last_companies'));
  }
}
