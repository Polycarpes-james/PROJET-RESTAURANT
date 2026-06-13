<?php

namespace App\Http\Controllers\Admin;

use App\Models\Panier;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommandeInvite;
use App\Models\CommandeInvitePlat;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $commandesGuests = CommandeInvite::all();
        $commandes = Commande::with('user')->latest()->paginate(10);
        
        return view('admin.commandes.index', [
            'commandesGuests' => $commandesGuests,
            'commandes' => $commandes
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        $panier = Panier::with('plats')->where('user_id', $commande->id)->first();

        $panierGuest = CommandeInvitePlat::with('commandeInvite')->where('commande_invite_id', $commande->invite_id)->first();
        
    // dd($commande);

        return view('admin.commandes.show', [
            'commande' => $commande, 
            'panier' => $panier, 
            'panierGuest' => $panierGuest
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        $validated = $request->validate([
            'status' => 'required|in:en_attente,en_preparation,livree,annulee',
        ]);

        $commande->update(['status' => $validated['status']]);
        return redirect()->back()->with('success', 'Statut de la commande mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
