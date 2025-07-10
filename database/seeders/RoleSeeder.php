<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding roles...');

        $roles = [
            'admin',
            'manager',
            'user'];

        foreach ($roles as $role) {
            $role_exists = \Spatie\Permission\Models\Role::where('name', $role)->exists();
            if ($role_exists) {
                $this->command->warn("Role '$role' already exists, skipping creation.");

                continue;
            }
            \Spatie\Permission\Models\Role::firstOrCreate(['name' => $role]);
        }

        $this->command->info('Roles seeded successfully!');
    }
}
