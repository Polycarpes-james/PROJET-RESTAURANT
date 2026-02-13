<?php

namespace App\Models;

use App\Models\Plat;
use App\Models\CommandeInvitePlat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CommandeInvite extends Model
{
    use HasFactory;
    
    protected $table = 'commande_invites';

    protected $fillable = [
        'nom', 
        'email', 
        'adresse', 
        'panier', 
        'total'
    ];
    public function plats ():BelongsToMany
    {
        return $this->belongsToMany(Plat::class, 'commande_invite_plat')
                    ->withPivot('quantite', 'prix_total')
                    ->withTimestamps();
    }

    public function commmandeInvitePlats()
    {
        return $this->hasMany(CommandeInvitePlat::class);
    }

}
