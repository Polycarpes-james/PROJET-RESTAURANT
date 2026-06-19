<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Panier;
use App\Models\Commande;
use App\Models\Livraison;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use League\Glide\Urls\UrlBuilderFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'role',
    ];

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

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }


    public function isAdmin()
    {
        return in_array(
            $this->role,
            [
                'admin',
                'super_admin'
            ]
        );
    }

    
    public function getPictureUrl(?int $width = null, ?int $height = null): string
    {
        if ($width === null) {
            return Storage::disk('public')->url($this->avatar);
        }        
        $urlBuilder = UrlBuilderFactory::create('images/', config('glide.key'));

        return $urlBuilder->getUrl($this->avatar, ['w' => $width, 'h' => $height, 'fit' => 'crop']);
    }
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
