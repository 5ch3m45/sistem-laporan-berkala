<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('name')->paginate(25); // get data perusahaan, order by Name, perpage 25 item (keyword: pagination)
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
        $company->update($request->all()); // simpan update ke database dengan semua parameter request (keyword: eloquent update)
        return redirect()->route('show_company', ['company' => $company->id]) // redirect ke route show_company
            ->with(['success' => 'Profil perusahaan berhasil diubah']); // dengan message success
    }
}
