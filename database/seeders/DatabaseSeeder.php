<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Avis;
use App\Models\Category;
use App\Models\Commande;
use App\Models\Ingredient;
use App\Models\Livraison;
use App\Models\Menu;
use App\Models\Panier;
use App\Models\PanierPlat;
use App\Models\Plat;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
        ]);
        User::factory(30)->create(); 
        $avis = Avis::factory(100)->create();
        Category::factory(10)->create();

        $ingredients = Ingredient::factory(40)->create();

        $plats = Plat::factory(40)->hasAttached($ingredients->random(10), $avis->random(15))->create();
        Menu::factory(10)->hasAttached($plats->random(10))->create();
        Reservation::factory(20)->create();
    }
}
