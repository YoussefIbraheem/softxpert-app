<?php

use App\Enums\UserRole;
use App\Models\Task;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

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
});

test('manager can filter tasks by status', function () {
    $this->actingAs($this->manager);

    $this->getJson('/api/tasks?status=pending&per_page=50')
        ->assertOk()
        ->assertJsonFragment(['title' => $this->task1->title])
        ->assertJsonMissing(['title' => $this->task2->title]);
});

test('manager can filter tasks by partial title', function () {
    $this->actingAs($this->manager);

    $this->getJson('/api/tasks?title=important&per_page=50')
        ->assertOk()
        ->assertJsonFragment(['title' => $this->task1->title])
        ->assertJsonMissing(['title' => $this->task2->title]);
});

test('manager can filter by owner_id', function () {
    $this->actingAs($this->manager);

    $this->getJson('/api/tasks?owner_id='.$this->manager->id.'&per_page=50')
        ->assertOk()
        ->assertJsonFragment(['owner_name' => $this->manager->name]);
});

test('manager can filter by assignee_id', function () {
    $this->actingAs($this->manager);

    $this->getJson('/api/tasks?assignee_id='.$this->user->id.'&per_page=50')
        ->assertOk()
        ->assertJsonFragment(['title' => $this->task1->title]);
});

test('manager can filter by due_date range', function () {
    $this->actingAs($this->manager);

    $from = now()->subDay()->toDateString();
    $to = now()->addDays(10)->toDateString();

    $this->getJson("/api/tasks?due_from={$from}&due_to={$to}&per_page=50")
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json->has('data')->etc()
        );
});

test('user only sees own assigned tasks', function () {
    $this->actingAs($this->user);

    $this->getJson('/api/tasks?per_page=50')
        ->assertOk()
        ->assertJsonFragment(['title' => $this->task1->title])
        ->assertJsonFragment(['title' => $this->task2->title])
        ->assertJsonMissing(['title' => $this->task3->title]);
});

test('user cannot filter outside own assignments', function () {
    $this->actingAs($this->user);

    $this->getJson('/api/tasks?status=completed&per_page=50')
        ->assertOk()
        ->assertJsonMissing(['title' => $this->task3->title]);
});

test('invalid filter inputs return 422', function () {
    $this->actingAs($this->manager);

    $this->getJson('/api/tasks?status=invalid&per_page=50')
        ->assertStatus(422);

    $this->getJson('/api/tasks?owner_id=999999&per_page=50')
        ->assertStatus(422);

    $this->getJson('/api/tasks?due_date_from=not-a-date&due_date_from_to=also-bad&per_page=50')
        ->assertStatus(422);
});
