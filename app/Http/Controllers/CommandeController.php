<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\CommandeController as AdminCommandeController;
use App\Models\Category;
use App\Models\Commande;
use App\Models\Menu;
use App\Models\Panier;
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function index ()
    {
        // dd(Au);
        // dd(Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum());
        $livraison = null;
        $total_number = 0;
        if(Auth::user() && Commande::where('user_id', Auth::id()) && Panier::where('user_id', Auth::id())->first()){
            $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();
            if (Commande::where('user_id', Auth::id())->first()) {
                $livraison = Commande::with('livraisons')->where('user_id', Auth::id())->first()->livraisons->first();
            }
        } else {
            $panier = session()->get('panier_invite');
            // $panier = session()->get('panier_invite');
            // // $panierPlat = $panier[4];
            // // unset($panierPlat);
            // // $panierPlat['name'] = "Le nom";
            // // session()->put('panier_invite', $panier);
            // // session()->put('panier_invite', 'none');
            // // dd($panierPlat);
            // // dd( array_sum(array_column($panier, 'quantite')));    
            // dd(session()->get('platsInCard'));             
            if($panier){
                $total_number = array_sum(array_column($panier, 'quantite'));
            }
        }
       
        // dd($total_number);
        // dd(Plat::all());
        return view('commandes.index', [
            'plats' => Plat::all(),
            'categories' => Category::all(),
            'menus' => Menu::all(),
            'commande' => Commande::where('user_id', Auth::id())->first(),
            'livraison' => $livraison,
            'total' => $total_number
        ]);
    }    
}
 