<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aulas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'aulas';
    protected $fillable = ['nombre','descripcion','capacidad','fecha','hora_inicio','hora_final','curso_id','fecha_registro','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
