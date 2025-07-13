<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventRecordController;
use App\Http\Controllers\Api\WorkersController;
use App\Http\Controllers\UserController;



Route::get('/login', [UserController::class, 'showLogin'])->name('user.showLogin');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {

  Route::get('/', [HomeController::class, 'index'])->name('index');

  Route::post('/logout', [UserController::class,'logout'])->name('user.logout');

  // EVENTOS
  Route::get('/evento/detalhamento/{id}', [EventRecordController::class, 'show'])->name('detail');
  Route::get('/evento/adicionar', [EventRecordController::class, 'create'])->name('event.create');
  Route::post('/evento/adicionar', [EventRecordController::class, 'store'])->name('event.store');
  Route::delete('/evento/remover/{eventRecord}', [EventRecordController::class, 'destroy'])->name('event.destroy');
  Route::get('/evento/editar/{eventRecord}', [EventRecordController::class, 'edit'])->name('event.edit');

  //TRABALHADORES
  Route::get('/trabalhador', [WorkersController::class, 'index'])->name('worker.index');
  Route::get('/trabalhador/adicionar', [WorkersController::class, 'create'])->name('worker.create');
  Route::get('/trabalhador/editar/{worker}', [WorkersController::class, 'edit'])->name('worker.edit');
  Route::post('/trabalhador/adicionar', [WorkersController::class, 'store'])->name('worker.store');
  Route::put('/trabalhador/editar/{worker}', [WorkersController::class, 'update'])->name('worker.update');
  Route::delete('/trabalhador/deletar/{worker}', [WorkersController::class, 'destroy'])->name('worker.delete');

  //INVENTARIO
  Route::get('/inventario', [InventoryController::class, 'index'])->name('inventory.index');
  Route::get('/inventario/adicionar', [InventoryController::class, 'create'])->name('inventory.create');
  Route::post('/inventario/adicionar', [InventoryController::class, 'store'])->name('inventory.store');
  Route::get('/inventario/editar/{inventory}', [InventoryController::class, 'edit'])->name('inventory.edit');

});

