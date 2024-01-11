<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aulas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'aulas';
    protected $fillable = ['nombre','descripcion','capacidad','fecha','hora_inicio','hora_final','curso_id', 'docente_id', 'asignatura_id','fecha_registro', 'estado', 'abierto','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Cursos::class);
    }
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'docente_id');
    }
}
