<?php

namespace App\Models;

use App\Enums\AnyEnum;
use App\Enums\RoleEnum;
use App\Models\Category;
use App\Models\Commande;
use App\Models\Ingredient;
use App\Models\Menu;
use App\Models\Picture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class Plat extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 
        'description', 
        'price',
        'disponible',
        'temps_preparation',
        'raison_indisponible',
        'category_id'
    ];

    public function panierPlats()
    {
        return $this->hasMany(PanierPlat::class);
    }

    public function getPlatStatusAttribute(): string
    {
        $status = $this->disponible;
        return $status ? AnyEnum::from($status)->platStatus() : '';
    }

    public function getPlatColorAttribute(): string
    {
        $status = $this->disponible;
        return $status ? AnyEnum::from($status)->platColor() : '';
    }

    public function category ():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function menus ():BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    } 

    public function commandes ():BelongsToMany
    {
        return $this->belongsToMany(Commande::class, 'commande_plat')
                ->withPivot('quantite')
                ->withTimestamps();
    }

    public function pictures () : HasMany
    { 
        return $this->hasMany(Picture::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function sumNotes ()
    {
        $sum = $this->avis->sum('note');
        return $sum;
    }
    public function moyenneNotes()
    {
        return $this->avis()->avg('note');
    }
    
    // nombre total d'avis
    public function nombreAvis()
    {
        return $this->avis()->count();
    }

    public function scopeId (Builder $builder, string $id): Builder
    {   
        return $builder->where('id', $id);
    }

    public function ingredients():BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function getSlug()
    {
        return Str::slug($this->name);
    }
    
    public function getPicture (): ?Picture
    {
        return $this->pictures[0] ?? new Picture(['filename'=>'modal1.jpg']);;        
    }

   
   
    /**
     * @param UploadedFile[] $files
     */
    public function attachFiles (array $files)
    {
        $pictures = [];

        foreach($files as $file){
            if($file->getError()){
                continue;
            };

            $filename = $file->store('plats/' . $this->id, 'public');

            $pictures[] = [
                'filename' => $filename
            ];
        }

        if (count($pictures) > 0) {
            $this->pictures()->createMany($pictures);
        }
    }


}
