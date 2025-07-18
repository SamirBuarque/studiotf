<?php

use App\Http\Controllers\Api\PlanningController;
use App\Http\Controllers\Api\InventoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventRecordController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\WorkersController;
use App\Http\Controllers\FileController;

//Eventos
Route::get('/events', [EventRecordController::class, 'index']);
Route::get('/events/{eventRecord}/status', [EventRecordController::class, 'getStatus'])->name('event.status');
Route::post('/events/{eventRecord}/status', [EventRecordController::class, 'updateStatus'])->name('event.update.status');

Route::get('/user', function (Request $request) {
    return $request->user();
});
// planejamento
Route::get('/{eventRecord}/plannings', [PlanningController::class, 'index']);
Route::post('/{eventRecord}/plannings', [PlanningController::class, 'store']);
Route::put('/{eventRecord}/plannings/{planning}', [PlanningController::class, 'update']);
Route::delete('/plannings/{planning}', [PlanningController::class, 'destroy']);

//produtos
Route::get('/{eventRecord}/products', [ProductsController::class, 'index']);
Route::post('/{eventRecord}/products', [ProductsController::class, 'store']);
Route::put('/{eventRecord}/products/{product}', [ProductsController::class, 'update']);
Route::delete('/products/{product}', [ProductsController::class, 'destroy']);

//trabalhadores
Route::get('/{eventRecord}/workers', [WorkersController::class, 'unrelatedWorkers']);
Route::get('/{eventRecord}/linked-workers', [WorkersController::class,'linkedWorkers']);
Route::post('/{eventRecord}/workers', [WorkersController::class,'linkWorker']);
Route::put('/unlink-worker', [WorkersController::class,'unlinkWorker']);

//Arquivos
Route::post('/{eventRecord}/files/upload', [FileController::class, 'upload'])->name('file.upload');
Route::get('/{eventRecord}/files/view/{fileId}', [FileController::class, 'view'])->name('file.view');
Route::delete('/{eventRecord}/files/{file}', [FileController::class, 'destroy'])->name('file.destroy');

//Inventario
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::delete('/inventory/{id}', [InventoryController::class, 'delete'])->name('inventory.delete');
Route::put('/inventory/{inventory}', [InventoryController::class, 'update'])->name('inventory.update');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/{eventRecord}/inventory', [InventoryController::class, 'linkedInventory'])->name('inventory.linked-inventory');
Route::post('/unlink-inventory', [InventoryController::class, 'unlinkInventory'])->name('inventory.unlink-inventory');