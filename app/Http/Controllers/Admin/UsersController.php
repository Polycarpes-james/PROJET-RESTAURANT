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
        abort_unless(
            auth()->user()->role === 'super_admin',
            response()->json([
                'message'=>'Vous ne pouvez pas supprimer un utilisateur'
            ],403)
        );


        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur supprimé avec succès'
        ]);
    }
}
