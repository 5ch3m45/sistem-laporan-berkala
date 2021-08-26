<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;

use App\Models\Company;

Route::prefix('/perusahaan')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('company');
    Route::get('/baru', [CompanyController::class, 'create'])->name('create_company');
    Route::post('/baru', [CompanyController::class, 'store']);
    Route::get('/{company}', [CompanyController::class, 'show'])->name('show_company');
    Route::get('/{company}/ubah', [CompanyController::class, 'edit'])->name('edit_company');
    Route::post('/{company}/ubah', [CompanyController::class, 'update']);
});
