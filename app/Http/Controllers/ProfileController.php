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
        
        if(Auth::user() && $commande && Panier::where('user_id', Auth::id())->first()){
            $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();
        } else {
            $panier = session()->get('panier_invite');          
            if($panier){
                $total_number = array_sum(array_column($panier, 'quantite'));
            }
        }

        // dd(Panier::with('plats')->where('user_id', $commande->user_id)->first()->plats);

        return view('profile.index', [
            'user' => Auth::user(),
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
        $request->validate([
            'name' => "required|string", 
            'firstname' => "required|string", 
            'email' => "required|email", 
            'password' => "nullable", 
            'passwordconfirm' => "same:password|nullable", 
        ]);

        $request->user()->update([
            'name' => $request->name, 
            'firstname' => $request->firstname, 
            'email' => $request->email, 
            'password' => Hash::make($request->password), 
            'passwordconfirm' => $request->passwordconfirm, 
        ]);

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        $request->user()->save();

        return response()->json([
                'success' => true, 
                'message' => 'Vos informations ont été modifiées !'
            ])
        // to_route('rettine.profile.index')
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
