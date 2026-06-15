<?php

namespace App\Models;

use App\Models\CommandeInvitePlat;
use App\Models\Plat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CommandeInvite extends Model
{
    use HasFactory;
    
    protected $table = 'commande_invites_info';

    protected $fillable = [
        'invite_id',
        'name', 
        'lastname', 
        'email',
        'address', 
        'phone', 
        'instructions',
        'total_quantite',
        'total_prix'
    ];

    public function plats ():BelongsToMany
    {
        return $this->belongsToMany(Plat::class, 'commande_invite_plats')
                    ->withPivot('quantite', 'prix_total')
                    ->withTimestamps();
    }    
    // public function CommandeInvitePlat(): BelongsToMany
    // {
    //     return $this->belongsToMany(CommandeInvitePlat::class);
    // }

}
