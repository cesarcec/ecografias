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
        Schema::create('resultado', function (Blueprint $table) {
            $table->id();
            $table->string('informe', 2048);
            $table->string('conclusion', 2048);
            $table->string('recomendacion', 2048);
            $table->timestamp('fecha')->nullable();
            $table->string('imagen_1', 2048)->nullable();
            $table->string('imagen_2', 2048)->nullable();
            $table->string('imagen_3', 2048)->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('examen_id')->constrained('examen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultado');
    }
};
