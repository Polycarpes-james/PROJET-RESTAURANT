<?php

namespace App\Data\Plat;

use App\Data\Category\CategoryData;
use App\Data\Ingredient\IngredientData;
use App\Data\Picture\PictureData;
use App\Models\Plat;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PlatModalData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public float $price,
        public ?CategoryData $category,
        #[DataCollectionOf(PictureData::class)]
        public DataCollection $pictures,
        #[DataCollectionOf(IngredientData::class)]
        public DataCollection $ingredients,

    ) {}

    public static function fromModel(Plat $plat): self
    {
        return new self(
            id: $plat->id,
            name: $plat->name,
            description: $plat->pivot->quantite,
            price: $plat->price,
            category: $plat->category ? CategoryData::fromModel($plat->category) : null,
            pictures: PictureData::collect($plat->pictures),
            ingredients: IngredientData::collect($plat->ingredients),
        );
    }
}