<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormularioPregunta extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'formulario_preguntas';
    protected $fillable = ['pregunta', 'puntaje', 'fecha_registro','formulario_id', 'tipo_pregunta_id', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
