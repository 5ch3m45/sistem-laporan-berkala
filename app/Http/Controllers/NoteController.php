<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreNoteRequest;

use App\Models\Company;
use App\Models\Note;

class NoteController extends Controller
{
    public function index(Company $company)
    {
        $notes = Note::where('company_id', $company->id)->orderByDesc('id')->paginate(10); // get semua note dari company
        return view('company.note.index', compact('company', 'notes')); // tampilkan view company/note/index.blade.php
    }

    public function store(Company $company, StoreNoteRequest $request)
    {
        $request['user_id'] = Auth::id(); // menambahkan user_id di $request
        $request['company_id'] = $company->id; // menambahkan company_id di $request
        $request['is_read'] = 0; // menambahkan is_read = 0 di $request (0 berarti false, belum dibaca)

        Note::create($request->all()); // simpan note ke database

        return redirect()->route('note', ['company' => $company->id]) // redirect ke route note
            ->with(['success' => 'Catatan berhasil disimpan']); // dengan pesan success
    }

    public function edit(Company $company, Note $note)
    {
        return view('company.note.edit', compact('company', 'note')); // tampilkan halaman company/note/edit.blade.php
    }

    public function update(Company $company, Note $note, StoreNoteRequest $request)
    {
        $note = $note->update($request->all()); // update note
        return redirect()->route('note', ['company' => $company->id]) // redirect ke route note
            ->with(['success' => 'Catatan berhasil diubah']); // dengan pesan success
    }

    public function delete(Company $company, Note $note)
    {
        $note->delete(); // hapus note
        return back()->with(['success' => 'Catatan berhasil dihapus']); // kembali dengan pesan success
    }
}
