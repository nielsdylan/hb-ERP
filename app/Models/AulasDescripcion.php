<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AulasDescripcion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'aulas_descripcion';
    protected $fillable = ['reserva','aula_id','alumno_id','fecha_registro','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
