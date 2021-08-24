<?php

use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Route;

Route::get('/perusahaan/{company}/anggota', [EmployeController::class, 'index'])->name('employe');
Route::post('/perusahaan/{company}/anggota/baru', [EmployeController::class, 'store'])->name('create_employe');
Route::get('/perusahaan/{company}/anggota/{employe}', [EmployeController::class, 'edit'])->name('update_employe');
Route::put('/perusahaan/{company}/anggota/{employe}', [EmployeController::class, 'update']);
Route::delete('/perusahaan/{company}/anggota/{employe}', [EmployeController::class, 'destroy'])->name('delete_employe');