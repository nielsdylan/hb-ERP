<?php

namespace App\Http\Controllers\Components\Academico;

use App\Exports\ModeloImportarAlumnosExport;
use App\Http\Controllers\Controller;
use App\Imports\ImportarAlumnosImport;
use App\Models\Alumnos;
use App\Models\Empresas;
use App\Models\LogActividades;
use App\Models\Personas;
use App\Models\Roles;
use App\Models\TipoDocumentos;
use App\Models\User;
use App\Models\UsuariosRoles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AlumnosController extends Controller
{
    //
    public function lista()
    {
        // $moneda = Alum::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $nivel = Nivel::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $tipo_habitacion = TipoHabitacion::where('empresa_id',Auth()->user()->empresa_id)->get();
        $tipos_documentos = TipoDocumentos::all();
        $empresas = Empresas::all();
        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE ALUMNOS', null, null, null, 'INGRESO A LA LISTA DE ALUMNOS');
        return view('components.academico.alumnos.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = UsuariosRoles::where('rol_id',2)->get();
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
            return $data->usuario->persona->celular;
        })
        ->addColumn('sexo', function ($data) { 
            return ($data->usuario->persona->sexo=='M'?'MASCULINO':'FEMENINO');
        })
        ->addColumn('fecha_caducidad', function ($data) { 
            return $data->usuario->persona->fecha_caducidad_dni;
        })
        ->addColumn('accion', function ($data) { return
            '<div class="btn-list">
                <button type="button" class="editar protip btn text-warning btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar" >
                    <i class="fe fe-edit fs-14"></i>
                </button>
                <button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>
                
            </div>';
        })->rawColumns(['accion'])->make(true);
    }
    public function guardar(Request $request) {

        try {
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

                if ($request->hasFile('path_dni')) {
                    $image = $request->file('path_dni');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destination = 'components/images/alumnos/';
                    $request->file('path_dni')->move($destination, $name);
                    $data->path_dni = $destination.$name;
                }

                // $data->path_dni                 = $request->path_dni;
                $data->fecha_cumpleaños         = $request->fecha_cumpleaños;
                $data->fecha_caducidad_dni      = $request->fecha_caducidad_dni;

                if ((int) $request->id == 0) {
                    $data->fecha_registro       = date('Y-m-d H:i:s');
                    $data->created_at           = date('Y-m-d H:i:s');
                    $data->created_id           = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN ALUMNO', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO ALUMNO ');
                }else{
                    $data_old=Personas::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN ALUMNO', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN ALUMNO');
                }

                if ((int) $request->id == 0) {
                
                    $usuario = User::firstOrNew(['persona_id' => $data->id]);
                    $usuario->nombre_corto      = $request->apellido_paterno.' '.(explode(' ',$request->nombres)[0]);
                    $usuario->email             = $request->email;
                    $usuario->password          = Hash::make($request->nro_documento);
                    $usuario->avatar_initials   = substr($request->apellido_paterno, 0, 1).substr(explode(' ',$request->nombres)[0], 0, 1);
                    $usuario->persona_id        = $data->id;
                    $usuario->empresa_id        = $request->empresa_id;
                    if ((int) $request->id == 0) {
                        $usuario->fecha_registro    = date('Y-m-d H:i:s');
                        $usuario->created_at = date('Y-m-d H:i:s');
                        $usuario->created_id = Auth()->user()->id;
                        $usuario->save();
                        LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN USUARIO', $data->getTable(), NULL, $usuario, 'SE A CREADO UN USUARIO');
                    }else{
                        $usuario_old=User::where('persona_id',$data->id);
                        $usuario->updated_at   = date('Y-m-d H:i:s');
                        $usuario->updated_id   = Auth()->user()->id;
                        $usuario->save();
                        LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN USUARIO', $data->getTable(), $usuario_old, $usuario, 'SE A MODIFICADO UN USUARIO');
                    }

                    $usuario_rol = UsuariosRoles::firstOrNew(['usuario_id' => $usuario->id],['rol_id'=>2]);
                    $usuario_rol->usuario_id = $usuario->id;
                    $usuario_rol->rol_id = 2;
                    if ((int) $request->id == 0) {
                        $usuario_rol->created_at = date('Y-m-d H:i:s');
                        $usuario_rol->created_id = Auth()->user()->id;
                        $usuario_rol->save();
                        LogActividades::guardar(Auth()->user()->id, 3, 'SE ASIGNO UN ROL AL USUARIO', $data->getTable(), NULL, $usuario_rol, 'SE ASIGNO ROL A UN USUARIO');
                    }else{
                        $usuarior_rol_old = UsuariosRoles::where('usuario_id',$usuario->id)->where('rol_id',2)->first();
                        $usuario_rol->updated_at   = date('Y-m-d H:i:s');
                        $usuario_rol->updated_id   = Auth()->user()->id;
                        $usuario_rol->save();
                        LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN ROL', $data->getTable(), $usuarior_rol_old, $usuario_rol, 'SE A MODIFICADO UN ROL DEL USUARIO');
                    }
                }
                    
                
            $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
        } catch (Exception $ex) {
            $respuesta = array("titulo"=>"Error","mensaje"=>"Hubo un problema al registrar. Por favor intente de nuevo, si persiste comunicarse con su area de TI","tipo"=>"error","ex"=>$ex);
        }
        return response()->json($respuesta,200);
    }
    function editar($id) {
        $usuario_rol = UsuariosRoles::find($id);
        $usuario = User::find($usuario_rol->usuario_id);
        $persona = Personas::find($usuario->persona_id);
        LogActividades::guardar(Auth()->user()->id, 6, 'TABLA DE ALUMNO ALUMNO', $persona->getTable(), $persona, NULL, 'SELECCIONO UN ALUMNO PARA MODIFICARLO');
        return response()->json([
            "success"=>true,
            "usuario_rol"=>$usuario_rol,
            "usuario"=>$usuario,
            "persona"=>$persona

        ],200);
    }
    function eliminar($id) {
        $usuario_rol = UsuariosRoles::find($id);
        $usuario_rol->deleted_id   = Auth()->user()->id;
        $usuario_rol->save();
        $usuario_rol->delete();
        $usuario = User::find($usuario_rol->usuario_id);
        $usuario->deleted_id   = Auth()->user()->id;
        $usuario->save();
        $usuario->delete();
        $persona = Personas::find($usuario->persona_id);
        $persona->deleted_id   = Auth()->user()->id;
        $persona->save();
        $persona->delete();
        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UN ALUMNO', $persona->getTable(), $persona, NULL, 'ELIMINO UN REGISTRO DE LA LISTA DE ALUMNO');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }

    public function buscar(Request $request) {
        if ((int)$request->id == 0) {
            $data = Personas::where('nro_documento','=',$request->nro_documento)->first();
            if ($data) {
                return response()->json(["success"=>true,"data"=>$data],200);
            }
            return response()->json(["success"=>false],200);
        }
        return response()->json(["success"=>false],200);
    }
    public function modeloImportarAlumnosExport() 
    {
        return Excel::download(new ModeloImportarAlumnosExport, 'modelo-importar-alumnos.xlsx');
    }
    public function importarAlumnosExport(Request $request) {
        $collection = Excel::toCollection(new ImportarAlumnosImport, $request->file('importar_excel'));
        $array_nulos=array();
        $titulo     = '';
        $mensaje    = '';
        $tipo       = '';
        $success    = true;
        // try {
            foreach ($collection[0] as $key => $value) {
                if ($key!=0 && !empty($value[0]) && !empty($value[1])&& !empty($value[2])&& !empty($value[3])&& !empty($value[4])&& !empty($value[9])&& !empty($value[10])&& !empty($value[11])&& !empty($value[12])&& !empty($value[13])) {

                    $tipo_documento = TipoDocumentos::firstOrNew(['descripcion' => $value[0]]);
                    $tipo_documento->descripcion = $value[0];
                    $tipo_documento->save();

                    $empresa = Empresas::firstOrNew(['razon_social' => $value[10]]);
                    $empresa->razon_social = $value[10];
                    $empresa->tipo_documento_id = 1;
                    // $empresa->fecha_registro = date('Y-m-d H:i:s');
                    $empresa->save();

                    $data = Personas::firstOrNew(['nro_documento' => $value[1]]);
                    $data->tipo_documento_id        = $tipo_documento->id;
                    $data->nro_documento            = $value[1];
                    $data->apellido_paterno         = $value[2];
                    $data->apellido_materno         = $value[3];
                    $data->nombres                  = $value[4];
                    $data->sexo                     = $value[9];
                    $data->nacionalidad             = $value[6];
                    $data->cargo                    = $value[7];
                    $data->telefono                 = $value[8];
                    $data->whatsapp                 = $value[8];

                    $data->fecha_cumpleaños         = date("Y-m-d", strtotime($value[11]));
                    $data->fecha_caducidad_dni      = date("Y-m-d", strtotime($value[12]));

                    if (!Personas::firstOrNew(['nro_documento' => $value[1]])) {
                        $data->fecha_registro       = date('Y-m-d H:i:s');
                        $data->created_at           = date('Y-m-d H:i:s');
                        $data->created_id           = Auth()->user()->id;
                        $data->save();
                        LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN ALUMNO', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO ALUMNO ');
                    }else{
                        $data_old=Personas::firstOrNew(['nro_documento' => $value[1]]);
                        $data->updated_at   = date('Y-m-d H:i:s');
                        $data->updated_id   = Auth()->user()->id;
                        $data->save();
                        LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN ALUMNO', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN ALUMNO');
                    }

                    // registramos como usuario
                    $usuario = User::firstOrNew(['persona_id' => $data->id]);
                    $usuario->nombre_corto      = $data->apellido_paterno.' '.(explode(' ',$data->nombres)[0]);
                    $usuario->email             = $value[13];
                    $usuario->password          = Hash::make($data->nro_documento);
                    $usuario->avatar_initials   = substr($data->apellido_paterno, 0, 1).substr(explode(' ',$data->nombres)[0], 0, 1);
                    $usuario->persona_id        = $data->id;
                    $usuario->empresa_id        = $empresa->id;
                    if (!User::firstOrNew(['persona_id' => $data->id])) {
                        $usuario->fecha_registro    = date('Y-m-d H:i:s');
                        $usuario->created_at = date('Y-m-d H:i:s');
                        $usuario->created_id = Auth()->user()->id;
                        $usuario->save();
                        LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN USUARIO', $data->getTable(), NULL, $usuario, 'SE A CREADO UN USUARIO');
                    }else{
                        $usuario_old=User::where('persona_id',$data->id);
                        $usuario->updated_at   = date('Y-m-d H:i:s');
                        $usuario->updated_id   = Auth()->user()->id;
                        $usuario->save();
                        LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN USUARIO', $data->getTable(), $usuario_old, $usuario, 'SE A MODIFICADO UN USUARIO');
                    }

                    $usuario_rol = UsuariosRoles::firstOrNew(['usuario_id' => $usuario->id],['rol_id'=>2]);
                    $usuario_rol->usuario_id = $usuario->id;
                    $usuario_rol->rol_id = 2;
                    if ((int) $request->id == 0) {
                        $usuario_rol->created_at = date('Y-m-d H:i:s');
                        $usuario_rol->created_id = Auth()->user()->id;
                        $usuario_rol->save();
                        LogActividades::guardar(Auth()->user()->id, 3, 'SE ASIGNO UN ROL AL USUARIO', $data->getTable(), NULL, $usuario_rol, 'SE ASIGNO ROL A UN USUARIO');
                    }else{
                        $usuarior_rol_old = UsuariosRoles::where('usuario_id',$usuario->id)->where('rol_id',2)->first();
                        $usuario_rol->updated_at   = date('Y-m-d H:i:s');
                        $usuario_rol->updated_id   = Auth()->user()->id;
                        $usuario_rol->save();
                        LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN ROL', $data->getTable(), $usuarior_rol_old, $usuario_rol, 'SE A MODIFICADO UN ROL DEL USUARIO');
                    }
                    $titulo     = 'Éxito';
                    $mensaje    = 'Se registro con éxito al alumno';
                    $tipo       = 'success';
                }else{
                    if (!empty($value[0]) || !empty($value[1]) || !empty($value[2]) || !empty($value[3]) || !empty($value[4]) || !empty($value[5]) || !empty($value[6]) || !empty($value[7]) || !empty($value[8]) || !empty($value[9]) || !empty($value[10]) || !empty($value[11]) || !empty($value[12]) || !empty($value[13])) {
                        array_push($array_nulos,(object)$value);
                        $titulo     = 'Warning';
                        $mensaje    = 'Los registro estan incompletos';
                        $tipo       = 'success';
                    }
                    
                    
                }
                
            }
        // } catch (Exception $ex) {
        //     $titulo     = 'Error';
        //     $mensaje    = 'Ocurrio un error al importar el Excel';
        //     $tipo       = 'error';
        // }

        $respuesta = array("titulo"=>$titulo,"mensaje"=>$mensaje,"tipo"=>$tipo,"incompletos"=>$array_nulos);
        return response()->json($respuesta,200);
    }

}
