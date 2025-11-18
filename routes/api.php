<?php

use App\Http\Controllers\RunController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);

Route::get('/machines', [MachineController::class, 'index']);
Route::post('/machines', [MachineController::class, 'store']);
Route::get('/machines/by-serial/{serial}', [MachineController::class, 'findBySerial']);


Route::get('/runs', [RunController::class, 'index']);
Route::delete('/runs/{id}', [RunController::class, 'destroy']);


// Empezar la run
Route::post('/runs/start', [RunController::class, 'start']);
// Finalizar la run
Route::post('/runs/{id}/end', [RunController::class, 'end']);

Route::post('/results', [ResultController::class, 'store']);
// Resultados en conjunto
Route::post('/results/bulk', [ResultController::class, 'storeBulk']);
Route::get('/results/{run_id}', [ResultController::class, 'show']);
