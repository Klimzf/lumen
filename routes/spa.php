<?php

use App\Http\Controllers\Note\NoteController;
use Illuminate\Support\Facades\Route;

// Все маршруты SPA защищены аутентификацией
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // CRUD для записок
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
});

// Fallback для SPA - все остальные запросы отдают корневой компонент Vue
Route::get('/{any}', function () {
    return inertia('App');
})->where('any', '.*');
