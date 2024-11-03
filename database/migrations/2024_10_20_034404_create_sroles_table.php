<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Crear la tabla 'roles'
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->timestamps();
        });

        // Asegúrate de que la tabla 'users' ya existe antes de agregar la clave foránea
        Schema::table('users', function (Blueprint $table) {
            // Verificar si la columna 'role_id' ya existe antes de agregarla
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Verificar si la columna 'role_id' existe antes de intentar eliminarla
            if (Schema::hasColumn('users', 'role_id')) {
                // Verificar si la clave foránea existe antes de intentar eliminarla
                $foreignKeys = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'users' AND COLUMN_NAME = 'role_id' AND TABLE_SCHEMA = DATABASE()");
                
                foreach ($foreignKeys as $key) {
                    if ($key->CONSTRAINT_NAME === 'users_role_id_foreign') {
                        $table->dropForeign(['role_id']);
                        break;
                    }
                }

                $table->dropColumn('role_id');
            }
        });

        // Eliminar la tabla 'roles'
        Schema::dropIfExists('roles');
    }
};