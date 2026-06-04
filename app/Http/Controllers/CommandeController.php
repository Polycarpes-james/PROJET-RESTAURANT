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
        $total_number = 0;
        if(Auth::user() && Commande::where('user_id', Auth::id()) && Panier::where('user_id', Auth::id())->first()){
            $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();
        } else {
            $panier = session()->get('panier_invite');
            if($panier){
                $total_number = array_sum(array_column($panier, 'quantite'));
            }
        }

        $panier = Panier::where('user_id', Auth::id())->first();

        return view('commandes.index', [
            'panier' => $panier,
            'categories' => Category::all(),
            'menus' => Menu::all(),
            'commande' => Commande::where('user_id', Auth::id())->first(),
            'total' => $total_number
        ]);
    }    
}
 