<?php

namespace App\Http\Controllers\Admin;

use App\Data\Ingredient\IngredientData;
use App\Data\Plat\PlatData;
use App\Data\Plat\PlatShowData;
use App\Data\Plat\UpdatePlatData;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Menu;
use App\Models\Picture;
use App\Models\Plat;
use App\Services\PlatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlatController extends Controller
{
    public function __construct()
    {
        return $this->authorizeResource(Plat::class, 'plat');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.plats.index', [
            'plats' => Plat::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plats = new Plat();
        return view('admin.plats.form', [
            'plat' => new Plat(), 
            'menu' => null,
            'hidden' => "false",
            'menus' => Menu::all(),
            'store' => 'store',
            'categories' => Category::pluck('name', 'id'),
            'ingredients' => Ingredient::all()
        ]);
    }

    public function createPlatMenu (string $slug, Menu $menu)
    {
        // dd($menu->id);
        return view('admin.plats.form', [
            'plat' => new Plat(),
            'menu' => $menu,
            'menus' => Menu::all(),
            'hidden' => "true",
            'store' => 'store_',
            'categories' => Category::pluck('name', 'id'),
            'ingredients' => Ingredient::all()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdatePlatData $data)
    {
        // Initialisation du plat
        $plat = Plat::create($data->toArray());
        // Synchroniser les ingredients
        $plat->ingredients()->sync($data->ingredients);
        // Sunchroniser les pictures
        if($data->pictures){
            $plat->attachFiles($data->pictures);
        }
        // Synchroniser les menus 
        $plat->menus()->sync($data->menus);
        $plat->save();
        return to_route('admin.plat.index')->with('success', "Le plat " . $plat->name . " à bien été crée");
    }

    public function store_(UpdatePlatData $data, Menu $menu)
    {    
        $plat = Plat::create($data->toArray());
        $plat->ingredients()->sync($data->ingredients);
        $plat->attachFiles($data->pictures);
        $plat->menus()->sync($data->menus);
        $plat->save();
        return to_route('admin.menu.show', ['plat' => $plat])->with('success', "Le plat à bien été crée");
    }

    /**
     * Display the specified resource.
     */
    public function show(Plat $plat, PlatService $platService)
    {
        $platShow = $platService->show($plat);
        return response()->json(['platShow' => $platShow]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plat $plat)
    {
        // dd($plat->pictures()->pluck('id'));
        return view('admin.plats.form', [
            'plat' => $plat,
            'categories' => Category::pluck('name', 'id'),
            'ingredients' => Ingredient::all(), 
            'menu' => null,
            'menus' => Menu::all(),
            'hidden' => "false",
            'store' => 'store'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlatData $data, Request $request, Plat $plat)
    {
        $plat->update($data->toArray());
                // $plat->ingredients()->sync($data->toArray);
        if (!empty($data->pictures)) {
            foreach ($plat->pictures as $picture) {
                $picture->delete();
                if ($picture->filename && Storage::disk('public')->exists($picture->filename)) {
                    Storage::disk('public')->delete($picture->filename);
                }
            }
            $plat->attachFiles($data->pictures);
        }

        $plat->menus()->sync($data->menus);
        $plat->save();

        return to_route('admin.plat.index')->with('success', 'Le Plat '. $plat->name .' a été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plat $plat)
    {
        if(Storage::disk('public')->exists('plats/'.$plat->id)){
            Storage::disk('public')->deleteDirectory('plats/'.$plat->id);
        }
        Picture::destroy($plat->pictures()->pluck('id'));

        $plat->delete();
        return to_route('admin.plat.index')->with('delete', 'Le Plat '. $plat->name .' a été supprimé !');
    }
}
