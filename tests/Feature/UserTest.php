<?php

use App\Enums\UserRole;
use App\Models\User;

test('admin can change user role to manager', function () {
    $admin = User::factory()->create();
    $user = User::factory()->create();

    $admin->assignRole(UserRole::ADMIN);
    $user->assignRole(UserRole::USER);

    $this->actingAs($admin);

    $response = $this->postJson('api/change-role', [
        'user_id' => $user->id,
        'role_name' => UserRole::MANAGER->value,
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
            'role' => UserRole::MANAGER->value,
        ]);

    expect($user->fresh()->hasRole(UserRole::MANAGER))->toBeTrue();
});

test('admin can change manager role to user', function () {
    $admin = User::factory()->create();
    $manager = User::factory()->create();

    $admin->assignRole(UserRole::ADMIN);
    $manager->assignRole(UserRole::MANAGER);

    $this->actingAs($admin);

    $response = $this->postJson('api/change-role', [
        'user_id' => $manager->id,
        'role_name' => UserRole::USER->value,
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => $manager->name,
            'email' => $manager->email,
            'role' => UserRole::USER->value,
        ]);

    expect($manager->fresh()->hasRole(UserRole::USER))->toBeTrue();
});

test('admin cannot change other admin role or own role', function () {
    $admin1 = User::factory()->create();
    $admin2 = User::factory()->create();

    $admin1->assignRole(UserRole::ADMIN);
    $admin2->assignRole(UserRole::ADMIN);

    $this->actingAs($admin1);

    // Own role
    $this->postJson('api/change-role', [
        'user_id' => $admin1->id,
        'role_name' => UserRole::USER->value,
    ])->assertStatus(403);

    // Other admin's role
    $this->postJson('api/change-role', [
        'user_id' => $admin2->id,
        'role_name' => UserRole::USER->value,
    ])->assertStatus(403);

    expect($admin2->fresh()->hasRole(UserRole::ADMIN))->toBeTrue();
});

test('non-admins cannot change roles', function () {
    $manager = User::factory()->create();
    $user = User::factory()->create();

    $manager->assignRole(UserRole::MANAGER);
    $user->assignRole(UserRole::USER);

    // Manager trying to promote user
    $this->actingAs($manager);

    $this->postJson('api/change-role', [
        'user_id' => $user->id,
        'role_name' => UserRole::MANAGER->value,
    ])->assertStatus(403);

    // User trying to change another user's role
    $this->actingAs($user);

    $this->postJson('api/change-role', [
        'user_id' => $manager->id,
        'role_name' => UserRole::USER->value,
    ])->assertStatus(403);
});

test('only manager and admin can get list of users', function () {
    $admin = User::factory()->create();
    $manager = User::factory()->create();
    $user = User::factory()->create();

    $admin->assignRole(UserRole::ADMIN);
    $manager->assignRole(UserRole::MANAGER);
    $user->assignRole(UserRole::USER);

    // Admin
    $this->actingAs($admin);
    $this->getJson('/api/users')->assertStatus(200);

    // Manager
    $this->actingAs($manager);
    $this->getJson('/api/users')->assertStatus(200);

    // User
    $this->actingAs($user);
    $this->getJson('/api/users')->assertStatus(403);
});

test('user can update their own name', function () {
    $user = User::factory()->create([
        'name' => 'Original Name',
    ]);
    $user->assignRole(UserRole::USER);

    $this->actingAs($user);

    $response = $this->postJson('/api/user/update', [
        'name' => 'Updated Name',
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => 'Updated Name',
            'email' => $user->email,
        ]);

    expect($user->fresh()->name)->toBe('Updated Name');
});
