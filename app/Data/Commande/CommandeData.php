<?php

namespace App\Data\Commande;

use Spatie\LaravelData\Data;

class CommandeData extends Data
{
    public function __construct(
        public ?int $user_id,
        public string $status,
        public string $total_price,
    ) {}
}
