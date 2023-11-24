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
        Schema::create('aulas_descripcion', function (Blueprint $table) {
            $table->id();
            $table->boolean('reserva')->default(true);
            $table->foreignId('aula_id')->constrained('aulas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('alumno_id')->constrained('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('fecha_registro')->nullable();
            $table->integer('estado')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_id')->nullable();
            $table->integer('updated_id')->nullable();
            $table->integer('deleted_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulas_descripcion');
    }
};
