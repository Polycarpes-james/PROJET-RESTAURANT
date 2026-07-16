<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Plat;

class AvisController extends Controller
{
    public function index () {
        return view('admin.avis.index', [
            'plats' => Plat::all()
        ]);
    }

    public function show (Plat $plat) {

        // $avis = $plat;

        return response()->json(['avis' => $plat]);
    }

    public function destroy (Avis $avi) {
        $avi->delete();
    }
    
}
