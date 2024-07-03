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
            $table->string('informe');
            $table->string('conclusion');
            $table->string('recomendacion');
            $table->date('fecha');
            $table->string('imagen_1');
            $table->string('imagen_2');
            $table->string('imagen_3');
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
