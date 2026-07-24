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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('firstname')->nullable();
            $table->string('user_id')->nullable();
            $table->string('email')->unique();
            $table->string('google_id')->nullable()->unique();
            $table->string('provider')->nullable();
            $table->string('join_date')->nullable();
            $table->string('last_login')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('status')->nullable();
            $table->string('avatar')->nullable();
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->string('line_manager')->nullable();
            $table->string('seconde_line_manager')->nullable();

            // Authentication
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
