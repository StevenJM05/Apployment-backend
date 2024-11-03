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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->string('token', 64)->unique();
            $table->string('tokenable_type', 191); // Limitar a 191 caracteres
            $table->unsignedBigInteger('tokenable_id');
            $table->timestamps();
            
             // Crear un índice compuesto con longitudes limitadas
            $table->index(['tokenable_type', 'tokenable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};


