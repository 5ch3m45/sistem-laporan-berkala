<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreNoteRequest;

use App\Models\Company;
use App\Models\Note;

class NoteController extends Controller
{
    public function store(Company $company, StoreNoteRequest $request)
    {
        $request['user_id'] = Auth::id(); // menambahkan user_id di $request

        if(Note::create($request->all())) {
            notify()->success('Catatan berhasil disimpan.');
            return back();
        }
        notify()->error('Gagal. Coba lagi.');
        return back();
    }
    
    public function destroy(Request $request) {
        $note = Note::where('user_id', Auth::id())->where('id', $request->note_id)->first();
        if($note->delete()) {
            notify('Catatan berhasil dihapus.');
            return back();
        }
        notify()->error('Gagal. Coba lagi.');
        return back();
    }
}
