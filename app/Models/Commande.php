<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status'
    ];

    public function user ():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paniers()
    {
        return $this->belongsToMany(Panier::class, 'commande_panier')
                    ->withPivot(['quantite', 'price'])
                    ->withTimestamps();
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }
}
