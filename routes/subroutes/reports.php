<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyReportController;

Route::prefix('/perusahaan/{company}/laporan')->group(function () {
  Route::get( '/',                  [CompanyReportController::class, 'index'  ])->name('report');
  Route::get( '/baru',              [CompanyReportController::class, 'create' ])->name('create_report');
  Route::post('/baru',              [CompanyReportController::class, 'store'  ]);
  Route::get( '/{report}',       [CompanyReportController::class, 'show'   ])->name('show_report');
  Route::get( '/{report}',       [CompanyReportController::class, 'show'   ])->name('show_report');
  Route::delete('/{report}/hapus', [CompanyReportController::class, 'delete' ])->name('delete_report');
});