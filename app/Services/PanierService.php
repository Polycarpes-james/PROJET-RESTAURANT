<?php
namespace App\Services;


use App\Exceptions\PlatIndisponibleException;
use App\Models\Commande;
use App\Models\Panier;
use App\Models\Plat;
use Illuminate\Support\Facades\Auth;

class PanierService
{
        /**
         * La fonction "total" renvoie le nombre total de plats pour les invités et les abonnés
         */
    static public function total () {
        $total_number = 0;
        if(Auth::user() && Commande::where('user_id', Auth::id()) && Panier::where('user_id', Auth::id())->first()){
            $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();
        } else {
            $panier = session()->get('panier_invite');    
            if($panier){
                $total_number = array_sum(array_column($panier, 'quantite'));
            }
        }
        return $total_number;
    }

    
    public function verifierDisponibilite(Plat $plat)
    {
        if ($plat->disponible !== 'yes') {
            throw new PlatIndisponibleException(
                raison: $plat->raison_indisponible ?? "Aucune raison n'a été précisée.",
                message: "Le plat '{$plat->name}' est actuellement indisponible."
            );
        }
    }
}