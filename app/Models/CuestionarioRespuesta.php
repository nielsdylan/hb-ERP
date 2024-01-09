<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CuestionarioRespuesta extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cuestionario_respuestas';
    protected $fillable = ['descripcion', 'verdadero', 'fecha_registro','pregunta_id', 'cuestionario_id', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
