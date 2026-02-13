<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Plat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function store(Request $request, Plat $plat)
    {
        $data = $request->validate([
            'note' => 'required|numeric|min:0.5|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();

        $avis = Avis::updateOrCreate(
            ['user_id' => $userId, 'plat_id' => $plat->id],
            ['note' => $data['note'], 'commentaire' => $data['commentaire'] ?? null]
        );

        $moyenne = round($plat->avis()->avg('note'), 2);
        $count = $plat->avis()->count();

        return response()->json([
            'success' => true,
            'avis' => [
                'id' => $avis->id,
                'note' => $avis->note,
                'commentaire' => $avis->commentaire,
            ],
            'moyenne' => $moyenne,
            'nombre' => $count,
            'message' => 'Merci pour votre avis !',
        ]);
    }

}
