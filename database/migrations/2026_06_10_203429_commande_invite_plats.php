<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commande_invite_plats', function (Blueprint $table) {
            $table->id();
            $table->uuid('commande_invite_id');
            $table->foreignId('plat_id')->constrained()->onDelete('cascade');
            $table->string('plat_name');
            $table->integer('quantite');
            $table->decimal('prix_total', 10, 2);
            $table->decimal('prix_unitaire', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_invite_plats');
    }
};
