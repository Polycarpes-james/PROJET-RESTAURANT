<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];


    public function getSlug()
    {
        return Str::slug($this->name);
    }
    public function plats ():BelongsToMany
    {
        return $this->belongsToMany(Plat::class);
    }
    
    public function sumPlats ()
    {
        return $this->plats()->count();
    }

    public function truncateText($text = null, $maxLength = 200)
    {
        if (strlen($text) <= $maxLength) {
            return $text;
        }

        return substr($text, 0, $maxLength) . '...';
    }
    //  public function updateNumber()
    // {
    //     if ($this->plat_number !== null) {
    //         $this->plat_number = $this->plats()->sum('id');
    //         $this->save(); 
    //     } else {
    //         return;
    //     }
    // }

    // public function updateStats()
    // {
    //     $this->plat_number = $this->plats()->sum('id');
    //     $this->save();
    // }
}
