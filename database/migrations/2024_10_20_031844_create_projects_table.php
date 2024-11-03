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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191); // Limitar a 191 caracteres
            $table->string('description', 191); // Limitar a 191 caracteres
            $table->unsignedBigInteger('profile_id');
            $table->timestamps();

            // Agregar índice para la clave foránea
            $table->index('profile_id');

            $table->foreign('profile_id')->references('id')->on('profile')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};