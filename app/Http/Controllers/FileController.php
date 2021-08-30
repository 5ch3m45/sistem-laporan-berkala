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
    public function store(StoreFileRequest $request)
    {
        if($request->name) {
            $filename = $request->name . '.xlsx';
        } else {
            $filename = $request->file->getClientOriginalName();
            $request['name'] = $filename;
        }

        // cek apakah file name is exist
        if( File::where('name', $filename)->first() ) {
            notify()->error('File sudah ada.');
            return back();
        }

        $request['uri'] = 'excel/' . $filename; // menambahkan uri ke $request
        $request['uploaded_by'] = Auth::id(); // menambahkan uploaded_by ke $request

        if(Storage::putFileAs('excel', $request->file, $filename) && File::create($request->all())) {
            notify()->success('File berhasil diunggah');
            return back();
        }
        notify()->error('Gagal. Coba lagi.');
        return back();
    }

    public function destroy(Request $request) {
        $file = File::find($request->file_id);
        if(Storage::delete($file->uri) && $file->delete()) {
            notify()->success('Berkas berhasil dihapus.');
            return back();
        }
        notify()->error('Gagal. Coba lagi.');
        return back();
    }
}
