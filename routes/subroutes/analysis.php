<?php

use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;

Route::prefix('/perusahaan/{company}/analisis')->group(function () {
    Route::get('/', [AnalysisController::class, 'index'])->name('analysis');
});