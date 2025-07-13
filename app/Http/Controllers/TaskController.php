<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Http\Requests\ChangeTaskStatusRequest;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\TaskFilterRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\UrlParam;

#[Group('Tasks'), Authenticated]

class TaskController extends Controller
{
    use AuthorizesRequests;

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
     * - Example of properties:
     *     - "depends_on_links": [
     *           "id": 8,
     *           "title": "Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.",
     *           "link": "http://localhost:8000/api/tasks/8"
     *       ],
     *
     *
     *     - "dependents_links": [
     *           "id": 8,
     *           "title": "Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.",
     *           "link": "http://localhost:8000/api/tasks/8"
     *       ],
     *
     * Access Level: user (own tasks), manager, admin (all)
     */
    #[ResponseFromApiResource(TaskResource::class, Task::class, collection: true)]
    public function index(TaskFilterRequest $request): AnonymousResourceCollection
    {
        $user = $request->user();

        $query = Task::query();

        $query = $this->limitUserVisibility($user, $query);

        $perPage = $request->validated('per_page', 10);

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

    /**
     * Get Task
     *
     * Get a single task details using the task id
     *
     * Access Level: Admin , Manager , User(if assigned)
     * - Example of properties:
     *     - "depends_on_links": [
     *           "id": 8,
     *           "title": "Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.",
     *           "link": "http://localhost:8000/api/tasks/8"
     *       ],
     *
     *
     *     - "dependents_links": [
     *           "id": 8,
     *           "title": "Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.",
     *           "link": "http://localhost:8000/api/tasks/8"
     *       ],
     */
    #[ResponseFromApiResource(TaskResource::class, Task::class, collection: false, ), UrlParam(name: 'id', type: 'int', description: 'The desired task id')]
    public function show(Request $request, int $id): TaskResource
    {

        $user = $request->user();
        $query = Task::query();

        $task = $this->limitUserVisibility($user, $query)->where('id', $id)->first();

        if (! $task) {
            abort(404, 'Task not found!');
        }

        return new TaskResource($task);
    }

    /**
     * Create New Task
     *
     * - Creates a new task with assignees (users).
     * - user cannot be entered twice.
     * - Default status (Pending)
     * - Access Level: Admin , Manager
     * - Example of properties:
     *     - "depends_on_links": [
     *           "id": 8,
     *           "title": "Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.",
     *           "link": "http://localhost:8000/api/tasks/8"
     *       ],
     *
     *
     *     - "dependents_links": [
     *           "id": 8,
     *           "title": "Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.",
     *           "link": "http://localhost:8000/api/tasks/8"
     *       ],
     */
    #[ResponseFromApiResource(TaskResource::class, Task::class, collection: false, )]
    public function store(CreateTaskRequest $request): TaskResource
    {
        $user = $request->user();

        $data = $request->validated();

        $task = $user->created_tasks()->create($data);

        if (isset($data['assignees_ids'])) {

            foreach ($data['assignees_ids'] as $assignee_id) {
                $assignee = User::find($assignee_id);

                if (! $assignee) {
                    abort(404, 'Assignee Id not found!');
                }

                $assignee_exists = $task->assignees()->where('user_id', $assignee_id)->exists();

                if ($assignee_exists) { // skip duplicate entery
                    continue;
                }

                $task->assignees()->attach($assignee);
            }
        }

        return new TaskResource($task);
    }

    /**
     * Change Task Status
     *
     * update the task status to --> (Pending , In Progress , Completed , Cancelled)
     * setting the task to cancelled is only limited to manager access level
     *
     * - Example of properties:
     *   -  "depends_on_links": [
     *           "id": 8,
     *           "title": "Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.",
     *           "link": "http://localhost:8000/api/tasks/8"
     *       ],
     *
     *
     *    - "dependents_links": [
     *           "id": 8,
     *           "title": "Accusamus expedita nihil molestiae culpa blanditiis laboriosam laborum.",
     *           "link": "http://localhost:8000/api/tasks/8"
     *       ],
     */
    #[ResponseFromApiResource(TaskResource::class, Task::class, collection: false, )]
    public function changeStatus(ChangeTaskStatusRequest $request, $id): TaskResource
    {
        $data = $request->validated();

        $task = Task::with(['dependencies', 'dependents'])->findorFail($id);

        $this->authorize('update', $task);

        $is_user = $request->user()->hasRole(UserRole::USER);
        $unclosed_dependents = $this->checkDependents($task);

        if ($is_user && $unclosed_dependents) {
            abort(422, 'Action cannot be taken, please check for unclosed dependent tasks');
        }

        $task->update([
            'status' => $data['status'],
        ]);

        return new TaskResource($task);
    }

    /**
     * Limit Visibility
     *
     * private function used to limit the visibility of the tasks for users
     *
     * @hideFromAPIDocumentation
     */
    private function limitUserVisibility(User $user, $query): Builder
    {
        if ($user->hasRole(UserRole::USER)) {
            $query->whereHas('assignees', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        return $query;
    }

    /**
     * Check Dependent Tasks Status
     *
     * private function used to check for unclosed tasks
     *
     *
     * @hideFromAPIDocumentation
     */
    private function checkDependents(Task $task): bool
    {
        $dependents = $task->dependents()->get();

        if ($dependents->count() == 0) {
            return false;
        }

        foreach ($dependents as $dependent) {
            if ($dependent->status == TaskStatus::PENDING || $dependent->status == TaskStatus::IN_PROGRESS) {
                return true;
            }
        }

        return false;
    }
}
