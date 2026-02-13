<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanierPlat extends Model
{
    use HasFactory;

    protected $table = 'panier_plat';

    protected $fillable = [
        'panier_id',
        'plat_id',
        'quantite',
        'prix_total',
    ];

    public function plat()
    {
        return $this->belongsTo(Plat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

