<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeRequest;
use App\Models\Company;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function store(StoreEmployeRequest $request) {
        if(Employe::create($request->all())) {
            notify()->success('Dewan baru berhasil disimpan.');
            return back();
        }
        notify()->error('Gagal. Coba lagi.');
        return back();
    }

    public function update(Request $request) {
        $employe = Employe::find($request->employe_id);
        if(!$employe) {
            notify()->error('Data tidak ditemukan.');
            return back();
        }
        if( $employe->update($request->all()) ) {
            notify()->success('Berhasil diupdate.');
            return back();
        }
        notify()->error('Gagal. Coba lagi.');
        return back();
    }

    public function destroy(Request $request) {
        $employe = Employe::find($request->employe_id);
        if($employe->delete()) {
            notify()->success('Dewan berhasil dihapus.');
            return back();
        }
        notify()->error('Gagal. Coba lagi.');
        return back();
    }
}
