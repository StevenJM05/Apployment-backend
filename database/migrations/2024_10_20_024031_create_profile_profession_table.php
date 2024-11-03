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
        Schema::create('profile_professions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profession_id');
            $table->unsignedBigInteger('profile_id');
            $table->timestamps();

            // Agregar índices para las columnas de claves foráneas
            $table->index('profession_id');
            $table->index('profile_id');

            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profile')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_professions');
    }
};