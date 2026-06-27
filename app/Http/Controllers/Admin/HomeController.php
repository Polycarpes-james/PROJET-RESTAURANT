<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $commandes = Commande::selectRaw('DATE(created_at) as date, SUM(total_price) as total')->groupBy('date')->orderBy('date')->get();
        $reservations = Reservation::selectRaw('DATE(created_at) as date, SUM(id) as total')->groupBy('date')->orderBy('date')->get();
        return view('admin.index', [
            'commandes' => $commandes,
            'reservations' => $reservations
        ]);
    }
}
