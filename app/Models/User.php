<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\AnyEnum;
use App\Models\Commande;
use App\Models\Livraison;
use App\Models\Panier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'firstname',
        'email',
        'password',
        'admin',
        'avatar',
    ];    
    public function getRoleLabelAttribute(): string
    {
        $role = $this->getRoleNames()->first();

        return $role ? AnyEnum::from($role)->label() : 'Aucun rôle';
    }

    public function getRoleColorAttribute(): string
    {
        $role = $this->getRoleNames()->first();

        return $role ? AnyEnum::from($role)->color() : '';
    }

    public function commande ():BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }

    public function panier():HasOne
    {
        return $this->hasOne(Panier::class); // Un utilisateur a un seul panier
    }
    public function cutName () {
        $initiales = collect(explode(' ', $this->name . " " . $this->firstname))->map(fn ($part) => mb_substr($part, 0, 1))->implode('');
        $name = strtoupper($initiales);
        return $name;
    }
    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }
    public function avis()
    {
        return $this->hasMany(\App\Models\Avis::class);
    }

    // public function getPicture (): ?Picture
    // {
    //     return $this->avatar ?? null;        
    // }

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
