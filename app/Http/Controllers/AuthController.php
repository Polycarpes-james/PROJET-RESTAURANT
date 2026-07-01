<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SigninResquest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login ()
    {
        return view('auth.login');
    }
    public function showSigninForm()
    {
        return view('auth.signin');
    }

    public function signin (SigninResquest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect()->route('.rettine')->with('success', 'Compte créé avec succès.');
    }

    

    public function doLogin (LoginRequest $request)
    {
        $credentials = $request->validated();


        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            if (Auth::user()->hasAnyRole() === "admin" || Auth::user()->hasAnyRole() === "super_admin") {
                return redirect()->route('admin.dashboard');
            } 
            
            if (Auth::user()->role === "user") {
                return redirect()->route('.rettine');
            }
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrect'
        ])->onlyInput('email');
    }

    public function logout ()
    {
        Auth::logout();
        return to_route('.rettine')->with('success', 'Vous êtes maintenant deconnecté');
    }
}
