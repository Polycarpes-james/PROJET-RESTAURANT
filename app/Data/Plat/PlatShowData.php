<?php

namespace App\Data\Plat;

use App\Data\Category\CategoryData;
use App\Data\Ingredient\IngredientData;
use App\Data\Plat\PlatData;
use App\Models\Plat;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]

class PlatShowData extends Data
{
    public function __construct(
        public Plat $plat,
    ) {}

    public static function fromModel(Plat $plat): self
    {
        return new self(
            plat: $plat,
        );
    }
}
