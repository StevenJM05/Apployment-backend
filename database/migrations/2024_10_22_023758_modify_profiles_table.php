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
        Schema::table('profile', function (Blueprint $table) {
            $table->string('qualifications')->nullable()->change();
            $table->boolean('status')->default(true);
            // Si deseas agregar un índice para la columna status, puedes hacerlo así:
            // $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile', function (Blueprint $table) {
            $table->string('qualifications')->nullable(false)->change();
            $table->dropColumn('status');
        });
    }
};