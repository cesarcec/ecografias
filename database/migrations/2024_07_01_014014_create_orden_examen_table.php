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
        Schema::create('orden_examen', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_cita');
            $table->date('fecha_programada');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('estado_orden', 100);
            $table->foreignId('paciente_id')->nullable()->constrained('paciente');
            $table->foreignId('recepcionista_id')->nullable()->constrained('recepcionista');
            $table->foreignId('doctor_id')->nullable()->constrained('doctor');
            $table->foreignId('estudio_id')->nullable()->constrained('estudio');
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_examen');
    }
};
