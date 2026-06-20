<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Plat;
use App\Models\Category;
use App\Models\Ingredient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\PlatsRequest;

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
        // dd(Menu::all()->pluck('id'));

        $plats = new Plat();
        // dd($plats->menus);
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
    public function store(PlatsRequest $request)
    {

        // dd($request);
        $validated = $request->validate([
                'name' => 'required|string|min:5',
                'description' => 'required|min:1',
                'temps_preparation' => 'required|integer',
                'price' => 'required|numeric',
                'disponible' => 'required|in:yes,no',
                'raison_indisponible' => 'nullable',
                'category_id' => 'required|exists:categories,id',
                'pictures' => 'array',
                'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        // dd($validated);
    
        $plat = Plat::create($validated);
        
        $plat->ingredients()->sync($request->validated('ingredients'));
        
        if($request->hasFile('pictures')){
            $plat->attachFiles($request->validated('pictures'));
        }

        $plat->menus()->sync($request->validated('menus'));


        // dd($plat->ingredients()->sync($request->validated('ingredients')));

        $plat->save();

        return to_route('admin.plat.index')->with('success', "Le plat à bien été crée");
    }

    public function store_(PlatsRequest $request, Menu $menu)
    {

        $validated = $request->validate([
                'name' => 'required|string|min:5',
                'description' => 'required|min:1',
                'disponible' => 'required|in:yes,no',
                'raison_indisponible' => 'nullable',
                'price' => 'required|numeric',
                'temps_preparation' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
                'pictures' => 'array',
                'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        // dd($validated);
    
        $plat = Plat::create($validated);
        
        $plat->ingredients()->sync($request->validated('ingredients'));
        
        $plat->attachFiles($request->validated('pictures'));

        $plat->menus()->sync($request->validated('menus'));


        // dd($plat->ingredients()->sync($request->validated('ingredients')));
        // dd($plat);
        $plat->save();

        return to_route('admin.menu.show', [
            'menu' => $menu
        ])->with('success', "Le plat à bien été crée");
    }

    /**
     * Display the specified resource.
     */
    public function show(Plat $plat)
    {
        $disponible = null;
        $style_disponible = null;
        $target = $plat->disponible;

        if ($target === "yes") {
            $disponible = "Le plat est disponible";
            $style_disponible = "valide";
        } else {
            $disponible = "Le plat est indisponible";
            $style_disponible = "invalide";
        }
        
        return view('admin.plats.show', [
            'plat' => $plat,
            'disponible' => $disponible,
            'style_disponible' => $style_disponible
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plat $plat)
    {
        // dd($plat->menus->pluck('id'));
        // dd($plat->disponibilite );

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
    public function update(PlatsRequest $request, Plat $plat)
    {
        // dd($request);
        $validated = $request->validate([
                'name' => 'required|string|min:5',
                'temps_preparation' => 'required|integer',
                'description' => 'required|min:1',
                'raison_indisponible' => 'nullable',
                'disponible' => 'required|in:yes,no',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'pictures' => 'array',
                'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        $plat->update($validated);
        
        $plat->ingredients()->sync($request->validated('ingredients'));
        

        if ($request->hasFile('pictures')) {
            foreach ($plat->pictures as $picture) {
                $picture->delete();
                if ($picture->filename && Storage::disk('public')->exists($picture->filename)) {
                    Storage::disk('public')->delete($picture->filename);
                }
            }

            $plat->attachFiles($request->validated('pictures'));

        }   


        $plat->menus()->sync($request->validated('menus'));
        // dd($plat->ingredients()->sync($request->validated('ingredients')));
        // dd($plat);
        $plat->save();

        return to_route('admin.plat.index')->with('success', 'Le Plat '. $plat->name .' a été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plat $plat)
    {
        $plat->delete();
        return to_route('admin.plat.index')->with('delete', 'Le Plat '. $plat->name .' a été supprimé !');
    }
}
