<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificado extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'certificados';
    protected $fillable = [
        'fecha_curso',
        'codigo_curso',
        'curso',
        'tipo_curso',
        'tipo_documento',
        'numero_documento',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'empresa',
        'cargo',
        'email',
        'supervisor_responsable',
        'observaciones',
        'acronimos',
        'nombre_curso_oficial',
        'fecha_oficial',
        'cod_certificado',
        'descripcion_larga',
        'descripcion_corta',
        'fecha_vencimiento',
        'duracion',
        'nota',
        'aprobado',
        'comentario',
        'estado',
        'created_id', 'updated_id', 'deleted_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    static function vigencia($id)
    {
        $certificado = Certificado::find($id);
        if (date("Y-m-d") <= $certificado->fecha_vencimiento) {

            $fecha_actual = date("Y-m-d",strtotime(date("Y-m-d")));
            $estado='Vigente';
            $color = 'success';
            
            if (date("Y-m-d") >= date("Y-m-d",strtotime($certificado->fecha_vencimiento."- 1 month"))) {
                $estado='Perecer';
                $color = 'warning';
            }

            return '<span class="badge rounded-pill bg-'.$color.' badge-sm me-1 mb-1 mt-1 protip" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="'.$estado.'">'.$estado.'</span>';
        }else{
            return '<span class="badge rounded-pill bg-danger badge-sm me-1 mb-1 mt-1 protip" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Vencido">Vencido</span>';
        }
        
    }
}
