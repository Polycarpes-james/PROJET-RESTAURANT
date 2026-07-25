<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Panier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index ()
    {
        // dd(Auth::user());
        $total_number = 0;
        $commande = Commande::where('user_id', Auth::id())->first();
        $user = Auth::user();

        if($user && Panier::where('user_id', Auth::id())->first()){
            $panier = Panier::where('user_id', Auth::id())->with('panierPlats')->first();
            $total_number = $panier->panierPlats->pluck('quantite')->sum();
        }
        
        // dd(Panier::with('plats')->where('user_id', $commande->user_id)->first()->plats);

        $profile = auth()->user()->profileCompletion();
    

        return view('profile.index', [
            'user' => Auth::user(),
            'profile' => $profile,
            'panier' => $panier ?? [],
            'commandes' => Commande::where('user_id', Auth::id())->first(),
            'platsCommande' => $commande ? Panier::with('plats')->where('user_id', $commande->user_id)->first()->plats : [],
            'total' => $total_number
        ]);
    }

    public function updateAvatar (Request $request)
    {
        // dd($request);
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        // Supprimer l’ancien avatar si existe

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
        }   
        // Sauvegarde du nouveau
        $path = $request->file('avatar')->store('avatars/' . $user->id, 'public');
        $user->avatar = $path;

        $user->save();

        return to_route('rettine.profile.index');
   
    }
    /**
     * Display the user's profile form.
     */
    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request):JsonResponse
    {
        // dd($request);
       $data = $request->validate(
        [
            'name' => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'string'],
            'password' => ['nullable', 'min:2', 'confirmed', 'required_with:password_confirmation'],
            'password_confirmation' => ['nullable', 'required_with:password'],
        ],
        [
            'name.required' => 'REQUIRED',
            'firstname.required' => 'REQUIRED',
            'phone_number.required' => 'REQUIRED',
            'email.required' => 'REQUIRED',
            'email.email' => 'INVALID_EMAIL',
            'password.min' => 'PASSWORD_TOO_SHORT',
            'password.confirmed' => 'PASSWORD_CONFIRMATION_FAILED',
            'password.required_with' => 'PASSWORD_REQUIRED',
            'password_confirmation.required_with' => 'PASSWORD_CONFIRMATION_REQUIRED',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $request->user()->update($data);

        return response()->json([
                'success' => true, 
                'user' => $request->user(),
                'message' => 'Vos informations ont été modifiées !'
            ])
        ;
    }

    // /**
    //  * Delete the user's account.
    //  */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
