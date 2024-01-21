<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormularioRespuesta extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'formulario_respuestas';
    protected $fillable = ['descripcion', 'verdadero', 'seleccion', 'fecha_registro','formulario_pregunta_id', 'formulario_id', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
