<?php

namespace App\Data;

use App\Models\Plat;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PlatData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public float $price,
        public string $availability,
        public ?string $image,
        public string $shortDescription,
        public string $priceFormatted,
    ) {}

    public static function fromModel(Plat $plat): self
    {
        return new self(
            id: $plat->id,
            name: $plat->name,
            description: $plat->description,
            price: $plat->price,
            availability: $plat->disponible,
            image: $plat->getPicture()?->getPictureUrl(300,250),
            shortDescription: str($plat->description)->limit(60),
            priceFormatted: number_format($plat->price,0,' ',' ').' FCFA',
        );
    }
}