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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('names', 191); // Limitar a 191 caracteres
            $table->string('last_name', 191); // Limitar a 191 caracteres
            $table->date('birthdate');
            $table->string('gender', 10); // Limitar a 10 caracteres (ajustar según sea necesario)
            $table->string('photo', 191); // Limitar a 191 caracteres
            $table->float('qualifications');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};