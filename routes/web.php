<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventRecordController;
use App\Http\Controllers\TesteFormulario;
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/evento/detalhamento/{id}', [EventRecordController::class, 'show'])->name('detail');
Route::get('/evento/adicionar', [EventRecordController::class, 'create'])->name('event.create');
Route::post('/evento/adicionar', [EventRecordController::class, 'store'])->name('event.store');
Route::delete('/evento/remover/{eventRecord}', [EventRecordController::class, 'destroy'])->name('event.destroy');

