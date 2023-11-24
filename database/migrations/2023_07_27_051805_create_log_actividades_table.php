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
        Schema::create('log_actividades', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('log_tipo_actividad_id')->constrained('log_tipo_actividades')->onDelete('cascade')->onUpdate('cascade');
            $table->text('formulario');
            $table->text('tabla')->nullable();
            $table->text('valor_anterior')->nullable();
            $table->text('nuevo_valor')->nullable();
            $table->text('comentarios')->nullable();
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
        Schema::dropIfExists('log_actividades');
    }
};
