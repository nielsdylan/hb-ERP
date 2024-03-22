<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CuestionarioUsuario extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cuestionario_usuario';
    protected $fillable = ['numero_documento', 'apellido_paterno','apellido_materno','nombres', 'cuestionario_id', 'usuario_id', 'persona_id','aula_id', 'aciertos','nota', 'fecha_registro', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


}
