<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Panier;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index () {
        $commandes = Commande::with(['paniers.plats'])->get();

    // pour le graphique
    $chartCommandes = $commandes->groupBy(function($commande){

        return $commande->created_at->format('Y-m-d');

    })->map(function($items, $date){


        return [

            'date'=>$date,
            'total'=>$items->sum('total_price'),
            'totalCommande' => $items->count(),
            'commandes'=>$items->map(function($commande){
                return [

                    'id'=>$commande->id,
                    'totalPrice'=>$commande->total_price,
                    'quantite_total' => $commande->paniers->first()->panierPlats->pluck('quantite')->sum(),
                    'plats'=>$commande->livraisons->map(function($info, $commande){                    
                        return [
                            'name'=>$info->name,
                            'lastname'=>$info->lastname,
                            'email'=>$info->email,
                            'phone'=>$info->phone,
                            'avatar' => $info->user->is_google_avatar ? $info->user->avatar : image_url($info->user->avatar, 50, 60),
                            'address'=>$info->address,
                            'instructions'=>$info->instructions,
                            'link_commande' => route('admin.commande.show', ['commande' => $info->commande])
                        ];
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
