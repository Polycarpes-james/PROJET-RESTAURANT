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

    public function destroy (Request $request, User $user)
    { 

        dd($request);

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);


        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // return Redirect::to_route('.rettine');
    }
}
