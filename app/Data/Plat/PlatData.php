<?php
namespace App\Data\Plat;

use App\Data\Category\CategoryData;
use App\Data\Picture\PictureData;
use App\Models\Plat;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


#[TypeScript]
class PlatData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public string $disponible,
        public ?string $temps_preparation,
        public ?string $raison_indisponible,
        public ?CategoryData $category,
        public  Optional|UploadedFile $pictures
    ) {}

    // public static function fromModel(Plat $plat): self
    // {
    //     return self::from(
    //         $plat,
    //         [
    //             "category_id" => $plat->category ? CategoryData::fromModel($plat->category) : null,
    //         ]
    //         // pictures: PictureData::collect($plat->pictures),
    //     );
    // }
}