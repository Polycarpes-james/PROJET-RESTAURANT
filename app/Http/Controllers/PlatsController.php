<?php

namespace App\Http\Controllers;

use App\Data\PlatData;
use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Commande;
use App\Models\Panier;
use App\Models\Plat;
use App\Services\PanierService;
use App\Services\PlatService;
use Illuminate\Support\Facades\Auth;

class PlatsController extends Controller
{
       
    public function __construct(
        protected PlatService $platService,
        protected PanierService $panierService
    ) {}

    public function plats(PlatService $platService, PanierService $panierService){
        return view('plats.index', [
            'plats' => $platService->cards(),
            'total' => $panierService->total(),
        ]);
    }
    
    public function show(string $slug, Plat $plat, PlatService $platService, PanierService $panierService) {
        $avis = Avis::where('plat_id', $plat->id)->with('user')->latest()->paginate(3);

        // dd($platService->show($plat)->toArray());
        return view('plats.show', [
            'platService' => $platService->show($plat)->toArray(),
            'total' => $panierService->total(),
            'avis' => $avis
        ]);
    }

    /**
     * La fonction "show" permet de voir le contenu d'un plat en particulié
     */
    

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
            $panierElement = Panier::where('user_id', Auth::id())->first()->plats->where('id', $plat->id)->first();
            if ($panierElement) {
                $quantite = $panierElement->pivot->quantite;
            }
        }

        $picture = $plat->getPicture()->getPictureUrl(266, 200);
        
        return response()->json(['plat' => $plat, 'quantite' => $quantite, 'picture' => $picture, 'session' => $session_invite]);
    }

    public function show_modalInvite (Plat $plat) {
        $session_invite = session()->get('invite_session');
        $panier = session()->get('panier_invite');
        // $platPanier =  $panier[$plat->id];
        // dd($panier);
        return response()->json(['plat' => $plat, 'panier' => $panier, 'session' => $session_invite]);

    }
}
