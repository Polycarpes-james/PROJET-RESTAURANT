<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class ImageItem {
    

    public static function url(
        ?string $path,
        ?int $width = null,
        ?int $height = null,
        string $fit = 'crop'
    ): string {

        // Image par défaut
        if (blank($path)) {
            return asset('images/default-user.png');
        }

        // Aucune miniature demandée
        if ($width === null || $height === null) {
            return filter_var($path, FILTER_VALIDATE_URL) ? $path : Storage::disk('public')->url($path);
        }

        /**
         * =====================================
         * AVATAR GOOGLE / IMAGE DISTANTE
         * =====================================
         */
        if (filter_var($path, FILTER_VALIDATE_URL)) {

            // On demande une image en haute résolution à Google
            $googleUrl = preg_replace('/=s\d+-c$/', '=s1024-c', $path);

            // Nom unique
            $filename = md5($googleUrl).'.jpg';

            $thumbnailPath = "thumbnails/google/{$width}x{$height}/{$filename}";

            if (Storage::disk('public')->exists($thumbnailPath)) {
                return Storage::disk('public')->url($thumbnailPath);
            }

            try {

                $response = Http::timeout(15)->get($googleUrl);

                if (!$response->successful()) {
                    return asset('images/default-user.png');
                }

                $image = Image::read($response->body());

                match ($fit) {
                    'contain' => $image->contain($width, $height),
                    default => $image->cover($width, $height),
                };

                Storage::disk('public')->put($thumbnailPath, (string) $image->toJpeg(90)->toString());

                return Storage::disk('public')->url($thumbnailPath);

            } catch (\Throwable $e) {
                // dd($e);
                return asset('images/default-user.png');

            }
        }

        /**
         * =====================================
         * IMAGE LOCALE
         * =====================================
         */

        if (!Storage::disk('public')->exists($path)) {
            return asset('images/default-user.png');
        }

        $thumbnailPath = "thumbnails/{$width}x{$height}/{$path}";

        if (Storage::disk('public')->exists($thumbnailPath)) {
            return Storage::disk('public')->url($thumbnailPath);
        }

        // Création automatique des dossiers
        Storage::disk('public')->makeDirectory(dirname($thumbnailPath));

        try {

            $image = Image::read(
                Storage::disk('public')->path($path)
            );

            match ($fit) {
                'contain' => $image->contain($width, $height),
                default => $image->cover($width, $height),
            };

            Storage::disk('public')->put(
                $thumbnailPath,
                (string) $image->toJpeg(90)
            );

            return Storage::disk('public')->url($thumbnailPath);

        } catch (\Throwable $e) {

            return asset('images/default-user.png');

        }
    }
}