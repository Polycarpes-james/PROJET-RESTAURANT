<?php

namespace App\Enums;

enum AnyEnum: string
{
    // User 
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case CLIENT = 'client';
    // Plat
    case YES = 'yes';
    case NO = 'no';

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
    // Le status du plat
    public function platStatus(): string
    {
        return match ($this) {
            self::YES => 'Disponible',
            self::NO => 'Indisponible',
        };
    }
    // Le label
    public function platLabel(): string
    {
        return match ($this) {
            self::YES => "Ce plat est disponible!",
            self::NO => "Ce plat n'est pas disponible!",
        };
    }
    public function platColor(): string
    {
        return match ($this) {
            self::YES => "livre",
            self::NO => "annule",
        };
    }
}