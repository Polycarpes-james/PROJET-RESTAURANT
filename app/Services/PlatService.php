<?php

namespace App\Services;

use App\Data\Category\CategoryData;
use App\Data\Ingredient\IngredientData;
use App\Data\Picture\PictureData;
use App\Data\Plat\PlatCardData;
use App\Data\Plat\PlatData;
use App\Data\Plat\PlatShowData;
use App\Models\Avis;
use App\Models\Panier;
use App\Models\Plat;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\DataCollection;

class PlatService
{
    public function details(Plat $plat): array
    {

    }

    public function modal(Plat $plat): array
    {

    }
    /**
     * @return DataCollection<PlatCardData>
     */
    public function cards(): DataCollection
    {
        return new DataCollection(PlatCardData::class, Plat::with(['category', 'pictures',])->get());
    }

    public function show (Plat $plat):PlatShowData
    {
        // Récupération des avis du plat avec l'utilisateur associé
        $quantite = 0;
        $ok = false;
        $avis = Avis::where('plat_id', $plat->id)->with('user')->latest()->paginate(10);

        // Calcul de la moyenne des notes et du nombre d'avis
        $moyenne = $avis->avg('note');
        $nombreAvis = $avis->count();

        if ( Auth::user() && Panier::where('user_id', Auth::id()) ) {
            if (Panier::where('user_id', Auth::id())->first() && Panier::where('user_id', Auth::id())->first()->plats->where('id', $plat->id)->first()) {
                $quantite = Panier::where('user_id', Auth::id())->first()->plats->where('id', $plat->id)->first()->pivot->quantite;
            }
        } else {
            if (session()->get('panier_invite')) {
                if(!in_array($plat->id, session()->get('panier_invite'))){
                    $ok = true;
                } 
            }
        }

        if($ok){
            $quantite = session()->get('panier_invite')[$plat->id]['quantite']; 
        }
        $totalPriceIngredients = $plat->ingredients->sum('price');
        
        return new PlatShowData(
            plat: PlatData::from($plat),
            note: $plat->sumNotes(),
            avis: $plat->nombreAvis(),
            quantite: $quantite,
            totalIngredientsPrice: $totalPriceIngredients,
            pictures: new DataCollection(PictureData::class, $plat->pictures->map(fn ($picture) => PictureData::fromModel($picture, $picture->getPictureUrl(200, 190)))),
            ingredients: new DataCollection(IngredientData::class, $plat->ingredients->map(fn ($ingredient) => IngredientData::fromModel($ingredient))),
            category: $plat->category ? CategoryData::fromModel($plat->category) : null
        );
    }
}