<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Panier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total'
    ];

    public function user ():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function plats ():BelongsToMany
    {
        return $this->belongsToMany(Plat::class, 'panier_plat')
                    ->withPivot('quantite', 'prix_total')
                    ->withTimestamps();
    }
    public function commandes()
    {
    return $this->belongsToMany(Commande::class, 'commande_panier')
                ->withPivot(['quantite', 'price'])
                ->withTimestamps();
    }

    public function panierPlats()
    {
        return $this->hasMany(PanierPlat::class);
    }


}
