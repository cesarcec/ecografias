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
        Schema::create('tipo_estudio', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre', 250);
            $table->tinyInteger('estado')->default(1); //0 eliminado, 1 activo
            $table->timestamps(); //created_at, update_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_estudio');
    }
};
