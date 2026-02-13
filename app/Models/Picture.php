<?php

namespace App\Models;

use App\Models\Plat;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use League\Glide\Urls\UrlBuilderFactory;

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

    public function getPictureUrl(?int $width = null, ?int $height = null): string
    {
        if ($width === null) {
            return Storage::disk('public')->url($this->filename);
        }        
        $urlBuilder = UrlBuilderFactory::create('images/', config('glide.key'));

        return $urlBuilder->getUrl($this->filename, ['w' => $width, 'h' => $height, 'fit' => 'crop']);
    }
}
