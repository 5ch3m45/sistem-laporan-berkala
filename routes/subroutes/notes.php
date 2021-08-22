<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NoteController;

Route::prefix('/perusahaan/{company}/catatan')->group(function () {
  Route::get('/', [NoteController::class, 'index'])->name('note');
  Route::get('/baru', [NoteController::class, 'create'])->name('create_note');
  Route::post('/baru', [NoteController::class, 'store'])->name('create_note');
  Route::get('/{note}/ubah', [NoteController::class, 'edit'])->name('edit_note');
  Route::post('/{note}/ubah', [NoteController::class, 'update'])->name('edit_note');
  Route::get('/{note}/hapus', [NoteController::class, 'delete'])->name('delete_note');
});