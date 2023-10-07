<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tareas', [TareaController::class,'InsertarTarea']);
Route::get('/tareas', [TareaController::class,'ListarTareas']);
Route::get('/tareas', [TareaController::class,'ListarUnaTarea']);