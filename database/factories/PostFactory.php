<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->realText(50),
            'content'   => $this->faker->paragraph(30),
            'created_by'=> User::all()->random()->id,
        ];
    }
}
