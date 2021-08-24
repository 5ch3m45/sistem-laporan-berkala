<?php

use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportWordController;

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

require(__DIR__.'/subroutes/auth.php');
Route::middleware(['auth'])->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
  require(__DIR__.'/subroutes/analysis.php');
  require(__DIR__.'/subroutes/companies.php');
  require(__DIR__.'/subroutes/employe.php');
  require(__DIR__.'/subroutes/file.php');
  require(__DIR__.'/subroutes/notes.php');
  require(__DIR__.'/subroutes/reports.php');
  require(__DIR__.'/subroutes/stats.php');
});

Route::get('export-word', [ExportWordController::class, 'index']);


Route::get('/perusahaan/{company}/export-word', [AnalysisController::class, 'exportWord']);