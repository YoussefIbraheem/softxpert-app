<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use App\Rules\OnlyManagerCanCancelTask;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeTaskStatusRequest extends FormRequest
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
            'status' => [
                'required',
                'string',
                Rule::in(array_column([TaskStatus::PENDING, TaskStatus::IN_PROGRESS, TaskStatus::COMPLETED, TaskStatus::CANCELLED], 'value')),
                new OnlyManagerCanCancelTask($this->user()),
            ],
        ];
    }
}
