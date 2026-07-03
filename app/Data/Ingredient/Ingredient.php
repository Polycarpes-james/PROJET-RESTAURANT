<?php

namespace App\Data\Ingredient;

use App\Models\Ingredient;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class IngredientData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public float $price,
    ) {}

    public static function fromModel(Ingredient $ingredient): self
    {
        return new self(
            id: $ingredient->id,
            name: $ingredient->name,
            price: $ingredient->price,
        );
    }
}