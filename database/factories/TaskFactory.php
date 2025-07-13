<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = \App\Enums\TaskStatus::cases();

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => TaskStatus::PENDING,
            'owner_id' => \App\Models\User::factory(), // Assuming you have a UserFactory
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
