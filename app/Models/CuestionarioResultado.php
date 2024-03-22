<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CuestionarioResultado extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cuestionario_resultado';
    protected $fillable = ['seleccion', 'descripcion','tipo_pregunta_id','cuestionario_id', 'cuestionario_pregunta_id','cuestionario_respuesta_id','cuestionario_usuario_id', 'fecha_registro', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function cuestionarioPregunta(): BelongsTo
    {
        return $this->belongsTo(CuestionarioPregunta::class);
    }
    public function cuestionarioRespuesta(): BelongsTo
    {
        return $this->belongsTo(CuestionarioRespuesta::class);
    }
}
