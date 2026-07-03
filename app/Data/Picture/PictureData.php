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
        public string $filename,
        public string $url,
        public string $firstPicture,
    ) {}

    public static function fromModel(Picture $picture): self
    {
        return new self(
            id: $picture->id,
            filename: $picture->filename,
            url: $picture->getPictureUrl(500,400),
            firstPicture: $picture->getPicture()->getPictureUrl(500,400)
        );
    }
}