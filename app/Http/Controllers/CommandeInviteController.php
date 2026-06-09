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
            return response()->json(['error' => 'vide',
            'message' => 'Votre panier est vide, vous ne pouvez pas la valider, veillez passer une commande!',
            
            ]);
        }

        $commande = new CommandeInvite();
        $commande->nom = $request->nom; // récupéré via formulaire invité
        $commande->email = $request->email;
        $commande->adresse = $request->adresse ?? null;
        $commande->panier = json_encode(array_values($panier));
        $commande->total = array_sum(array_column($panier, 'prix_total'));
        $commande->save();

        // Supprimer le panier de session
        session()->forget('panier_invite');

        return response()->json([
            'success' => true,
            'message' => 'Commande invitée enregistrée avec succès !'
        ]);
    }

}
