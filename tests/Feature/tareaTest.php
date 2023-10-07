<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class tareaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_InsertarTarea()
    {
        $response = $this -> post('/api/tareas',[
            "titulo" => "Hompage",
            "contenido" => "Crear Hompage",
            "estado" => "En proceso",
            "autor" => "Raul",
        ]);

        $response->assertStatus(201);

        $response->assertJsonCount(7);

        $this->assertDatabaseHas('tareas', [
            "titulo" => "Hompage",
            "contenido" => "Crear Hompage",
            "estado" => "En proceso",
            "autor" => "Raul",
        ]);

    }

    public function test_InsertarTareaConErrores()
    {
        $response = $this -> post('/api/tareas',[
            "titulo" => "Hompage",
            "estado" => "En proceso",
            "autor" => "Raul",
        ]);

        $response->assertStatus(403);

    }

    public function test_ListarTareas()
    {
        $response = $this->get('/api/tareas');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            [
               'id',
               'Titulo',
               'Contenido',
               'Estado',
               'Autor',
               'created_at',
               'updated_at',
               'deleted_at'
           ]
   ]);

    }

    public function test_ListarUnaTarea()
    {
        $response->assertJsonStructure([
            [
               'id',
               'Titulo',
               'Contenido',
               'Estado',
               'Autor',
               'created_at',
               'updated_at',
               'deleted_at'
           ]
        ]);

        $response = $this->get('/api/tareas/1');

        $response->assertStatus(200);

        $response->assertJsonCount(8);

        $response->assertJsonStructure($estructura);

    }

    public function test_ListarUnaTareaInexistente()
    {
        $response = $this->get('/api/tareas/1988');

        $response->assertJsonStructure($estructura);

    }

    public function test_ModificarTarea()
    {
        $response->assertJsonStructure([
            [
               'id',
               'Titulo',
               'Contenido',
               'Estado',
               'Autor',
               'created_at',
               'updated_at',
               'deleted_at'
           ]
        ]);

        $response = $this -> post('/api/tareas/1',[
            "titulo" => "GTA IV",
            "contenido" => "Hackeando la matrix",
            "estado" => "En proceso",
            "autor" => "Gonzalito",
        ]);

        $response->assertStatus(200);

        $response->assertJsonCount(7);

        $this->assertDatabaseHas('tareas', [
            "titulo" => "GTA IV",
            "contenido" => "Hackeando la matrix",
            "estado" => "En proceso",
            "autor" => "Gonzalito",
        ]);
    }
    
    public function test_ModificarTareaInexistente()
    {
        $response = $this -> put('/api/tareas/5556735'[

        ]);

        $response->assertStatus(404);

    }

    public function test_EliminarTareaExistente()
    {
        $response = $this -> put('/api/tareas/1');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "mensaje" => "El producto con id 1 ha sido eliminado correctamente"
        ]);

       $this->assertDatabaseMissing('tareas', [
        'id' => '1',
        'deleted_at' => null
        ]);

        Producto::withTrashed()->where("id",1)->restore();
    }

    public function test_EliminarTareaInexistente()
    {
        $response = $this -> delete('/api/tareas/93223');

        $response->assertStatus(404);
    }


}