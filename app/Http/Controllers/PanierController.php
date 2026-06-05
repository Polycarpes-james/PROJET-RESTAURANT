<?php

namespace App\Http\Controllers;

header('Content-Type: application/json; charset=utf-8');

use App\Models\Category;
use App\Models\Plat;
use App\Models\Panier;
use App\Models\Commande;
use App\Models\PanierPlat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{

    
    public function sessionInvite (Request $request) {

        $request->validate([
            'session_element' => 'required|string'
        ]);

        return response()->json(['success' => true, 'session' => session()->put('invite_session', $request->session_element),'message' => "Vous pouvez passez vos commandes en tant qu'invité"]);
    }

    public function ajouterAuPanierInvite(Request $request)
    {

        $request->validate([
            'plat_id' => 'required|exists:plats,id',
            'quantite' => 'required|integer|max:100',
            'state' => 'nullable|boolean'
        ]);

        $panier = session()->get('panier_invite');

        $plat = Plat::findOrFail($request->plat_id);

        $platsInCard = session()->get('platsInCard', []);  
        // Vérifier si le plat est déjà dans le panier
        if(isset($panier[$plat->id])) {
            $quantiteAjoutee = $request->quantite;
            $nouvelleQuantite = $panier[$plat->id]['quantite'] + $quantiteAjoutee;
            
            $panier[$plat->id]['quantite'] = $request->state ? $quantiteAjoutee : $nouvelleQuantite;
            $panier[$plat->id]['prix_total'] = ($request->state ? $quantiteAjoutee : $nouvelleQuantite) * $panier[$plat->id]['price'];
            return response()->json(['success' => true, 'platTotal' => $panier[$plat->id]['quantite'],  'total' => array_sum(array_column($panier, 'quantite')), 'message' => 'Le plat ' . "'$plat->name'" . ' a été augmentée dans le panier !']);
        } else {
            $panier[$plat->id] = [
                'plat_id' => $plat->id,
                'name' => $plat->name,
                'quantite' => $request->quantite,
                'price' => $plat->price,
                'category_id' => $plat->category->id,
                'prix_total' => $plat->price * $request->quantite,
                'description' => $plat->truncateText($plat->description, 75),
                'picture' => $plat->getPicture()->getPictureUrl(160, 140),
                'link_view' => route('rettine.plats.show', ['plat' => $plat, 'slug' => $plat->getSlug()]),
            ];
        }

        if (!in_array($plat->getSlug(), $platsInCard)) {
            $platsInCard[] = $plat->getSlug();
            session()->put('platsInCard', $platsInCard); 
        }


        session()->put('panier_invite', $panier);

        return response()->json([
            'success' => true,
            'message' => "Le plat " . $plat->name . ' a été ajouté dans le panier !',
            'panier' => $panier,
            'total' => array_sum(array_column($panier, 'quantite')),
            'platTotal' => $panier[$plat->id]['quantite'],
        ]);
    }

    /**
     * La fonction "getPanierInvite" permet d'afficher le panier d'un invité
     */
    public function getPanierInvite()
    {
        
        $panier = session()->get('panier_invite') ?? [];

        $session_invite = session()->get('invite_session');
        
        $categoriesData = [];

        $categories = Category::all();
                                                                                                            
        foreach ($categories as $cate) {
            
            $platsCategorie = array_filter($panier ?? [], function ($plat) use ($cate) {
                return $plat['category_id'] == $cate->id;
            });

            $categoriesData[] = [
                'category'      => $cate,
                'plats'         => $platsCategorie,
                'totalQuantite' => array_sum(array_column($platsCategorie, 'quantite')),
                'totalPrix'     => array_sum(array_column($platsCategorie, 'prix_total')),
                'nombreDifferents' => count($platsCategorie),
            ];
        }            
                                  
        return view('panier.index', [
            'categories' => $categoriesData,
            'panier' => $panier,
            'panier_condition' => array_sum(array_column($panier, 'prix_total')),
            'plats' => $panier ? array_values($panier) : [],
            'totalPrice' => $panier ? array_sum(array_column($panier, 'prix_total')) : 0, 
            'total' => $panier ? array_sum(array_column($panier, 'quantite')) : 0, 
            'session' => $session_invite
        ]);
    }
    
    public function voirPanier()
    {
        $session_invite = session()->get('invite_session');
        
        if (!auth()->check()) {
            return response()->json([
                'error' => 'connect',
                'message' => 'Veuillez vous connecter ou continuer en tant qu’invité.',
                'session' => $session_invite                
            ], 403);
        }
    
        $panier = Panier::where('user_id', Auth::id())->first();


        if (!$panier) {
            return view('panier.index', [
                'plats' => [],
                'total' => 0,
                'categories' => [],
                'totalPrice' => 0,
                'panier' => $panier
            ]);
        }

        $panierDetails = $panier->panierPlats()->with('plat')->get();
        $totalPrice = $panierDetails->sum('prix_total');

        // dd($totalPrice);
        $panier->total = $totalPrice;
        $panier->save();
        
        $categoriesData = [];

        $categories = Category::all();

        foreach ($categories as $cate) {

            $platsCategorie = $panier->panierPlats->where('plat.category_id', $cate->id);

            $categoriesData[] = [
                'category' => $cate,
                'plats' => $platsCategorie,
                'totalQuantite' => $platsCategorie->sum('quantite'),
                'totalPrix' => $platsCategorie->sum('prix_total'),
                'nombreDifferents' => $platsCategorie->count(),
            ];
        }
        
        return view('panier.index', [
            'plats' => $panierDetails,
            'categories' => $categoriesData,
            'totalPrice' => $totalPrice, 
            'panier' => $panier,
            'total' => $this->total(),
            'session' => $session_invite,
            'panier_condition' => $panier->total
        ]);
    }
    /**
     * La fonction "ajouterAuPanier" permet d'ajouter un plat au panier (Invité|Abonné)
     */
    public function ajouterAuPanier(Request $request)
    {

        if (!auth()->check()) {
            return response()->json([
                'error' => 'connect',
                'message' => 'Veuillez vous connecter ou continuer en tant qu’invité.',
            ], 403);
        }
        $request->validate([
            'plat_id' => 'required|exists:plats,id',
            'quantite' => 'required|integer|max:100|min:1',
            'state' => 'nullable|boolean'
        ]);

        $user = auth()->user();
        // Récupérer ou créer le panier
        $panier = $user->panier ?? Panier::create(['user_id' => $user->id]);
        $plat = Plat::findOrFail($request->plat_id);

        $quantiteAjoutee = $request->quantite;

        $panierDetails = $panier->panierPlats()->with('plat')->get()->map(function ($item) {
                return [
                    'plat_id' => $item->plat->id,
                    'name' => $item->plat->name,
                    'category_id' => $item->plat->category->id,
                    'description' => $item->plat->truncateText($item->plat->description, 80),
                    'price' => $item->plat->price,
                    'picture' => $item->plat->getPicture()->getPictureUrl(160, 140),
                    'quantite' => $item->quantite,
                    'link_view' => route('rettine.plats.show', ['plat' => $item->plat, 'slug' => $item->plat->getSlug()]),
                    'prix_total' => $item->prix_total
                ];
            });
        // Vérifier si le plat est déjà dans le panier
        $panierPlat = PanierPlat::where('panier_id', $panier->id)->where('plat_id', $plat->id)->first();

        $totalGeneral = null;

        $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();

        if ($panierPlat) {
            $nouvelleQuantite = $panierPlat->quantite + $quantiteAjoutee;
            $panierPlat->update([
                'quantite' => $request->state ? $quantiteAjoutee : $nouvelleQuantite,
                'prix_total' => $plat->price * ($request->state ? $quantiteAjoutee : $nouvelleQuantite)
            ]);
            return response()->json(['success' => true, 'platTotal' => $panierPlat->quantite,'total' => $total_number + 1, 'message' => 'Le plat ' . "'$plat->name'" . ' a été augmentée dans le panier !']);
        } else {
            // Création d'une nouvelle entrée
            if($request->state){
                $panierPlat->update([
                    'quantite' => $quantiteAjoutee,
                    'prix_total' => $plat->price * $quantiteAjoutee
                ]);
            }
            PanierPlat::create([
                'panier_id' => $panier->id,
                'plat_id' => $plat->id,
                'quantite' => $quantiteAjoutee,
                'prix_total' => $plat->price * $quantiteAjoutee
            ]);
        }

        // Préparer le JSON simplifié pour le frontend
      
        $totalGeneral = $panierDetails->sum('prix_total');

        $panier->total = $totalGeneral;
        $panier->save();
        // Calcul du total général

        session()->put("plat", 'is');

        return response()->json([
            'success' => true,
            'message' => "Le plat " . $plat->name . ' a été ajouté dans le panier !',
            'panier' => $panierDetails,
            'total' => $total_number + 1,
            'platTotal' => 1,
            'total_general' => $totalGeneral  
        ]);
    }

    public function total () {
        $total_number = 0;
        if(Auth::user() && Commande::where('user_id', Auth::id()) && Panier::where('user_id', Auth::id())->first()){
            $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();
        } else {
            $panier = session()->get('panier_invite');    
            if($panier){
                $total_number = array_sum(array_column($panier, 'quantite'));
            }
        }

        return $total_number;
    }

    public function voirPanierReflesh () {
        $panierDetails = Panier::where('user_id', Auth::id())->first()->panierPlats()->with('plat')->get()->map(function ($item) {
            return [
                'plat_id' => $item->plat->id,
                'name' => $item->plat->name,
                // 'description' => $item->plat->truncateText($item->plat->description, 75),
                'price' => $item->plat->price,
                'picture' => $item->plat->getPicture()->getPictureUrl(160, 140),
                'quantite' => $item->quantite,
                'link_view' => route('rettine.plats.show', ['plat' => $item->plat->id, 'slug' => $item->plat->getSlug()]),
                'prix_total' => $item->prix_total
            ];
        });
        $totalPrice = $panierDetails->sum('prix_total');
        return response()->json([
            'plats' => $panierDetails,
            'total' => $totalPrice
        ]);
    }

    public function voirPanierRefleshInvite () {
        $panier = session()->get('panier_invite');

        $session_invite = session()->get('invite_session');

        return response()->json([
            'plats' => $panier ? array_values($panier) : [],
            'total' => $panier ? array_sum(array_column($panier, 'prix_total')) : 0, 
            'session' => $session_invite 
        ]);
    }

    public function removeDish(Request $request)
    {
        $request->validate([
            'plat_id' => 'required|exists:plats,id',
        ]);

        $user = auth()->user();
        $panier = $user->panier ?? Panier::create(['user_id' => $user->id]);

        $panierPlat = PanierPlat::where('panier_id', $panier->id)
                                ->where('plat_id', $request->plat_id)
                                ->first();
        
        if ($panierPlat) {
            $panierPlat->delete();

            $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();

            return response()->json(['success' => true, 'total' => $total_number, 'message' => 'le plat a été supprimé du panier']);
        } else {
            return response()->json(['success' => false, 'message' => 'le plat a déjà été supprimé du panier']);
        }
    }

    public function removeDishInvite (Request $request) {
        $request->validate([
            'plat_id' => 'required|exists:plats,id'
        ]);
        
        $panier = session()->get('panier_invite', []);
        
        $platsInCard = session()->get('platsInCard', []);

        if($panier[$request->plat_id]){
            unset($panier[$request->plat_id]);
            session()->put('panier_invite', $panier);
            $totalNumber = array_sum(array_column($panier, 'quantite'));
            return response()->json(['success' => true, 'total' => $totalNumber, 'message' => 'le plat a été supprimé du panier']);
        } else {
            return response()->json(['success' => false, 'message' => 'le plat a déjà été supprimé du panier']);
        }
        
    }   

    // public function removeDishInvite (Request $request)
    // {
    //     $request->validate([
    //         'plat_id' => 'required|exists:plats,id'
    //     ]);

    //     $platId = $request->plat_id;

    //     // Récupération des sessions
    //     $panier = session()->get('panier_invite', []);
    //     $platsInCard = session()->get('platsInCard', []);

    //     // Vérifier si le plat existe dans le panier
    //     if (!isset($panier[$platId])) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Le plat a déjà été supprimé du panier.'
    //         ]);
    //     }

    //     /** ------------------------------
    //      * 1️⃣ SUPPRESSION DU PANIER
    //      * ----------------------------- */
    //     unset($panier[$platId]);
    //     session()->put('panier_invite', $panier);

    //     // Recalcul du nombre total dans le panier   
    //     $totalNumber = array_sum(array_column($panier, 'quantite'));

    //     if (in_array($platId, $platsInCard)) {
    //         // Retirer le plat du tableau
    //         $platsInCard = array_filter($platsInCard, function ($id) use ($platId) {
    //             unset($platId);
    //         });

    //         // Réindexer proprement
    //         $platsInCard = array_values($platsInCard);

    //         session()->put('platsInCard', $platsInCard);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'total' => $totalNumber,
    //         'message' => 'Le plat a été supprimé du panier.'
    //     ]);
    // }

        
    public function modifierQuantite(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'error' => 'connect',
                'message' => 'Veuillez vous connecter ou continuer en tant qu’invité.'
            ], 403);
        }

        $request->validate([
            'plat_id' => 'required|exists:plats,id',
            'delta' => 'required|integer'
        ]);

        $panier = auth()->user()->panier ?? Panier::create(['user_id' => auth()->user()->id]);

        $panierPlat = PanierPlat::where('panier_id', $panier->id)
                                ->where('plat_id', $request->plat_id)
                                ->first();
        if (!$panierPlat) {
            return response()->json(['error' => 'Plat non trouvé dans le panier'], 404);
        }

        $nouvelleQuantite = $panierPlat->quantite + $request->delta;
        $total_number = Panier::where('user_id', Auth::id())->with('panierPlats')->first()->panierPlats->pluck('quantite')->sum();

        if ($nouvelleQuantite <= 0) {
            return response()->json(['success' => false]);
        } else {
            $panierPlat->update([
                'quantite' => $nouvelleQuantite,
                'prix_total' => $panierPlat->plat->price * $nouvelleQuantite
            ]);
            return response()->json(['success' => true, 'total' => $total_number + $request->delta, 'message' => $panierPlat->plat->name . ' a été modifié dans le panier']);
        }
    }

    public function modifierQuantiteInvite (Request $request){
    
        $request->validate([
            'plat_id' => 'required|exists:plats,id',
            'delta' => 'required|integer'
        ]);       

        $plat = Plat::findOrFail($request->plat_id);

        $panier = session()->get('panier_invite', []);
        
        if(!isset($panier[$plat->id])){
            return response()->json(['success' => false]);
        } 

        $nouvelleQuantite = $panier[$plat->id]['quantite'] + $request->delta;
        $totalNumber = array_sum(array_column($panier, 'quantite'));

        $panierPlat = $panier[$plat->id];

        if($nouvelleQuantite <= 0){
            return response()->json(['success' => false]);
        } else {
            $panier[$plat->id]['quantite'] = $nouvelleQuantite;
            $panier[$plat->id]['prix_total'] = $panier[$plat->id]['price'] * $nouvelleQuantite;

            session()->put('panier_invite', $panier);
            return response()->json(['success' => true, 'total' => $totalNumber, 'plat' => $panierPlat, 'message' => $panier[$plat->id]['name'] . ' a été modifié dans le panier']);
        }
    }
        
    public function validerPanier()
    {
        $panier = Panier::with('panierPlats')->where('user_id', Auth::id())->firstOrFail();

        if ($panier->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        // Marquer le panier comme validé
        $panier->update(['status' => 'valide']);

        // Calcul du total
        $total = $panier->total;

        // 🔹 Récupérer ou créer UNE seule commande par utilisateur
        $commande = Commande::firstOrCreate(
            ['user_id' => Auth::id()], // uniquement le critère de recherche
            [
                'total_price' => $total,
                'status' => 'en_attente',
            ]
        );

        
        if(!$panier || $panier->plats->isEmpty()){
            return response()->json([
            'error' => 'vide',
            'message' => 'Votre panier est vide, vous ne pouvez pas la valider, veillez passer une commande!',
        ]);
        }

        // 🔹 Si la commande existait déjà → on la met simplement à jour
        if (!$commande->wasRecentlyCreated) {
            $commande->update([
                'total_price' => $total,
                'status' => 'en_attente',
            ]);
        }

        // 🔹 Synchroniser le panier sans doublons
        $commande->paniers()->syncWithoutDetaching([
            $panier->id => [
                'quantite' => $panier->panierPlats->sum('quantite'),
                'price' => $total,
            ],
        ]);

        return response()->json([
            'success' => true,
            'commande' => $commande,
            'panier' => $panier,
        ]);
    }


    public function annulerCommande(Request $request)
    {
        $panier = Panier::where('user_id', Auth::id())
                        ->where('id', $request->id)
                        ->firstOrFail();

        $panier->update(['status' => 'annule']);

        return response()->json(['message' => 'Commande annulée ❌']);
    }

}
