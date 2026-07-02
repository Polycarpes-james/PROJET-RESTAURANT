<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case CLIENT = 'client';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Administrateur',
            self::ADMIN => 'Administrateur',
            self::CLIENT => 'Client',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'livre',
            self::ADMIN => 'nouveau',
            self::CLIENT => 'encours',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'shield',
            self::ADMIN => 'user-cog',
            self::CLIENT => 'user',
        };
    }
}