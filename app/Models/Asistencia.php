<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asistencia extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'asistencias';
    protected $fillable = ['reserva','aula_id','alumno_id','fecha_registro', 'estado','created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function aula(): BelongsTo
    {
        return $this->belongsTo(Aulas::class);
    }
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }
}
