<?php
namespace App\Data\Plat;

use App\Data\Category\CategoryData;
use App\Models\Plat;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


#[TypeScript]
class PlatData extends Data
{
    public function __construct(
        public string $name,
        public string $id,
        public string $description,
        public float $price,
        public string $disponible,
        public ?string $temps_preparation,
        public ?string $raison_indisponible,
        public ?int $category_id,
        public  Optional|UploadedFile $pictures,
    ) {}
}