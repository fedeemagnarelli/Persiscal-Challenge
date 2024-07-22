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
        Schema::table('bookings', function (Blueprint $table) {
            //Lo creo con un estado default que sea confirmado, ya que creo que es el estado por defecto al insertar, se podria manejar tambien con otra tabla que adminsitre los estados y tenga todos los estados posibles como: pendiente, rechazado, confirmado, entre otros.
            $table->string('status')->default('confirmed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
