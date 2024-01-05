<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cursos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cursos';
    protected $fillable = ['codigo','nombre','descripcion','fecha_registro', 'estado', 'asignatura_id','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function asignatura(): BelongsTo
    {
        return $this->belongsTo(Asignatura::class);
    }
}
