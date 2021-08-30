<?php

use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\API\v1\CompanyReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ExportWordController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ReportController;
use App\Models\Report;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get( '/masuk', [AuthController::class, 'index'])->name('login');
Route::post('/masuk', [AuthController::class, 'login']);
Route::get('/daftar', [AuthController::class, 'registerForm'])->name('register');
Route::post('/daftar', [AuthController::class, 'register']);
Route::get('export-data-excel', [CompanyReportController::class, 'exportExcel']);
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/berkas', [FileController::class, 'store'])->name('upload_file');
    Route::delete('/berkas', [FileController::class, 'destroy'])->name('delete_file');

    Route::post('/catatan', [NoteController::class, 'store'])->name('create_note');
    Route::delete('/catatan', [NoteController::class, 'destroy'])->name('delete_note');
    
    Route::post('/dewan', [EmployeController::class, 'store'])->name('create_employe');
    Route::delete('/dewan', [EmployeController::class, 'destroy'])->name('delete_employe');
    Route::put('/dewan', [EmployeController::class, 'update'])->name('update_employe');
    
    Route::post('/laporan', [ReportController::class, 'store'])->name('create_report');
    Route::delete('/laporan', [ReportController::class, 'destroy'])->name('delete_report');
    Route::get('/laporan/{report}', [ReportController::class, 'show'])->name('show_report');
    
    Route::get( '/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/perusahaan', [CompanyController::class, 'index'])->name('company');
    Route::post('/perusahaan', [CompanyController::class, 'store'])->name('create_company');
    Route::get('/perusahaan/{company}', [CompanyController::class, 'show'])->name('show_company');
    Route::get('/perusahaan/{company}/edit', [CompanyController::class, 'edit'])->name('edit_company');
    Route::put('/perusahaan/{company}/edit', [CompanyController::class, 'update'])->name('edit_company');
    Route::get('/perusahaan/{company}/analisis-tahunan', [CompanyController::class, 'analysis'])->name('company_analysis');
    Route::get('/perusahaan/{company}/berkas', [CompanyController::class, 'files'])->name('company_files');
    Route::get('/perusahaan/{company}/catatan', [CompanyController::class, 'notes'])->name('company_notes');
    Route::get('/perusahaan/{company}/dewan', [CompanyController::class, 'employes'])->name('company_employes');
    Route::get('/perusahaan/{company}/laporan', [CompanyController::class, 'reports'])->name('company_reports');
});