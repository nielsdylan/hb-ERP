<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogActividades extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'log_actividades';
    protected $fillable = ['fecha', 'usuario_id', 'log_tipo_actividad_id', 'formulario', 'tabla', 'valor_anterior', 'nuevo_valor', 'comentarios', 'created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
