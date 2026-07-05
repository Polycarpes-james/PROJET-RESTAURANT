<?php

namespace App\Data\Picture;

use App\Models\Picture;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PictureData extends Data
{
    public function __construct(
        public int $id,
        public string $filename
    ) {}

    public static function fromModel(Picture $picture): self
    {
        return self::from(
            id: $picture->id, 
            filename: $picture->filename
        );
    }
}