<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Plat;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.menus.index', [
            'menus' => Menu::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.menus.form", [
            'menu' => new Menu(),
            'plats' => Plat::all()
        ]);
    }
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        $menu = Menu::create($request->validated());

        $menu->plats()->sync($request->validated('plats'));

        // dd($menu->plats()->sync($request->validated('plats')));

        return to_route('admin.menu.show', [
            'menu' => $menu
        ])->with('success', "Le menu à bien été crée");
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('admin.menus.show', [
            'menu' => $menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.form', [
            'menu' => $menu,
            'plats' => Plat::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->update($request->validated());
        $menu->plats()->sync($request->validated('plats'));
        return to_route('admin.menu.index')->with('success', 'Le menu '. $menu->name .' à bien été modifié!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return to_route('admin.menu.index')->with('delete', 'Le menu '. $menu->name .' à bien été supprimé');
    }
}
