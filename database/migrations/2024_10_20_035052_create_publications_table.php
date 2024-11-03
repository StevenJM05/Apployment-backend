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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191); // Limitar a 191 caracteres
            $table->text('description')->nullable(); // Usar text para descripciones más largas y permitir nulo
            $table->string('location', 191)->nullable(); // Limitar a 191 caracteres y permitir nulo
            $table->date('date');
            $table->boolean('status');
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('profession_id');
            $table->timestamps();

            // Agregar índices para las claves foráneas
            $table->index('profile_id');
            $table->index('profession_id');

            $table->foreign('profile_id')->references('id')->on('profile')->onDelete('cascade');
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};