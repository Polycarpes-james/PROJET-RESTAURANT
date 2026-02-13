<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index () {
        $total_number = 0;
        if(Auth::user() && Commande::where('user_id', Auth::id()) && Panier::where('user_id', Auth::id())->first()){
            $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();
        } else {
            $panier = session()->get('panier_invite');      
            if($panier){
                $total_number = array_sum(array_column($panier, 'quantite'));
            }
        }
        return view('index', [
            'user' => Auth::user() ?? null,
            'total' => $total_number
        ]);
    }

    // public function commandes ()
    // {
    //     return view('commandes.index');
    // }
}
