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
        Schema::create('commande_invites_info', function (Blueprint $table) {
            $table->id();
            $table->uuid('invite_id');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('address');
            $table->string('phone');
            $table->text('instructions')->nullable();
            $table->enum('status', ['en_attente', 'en_preparation', 'livree', 'annulee'])->default('en_attente');
            $table->integer('total_quantite');
            $table->integer('total_prix');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_invites_info');
    }
};
