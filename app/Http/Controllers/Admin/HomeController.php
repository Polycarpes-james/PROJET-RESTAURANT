<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
      $commandes = Commande::with([
        'paniers.plats'
    ])->get();



    // pour le graphique
    $chartCommandes = $commandes->groupBy(function($commande){

        return $commande->created_at->format('Y-m-d');

    })->map(function($items, $date){


        return [

            'date'=>$date,

            'total'=>$items->sum('total_price'),

            'commandes'=>$items->map(function($commande){


                return [

                    'id'=>$commande->id,

                    'total'=>$commande->total_price,


                    'plats'=>$commande->paniers->flatMap(function($panier){


                        return $panier->plats->map(function($plat) use ($panier){


                            return [

                                'name'=>$plat->name,

                                'description'=>$plat->description,

                                'quantite'=>$panier->pivot->quantite

                            ];


                        });


                    })


                ];


            })


        ];

    })->values();






        $reservations = Reservation::selectRaw('DATE(created_at) as date, SUM(id) as total')->groupBy('date')->orderBy('date')->get();

        return view('admin.index', [
            'commandes' => $chartCommandes,
            'reservations' => $reservations
        ]);
    }
}
