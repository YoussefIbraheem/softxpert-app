<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use App\Rules\AssignUsersOnly;
use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string', 'max:500'],
            'assignees_ids' => ['nullable', 'array'],
            'assignees_ids.*' => ['required_unless:assignees_ids,null', 'integer', 'exists:users,id', new AssignUsersOnly],
            'due_date' => ['required', 'date', 'date_format:Y-m-d H:i:s', 'after_or_equal:today'],
        ];
    }
}
