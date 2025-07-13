<?php

namespace App\Rules;

use App\Enums\UserRole;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AssignUsersOnly implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::find($value);

        if (! $user) {
            abort(422, 'Assignee Id not found!');
        }

        if ($user->hasAnyRole([UserRole::ADMIN, UserRole::MANAGER])) {
            $fail('Only users can be assigned to tasks');
        }
    }
}
