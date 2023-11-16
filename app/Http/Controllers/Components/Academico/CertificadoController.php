<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Certificado;
use App\Models\LogActividades;
use App\Models\UsuariosAccesos;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CertificadoController extends Controller
{
    //
    public function lista()
    {
        // $moneda = Alum::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $nivel = Nivel::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $tipo_habitacion = TipoHabitacion::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $tipos_documentos = TipoDocumentos::all();
        // $empresas = Empresas::all();
        // $array_accesos = array();
        // $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
        // foreach ($usuario_accesos as $key => $value) {
        //     array_push($array_accesos,$value->acceso_id);
        // }

        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE CERTIFICADOS', null, null, null, 'INGRESO A LA LISTA DE CERTIFICADOS');
        return view('components.academico.certificado.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = Certificado::all();
        return DataTables::of($data)
        // ->addColumn('documento', function ($data) {
        //     return $data->usuario->persona->nro_documento;
        // })
        // ->addColumn('apellidos_nombres', function ($data) {
        //     return $data->usuario->persona->apellido_paterno.' '.$data->usuario->persona->apellido_materno.' '.$data->usuario->persona->nombres;
        // })
        // ->addColumn('email', function ($data) {
        //     return $data->usuario->email;
        // })
        // ->addColumn('cargo', function ($data) {
        //     return $data->usuario->persona->cargo;
        // })
        // ->addColumn('celular', function ($data) {
        //     return $data->usuario->persona->telefono;
        // })
        // ->addColumn('sexo', function ($data) {
        //     return ($data->usuario->persona->sexo=='M'?'MASCULINO':'FEMENINO');
        // })
        // ->addColumn('fecha_caducidad', function ($data) {
        //     return date("d/m/Y", strtotime($data->usuario->persona->fecha_caducidad_dni)) ;
        // })
        ->addColumn('accion', function ($data) {
            $array_accesos = array();
            $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
            foreach ($usuario_accesos as $key => $value) {
                array_push($array_accesos,$value->acceso_id);
            }
            return
            '<div class="btn-list">

                <button type="button" class="editar protip btn text-warning btn-sm" data-id="'.$data->usuario->persona->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar" >
                    <i class="fe fe-edit fs-14"></i>
                </button>
                <button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->usuario->persona->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>

            </div>';
        })->rawColumns(['accion'])->make(true);
    }
}
