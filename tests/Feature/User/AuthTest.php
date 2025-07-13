<?php

use App\Enums\UserRole;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('user can register successfully', function () {
    $data = [
        'name' => fake()->name(),
        'email' => fake()->safeEmail(),
        'password' => 'Password@123',
        'password_confirmation' => 'Password@123',
    ];

    $response = $this->postJson('/api/register', $data);

    $response->assertStatus(201)
        ->assertHeader('Content-Type', 'application/json')
        ->assertJsonFragment([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => UserRole::USER->value,
        ]);

    $this->assertDatabaseHas('users', [
        'email' => $data['email'],
        'name' => $data['name'],
    ]);
});

test('user can login and receive token', function () {
    $password = 'Password@123';
    $user = User::factory()->create([
        'password' => bcrypt($password),
    ]);

    $user->assignRole(UserRole::USER);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => $password,
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
            'role' => UserRole::USER->value,
        ])
        ->assertJsonStructure([
            'data' => ['id', 'name', 'email', 'role'],
            'access_token',
        ]);
});

test('user must follow password complexity rules', function () {
    $invalidPasswords = ['password@123', 'Password123', 'Password@', 'Pass@1'];

    foreach ($invalidPasswords as $pwd) {
        $response = $this->postJson('/api/register', [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => $pwd,
            'password_confirmation' => $pwd,
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('password');
    }
});

test('user cannot register with invalid email format', function () {
    $response = $this->postJson('/api/register', [
        'name' => fake()->name(),
        'email' => fake()->name(), // invalid email
        'password' => 'Password@123',
        'password_confirmation' => 'Password@123',
    ]);

    $response->assertStatus(422)->assertJsonValidationErrors('email');
});

test('user cannot register with mismatched passwords', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Mismatch User',
        'email' => fake()->safeEmail(),
        'password' => 'Password@123',
        'password_confirmation' => 'Different@123',
    ]);

    $response->assertStatus(422)->assertJsonValidationErrors('password');
});

test('user cannot register with an already used email', function () {
    $email = fake()->safeEmail();

    // First registration
    $this->postJson('/api/register', [
        'name' => 'First User',
        'email' => $email,
        'password' => 'Password@123',
        'password_confirmation' => 'Password@123',
    ])->assertStatus(201);

    // Second registration attempt
    $response = $this->postJson('/api/register', [
        'name' => 'Second User',
        'email' => $email,
        'password' => 'Password@123',
        'password_confirmation' => 'Password@123',
    ]);

    $response->assertStatus(422)->assertJsonValidationErrors('email');
});

test('user cannot login with non-existent credentials', function () {
    $response = $this->postJson('/api/login', [
        'email' => fake()->safeEmail(),
        'password' => 'Password@123',
    ]);

    $response->assertStatus(422)->assertJsonValidationErrors('email');
});

test('user cannot login with incorrect password', function () {
    $user = User::factory()->create([
        'password' => bcrypt('Password@123'),
    ]);

    $user->assignRole(UserRole::USER);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'WrongPassword@123',
    ]);

    $response->assertStatus(422)->assertJsonValidationErrors('email');
});

test('user cannot login without required fields', function () {
    $response = $this->postJson('/api/login', []);
    $response->assertStatus(422)->assertJsonValidationErrors(['email', 'password']);
});

test('user can logout successfully', function () {
    $user = User::factory()->create([
        'password' => bcrypt('Password@123'),
    ]);
    $user->assignRole(UserRole::USER);

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/logout');

    $response->assertStatus(200)->assertJson([
        'message' => 'Logged out successfully!',
    ]);
});
