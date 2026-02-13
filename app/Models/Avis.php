<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'plat_id', 
        'note', 
        'commentaire'
    ];

    protected $casts = [
        'note' => 'float',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plat()
    {
        return $this->belongsTo(Plat::class);
    }
}
