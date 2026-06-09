<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommandeInvite;

class CommandeInviteController extends Controller
{
    public function commanderInvite(Request $request)
    {
        
        $panier = session()->get('panier_invite', []);

        if(empty($panier)) {
            return response()->json([
                'error' => 'vide',
                'message' => 'Votre panier est vide, vous ne pouvez pas la valider, veillez passer une commande!',
            
            ]);
        }
        $commande = new CommandeInvite();

        $commande->commande_client_id = array_sum(array_column($panier, 'quantite')) + 115;
        $commande->name = $request->name; 
        $commande->lastname = $request->lastname; 
        $commande->email = $request->email;
        $commande->address = $request->address ?? null;
        $commande->phone = $request->phone ?? null;
        $commande->instructions = $request->instructions ?? null;
        $commande->total_quantite = array_sum(array_column($panier, 'quantite'));
        $commande->total_prix = array_sum(array_column($panier, 'prix_total'));

        $commande->save();
        

        // Supprimer le panier de session
        session()->forget('panier_invite');

        return to_route('rettine.commandes')->with('success', 'Votre livraison a été enregistrée avec succès.');
    }

}
