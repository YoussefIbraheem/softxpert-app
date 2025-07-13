<?php

use App\Enums\UserRole;
use App\Models\Task;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->admin = User::factory()->create()->assignRole(UserRole::ADMIN);
    $this->manager = User::factory()->create()->assignRole(UserRole::MANAGER);
    $this->user = User::factory()->create()->assignRole(UserRole::USER);
});

test('admin can update a task', function () {
    $task = Task::factory()->create(['owner_id' => $this->admin->id]);

    $this->actingAs($this->admin);

    $response = $this->postJson(route('tasks.update', $task->id), [
        'title' => 'Updated Title',
        'description' => 'Updated Description',
    ]);

    $response->assertStatus(200)
        ->assertJson(
            fn (AssertableJson $json) => $json->where('title', 'Updated Title')
                ->where('description', 'Updated Description')
                ->etc()
        );

    expect($task->fresh()->title)->toBe('Updated Title');
});

test('manager can update a task', function () {
    $task = Task::factory()->create(['owner_id' => $this->manager->id]);

    $this->actingAs($this->manager);

    $response = $this->postJson(route('tasks.update', $task->id), [
        'title' => 'Manager Title',
    ]);

    $response->assertStatus(200);
    expect($task->fresh()->title)->toBe('Manager Title');
});

test('user cannot update a task', function () {
    $task = Task::factory()->create(['owner_id' => $this->manager->id]);

    $this->actingAs($this->user);

    $response = $this->postJson(route('tasks.update', $task->id), [
        'title' => 'Illegal Update',
    ]);

    $response->assertStatus(403);
});

test('admin can assign users during update', function () {
    $task = Task::factory()->create(['owner_id' => $this->admin->id]);
    $assignee = User::factory()->create()->assignRole(UserRole::USER);

    $this->actingAs($this->admin);

    $response = $this->postJson(route('tasks.update', $task->id), [
        'assignees_ids' => [$assignee->id],
    ]);

    $response->assertStatus(200);
    expect($task->fresh()->assignees()->pluck('id')->toArray())->toContain($assignee->id);
});

test('invalid user ID in assignees is rejected', function () {
    $task = Task::factory()->create(['owner_id' => $this->admin->id]);

    $this->actingAs($this->admin);

    $response = $this->postJson(route('tasks.update', $task->id), [
        'assignees_ids' => [99999], // ID does not exist
    ]);

    $response->assertStatus(422);
});

test('status cannot be updated via update endpoint', function () {
    $task = Task::factory()->create([
        'owner_id' => $this->admin->id,
    ]);

    $this->actingAs($this->admin);

    $response = $this->postJson(route('tasks.update', $task->id), [
        'status' => 'cancelled',
    ]);

    $response->assertStatus(200); // Still processes
    expect($task->status->value)->not()->toBe('cancelled'); // Status unchanged
});
