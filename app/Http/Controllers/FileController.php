<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;

use App\Models\Company;
use App\Models\File;

class FileController extends Controller
{
    public function index(Company $company, Request $request)
    {
        $files = File::where('company_id', $company->id);
        
        if($request->has('name')) {
            $files = $files->where('name', 'like', '%'.$request->name.'%');
        }

        $files = $files->orderBy('name')->get(); // dapatkan semua file berdasarkan id perusahaan
        return view('company.file.index', compact('company', 'files')); // tampilkan view company/file/index.blade.php
    }

    public function create(Company $company)
    {
        return view('company.file.create', compact('company'));
    }

    public function store(Company $company, StoreFileRequest $request)
    {
        if($request->name) {
            $filename = $request->name . '.xlsx';
        } else {
            $filename = $request->file->getClientOriginalName();
            $request['name'] = $filename;
        }

        $request['uri'] = 'excel/' . $filename; // menambahkan uri ke $request
        $request['company_id'] = $company->id; // menambahkan company_id ke $request
        $request['uploaded_by'] = Auth::id(); // menambahkan uploaded_by ke $request

        Storage::putFileAs('excel', $request->file, $filename); // upload file ke folder storage/excel dengan nama $name

        File::create($request->all()); // simpan informasi file ke database

        return redirect()->route('company_file', ['company' => $company->id]) // redirect ke route company_file
            ->with('success', 'File berhasil diunggah'); // dengan pesan sukses
    }

    public function edit(Company $company, File $file)
    {
        return view('company.file.edit', compact('company', 'file')); // tampilkan view company/file/edit.blade.php
    }

    public function update(Company $company, File $file, UpdateFileRequest $request)
    {
        $file->update($request->all());
        return redirect()->route('company_file', ['company' => $company->id]) // redirect ke route company_file
            ->with(['success' => 'File berhasil diubah']); // dengan pesan sukses
    }

    public function destroy(Company $company, File $file) {
        Storage::delete($file->uri);
        $file->delete();
        return redirect()->route('company_file', ['company' => $company->id])
            ->with(['success' => 'File berhasil dihapus.']);
    }

    public function exportExcel()
    {
        return view('company.file.export-excel');
    }
}
