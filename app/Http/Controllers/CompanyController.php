<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\Report;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::orderBy('name');
        if(isset($request->name)) {
            $companies = $companies->where('name', 'like', '%'.$request->name.'%');
        }
        $companies = $companies->paginate(25); // get data perusahaan, order by Name, perpage 25 item (keyword: pagination)
        return view('company.index', compact('companies')); // tampilkan view company index
    }

    public function show(Company $company)
    {
        return view('company.show', compact('company')); // tampilkan view company/show.blade.php, sesuai parameter id perusahaan (keyword: route model binding)
    }

    public function create()
    {
        return view('company.create'); // tampilkan view company/create.blade.php
    }

    public function store(StoreCompanyRequest $request) // validasi request ada di StoreCompanyRequest (keyword: form request validation)
    {
        $company = Company::create($request->all()); // simpan company ke db dengan semua parameter di $request
        return redirect()->route('show_company', ['company' => $company->id]) // redirect ke route show_company dengan parameter id perusahaan
            ->with(['success' => 'Perusahaan berhasil disimpan.']); // dengan pesan sukses
    }

    public function edit(Company $company)
    {
        return view('company.edit', compact('company')); // tampilkan view company/edit.blade.php, sesuai parameter id perusahaan (keyword: route model binding)
    }

    public function update(Company $company, StoreCompanyRequest $request)
    {
        if ($company->update($request->all())) {
            notify()->success('Perusahaan berhasil diupdate');
            return back(); // dengan message success
        }
        notify()->error('Gagal. Coba lagi.');
        return back();
    }

    public function analysis(Company $company) {
        $latest_report = Report::where('company_id', $company->id)
            ->orderByDesc('year')
            ->orderByDesc('quarter')
            ->first();
        return view('company.analysis', compact('company', 'latest_report'));
    }
    
    public function employes(Company $company) {
        return view('company.employes', compact('company'));
    }

    public function files(Company $company) {
        return view('company.files', compact('company'));
    }

    public function reports(Company $company) {
        return view('company.reports', compact('company'));
    }

    public function notes(Company $company) {
        return view('company.notes', compact('company'));
    }
}
