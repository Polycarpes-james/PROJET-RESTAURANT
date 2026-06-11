<?php

namespace App\Http\Controllers;

use App\Models\CommandeInvite;
use App\Models\CommandeInvitePlat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
        // $request->validate([
        //     "name" => 'required|string',
        //     "lastname" => 'required|string',
        //     "email" => 'required|email',
        //     "address" => 'required|string',
        //     "phone" => 'required|strin',
        //     "instructions" => 'required|string',
        //     "total_quantite" => 'required|integer',
        //     "total_prix" =>'required|integer'
        // ]);
        // dd(Cookie::get());
        $elements = [
                "invite_id" => Cookie::get('invite_id'),
                "name" => $request->name,
                "lastname" => $request->lastname,
                "email" => $request->email,
                "address" => $request->address ?? null,
                "phone" => $request->phone ?? null,
                "instructions" => $request->instructions ?? null,
                "total_quantite" => collect($panier)->sum('quantite'),
                "total_prix" => collect($panier)->sum('prix_total'),      
            ];
        // $commande = new CommandeInvite();
        $commande = CommandeInvite::where('invite_id', Cookie::get('invite_id'))->first();
        // dd($commande);
        if($commande){
            $commande->update($elements);
        } else {
            CommandeInvite::create($elements);
        }
        
        foreach ($panier as $item) {
            CommandeInvitePlat::create([
                'commande_invite_id' => Cookie::get('invite_id'),
                'plat_id' => $item['plat_id'],
                'plat_name' => $item['name'],
                'prix_total' => $item['prix_total'],
                'prix_unitaire' => $item['price'],
                'quantite' => $item['quantite'],
            ]);
        }


        // Supprimer le panier de session
        session()->forget('panier_invite');

        return to_route('rettine.commandes')->with('success', 'Votre livraison a été enregistrée avec succès.');
    }

}
