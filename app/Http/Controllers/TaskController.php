<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\TaskFilterRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Group('Tasks'), Authenticated]

class TaskController extends Controller
{
    /**
     * Get Tasks
     *
     * Retrieve tasks with optional filters.
     *
     * Filters:
     * - `status`: pending, in_progress, completed, cancelled
     * - `title`: partial match
     * - `owner_id`: filter by owner
     * - `assignee_id`: filter by assigned user
     * - `due_date_from`, `due_date_to`: filter by due date range
     *
     * Access Level: user (own tasks), manager, admin (all)
     */
    #[ResponseFromApiResource(TaskResource::class, Task::class, collection: true)]
    public function index(TaskFilterRequest $request): AnonymousResourceCollection
    {
        $user = $request->user();

        $query = Task::query();

        $perPage = $request->validated('per_page', 10);

        // Limit visibility for users
        if ($user->hasRole(UserRole::USER)) {
            $query->whereHas('assignees', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%'.$request->title.'%');
        }

        if ($request->filled('owner_id')) {
            $query->where('owner_id', $request->owner_id);
        }

        if ($request->filled('assignee_id')) {
            $query->whereHas('assignees', function ($q) use ($request) {
                $q->where('user_id', $request->assignee_id);
            });
        }

        if ($request->filled('due_date_from')) {
            $query->whereDate('due_date', '>=', $request->due_date_from);
        }

        if ($request->filled('due_date_to')) {
            $query->whereDate('due_date', '<=', $request->due_date_to);
        }

        // Paginate and return
        $tasks = $query->paginate($perPage);

        return TaskResource::collection($tasks);
    }
}
