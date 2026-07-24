<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class ImageItem {
    
    public static function url(?string $path, ?int $width = null, ?int $height = null, string $fit = 'crop'): string {
        if ($width === null || $height === null) {
            return Storage::disk('public')->url($path);
        }

        $thumbnailPath = "thumbnails/{$width}x{$height}/{$path}";

        // Si la miniature existe déjà, on retourne son URL
        if (Storage::disk('public')->exists($thumbnailPath)) {
            return Storage::disk('public')->url($thumbnailPath);
        }

        // Récupération de l'image originale
        $image = Image::read(
            Storage::disk('public')->get($path)
        );

        // Redimensionnement façon Glide "fit crop"
        $image->cover($width, $height);

        // Sauvegarde de la miniature
        Storage::disk('public')->put(
            $thumbnailPath,
            $image->toJpeg(80)
        );

        return Storage::disk('public')->url($thumbnailPath);

    }
}