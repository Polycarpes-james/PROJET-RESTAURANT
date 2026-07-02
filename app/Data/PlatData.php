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
        public string $slug,
        public ?string $image,
        public string $link,
        public string $category,
        public float $note,
        public int $avis,
        public string $priceFormatted,
    ) {}

    public static function fromModel(Plat $plat): self
    {
        return new self(
            id: $plat->id,
            name: $plat->name,
            description: $plat->description,
            price: $plat->price,
            slug: $plat->getSlug(),
            image: $plat->getPicture()?->getPictureUrl(500,400),
            link: $plat->getSlug(),
            category: $plat->category?->name ?? "MULTITASK",
            note: $plat->sumNotes(),
            avis: $plat->nombreAvis(),
            priceFormatted: number_format($plat->price,0,' ',' ').' €',
        );
    }
}