<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tareas', [TareaController::class,'InsertarTarea']);
Route::get('/tareas', [TareaController::class,'ListarTareas']);
Route::get('/tareas/{id}', [TareaController::class,'ListarUnaTarea']);
Route::post('/tareas/{id}', [TareaController::class,'ModificarUnaTarea']);
Route::delet('/tareas/{id}', [TareaController::class,'EliminarTarea']);
Route::get('/tareas/{titulo}', [TareaController::class,'BuscarTareaSegunTitulo']);
Route::get('/tareas/{estado}', [TareaController::class,'BuscarTareaSegunEstados']);
Route::get('/tareas/{autor}', [TareaController::class,'BuscarTareaSegunAutor']);