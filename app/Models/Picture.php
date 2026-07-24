<?php

namespace App\Models;

use App\Models\Plat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename'
    ];

    public function plat()
    {
        return $this->belongsTo(Plat::class);
    }

    protected static function booted():void
    {
        static::deleting(function (Picture $picture) {
            Storage::disk('public')->delete($picture->filename);
            Storage::disk('public')->delete("/" . $picture->id);
        });
    }

    public function getPictureUrl(?int $width = null, ?int $height = null): string
    {
       if ($width === null || $height === null) {
            return Storage::disk('public')->url($this->filename);
        }

        $thumbnailPath = "thumbnails/{$width}x{$height}/{$this->filename}";

        // Si la miniature existe déjà, on retourne son URL
        if (Storage::disk('public')->exists($thumbnailPath)) {
            return Storage::disk('public')->url($thumbnailPath);
        }

        // Récupération de l'image originale
        $image = Image::read(
            Storage::disk('public')->get($this->filename)
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
