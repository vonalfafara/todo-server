<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTime();
        return [
            'user_id' => fake()->randomElement(User::pluck('id')),
            'status_id' => fake()->randomElement(Status::pluck('id')),
            'name' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
