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

    static function semaforoDocumentacion($persona_id)
    {
        $mensaje = "";
        $color = "danger";
        $incompletos = 0;
        $persona = Personas::find($persona_id);
        if (!$persona->fecha_caducidad_dni) {
            $incompletos = $incompletos + 1;
            $mensaje = "No ingreso la fecha de caducidad";
        }
        if (!$persona->path_dni) {
            $mensaje = ($mensaje!=""?$mensaje." ni su imagen de DNI":"No ingreso su imagen de DNI");
            $incompletos = $incompletos + 1;
        }
        $mensaje = $mensaje.'.';

        switch ($incompletos) {
            case 0:
                $mensaje = "Completo";
                $color = "success";
            break;
            case 1:
                $color = "warning";
            break;
            case 2:
                $color = "danger";
            break;
        }
        return array("color"=>$color,"mensaje"=>$mensaje);

    }

}
