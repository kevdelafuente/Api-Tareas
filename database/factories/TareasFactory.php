<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        {
            return [
                'titulo' => $this->faker->sentence,
                'contenido' => $this->faker->text(50),
                'autor' => $this->faker->name,
                'estado' => $this->faker->randomElement(['Pendiente', 'En progreso', 'Completada']),
            ];
        }
    }
}
