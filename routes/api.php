<?php

use App\Http\Controllers\Api\PlanningController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventRecordController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\WorkersController;

Route::get('/events', [EventRecordController::class, 'index']);

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


