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
        Schema::create('multimedia_publications', function (Blueprint $table) {
            $table->id();
            $table->string('multimedia_link', 191); // Limitar a 191 caracteres
            $table->text('description')->nullable(); // Usar text para descripciones más largas y permitir nulo
            $table->unsignedBigInteger('publication_id');
            $table->timestamps();

            // Agregar índice para la clave foránea
            $table->index('publication_id');

            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia_publications');
    }
};