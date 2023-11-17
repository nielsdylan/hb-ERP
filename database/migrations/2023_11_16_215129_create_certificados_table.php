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
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_curso')->nullable();
            $table->string('codigo_curso')->nullable();
            $table->string('curso')->nullable();
            $table->string('tipo_curso')->nullable();
            $table->foreignId('tipo_documento_id')->nullable()->constrained('tipo_documentos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('numero_documento')->nullable();
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('nombres')->nullable();
            $table->string('empresa')->nullable();
            $table->string('cargo')->nullable();
            $table->string('email')->nullable();
            $table->string('supervisor_responsable')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('acronimos')->nullable();
            $table->string('nombre_curso_oficial')->nullable();
            $table->date('fecha_oficial')->nullable();
            $table->string('cod_certificado')->nullable();
            $table->string('descripcion_larga')->nullable();
            $table->string('descripcion_corta')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('duracion')->nullable();
            $table->float('nota', 8, 2)->nullable();
            $table->integer('aprobado')->nullable();
            $table->string('comentario')->nullable();
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
        Schema::dropIfExists('certificados');
    }
};
