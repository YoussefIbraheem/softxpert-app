<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Carbon;

beforeEach(function () {
    $this->admin = User::factory()->create();
    $this->manager = User::factory()->create();
    $this->user1 = User::factory()->create();
    $this->user2 = User::factory()->create();
    $this->user3 = User::factory()->create();
    $this->due_date = Carbon::now()->addDays(2)->format('Y-m-d H:i:s');
    $this->admin->assignRole(UserRole::ADMIN);
    $this->manager->assignRole(UserRole::MANAGER);
    $this->user1->assignRole(UserRole::USER);
    $this->user2->assignRole(UserRole::USER);
    $this->user3->assignRole(UserRole::USER);

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

test('admin can create task', function () {
    $this->actingAs($this->admin);

    $response = $this->postJson('api/tasks/create', [
        'title' => 'Test Task',
        'description' => 'This is test task',
        'due_date' => $this->due_date,
        'assignees_ids' => [$this->user1->id, $this->user2->id],
    ]);

    $newTaskData = $response->Json();

    $response->assertStatus(201);

    $response->assertJsonStructure($this->taskJsonStructure);

    $this->assertDatabaseHas('tasks', ['title' => $newTaskData['title']]);
    $this->assertDatabaseHas('tasks', ['description' => $newTaskData['description']]);
    $this->assertDatabaseHas('tasks', ['due_date' => Carbon::parse($newTaskData['due_date'])->format('Y-m-d H:i:s')]);
    $this->assertDatabaseHas('task_user', ['user_id' => $this->user1->id, 'task_id' => $newTaskData['id']]);
    $this->assertDatabaseHas('task_user', ['user_id' => $this->user2->id, 'task_id' => $newTaskData['id']]);
});

test('manager can create task', function () {
    $this->actingAs($this->manager);

    $response = $this->postJson('api/tasks/create', [
        'title' => 'Test Task',
        'description' => 'This is test task',
        'due_date' => $this->due_date,
        'assignees_ids' => [$this->user1->id, $this->user2->id],
    ]);

    $newTaskData = $response->Json();

    $response->assertStatus(201);

    $response->assertJsonStructure($this->taskJsonStructure);

    $this->assertDatabaseHas('tasks', ['title' => $newTaskData['title']]);
    $this->assertDatabaseHas('tasks', ['description' => $newTaskData['description']]);
    $this->assertDatabaseHas('tasks', ['due_date' => Carbon::parse($newTaskData['due_date'])->format('Y-m-d H:i:s')]);
    $this->assertDatabaseHas('task_user', ['user_id' => $this->user1->id, 'task_id' => $newTaskData['id']]);
    $this->assertDatabaseHas('task_user', ['user_id' => $this->user2->id, 'task_id' => $newTaskData['id']]);
});

test('user cannot create task', function () {
    $this->actingAs($this->user1);

    $response = $this->postJson('api/tasks/create', [
        'title' => 'Test Task',
        'description' => 'This is test task',
        'due_date' => $this->due_date,
        'assignees_ids' => [$this->user1->id, $this->user2->id],
    ]);

    $response->assertStatus(403);
});

test('admin cannot enter the same user multiple times', function () {
    $this->actingAs($this->admin);

    $response = $this->postJson('api/tasks/create', [
        'title' => 'Test Task',
        'description' => 'This is test task',
        'due_date' => $this->due_date,
        'assignees_ids' => [$this->user1->id, $this->user1->id],
    ]);

    $response->assertStatus(201);
    $newTaskData = $response->json();

    $this->assertDatabaseCount('task_user', 1);
    $this->assertDatabaseHas('task_user', ['user_id' => $this->user1->id, 'task_id' => $newTaskData['id']]);
});

test('admin cannot enter non-existant user', function () {
    $this->actingAs($this->admin);

    $userIds = User::all()->pluck('id')->toArray();

    asort($userIds);

    $randomId = fake()->numberBetween(end($userIds));

    $response = $this->postJson('api/tasks/create', [
        'title' => 'Test Task',
        'description' => 'This is test task',
        'due_date' => $this->due_date,
        'assignees_ids' => [$randomId],
    ]);

    $response->assertStatus(422);

    $this->assertDatabaseCount('task_user', 0);
});
