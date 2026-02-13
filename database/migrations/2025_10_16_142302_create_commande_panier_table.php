<?php

use App\Models\Plat;
use App\Models\User;
use App\Models\Panier;
use App\Models\Commande;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commande_panier', function (Blueprint $table) {
            $table->foreignIdFor(Commande::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Panier::class)->constrained()->cascadeOnDelete();
            $table->integer('quantite')->nullable()->default(0);
            $table->decimal('price', 10, 2)->nullable()->default(0);
            $table->primary(['commande_id', 'panier_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_panier');
    }
};
