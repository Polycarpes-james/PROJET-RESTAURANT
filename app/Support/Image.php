<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use League\Glide\Urls\UrlBuilderFactory;

class Image{
    
    public static function url(?string $path, ?int $width = null, ?int $height = null, string $fit = 'crop'): string {
        if (!$path) return asset('images/default.png');

        if ($width === null && $height === null) {
            return Storage::disk('public')->url($path);
        }
        $urlBuilder = UrlBuilderFactory::create('images/',
            config('glide.key')
        );

        return $urlBuilder->getUrl($path, ['w' => $width, 'h' => $height, 'fit' => $fit,]);
    }
}