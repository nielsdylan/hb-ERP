<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'personas';
    protected $fillable = ['tipo_documento_id','nro_documento','apellido_paterno','apellido_materno','nombres','telefono','whatsapp','path_dni','fecha_cumpleaños','fecha_caducidad_dni', 'fecha_registro', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
