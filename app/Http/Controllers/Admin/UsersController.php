<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index () {
        
        return view('admin.users.index', [
            'users' => User::all()
        ]);
    }

    public function destroy(User $user)
    {
        if(auth()->user()->role !== 'super_admin'){
            return response()->json([
                'success' => false,
                'message' => "Cette action est reservée au super Administrateur"
            ], 403);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur supprimé avec succès'
        ]);
    }
}
