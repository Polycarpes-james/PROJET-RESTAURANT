<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Livraison;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LivraisonController extends Controller
{
    // public function create($commande_id)
    // {
    //     $commande = Commande::findOrFail($commande_id);
    //     return view('livraison.create', compact('commande'));
    // }


    public function store(Request $request, $commande_id)
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
