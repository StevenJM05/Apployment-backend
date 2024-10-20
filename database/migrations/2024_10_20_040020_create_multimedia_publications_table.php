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
            $table->string('multimedia_link');
            $table->string('description');
            $table->unsignedBigInteger('publication_id');
            $table->timestamps();

            $table->foreign('publication_id')->references('publication_id')->on('publications')->onDelete('cascade');
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
