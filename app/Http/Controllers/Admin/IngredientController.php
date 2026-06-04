<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IngredientRequest;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        return view('admin.ingredients.index', [
            'ingredients' => Ingredient::orderBy('price', 'desc')->paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ingredients.form', [
            'ingredient' => new Ingredient()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IngredientRequest $request)
    {

        $requestvalidated = $request->validate([
            'name' => 'required|string|min:3',
            'price' => 'required|numeric'
        ]);

        $ingredient =  Ingredient::create($requestvalidated);
    
        return to_route('admin.ingredient.index')->with('success', "L'ingredient à bien été crée");
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        return view('admin.ingredients.form', [
            'ingredient' => $ingredient
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        return view('admin.ingredients.form', [
            'ingredient' => $ingredient
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IngredientRequest $request, Ingredient $ingredient)
    {
        $validated = $request->validated();
        $ingredient->update($validated);
        return to_route('admin.ingredient.index')->with('success', "L'ingredient ". $ingredient->name .' à été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return to_route('admin.ingredient.index')->with('delete', "L'ingredient ". $ingredient->name .' à été supprimé !');
    }
}
