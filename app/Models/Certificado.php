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
        'tipo_documento_id',
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
            return array("color"=>$color,"texto"=>$estado);
        }else{
            return array("color"=>"danger","texto"=>"Vencido");
        }

    }
    public function documentos(): BelongsTo
    {
        return $this->belongsTo(TipoDocumentos::class, 'tipo_documento_id');
    }
}
