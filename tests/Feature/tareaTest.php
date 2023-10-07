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
}
