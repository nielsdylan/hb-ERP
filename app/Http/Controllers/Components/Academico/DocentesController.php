<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Empresas;
use App\Models\LogActividades;
use App\Models\Personas;
use App\Models\TipoDocumentos;
use App\Models\User;
use App\Models\UsuariosAccesos;
use App\Models\UsuariosRoles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class DocentesController extends Controller
{
    //
    public function lista()
    {
        // $moneda = Alum::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $nivel = Nivel::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $tipo_habitacion = TipoHabitacion::where('empresa_id',Auth()->user()->empresa_id)->get();
        $tipos_documentos = TipoDocumentos::where('estado',1)->get();
        $empresas = Empresas::where('estado',1)->get();
        $array_accesos = array();
        $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
        foreach ($usuario_accesos as $key => $value) {
            array_push($array_accesos,$value->acceso_id);
        }
        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE DOCENTES', null, null, null, 'INGRESO A LA LISTA DE DOCENTES');
        return view('components.academico.docentes.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = UsuariosRoles::where('rol_id',3)->where('estado',1)->get();
        return DataTables::of($data)
        ->addColumn('documento', function ($data) {
            return $data->usuario->persona->nro_documento;
        })
        ->addColumn('apellidos_nombres', function ($data) {
            return $data->usuario->persona->apellido_paterno.' '.$data->usuario->persona->apellido_materno.' '.$data->usuario->persona->nombres;
        })
        ->addColumn('email', function ($data) {
            return $data->usuario->email;
        })
        ->addColumn('cargo', function ($data) {
            return $data->usuario->persona->cargo;
        })
        ->addColumn('celular', function ($data) {
            return $data->usuario->persona->telefono;
        })
        ->addColumn('sexo', function ($data) {
            return ($data->usuario->persona->sexo=='M'?'MASCULINO':'FEMENINO');
        })
        ->addColumn('fecha_registro', function ($data) {
            return date("d/m/Y", strtotime($data->usuario->persona->fecha_registro)) ;
        })
        ->addColumn('accion', function ($data) {
            $array_accesos = array();
            $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
            foreach ($usuario_accesos as $key => $value) {
                array_push($array_accesos,$value->acceso_id);
            }
            return
            '<div class="btn-list">
                '.(in_array(10,$array_accesos)?'<button type="button" class="editar protip btn text-warning btn-sm" data-id="'.$data->usuario->persona->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar" >
                    <i class="fe fe-edit fs-14"></i>
                </button>':'').'
                '.(in_array(11,$array_accesos)?'<button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->usuario->persona->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>':'').'

            </div>';
        })->rawColumns(['accion'])->make(true);
    }
    public function guardar(Request $request) {
        // return $request;exit;
        // try {
                $data = Personas::firstOrNew(['id' => $request->id]);
                $data->tipo_documento_id        = $request->tipo_documento_id;
                $data->nro_documento            = $request->nro_documento;
                $data->apellido_paterno         = $request->apellido_paterno;
                $data->apellido_materno         = $request->apellido_materno;
                $data->nombres                  = $request->nombres;
                $data->sexo                     = $request->sexo;
                $data->nacionalidad             = $request->nacionalidad;
                $data->cargo                    = $request->cargo;
                $data->telefono                 = $request->telefono;
                $data->whatsapp                 = $request->whatsapp;

                // if ($request->hasFile('path_dni')) {
                //     $image = $request->file('path_dni');
                //     $name = time().'.'.$image->getClientOriginalExtension();
                //     $destination = 'components/images/alumnos/';
                //     $request->file('path_dni')->move($destination, $name);
                //     $data->path_dni = $destination.$name;
                // }

                // $data->path_dni                 = $request->path_dni;
                // $data->fecha_cumpleaños         = $request->fecha_cumpleaños;
                // $data->fecha_caducidad_dni      = $request->fecha_caducidad_dni;

                if ((int) $request->id == 0) {
                    $data->fecha_registro       = date('Y-m-d H:i:s');
                    $data->created_at           = date('Y-m-d H:i:s');
                    $data->created_id           = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN DOCENTE', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO DOCENTE ');
                }else{
                    $data_old=Personas::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN DOCENTE', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN DOCENTE');
                }

                $usuario = User::firstOrNew(['persona_id' => $data->id]);
                // if ((int) $request->id == 0) {


                    $usuario->nombre_corto      = $request->apellido_paterno.' '.(explode(' ',$request->nombres)[0]);
                    $usuario->nro_documento     = $request->nro_documento;
                    $usuario->email             = $request->email;

                    $usuario->avatar_initials   = substr($request->apellido_paterno, 0, 1).substr(explode(' ',$request->nombres)[0], 0, 1);
                    $usuario->persona_id        = $data->id;
                    $usuario->empresa_id        = $request->empresa_id;
                    if ((int) $request->id == 0) {
                        $usuario->password          = Hash::make($request->nro_documento);
                        $usuario->fecha_registro    = date('Y-m-d H:i:s');
                        $usuario->created_at = date('Y-m-d H:i:s');
                        $usuario->created_id = Auth()->user()->id;
                        $usuario->save();
                        LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN USUARIO', $data->getTable(), NULL, $usuario, 'SE A CREADO UN USUARIO EN EL FORMULARIO DE DOCENTES');
                    }else{
                        $usuario_old=User::where('persona_id',$data->id);
                        $usuario->updated_at   = date('Y-m-d H:i:s');
                        $usuario->updated_id   = Auth()->user()->id;
                        $usuario->save();
                        LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN USUARIO', $data->getTable(), $usuario_old, $usuario, 'SE A MODIFICADO UN USUARIO EN EL FORMULARIO DE DOCENTES');
                    }


                // }

                $usuario_rol = UsuariosRoles::firstOrNew(['usuario_id' => $usuario->id,'rol_id'=>3]);

                if (!UsuariosRoles::where('usuario_id',$usuario->id)->where('rol_id',3)->first()) {
                    $usuario_rol->usuario_id = $usuario->id;
                    $usuario_rol->rol_id = 3;
                    $usuario_rol->created_at = date('Y-m-d H:i:s');
                    $usuario_rol->created_id = Auth()->user()->id;
                    $usuario_rol->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'SE ASIGNO UN ROL AL USUARIO', $data->getTable(), NULL, $usuario_rol, 'SE ASIGNO ROL A UN USUARIO');
                }
                // else{
                //     $usuarior_rol_old = UsuariosRoles::where('usuario_id',$usuario->id)->where('rol_id',2)->first();
                //     $usuario_rol->updated_at   = date('Y-m-d H:i:s');
                //     $usuario_rol->updated_id   = Auth()->user()->id;
                //     $usuario_rol->save();
                //     LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN ROL', $data->getTable(), $usuarior_rol_old, $usuario_rol, 'SE A MODIFICADO UN ROL DEL USUARIO');
                // }


            $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
        // } catch (Exception $ex) {
        //     $respuesta = array("titulo"=>"Error","mensaje"=>"Hubo un problema al registrar. Por favor intente de nuevo, si persiste comunicarse con su area de TI","tipo"=>"error","ex"=>$ex);
        // }
        return response()->json($respuesta,200);
    }
    public function formulario(Request $request){

        $id = $request->id;
        $tipo = $request->tipo;

        $persona = array();
        $usuario = array();

        if ((int) $request->id >0) {
            $persona = Personas::find($id);
            $usuario = User::where('persona_id',$persona->id)->first();
        }

        // $usuario_rol = UsuariosRoles::where('usuario_id',$usuario->id)->get();
        $tipos_documentos = TipoDocumentos::where('estado',1)->get();
        $empresas = Empresas::where('estado',1)->get();
        $array_accesos = array();

        return view('components.academico.docentes.formulario', get_defined_vars());
    }
    function editar($id) {
        $persona = Personas::find($id);
        $usuario = User::where('persona_id',$persona->id)->first();
        $usuario_rol = UsuariosRoles::where('usuario_id',$usuario->id)->get();
        LogActividades::guardar(Auth()->user()->id, 6, 'DOCENTE', $persona->getTable(), $persona, NULL, 'SELECCIONO UN DOCENTE PARA MODIFICARLO');
        return response()->json([
            "success"=>true,
            "usuario_rol"=>$usuario_rol,
            "usuario"=>$usuario,
            "persona"=>$persona

        ],200);
    }
    function eliminar($id) {
        $persona = Personas::find($id);
        $persona->deleted_id   = Auth()->user()->id;
        $persona->estado   = 0;
        $persona->save();

        $usuario = User::where('persona_id',$persona->id)->first();
        $usuario->deleted_id   = Auth()->user()->id;
        $usuario->estado   = 0;
        $usuario->save();

        $usuario_rol = UsuariosRoles::where('usuario_id',$usuario->id)->where('rol_id',3)->where('estado',1)->first();
        $usuario_rol->deleted_id   = Auth()->user()->id;
        $usuario_rol->save();

        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UN DOCENTE', $persona->getTable(), $persona, NULL, 'ELIMINO UN REGISTRO DE LA LISTA DE DOCENTE');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }

    public function buscar(Request $request) {
        if ((int)$request->id == 0) {
            $data = Personas::where('nro_documento','=',$request->nro_documento)->where('estado',1)->first();
            if ($data) {
                $usuario = User::where('persona_id',$data->id)->first();
                return response()->json(["success"=>true,"persona"=>$data,"usuario"=>$usuario],200);
            }
            return response()->json(["success"=>false],200);
        }
        return response()->json(["success"=>false],200);
    }
}
