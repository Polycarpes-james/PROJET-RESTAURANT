<?php

namespace App\Data\Plat;

use Spatie\LaravelData\Data;

class UpdatePlatData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public string $disponible,
        public ?string $temps_preparation,
        public ?string $raison_indisponible,
        public int $category_id,
        /** @var UploadedFile[] */
        public array $pictures = [],
        public array $ingredients = [],
        public array $menus = [],
    ) {}
}
