<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Livraison;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivraisonController extends Controller
{
    
    public function index () {
        
        $livraison = null;
        $total_number = 0;
        if(Auth::user() && Commande::where('user_id', Auth::id()) && Panier::where('user_id', Auth::id())->first()){
            $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();
            if (Commande::where('user_id', Auth::id())->first()) {
                $livraison = Commande::with('livraisons')->where('user_id', Auth::id())->first()->livraisons->first();
            }
        } else {
            $panier = session()->get('panier_invite');          
            if($panier){
                $total_number = array_sum(array_column($panier, 'quantite'));
            }
        }
       
        return view('panier.infos_livraison', [
            'commande' => Commande::where('user_id', Auth::id())->first(),
            'livraison' => $livraison,
            'total' => $total_number
        ]);
    }
    
    public function create (Commande $commande_id){
        $commande = Commande::findOrFail($commande_id);
        return view('commandes.index', compact($commande));
    }

    public function store(Request $request, Commande $commande_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'instructions' => 'nullable|string',
        ]);

        Livraison::updateOrCreate(
            [
                'commande_id' => $commande_id,
                'user_id' => Auth::id(),
            ],
            [
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'instructions' => $request->instructions,
            ]
        );

        $commande = Commande::where('id', $commande_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($commande) {
            $commande->update(['status' => 'livree']);
        }

        return to_route('rettine.commandes')->with('success', 'Votre livraison a été enregistrée avec succès.');
    }

}
