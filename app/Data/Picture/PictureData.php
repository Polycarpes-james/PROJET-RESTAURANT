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

    public static function fromModel(Picture $picture, $pictureUrl): self
    {
        return new self(
            id: $picture->id, 
            filename: $pictureUrl
        );
    }
}