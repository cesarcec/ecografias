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
        Schema::create('repartidor', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('paterno', 50);
            $table->string('materno', 50);
            $table->string('telefono', 50);
            $table->string('licencia_conducir', 250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repartidor');
    }
};
