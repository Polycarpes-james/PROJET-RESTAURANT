<?php

namespace App\Data\Plat;

use App\Data\Category\CategoryData;
use App\Data\Ingredient\IngredientData;
use App\Data\Picture\PictureData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Avis;

class PlatShowData extends Data
{
    public function __construct(
        public PlatData $plat,
        public float $notes,
        public LengthAwarePaginator $avis,
        public ?Avis $aviUserPlat,
        public string $quantite,
        public int $totalIngredientsPrice,
        #[DataCollectionOf(PictureData::class)]
        public DataCollection $pictures,
        #[DataCollectionOf(IngredientData::class)]
        public DataCollection $ingredients,
        public  Optional|string $firstPicture,
        public ?CategoryData $category,
    ) {}

}