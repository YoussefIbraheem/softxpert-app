<?php

test('user can register', function () {

    $name = Faker\Factory::create()->name;
    $email = Faker\Factory::create()->email;
    $password = Faker\Factory::create()->password;

    $response = $this->postJson('/api/register', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password
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
    $email = Faker\Factory::create()->email;
    $password = Faker\Factory::create()->password;

    $this->postJson('/api/register', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password
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
});
