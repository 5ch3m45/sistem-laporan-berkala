<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StatController;

Route::get( '/perusahaan/{company}/statistik', [StatController::class, 'index'  ])->name('stats');