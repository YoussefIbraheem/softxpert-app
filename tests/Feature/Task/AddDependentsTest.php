<?php

use App\Enums\UserRole;
use App\Models\Task;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create();
    $this->manager = User::factory()->create();
    $this->user = User::factory()->create();

    $this->admin->assignRole(UserRole::ADMIN);
    $this->manager->assignRole(UserRole::MANAGER);
    $this->user->assignRole(UserRole::USER);
});

test('admin can add dependent tasks', function () {
    $parent = Task::factory()->create(['owner_id' => $this->admin->id]);
    $child1 = Task::factory()->create(['owner_id' => $this->admin->id]);
    $child2 = Task::factory()->create(['owner_id' => $this->admin->id]);

    $this->actingAs($this->admin);

    $response = $this->postJson(route('tasks.addDependents', $parent->id), [
        'dependent_tasks_ids' => [$child1->id, $child2->id],
    ]);

    $response->assertStatus(200);
    expect($parent->fresh()->dependents()->pluck('id')->toArray())->toEqualCanonicalizing([$child1->id, $child2->id]);
});

test('manager can add dependent tasks', function () {
    $parent = Task::factory()->create(['owner_id' => $this->manager->id]);
    $child = Task::factory()->create(['owner_id' => $this->manager->id]);

    $this->actingAs($this->manager);

    $response = $this->postJson(route('tasks.addDependents', $parent->id), [
        'dependent_tasks_ids' => [$child->id],
    ]);

    $response->assertStatus(200);
    expect($parent->fresh()->dependents()->pluck('id')->toArray())->toContain($child->id);
});

test('user cannot add dependent tasks', function () {
    $parent = Task::factory()->create(['owner_id' => $this->manager->id]);
    $child = Task::factory()->create(['owner_id' => $this->manager->id]);

    $this->actingAs($this->user);

    $response = $this->postJson(route('tasks.addDependents', $parent->id), [
        'dependent_tasks_ids' => [$child->id],
    ]);

    $response->assertStatus(403);
});

test('cannot make task dependent on itself', function () {
    $task = Task::factory()->create(['owner_id' => $this->admin->id]);

    $this->actingAs($this->admin);

    $response = $this->postJson(route('tasks.addDependents', $task->id), [
        'dependent_tasks_ids' => [$task->id],
    ]);

    $response->assertStatus(422);
    $response->assertSee('You cannot make the task dependent on itself');
});

test('returns 404 if parent task not found', function () {
    $child = Task::factory()->create();

    $this->actingAs($this->admin);

    $response = $this->postJson(route('tasks.addDependents', 9999), [
        'dependent_tasks_ids' => [$child->id],
    ]);

    $response->assertStatus(404);
});
