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
        Schema::create('avis', function (Blueprint $table) {
             $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('plat_id')->constrained()->cascadeOnDelete();
            $table->decimal('note', 2, 1)->check('note >= 0.5 and note <= 5');
            $table->text('commentaire')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'plat_id']); //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
