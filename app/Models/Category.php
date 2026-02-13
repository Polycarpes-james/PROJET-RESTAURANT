<?php

namespace App\Models;

use App\Models\Plat;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function plates():HasMany    
    {
        return $this->hasMany(Plat::class);
    }

    public function getSlug()
    {
        return Str::slug($this->name);
    }
}
