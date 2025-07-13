<?php

namespace App\Http\Resources;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Task
 */
class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status ?? TaskStatus::PENDING,

            'owner_name' => $this->owner->name,
            'owner_id' => $this->owner->id,

            'assignees' => $this->assignees ? UserResource::collection($this->assignees) : [],

            'depends_on_links' => $this->dependencies ? $this->dependencies->map(fn ($dependencies) => [
                'id' => $dependencies->id,
                'title' => $dependencies->title,
                'link' => route('tasks.getById', $dependencies->id),
            ]) : [],

            'dependents_links' => $this->dependents ? $this->dependents->map(
                fn ($dependent) => [
                    'id' => $dependent->id,
                    'title' => $dependent->title,
                    'link' => route('tasks.getById', $dependent->id),
                ]
            ) : [], // link to the parent task to be handled

            'due_date' => $this->due_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'is_owner' => $this->owner_id === $request->user()?->id,
        ];
    }
}
