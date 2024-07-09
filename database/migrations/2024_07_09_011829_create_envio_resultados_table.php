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
        Schema::create('envio_resultado', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('estado_envio');
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('resultado_id')->constrained('resultado');
            $table->foreignId('ubicacion_id')->nullable()->constrained('ubicacion');
            $table->foreignId('repartidor_id')->nullable()->constrained('repartidor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envio_resultado');
    }
};
