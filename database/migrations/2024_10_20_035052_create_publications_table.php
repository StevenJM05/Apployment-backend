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
            $table->string('title');
            $table->string('description');
            $table->string('location');
            $table->date('date');
            $table->boolean('status');
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('profession_id');
            $table->timestamps();

            $table->foreign('profile_id')->references('profile_id')->on('profile')->onDelete('cascade');
            $table->foreign('profession_id')->references('profession_id')->on('professions')->onDelete('cascade');
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
