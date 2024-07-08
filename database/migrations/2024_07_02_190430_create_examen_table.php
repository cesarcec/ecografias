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
        Schema::create('examen', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('observaciones', 2048);
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('orden_examen_id')->constrained('orden_examen');
            $table->foreignId('sala_id')->constrained('sala');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen');
    }
};
