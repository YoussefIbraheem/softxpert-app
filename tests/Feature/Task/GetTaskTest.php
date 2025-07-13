<?php

use App\Enums\UserRole;
use App\Models\Task;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create()->assignRole(UserRole::ADMIN);
    $this->manager = User::factory()->create()->assignRole(UserRole::MANAGER);
    $this->user = User::factory()->create()->assignRole(UserRole::USER);

    $this->task1 = Task::factory()->create([
        'title' => 'Important task',
        'status' => 'pending',
        'owner_id' => $this->manager->id,
    ]);

    $this->task2 = Task::factory()->create([
        'title' => 'Another task',
        'status' => 'completed',
        'owner_id' => $this->manager->id,
    ]);

    $this->task3 = Task::factory()->create([
        'title' => 'Special Assignment',
        'status' => 'pending',
        'owner_id' => $this->manager->id,
    ]);

    $this->task1->assignees()->attach($this->user);
    $this->task2->assignees()->attach($this->user);

    $this->taskJsonStructure = [
        'id',
        'title',
        'description',
        'status',

        'owner_name',
        'owner_id',

        'assignees',

        'dependents_links',

        'depends_on_links',

        'due_date',
        'created_at',
        'updated_at',

        'is_owner',
    ];
});

test('admin & manager can see any test details', function () {
    $this->actingAs($this->admin);

    $response = $this->getJson('/api/tasks/'.$this->task1->id);
    $response->assertStatus(200);
    $response->assertJsonStructure($this->taskJsonStructure);

    $this->actingAs($this->manager);

    $response = $this->getJson('/api/tasks/'.$this->task1->id);

    $response->assertStatus(200);
    $response->assertJsonStructure($this->taskJsonStructure);
});

test('admin & manager cannot see any non-existant test details', function () {
    $this->actingAs($this->admin);
    $randomNumber = rand(50, 999);

    $this->getJson('/api/tasks/'.$randomNumber)
        ->assertStatus(404)
        ->assertJsonStructure([]);
});

test('assigned user can see the task', function () {
    $this->actingAs($this->user);
    $response = $this->getJson('/api/tasks/'.$this->task1->id);
    $response->assertStatus(200);
    $response->assertJsonStructure($this->taskJsonStructure);
});

test('unassigned user cannot see the unassigned task', function () {
    $this->actingAs($this->user);
    $response = $this->getJson('/api/tasks/'.$this->task3->id);
    $response->assertStatus(404);
    $response->assertJsonStructure([]);
});
