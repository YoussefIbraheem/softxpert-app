<?php

use App\Enums\UserRole;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('user can register', function () {
    $name = Faker\Factory::create()->name;
    $email = Faker\Factory::create()->safeEmail;
    $password = 'Password@123';

    $response = $this->postJson('/api/register', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
    ]);

    $response->assertStatus(201);
    $response->assertHeader('Content-Type', 'application/json');
    $response->assertJsonFragment([
        'name' => $name,
        'email' => $email,
        'role' => 'user',
    ]);

    $this->assertDatabaseHas('users', [
        'name' => $name,
        'email' => $email,
    ]);
});

test('user can login', function () {
    $name = Faker\Factory::create()->name;
    $email = Faker\Factory::create()->safeEmail;
    $password = 'Password@123';

    $this->postJson('/api/register', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
    ])->assertStatus(201);

    $response = $this->postJson('/api/login', [
        'email' => $email,
        'password' => $password,
    ]);

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/json');
    $response->assertJsonFragment([
        'name' => $name,
        'email' => $email,
        'role' => 'user',
    ]);
    $response->assertJsonStructure([
        'data' => [
            'id',
            'name',
            'email',
            'role',
        ],
        'access_token',
    ]);
});

test('user needs to follow password criteria', function () {
    $name = Faker\Factory::create()->name;
    $email = Faker\Factory::create()->safeEmail;
    $passwords = ['password@123', 'Password123', 'Password@', 'Pass@1'];

    foreach ($passwords as $password) {
        $response = $this->postJson('/api/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(422);
    }
});

test('user cannot register with invalid email', function () {
    $name = Faker\Factory::create()->name;
    $email = Faker\Factory::create()->name; // Not a valid email
    $password = 'Password@123';

    $response = $this->postJson('/api/register', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
    ]);

    $response->assertStatus(422);
});

test('user cannot login with non-existent credentials', function () {
    $email = Faker\Factory::create()->safeEmail;
    $password = 'Password@123';

    $response = $this->postJson('/api/login', [
        'email' => $email,
        'password' => $password,
    ]);

    $response->assertStatus(422);
});

test('user cannot login with wrong password', function () {
    $name = Faker\Factory::create()->name;
    $email = Faker\Factory::create()->safeEmail;
    $wrongPassword = 'WrongPass@123';
    $password = 'Password@123';

    $this->postJson('/api/register', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
    ])->assertStatus(201);

    $response = $this->postJson('/api/login', [
        'email' => $email,
        'password' => $wrongPassword,
    ]);

    $response->assertStatus(422);
});

test('user cannot register with password mismatch', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Mismatch User',
        'email' => Faker\Factory::create()->safeEmail,
        'password' => 'Password@123',
        'password_confirmation' => 'Wrong@123',
    ]);

    $response->assertStatus(422);
});

test('user cannot register with existing email', function () {
    $email = Faker\Factory::create()->safeEmail;

    $this->postJson('/api/register', [
        'name' => 'User 1',
        'email' => $email,
        'password' => 'Password@123',
        'password_confirmation' => 'Password@123',
    ])->assertStatus(201);

    $response = $this->postJson('/api/register', [
        'name' => 'User 2',
        'email' => $email,
        'password' => 'Password@123',
        'password_confirmation' => 'Password@123',
    ]);

    $response->assertStatus(422);
});

test('user cannot login with missing fields', function () {
    $response = $this->postJson('/api/login', []);
    $response->assertStatus(422);
});

test('user can logout', function () {
    $user = User::factory()->create();
    $user->assignRole(UserRole::USER);
    $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/logout');

    $response->assertStatus(200);

});
