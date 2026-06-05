<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Plat;
use App\Models\Panier;
use App\Models\Commande;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlatsController extends Controller
{
       
    public function plats () {
        return view('plats.index', [
            'plats' => Plat::all(),
            'total' => $this->total()
        ]);
    }
    /**
     * La fonction "total" renvoie le nombre total de plats pour les invités et les abonnés
     */
    public function total () {
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

    /**
     * La fonction "show" permet de voir le contenu d'un plat en particulié
     */
    public function show (string $slug, Plat $plat)
    {
        // Récupération des avis du plat avec l'utilisateur associé
        $quantite = 0;
        $ok = false;
        $avis = Avis::where('plat_id', $plat->id)->with('user')->latest()->paginate(3);

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
        return view('plats.show', [
            'plat' => $plat,
            'plat_quantite' => $quantite,
            'avis' => $avis,
            'moyenne' => $moyenne,
            'nombreAvis' => $nombreAvis,
            'total' => $this->total()
        ]);
    }

    public function show_modal (Plat $plat) {
        $quantite = 0;

        if (!auth()->check()) {
            return response()->json([
                'error' => 'connect',
                'message' => 'Veuillez vous connecter ou continuer en tant qu’invité.'
            ], 403);
        }

        $session_invite = session()->get('invite_session');

        if (auth()->check()) {
            if (Panier::where('user_id', Auth::id())->first()->plats->where('id', $plat->id)->first()) {
                $quantite = Panier::where('user_id', Auth::id())->first()->plats->where('id', $plat->id)->first()->pivot->quantite;
            }
        }

        $picture = $plat->getPicture()->getPictureUrl(266, 200);
        
        return response()->json(['plat' => $plat, 'quantite' => $quantite, 'picture' => $picture, 'session' => $session_invite]);
    }

    public function show_modalInvite (Plat $plat) {
        $session_invite = session()->get('invite_session');
        $panier = session()->get('panier_invite');
        // $platPanier =  $panier[$plat->id];
        return response()->json(['plat' => $plat, 'panier' => $panier, 'session' => $session_invite]);

    }
}
