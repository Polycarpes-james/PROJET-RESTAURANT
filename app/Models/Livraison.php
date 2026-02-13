<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'commande_id',
        'name', 
        'lastname', 
        'email',
        'address', 
        'phone', 
        'instructions',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
