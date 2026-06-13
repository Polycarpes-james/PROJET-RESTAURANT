<?php

use App\Http\Controllers\Admin\AvisController as AdminAvisController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PlatController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\CommandeController as UserCommandeController;
use App\Http\Controllers\CommandeInviteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\PlatsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/images/{path}', [PictureController::class, 'show'])->where('path', '.*');


Route::middleware('auth')->prefix('rettine')->name('rettine.')->group(function (){

    // Route::post('/commander', [UserCommandeController::class, 'commander'])->name('commander');
    
    Route::post('/panier/ajouter', [PanierController::class, 'ajouterAuPanier'])->name('panier.add');
    Route::get('/panier', [PanierController::class, 'voirPanier'])->name('panier');
    Route::get('/panier/refresh', [PanierController::class, 'voirPanierReflesh']);


    Route::post('/panier/modifier', [PanierController::class, 'modifierQuantite'])->name('panier.modifier');
    Route::post('/panier/supprimer', [PanierController::class, 'removeDish'])->name('panier.supprimer');
    Route::post('/panier/commander', [PanierController::class, 'validerPanier'])->name('panier.commander');

    Route::get('/valider-plats-{panier}', [LivraisonController::class, 'index'])->name('commande_plats.index')->
    where([
        'panier' => '[0-9]+'
    ]);
    
    Route::post('/livraison/{commande}', [LivraisonController::class, 'store'])->name('livraison.store')->
    where([
        'commande' => '[0-9]+'
    ]);
    Route::post('/plats/{plat}/avis', [AvisController::class, 'store'])->name('avis.store')->
     where([
        'plat' => '[0-9]+'
    ]);
    Route::delete('/plats/{plat}/avis', [AvisController::class, 'destroy'])->name('plats.avis.destroy')
    ->
     where([
        'plat' => '[0-9]+'
    ]);

    Route::resource('profile', ProfileController::class);
    
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');

    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');

});

Route::name('guest.')->prefix('guest')->middleware('ensure')->group(function() {
    Route::post('/panier/ajouter', [PanierController::class, 'ajouterAuPanierInvite']);
    Route::post('/panier/supprimer', [PanierController::class, 'removeDishInvite']);
    Route::post('/panier/modifier', [PanierController::class, 'modifierQuantiteInvite']);
    Route::post('/panier/vider', [PanierController::class, 'viderPanier'])->name('panier.vider');

    Route::get('/shopCartUp@/cart-{invite_id}', [PanierController::class, 'getPanierInvite'])->name('panier')->where([
        'invite_id' => '[0-9a-z\-]+'
    ]);
    Route::post('/panier/commander', [PanierController::class, 'validerPanier'])->name('panier.commander');   

    Route::get('/panier/refresh', [PanierController::class, 'voirPanierRefleshInvite']);
    Route::post('/commande', [CommandeInviteController::class, 'commanderInvite'])->name('commande');
    Route::get('/valide-plats-{invite_id}', [LivraisonController::class, 'index'])->name('commande.valider')->where([
        'invite_id' => '[0-9a-z\-]+'
    ]);

    Route::post('/session', [PanierController::class, 'sessionInvite']);
    Route::get('/plats/{plat}', [PlatsController::class, "show_modalInvite"])->where([
        'plat' => '[0-9]+',
    ]);
});



Route::get('/rettine', [HomeController::class, "index"])->name('.rettine');

Route::get('/rettine/commandes', [UserCommandeController::class, "index"])->name('rettine.commandes');

Route::get('/rettine/reservation', [ReservationController::class, 'index'])->name('rettine.reservations');

Route::post('/rettine/reservation/store', [ReservationController::class, 'store'])->name('rettine.reservations.store');

Route::get('/rettine/plats', [PlatsController::class, "plats"])->name('rettine.plats');

Route::get('/rettine/plats/{plat}', [PlatsController::class, "show_modal"])->name('rettine.plat.show.modal')->where([
        'plat' => '[0-9]+',
    ]);;

Route::get('/rettine/plats/{slug}-{plat}', [PlatsController::class, "show"])->name('rettine.plats.show')->where([
        'plat' => '[0-9]+',
        'slug' => '[0-9a-z\-]+'
    ]);

// Route::prefix('rettine')->
// middleware('auth')->
// name('rettine_users')->group(function (){
//     // Route::resource('profile', ProfileController::class);
// });

Route::get('rettine/signin', [AuthController::class, 'showSigninForm'])->name('signin.form');
Route::post('rettine/signin', [AuthController::class, 'signin'])->name('signin');



Route::get('rettine/login', [AuthController::class, 'login'])
->middleware('guest')
->name('login');
Route::post('rettine/login', [AuthController::class, 'doLogin']);
Route::delete('rettine/logout', [AuthController::class, 'logout'])
->middleware('auth')
->name('logout');



Route::
middleware(['auth', 'admin'])->
prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminHomeController::class, 'index'])->name('dashboard');
    Route::resource('plat', PlatController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('reservation', AdminReservationController::class);
    Route::resource('commande', CommandeController::class);
    Route::resource('ingredient', IngredientController::class);
    Route::resource('avis', AdminAvisController::class);

    Route::get('/{slug}-{menu}/plat/create', [PlatController::class, 'createPlatMenu'])->name('menu.plat.create')->
    where([
        'menu' => '[0-9]+',
        'slug' => '[0-9a-z\-]+'
    ]);
    Route::post('menu/{menu}', [PlatController::class, "store_"])->name('plat.store_')->
    where([
        'menu' => '[0-9]+',
        'slug' => '[0-9a-z\-]+'
    ]);
    
});


// Route::prefix('rettine')->
// // middleware('auth')->
// // group(function () {
// //     Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');

// //     Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');
// //     Route::post('/profile/update-photo', [UserController::class, 'updatePhoto'])->name('profile.updatePhoto');
// //     Route::post('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.changePassword');
// //  });