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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            
            // $table->string('');
            $table->string('nombre_corto');
            $table->string('nro_documento')->nullable();
            $table->string('email');
            $table->string('password');
            $table->text('avatar_imagen')->nullable();
            $table->string('avatar_initials');
            $table->foreignId('persona_id')->nullable()->constrained('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('empresa_id')->nullable()->constrained('empresas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('usuarios');
    }
};
