<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding users...');

        $admin = User::where('email', 'admin@test.com')->first();

        if ($admin !== null) {
            $this->command->warn('Admin user already exists, skipping creation.');

        } else {
            $admin = User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@test.com',
            ]);

            $admin->assignRole(UserRole::ADMIN);
        }

        $manager = User::where('email', 'manager@test.com')->first();

        if ($manager !== null) {
            $this->command->warn('Manager user already exists, skipping creation.');

        } else {

            $manager = User::factory()->create([
                'name' => 'test manager',
                'email' => 'manager@test.com',
            ]);

            $manager->assignRole(UserRole::MANAGER);
        }

        $users = User::factory()->count(10)->create();

        $users->each(function (User $user) {
            $user->assignRole(UserRole::USER);
        });

        $this->command->info('Admin: '.$admin->email.' with password: password');
        $this->command->info('Manager: '.$manager->email.' with password: password');
        $this->command->info('Users: '.$users->pluck('email')->implode(', ').' with password: password');
        $this->command->info('Users created successfully!');
    }
}
