<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogActividades extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'log_actividades';
    protected $fillable = ['fecha', 'usuario_id', 'log_tipo_actividad_id', 'formulario', 'tabla', 'valor_anterior', 'nuevo_valor', 'comentarios', 'estado', 'created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public static function guardar($usuario_id, $log_tipo_actividad_id, $formulario, $tabla, $valor_anterior, $nuevo_valor, $comentarios) {
        $actividad = new LogActividades();
        $actividad->fecha = date('Y-m-d H:i:s');
        $actividad->usuario_id = $usuario_id;
        $actividad->log_tipo_actividad_id = $log_tipo_actividad_id;
        $actividad->formulario = $formulario;
        $actividad->tabla = $tabla;
        $actividad->valor_anterior = ($valor_anterior!==null?json_encode($valor_anterior, JSON_PRETTY_PRINT):$valor_anterior);
        $actividad->nuevo_valor = ($nuevo_valor!==null?json_encode($nuevo_valor, JSON_PRETTY_PRINT):$nuevo_valor);
        $actividad->comentarios = $comentarios;
        $actividad->created_id = $usuario_id;
        $actividad->created_at = date('Y-m-d H:i:s');
        $actividad->save();
    }
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function tipoActividades(): BelongsTo
    {
        return $this->belongsTo(LogTipoActividades::class,'log_tipo_actividad_id');
    }
}
