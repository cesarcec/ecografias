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
        Schema::create('estudio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 250);
            $table->string('descripcion', 500);
            $table->string('requerimientos', 250);
            $table->decimal('precio', 10, 2);
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('tipo_estudio_id')->nullable()->constrained('tipo_estudio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudio');
    }
};
