<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    function index () {
        return view('admin.avis.index', [
            'avis' =>  Avis::all()
        ]);
    }
}
