<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;

class AddTaskDependentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole([UserRole::ADMIN, UserRole::MANAGER]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dependent_tasks_ids' => ['required', 'array'],
            'dependent_tasks_ids.*' => ['required', 'integer', 'exists:tasks,id'],
        ];
    }
}
