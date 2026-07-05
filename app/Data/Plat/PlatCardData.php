<?php

namespace App\Data\Plat;

use App\Data\Category\CategoryData;
use App\Models\Plat;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
#[TypeScript]
class PlatCardData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public float $price,
        public string $priceFormatted,
        public string $slug,
        public string $link,
        public float $note,
        public int $avis,
        public ?CategoryData $category,
        public string $image,
    ) {}

    public static function fromModel(Plat $plat): self
    {
        return new self(
            id: $plat->id,
            name: $plat->name,
            description: $plat->description,
            price: $plat->price,
            priceFormatted: number_format($plat->price, 0, ' ', ' ') . ' €',
            slug: $plat->getSlug(),
            link: route('rettine.plats.show', [ 'plat' => $plat, 'slug' => $plat->getSlug()]),
            note: $plat->sumNotes(),
            avis: $plat->nombreAvis(),
            category: $plat->category ? CategoryData::fromModel($plat->category) : null,
            image: $plat->getPicture()?->getPictureUrl(500,400),
        );
    }
}