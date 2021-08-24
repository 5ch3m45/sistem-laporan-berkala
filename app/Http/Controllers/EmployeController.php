<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeRequest;
use App\Models\Company;
use App\Models\Employe;

class EmployeController extends Controller
{
    public function index(Company $company) {
        return view('company.employes.index', compact('company'));
    }

    public function store(Company $company, StoreEmployeRequest $request) {
        $request['is_contact_person'] = $request->cp ? 1 : 0;
        // cek contact_person
        if( $request['is_contact_person'] ==1 && Employe::where(['company_id' => $company->id, 'is_contact_person' => 1])->first() ) {
            return back()->with('error', 'Sudah ada contact person')->withInput();
        }
        
        $request['company_id'] = $company->id;
        
        if(Employe::create($request->all())) {
            return redirect()->route('employe', ['company' => $company->id])
                ->with('success', 'Anggota berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal. Coba lagi.')->withInput();
    }

    public function edit(Company $company, Employe $employe) {
        return view('company.employes.edit', compact('company', 'employe'));
    }

    public function update(Company $company, Employe $employe, StoreEmployeRequest $request) {
        $request['is_contact_person'] = $request->cp ? 1 : 0;
        // cek contact_person
        if( $request['is_contact_person'] ==1 && Employe::where(['company_id' => $company->id, 'is_contact_person' => 1])->first() ) {
            return back()->with('error', 'Sudah ada contact person')->withInput();
        }

        $request['company_id'] = $company->id;

        if( $employe->update($request->all()) ) {
            return redirect()->route('employe', ['company' => $company->id])
                ->with('success', 'Anggota berhasil diupdate');
        }

        return back()->with('error', 'Gagal. Coba lagi.')->withInput();
    }

    public function destroy(Company $company, Employe $employe) {
        if( $employe->delete() ) {
            return back()->with('success', 'Anggota berhasil dihapus');
        }
        
        return back()->with('error', 'Gagal. Coba lagi')->withInput();
    }
}
