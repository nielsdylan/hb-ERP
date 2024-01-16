<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CuestionarioPregunta extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cuestionario_preguntas';
    protected $fillable = ['pregunta', 'puntaje', 'fecha_registro','cuestionario_id', 'tipo_pregunta_id', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

}
