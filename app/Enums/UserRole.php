<?php

namespace App\Enums;

enum UserRole: string
{
    case USER = 'user';
    case MANAGER = 'manager';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::USER => 'User',
            self::MANAGER => 'Manager',
            self::ADMIN => 'Admin',
        };

    }
}
