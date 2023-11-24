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
        Schema::create('grupo_accesos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acceso_id')->nullable()->constrained('accesos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('grupo_id')->nullable()->constrained('grupos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('grupo_accesos');
    }
};
