<?php

namespace App\Data\Plat;

use App\Data\Picture\PictureData;
use App\Models\Plat;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PlatCardData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public float $price,
        public float $note,
        #[DataCollectionOf(PictureData::class)]
        public DataCollection $pictures,

    ) {}

    public static function fromModel(Plat $plat): self
    {
        return new self(
            id: $plat->id,
            name: $plat->name,
            price: $plat->price,
            note: $plat->sumNotes(),
            pictures: PictureData::collect($plat->pictures),
        );
    }
}