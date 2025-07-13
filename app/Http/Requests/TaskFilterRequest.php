<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'nullable|string|in:pending,in_progress,completed,cancelled',
            'title' => 'nullable|string|max:255',
            'owner_id' => 'nullable|integer|exists:users,id',
            'assignee_id' => 'nullable|integer|exists:users,id',
            'due_date_from' => 'nullable|date|before_or_equal:due_date_to',
            'due_date_to' => 'nullable|date|after_or_equal:due_date_from',
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}
