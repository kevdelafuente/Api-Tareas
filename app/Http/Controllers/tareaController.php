<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarea;
use Illuminate\Support\Facades\Validator;

class tareaController extends Controller
{
    public function InsertarTarea(Request $request){
        try {
            $validation = Validator::make($request->all(), [
                'titulo' => 'required|string|max:255',
                'contenido' => 'required|string|max:255',
                'estado' => 'required|string|max:25',
                'autor' => 'required|string|min:3|max:255',
            ]);
    
            if($validation->fails())
                return response($validation->errors(),403);
    
            $tarea=new Tarea();
            $tarea -> titulo = $request -> post ('titulo');
            $tarea -> contenido = $request -> post ('contenido');
            $tarea -> estado = $request -> post ('estado');
            $tarea -> autor = $request -> post ('autor');
            $tarea -> save();
    
            return $tarea;
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 500); 
        }
    }
    
    public function ModificarTarea(Request $request, $id){
        try {
            $tarea=tarea::findOrFail($id);
    
            $validation = Validator::make($request->all(), [
                'titulo' => 'required|string|max:255',
                'contenido' => 'required|string|max:255',
                'estado' => 'required|string|max:25',
                'autor' => 'required|string|min:3|max:255',
            ]);
    
            if($validation->fails())
                return response($validation->errors(),403);
    
            $tarea -> update($request->all());
            $tarea -> save();
    
            return $tarea;
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 500); 
        }
    }
    
    public function ListarTareas(Request $request){
        try {
            return Tareas::all();
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 500); 
        }
    }
    
    public function ListarUnaTarea(Request $request, $Id){
        try {
            return Tarea::findOrFail($Id);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 404); 
        }
    }
    
    public function EliminarTarea(Request $request, $Id){
        try {
            $tarea=tarea::findOrFail($Id);
            $tarea -> delete();
            return [
                "mensaje" => "La tarea con el id $Id ha sido eliminada correctamente"
            ];
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 500); 
        }
    }
    
    public function BuscarTareaSegunTitulo(request $request, $titulo){
        try {
            $tareas = Tarea::where('titulo', $titulo)->get();
    
            if ($tareas->isEmpty()) {
                return response(['mensaje' => 'No hay tareas con ese título'], 404);
            }
    
            return $tareas;
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 500); 
        }
    }
    
    public function BuscarTareaSegunEstados(request $request, $estado){
        try {
            $tareas = Tarea::where('estado', $estado)->get();
    
            if ($tareas->isEmpty()) {
                return response(['mensaje' => 'No hay tareas con ese estado'], 404);
            }
    
            return $tareas;
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 500); 
        }
    }
    
    public function BuscarTareaSegunAutor(request $request, $autor){
        try {
            $tareas = Tarea::where('autor', $autor)->get();
    
            if ($tareas->isEmpty()) {
                return response(['mensaje' => 'No hay tareas con ese autor'], 404);
            }
    
            return $tareas;
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 500); 
        }
    }
}