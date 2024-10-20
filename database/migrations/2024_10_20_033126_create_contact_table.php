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
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->unsignedBigInteger('profile_id');
            $table->timestamps();

            $table->foreign('profile_id')->references('profile_id')->on('profile')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};