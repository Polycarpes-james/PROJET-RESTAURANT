<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Picture;
use App\Models\Category;
use App\Models\Commande;
use App\Models\Ingredient;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plat extends Model
{
    use HasFactory;

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
    public function platValide ()
    {
        $disponible = $this->disponible;
        $stringValide = ""; 
        if ($disponible === "yes") {
            $stringValide = "Le plat est disponible";
        } else {
            $stringValide = "Le plat n'est pas disponible";
        }
        
        return [
            $stringValide,
            $disponible
        ]; 
    }

    public function ingredients():BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function total_price() 
    {
        return $this->ingredients()->sum('price');
    }

     public function getSlug()
    {
        return Str::slug($this->name);
    }
    
    public function getPicture (): ?Picture
    {
        return $this->pictures[0] ?? null;        
    }

    public function truncateText($text = null, $maxLength = 200)
    {
        
        $text = mb_convert_encoding($text ?? '', 'UTF-8', 'auto');
        // Si le texte est plus court que la limite → on le retourne tel quel
        if (mb_strlen($text, 'UTF-8') <= $maxLength) {
            return $text;
        }

        // On tronque d'abord grossièrement à la limite
        $truncated = mb_substr($text, 0, $maxLength, 'UTF-8');

        // Trouver le dernier espace pour ne pas couper un mot
        $lastSpace = mb_strrpos($truncated, ' ', 0, 'UTF-8');

        if ($lastSpace !== false) {
            $truncated = mb_substr($truncated, 0, $lastSpace, 'UTF-8');
        }

        // Ajoute les points de suspension
        return rtrim($truncated) . '...';
    }

    

    public function convertSecondsToText()
    {
        $totalMinutes = $this->temps_preparation;
        // dd($totalMinutes);

        $hours = floor($totalMinutes / 3600);   
        $rest = $totalMinutes % 3600;
        

        $parts = [];

        if ($hours > 0) {
            if ($rest === 0) {
                $parts[] = $hours . 'h';
            } else {
                $parts[] = $hours . 'h' . floor($rest / 60);
            }
        } else {
            $minutes = floor($totalMinutes / 60);
            $rest_sec = $totalMinutes % 60;

            if ($minutes > 1) {
                if ($rest_sec === 0 ) {
                    $parts[] = $minutes . ' mins';
                } else {
                    $parts[] = $minutes . ' mins';
                }
                
            } else {
                $parts[] = $minutes . "s";
            }
        }
    
        return implode('', $parts);
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
