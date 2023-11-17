<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Certificado;
use App\Models\LogActividades;
use App\Models\TipoDocumentos;
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
        ->addColumn('apellidos_nombres', function ($data) {
            return $data->apellido_paterno.' '.$data->apellido_materno.' '.$data->nombres;
        })
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
    public function formulario(Request $request)
    {
        $id = $request->id;
        $tipo = $request->tipo;
        $tipos_documentos = TipoDocumentos::all();
        // $aula = Aulas::find($id);
        LogActividades::guardar(Auth()->user()->id, 2, 'FORMULARIO DE AULA', null, null, null, 'INGRESO AL FORMULARIO DE AULA');
        return view('components.academico.certificado.formulario', get_defined_vars());
    }
    public function guardar(Request $request)
    {
        $data = Certificado::firstOrNew(['id' => $request->id]);
        $data->fecha_curso = $request->fecha_curso;
        $data->codigo_curso = $request->codigo_curso;
        $data->curso = $request->curso;
        $data->tipo_curso = $request->tipo_curso;
        $data->tipo_documento = $request->tipo_documento;
        $data->numero_documento = $request->numero_documento;
        $data->apellido_paterno = $request->apellido_paterno;
        $data->apellido_materno = $request->apellido_materno;
        $data->nombres = $request->nombres;
        $data->empresa = $request->empresa;
        $data->cargo = $request->cargo;
        $data->email = $request->email;
        $data->supervisor_responsable = $request->supervisor_responsable;
        $data->observaciones = $request->observaciones;
        $data->acronimos = $request->acronimos;
        $data->nombre_curso_oficial = $request->nombre_curso_oficial;
        $data->fecha_oficial = $request->fecha_oficial;
        $data->cod_certificado = $request->cod_certificado;
        $data->descripcion_larga = $request->descripcion_larga;
        $data->descripcion_corta = $request->descripcion_corta;
        $data->fecha_vencimiento = $request->fecha_vencimiento;
        $data->duracion = $request->duracion;
        $data->nota = $request->nota;
        $data->aprobado = $request->aprobado;
        $data->comentario = $request->comentario;
        $data->estado = $request->estado;

        if ((int) $request->id == 0) {
            $data->fecha_registro       = date('Y-m-d H:i:s');
            $data->created_at           = date('Y-m-d H:i:s');
            $data->created_id           = Auth()->user()->id;
            $data->save();
            LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN ALUMNO', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO ALUMNO ');
        }else{
            $data_old=Certificado::find($request->id);
            $data->updated_at   = date('Y-m-d H:i:s');
            $data->updated_id   = Auth()->user()->id;
            $data->save();
            LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN ALUMNO', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN ALUMNO');
        }

        return response()->json(["data"=>$request->all()],200);
    }
}
