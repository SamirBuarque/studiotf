<?php

use App\Http\Controllers\Api\PlanningController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventRecordController;


Route::get('/events', [EventRecordController::class, 'index']);

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/{eventRecord}/plannings', [PlanningController::class, 'index']);
Route::post('/{eventRecord}/plannings', [PlanningController::class, 'store']);
Route::put('/{eventRecord}/plannings/{planning}', [PlanningController::class, 'update']);
Route::delete('/plannings/{planning}', [PlanningController::class, 'destroy']);





