<?php

use App\Http\Controllers\API\v1\AnalysisController;
use App\Http\Controllers\API\v1\CompanyReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\v1\ReportController;
use App\Http\Controllers\API\v1\StatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('report-data', [CompanyReportController::class, 'show']);
Route::post('export-data-word', [CompanyReportController::class, 'exportWord']);
Route::post('export-data-excel', [CompanyReportController::class, 'exportExcel']);

// Route::prefix('v1')->group(function () {
//     Route::get('/perusahaan/{company}/chart', [StatController::class, 'companyStat']);
//     Route::get('/perusahaan/{company}/analyze', [AnalysisController::class, 'companyAnalysis']);
// });
