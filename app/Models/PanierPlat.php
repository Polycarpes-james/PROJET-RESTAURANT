<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function panier()
    {
        return $this->belongsTo(Panier::class);
    }

        public function scopePanierId (Builder $builder, string $id): Builder
    {   
        return $builder->where('panier_id', $id);
    }
    public function scopePlatId (Builder $builder, string $id): Builder
    {   
        return $builder->where('plat_id', $id);
    }
}

