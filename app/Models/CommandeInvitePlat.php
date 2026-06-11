<?php

namespace App\Models;

use App\Models\CommandeInvite;
use App\Models\Plat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommandeInvitePlat extends Model
{
    use HasFactory;

    protected $table = 'commande_invite_plats';


    protected $fillable = [
        'commande_invite_id',
        'plat_id',
        'plat_name',
        'prix_total',
        'prix_unitaire',
        'quantite',
    ];

    public function commandeInvite(): BelongsTo
    {
        return $this->belongsTo(CommandeInvite::class);
    }

    public function plat(): BelongsTo
    {
        return $this->belongsTo(Plat::class);
    }
}
