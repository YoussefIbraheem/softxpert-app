<?php

namespace App\Rules;

use App\Enums\TaskStatus;
use App\Enums\UserRole;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OnlyManagerCanCancelTask implements ValidationRule
{
    protected $user;

    /**
     * Class constructor.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->user->hasRole(UserRole::USER) && $value == TaskStatus::CANCELLED->value) {
            $fail('Only a Manager or an Admin can cancel the task. Contact your direct manager for more details');
        }
    }
}
