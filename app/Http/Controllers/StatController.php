<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

class StatController extends Controller
{
  public function index(Company $company){
    $company = Company::findOrFail($company->id);
    return view('company.statistic.index', compact('company'));
  }
}
