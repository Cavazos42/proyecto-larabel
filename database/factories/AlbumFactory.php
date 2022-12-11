<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'materia' => 'POO',
            'profesor' => fake()->name(),
            'grupo' => fake()->word,
            'semestre' => fake()->numberBetween(1, 9),
            'horario_inicio' => fake()->time(),
            'horario_fin' => fake()->time(),
            'user_id' => 1,
        ];
    }
}
