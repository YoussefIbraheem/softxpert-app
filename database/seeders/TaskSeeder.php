<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        })->first();

        if (! $manager) {
            $manager = User::factory()->create();
            $manager->assignRole('manager');
        }

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->first();

        if (! $users) {
            $users = User::factory()->count(5)->create();
            foreach ($users as $user) {
                $user->assignRole('user');
            }
        }

        $tasks = \App\Models\Task::factory()->count(10)->create([
            'owner_id' => $manager->id,
        ]);

        $depndent_tasks = \App\Models\Task::factory()->count(10)->create([
            'owner_id' => $manager->id,
        ]);

        foreach ($tasks as $task) {
            $task->assignees()->attach($users->pluck('id')->random(rand(1, 3)));
            $task->dependents()->attach($depndent_tasks->pluck('id')->random(rand(1, 3)));
        }
        $this->command->info('Tasks seeded successfully!');
        $this->command->info('Manager and users created if they did not exist.');
        $this->command->info('Tasks assigned to users successfully!');
        $this->command->info('Total tasks created: '.$tasks->count());
        $this->command->info('Total users assigned to tasks: '.$users->count());

    }
}
