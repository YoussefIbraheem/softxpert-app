<?php

use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Models\Task;
use App\Models\User;

beforeEach(function () {
    // Seed roles and set up shared variables
    $this->admin = User::factory()->create();
    $this->manager = User::factory()->create();
    $this->user = User::factory()->create();

    $this->admin->assignRole(UserRole::ADMIN);
    $this->manager->assignRole(UserRole::MANAGER);
    $this->user->assignRole(UserRole::USER);
});

test('assigned user can change status to allowed values only', function () {
    $task = Task::factory()->create(['status' => TaskStatus::PENDING, 'owner_id' => $this->manager->id]);
    $task->assignees()->attach($this->user);

    $this->actingAs($this->user);

    // Valid statuses for user
    foreach ([TaskStatus::IN_PROGRESS, TaskStatus::COMPLETED] as $status) {
        $response = $this->postJson(route('tasks.changeStatus', $task->id), [
            'status' => $status->value,
        ]);

        $response->assertStatus(200);
        expect($task->fresh()->status)->toBe($status);
    }
});

test('user cannot cancel a task', function () {
    $task = Task::factory()->create(['status' => TaskStatus::PENDING, 'owner_id' => $this->manager->id]);
    $task->assignees()->attach($this->user);

    $this->actingAs($this->user);

    $response = $this->postJson(route('tasks.changeStatus', $task->id), [
        'status' => TaskStatus::CANCELLED->value,
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['status']);
});

test('user cannot update task they are not assigned to', function () {
    $task = Task::factory()->create(['status' => TaskStatus::PENDING, 'owner_id' => $this->manager->id]);

    $this->actingAs($this->user);

    $response = $this->postJson(route('tasks.changeStatus', $task->id), [
        'status' => TaskStatus::IN_PROGRESS->value,
    ]);

    $response->assertStatus(403);
});

test('user cannot complete task if dependent is not completed', function () {
    $parent = Task::factory()->create(['status' => TaskStatus::PENDING, 'owner_id' => $this->manager->id]);
    $child = Task::factory()->create(['status' => TaskStatus::IN_PROGRESS, 'owner_id' => $this->manager->id]);

    // Set dependency
    $parent->dependents()->attach($child);
    $parent->assignees()->attach($this->user);

    $this->actingAs($this->user);

    $response = $this->postJson(route('tasks.changeStatus', $parent->id), [
        'status' => TaskStatus::COMPLETED->value,
    ]);

    $response->assertStatus(422);
});

test('manager can cancel task', function () {
    $task = Task::factory()->create(['status' => TaskStatus::IN_PROGRESS, 'owner_id' => $this->manager->id]);

    $this->actingAs($this->manager);

    $response = $this->postJson(route('tasks.changeStatus', $task->id), [
        'status' => TaskStatus::CANCELLED->value,
    ]);

    $response->assertStatus(200);
    expect($task->fresh()->status)->toBe(TaskStatus::CANCELLED);
});

test('admin can cancel task', function () {
    $task = Task::factory()->create(['status' => TaskStatus::IN_PROGRESS, 'owner_id' => $this->admin->id]);

    $this->actingAs($this->admin);

    $response = $this->postJson(route('tasks.changeStatus', $task->id), [
        'status' => TaskStatus::CANCELLED->value,
    ]);

    $response->assertStatus(200);
    expect($task->fresh()->status)->toBe(TaskStatus::CANCELLED);
});

test('manager can force cancel task', function () {
    $parent = Task::factory()->create(['status' => TaskStatus::IN_PROGRESS, 'owner_id' => $this->manager->id]);
    $child = Task::factory()->create(['status' => TaskStatus::IN_PROGRESS, 'owner_id' => $this->manager->id]);

    $parent->dependents()->attach($child);

    $this->actingAs($this->manager);

    $response = $this->postJson(route('tasks.changeStatus', $parent->id), [
        'status' => TaskStatus::CANCELLED->value,
    ]);

    $response->assertStatus(200);
    expect($parent->fresh()->status)->toBe(TaskStatus::CANCELLED);
});

test('admin can force cancel task', function () {
    $parent = Task::factory()->create(['status' => TaskStatus::IN_PROGRESS, 'owner_id' => $this->manager->id]);
    $child = Task::factory()->create(['status' => TaskStatus::IN_PROGRESS, 'owner_id' => $this->manager->id]);

    $parent->dependents()->attach($child);

    $this->actingAs($this->admin);

    $response = $this->postJson(route('tasks.changeStatus', $parent->id), [
        'status' => TaskStatus::CANCELLED->value,
    ]);

    $response->assertStatus(200);
    expect($parent->fresh()->status)->toBe(TaskStatus::CANCELLED);
});

test('cannot update non-existent task', function () {
    $this->actingAs($this->admin);

    $response = $this->postJson(route('tasks.changeStatus', 9999), [
        'status' => TaskStatus::COMPLETED->value,
    ]);

    $response->assertStatus(404);
});
