<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventRecordController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/detalhamento/{id}', [EventRecordController::class, 'show'])->name('detail');
Route::get('/adicionar', [EventRecordController::class, 'create'])->name('event.create');