<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogTipoActividades extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'log_tipo_actividades';
    protected $fillable = ['descripcion', 'estado', 'created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
