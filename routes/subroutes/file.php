<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FileController;

Route::prefix('/perusahaan/{company}/file')->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('company_file');
    Route::get('/baru', [FileController::class, 'create'])->name('upload_file');
    Route::post('/baru', [FileController::class, 'store']);
    Route::get('/{file}/ubah', [FileController::class, 'edit'])->name('edit_file');
    Route::post('/{file}/ubah', [FileController::class, 'update']);
    Route::delete('/{file}/hapus', [FileController::class, 'destroy'])->name('delete_file');
});
