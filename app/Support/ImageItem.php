<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class ImageItem {
    
    public static function url(?string $path, ?int $width = null, ?int $height = null, string $fit = 'crop'): string {
            if (blank($path)) {
                return asset('images/default-user.png');
            }
            // Pas de miniature demandée
            if ($width === null || $height === null) {
                if (filter_var($path, FILTER_VALIDATE_URL)) {
                    return $path;
                }
                return Storage::disk('public')->url($path);
            }

            /**
             * -----------------------------
             * IMAGE DISTANTE (Google...)
             * -----------------------------
             */
            if (filter_var($path, FILTER_VALIDATE_URL)) {

                // Nom unique basé sur l'URL
                $filename = md5($path) . '.jpg';
                $thumbnailPath = "thumbnails/google/{$width}x{$height}/{$filename}";
                if (Storage::disk('public')->exists($thumbnailPath)) {
                    return Storage::disk('public')->url($thumbnailPath);
                }
                

                // Télécharger l'image
                $response = Http::get($path);

                if (!$response->successful()) {
                    return asset('images/default-user.png');
                }

                $image = Image::read($response->body());

                match ($fit) {
                    'crop' => $image->cover($width, $height),
                    'contain' => $image->contain($width, $height),
                    default => $image->cover($width, $height),
                };

                Storage::disk('public')->put(
                    $thumbnailPath,
                    (string) $image->toJpeg(85)
                );

                return Storage::disk('public')->url($thumbnailPath);
            }

            /**
             * -----------------------------
             * IMAGE LOCALE
             * -----------------------------
             */

            if (!Storage::disk('public')->exists($path)) {
                return asset('images/default-user.png');
            }

            $thumbnailPath = "thumbnails/{$width}x{$height}/{$path}";

            if (Storage::disk('public')->exists($thumbnailPath)) {
                return Storage::disk('public')->url($thumbnailPath);
            }

            $image = Image::read(Storage::disk('public')->path($path));

            match ($fit) {
                'crop' => $image->cover($width, $height),
                'contain' => $image->contain($width, $height),
                default => $image->cover($width, $height),
            };

            Storage::disk('public')->put(
                $thumbnailPath,
                (string) $image->toJpeg(85)
            );

            return Storage::disk('public')->url($thumbnailPath);
    }
}