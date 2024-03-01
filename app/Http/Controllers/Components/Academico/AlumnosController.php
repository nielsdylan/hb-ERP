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
use App\Models\UsuariosAccesos;
use App\Models\UsuariosRoles;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class AlumnosController extends Controller
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

        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE ALUMNOS', null, null, null, 'INGRESO A LA LISTA DE ALUMNOS');
        return view('components.academico.alumnos.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = UsuariosRoles::where('rol_id',2)->where('estado',1)->get();
        return DataTables::of($data)
        ->addColumn('documento', function ($data) {
            $respuesta = $data->usuario->persona->semaforoDocumentacion($data->usuario->persona->id);
            $icono = '<i class="protip fa fa-circle text-'.$respuesta['color'].'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="'.$respuesta['mensaje'].'"></i>';
            return $icono.' '.$data->usuario->persona->nro_documento;
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
        ->addColumn('fecha_caducidad', function ($data) {
            return date("d/m/Y", strtotime($data->usuario->persona->fecha_caducidad_dni)) ;
        })
        ->addColumn('accion', function ($data) {
            $array_accesos = array();
            $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
            foreach ($usuario_accesos as $key => $value) {
                array_push($array_accesos,$value->acceso_id);
            }

            // '.((empty($data->usuario->persona->fecha_caducidad_dni) || empty($data->usuario->persona->path_dni)) ? '<button type="button" class="protip btn text-info btn-sm btn-pulse-info" data-id="'.$data->usuario->persona->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Falta validar su registro de Imagen de Dni/Fecha de caducación" >
            //     <i class="fe fe-alert-triangle fs-14"></i> </button>' : '' ).'
            return
            '<div class="btn-list">
                '.(in_array(7,$array_accesos)?'<button type="button" class="protip btn text-dark btn-sm" data-id="'.$data->usuario->persona->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Ver Perfil" > <i class="fe fe-user fs-14"></i> </button>':'').'



                '.(in_array(3,$array_accesos)?'<button type="button" class="editar protip btn text-warning btn-sm" data-id="'.$data->usuario->persona->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar" >
                    <i class="fe fe-edit fs-14"></i>
                </button>' : '' ).'
                '.(in_array(4,$array_accesos)?'<button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->usuario->persona->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>' : '' ).'

            </div>';
        })->rawColumns(['documento','accion'])->make(true);
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
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO DE PERSONA', $data->getTable(), NULL, $data, 'SE A CREADO UNA PERSONA DEL FORMULARIO DE ALUMNO ');
                }else{
                    $data_old=Personas::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICACION DE PERSONA', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UNA PERSONA DEL FORMULARIO DE ALUMNO ');
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
                        LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN USUARIO', $data->getTable(), NULL, $usuario, 'SE A CREADO UN USUARIO DESDE EL FORMULARIO DE ALUMNO');
                    }else{
                        $usuario_old=User::where('persona_id',$data->id);
                        $usuario->updated_at   = date('Y-m-d H:i:s');
                        $usuario->updated_id   = Auth()->user()->id;
                        $usuario->save();
                        LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN USUARIO', $data->getTable(), $usuario_old, $usuario, 'SE A MODIFICADO UN USUARIO DESDE EL FORMULARIO DE ALUMNOS');
                    }


                // }
                $usuario_rol = UsuariosRoles::firstOrNew(['usuario_id' => $usuario->id,'rol_id'=>2]);

                if ((int) $request->id == 0) {
                    $usuario_rol->usuario_id = $usuario->id;
                    $usuario_rol->rol_id = 2;
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
        } catch (Exception $ex) {
            $respuesta = array("titulo"=>"Error","mensaje"=>"Hubo un problema al registrar. Por favor intente de nuevo, si persiste comunicarse con su area de TI","tipo"=>"error","ex"=>$ex);
        }
        return response()->json($respuesta,200);
    }
    public function formulario(Request $request)
    {
        $id = $request->id;
        $tipo = $request->tipo;
        $persona = array();
        $usuario = array();
        $usuario_rol = array();
        if ((int)$id>0) {
            $persona = Personas::find($id);
            $usuario = User::where('persona_id',$persona->id)->first();
            $usuario_rol = UsuariosRoles::where('usuario_id',$usuario->id)->get();
            LogActividades::guardar(Auth()->user()->id, 6, 'TABLA DE ALUMNO ALUMNO', $persona->getTable(), $persona, NULL, 'SELECCIONO UN ALUMNO PARA MODIFICARLO');
        }
        // return $persona;
        $tipos_documentos = TipoDocumentos::where('estado',1)->get();
        $empresas = Empresas::where('estado',1)->get();
        $array_accesos = array();
        $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
        foreach ($usuario_accesos as $key => $value) {
            array_push($array_accesos,$value->acceso_id);
        }

        // $aula = Aulas::find($id);
        LogActividades::guardar(Auth()->user()->id, 2, 'FORMULARIO DE '.$tipo, null, null, null, 'INGRESO AL FORMULARIO DE ALUMNOS');
        return view('components.academico.alumnos.formulario', get_defined_vars());
    }

    function editar($id) {

        $persona = Personas::find($id);
        $usuario = User::where('persona_id',$persona->id)->first();
        $usuario_rol = UsuariosRoles::where('usuario_id',$usuario->id)->get();
        LogActividades::guardar(Auth()->user()->id, 6, 'TABLA DE ALUMNO ALUMNO', $persona->getTable(), $persona, NULL, 'SELECCIONO UN ALUMNO PARA MODIFICARLO');
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

        $usuario_rol = UsuariosRoles::where('usuario_id',$usuario->id)->where('rol_id',2)->where('estado',1)->first();
        $usuario_rol->deleted_id   = Auth()->user()->id;
        $usuario_rol->estado   = 0;
        $usuario_rol->save();

        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UN ALUMNO', $persona->getTable(), $persona, NULL, 'ELIMINO UN REGISTRO DE LA LISTA DE ALUMNO');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }

    public function buscar(Request $request) {
        $success = false;
        $data = array();
        $usuario = array();

        switch ($request->tipo) {
            case 'documento':
                $data = Personas::where('nro_documento','=',$request->valor)->where('estado',1)->first();
                if ($data) {
                    $usuario = User::where('persona_id',$data->id)->first();
                    $success = true;
                }
            break;

            case 'email':
                $usuario = User::where('email',$request->valor)->where('estado',1)->first();
                if ($usuario) {
                    $data = Personas::find($usuario->persona_id);
                    $success = true;
                }
            break;
        }
        return response()->json(["success"=>$success,"persona"=>$data,"usuario"=>$usuario],200);

    }
    public function modeloImportarAlumnosExport()
    {
        // return json_decode(json_encode(TipoDocumentos::where('estado',1)->pluck('codigo')->toArray()));
        return Excel::download(new ModeloImportarAlumnosExport, 'modelo-importar-alumnos.xlsx');
    }
    public function importarAlumnosExport(Request $request) {


        $importacion_alumnos = Excel::toArray(new ModeloImportarAlumnosExport, request()->file('importar_excel'));
        $importacion_alumnos = $importacion_alumnos[0];
        // return $importacion_alumnos;
        foreach ($importacion_alumnos as $key => $value) {
            if($key!=0){

                $validar = $this->validarCamposAlumnos($value);
                // return $validar;
                if(sizeof($validar)>0){
                    return response()->json(["titulo"=>"Alerta", "mensaje"=>"Se encontro que ".sizeof($validar)." registros no tienen los campos requeridos.","tipo"=>"warning","data"=>$validar, "icono"=>"fe fe-alert-triangle"],200);
                }
                $documento = TipoDocumentos::where('codigo',$value[0])->first();

                $data = Personas::firstOrNew(
                    ['nro_documento' => $value[1]],
                    ['estado' => 1]
                );
                $data->tipo_documento_id        = $documento->id;
                $data->nro_documento            = $value[1];
                $data->apellido_paterno         = $value[2];
                $data->apellido_materno         = $value[3];
                $data->nombres                  = $value[4];
                $data->sexo                     = $value[9];
                $data->nacionalidad             = $value[8];
                $data->cargo                    = $value[7];
                $data->telefono                 = $value[8];
                $data->whatsapp                 = $value[5];

                $data->fecha_cumpleaños         = $this->formatoFechaExcel($value[11]) ;
                $data->fecha_caducidad_dni      = $this->formatoFechaExcel($value[12]);
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
                $empresa = Empresas::where('razon_social',$value[10])->first();
                $usuario = User::firstOrNew(['persona_id' => $data->id]);
                $usuario->nombre_corto      = $data->apellido_paterno.' '.(explode(' ',$data->nombres)[0]);
                $usuario->nro_documento     = $data->nro_documento;
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

                // --- roles
                $usuario_rol = UsuariosRoles::firstOrNew(['usuario_id' => $usuario->id],['rol_id'=>2],['estado'=>1]);
                $usuario_rol->usuario_id = $usuario->id;
                $usuario_rol->rol_id = 2;
                if (!UsuariosRoles::where('usuario_id' , $usuario->id)->where('rol_id',2)->where('estado',1)->first()) {
                    $usuario_rol->created_at = date('Y-m-d H:i:s');
                    $usuario_rol->created_id = Auth()->user()->id;
                    $usuario_rol->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'SE ASIGNO UN ROL AL USUARIO', $data->getTable(), NULL, $usuario_rol, 'SE ASIGNO ROL A UN USUARIO');
                }else{
                    $usuarior_rol_old = UsuariosRoles::where('usuario_id',$usuario->id)->where('rol_id',2)->where('estado',1)->first();
                    $usuario_rol->updated_at   = date('Y-m-d H:i:s');
                    $usuario_rol->updated_id   = Auth()->user()->id;
                    $usuario_rol->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN ROL', $data->getTable(), $usuarior_rol_old, $usuario_rol, 'SE A MODIFICADO UN ROL DEL USUARIO');
                }
            }
        }
        return response()->json(["titulo"=>"Éxito", "mensaje"=>"Se importo con exito la lista de certificados","tipo"=>"success","icono"=>"fe fe-thumbs-up"],200);
    }


    public function formatoFechaExcel($numero){
        return gmdate("Y-m-d", (((int)$numero - 25569) * 86400));
    }

    public function validarCamposAlumnos($data){

        $validado = false;
        $array = array();




        $validado = (!$data[0] ? array_push($array,array(
            "tipos_documentos"      =>$data[0],
            "n_documento"           =>$data[1],
            "Apellido_Paterno"      =>$data[2],
            "Apellido_Materno"      =>$data[3],
            "Nombres"               =>$data[4],
            "Cargo"                 =>$data[7],
            "Sexo"                  =>$data[9],
            "Empresa"               =>$data[10],
            "Fecha_cumpleaños"      =>$data[11],
            "Fecha_Caducación"      =>$data[12],
            "Email"                 =>$data[13],
        )) : false );
        $validado = (!$data[1] ? array_push($array,array(
            "tipos_documentos"      =>$data[0],
            "n_documento"           =>$data[1],
            "Apellido_Paterno"      =>$data[2],
            "Apellido_Materno"      =>$data[3],
            "Nombres"               =>$data[4],
            "Cargo"                 =>$data[7],
            "Sexo"                  =>$data[9],
            "Empresa"               =>$data[10],
            "Fecha_cumpleaños"      =>$this->formatoFechaExcel($data[11]),
            "Fecha_Caducación"      =>$this->formatoFechaExcel($data[12]),
            "Email"                 =>$data[13],
        ))  : false );
        $validado = (!$data[2] ? array_push($array,array(
            "tipos_documentos"      =>$data[0],
            "n_documento"           =>$data[1],
            "Apellido_Paterno"      =>$data[2],
            "Apellido_Materno"      =>$data[3],
            "Nombres"               =>$data[4],
            "Cargo"                 =>$data[7],
            "Sexo"                  =>$data[9],
            "Empresa"               =>$data[10],
            "Fecha_cumpleaños"      =>$this->formatoFechaExcel($data[11]),
            "Fecha_Caducación"      =>$this->formatoFechaExcel($data[12]),
            "Email"                 =>$data[13],
        ))  : false );
        $validado = (!$data[3] ? array_push($array,array(
            "tipos_documentos"      =>$data[0],
            "n_documento"           =>$data[1],
            "Apellido_Paterno"      =>$data[2],
            "Apellido_Materno"      =>$data[3],
            "Nombres"               =>$data[4],
            "Cargo"                 =>$data[7],
            "Sexo"                  =>$data[9],
            "Empresa"               =>$data[10],
            "Fecha_cumpleaños"      =>$this->formatoFechaExcel($data[11]),
            "Fecha_Caducación"      =>$this->formatoFechaExcel($data[12]),
            "Email"                 =>$data[13],
        ))  : false );
        $validado = (!$data[4] ? array_push($array,array(
            "tipos_documentos"      =>$data[0],
            "n_documento"           =>$data[1],
            "Apellido_Paterno"      =>$data[2],
            "Apellido_Materno"      =>$data[3],
            "Nombres"               =>$data[4],
            "Cargo"                 =>$data[7],
            "Sexo"                  =>$data[9],
            "Empresa"               =>$data[10],
            "Fecha_cumpleaños"      =>$this->formatoFechaExcel($data[11]),
            "Fecha_Caducación"      =>$this->formatoFechaExcel($data[12]),
            "Email"                 =>$data[13],
        ))  : false );
        $validado = (!$data[9] ? array_push($array,array(
            "tipos_documentos"      =>$data[0],
            "n_documento"           =>$data[1],
            "Apellido_Paterno"      =>$data[2],
            "Apellido_Materno"      =>$data[3],
            "Nombres"               =>$data[4],
            "Cargo"                 =>$data[7],
            "Sexo"                  =>$data[9],
            "Empresa"               =>$data[10],
            "Fecha_cumpleaños"      =>$this->formatoFechaExcel($data[11]),
            "Fecha_Caducación"      =>$this->formatoFechaExcel($data[12]),
            "Email"                 =>$data[13],
        ))  : false );
        $validado = (!$data[10] ? array_push($array,array(
            "tipos_documentos"      =>$data[0],
            "n_documento"           =>$data[1],
            "Apellido_Paterno"      =>$data[2],
            "Apellido_Materno"      =>$data[3],
            "Nombres"               =>$data[4],
            "Cargo"                 =>$data[7],
            "Sexo"                  =>$data[9],
            "Empresa"               =>$data[10],
            "Fecha_cumpleaños"      =>$this->formatoFechaExcel($data[11]),
            "Fecha_Caducación"      =>$this->formatoFechaExcel($data[12]),
            "Email"                 =>$data[13],
        ))  : false );
        $validado = (!$data[11] ? array_push($array,array(
            "tipos_documentos"      =>$data[0],
            "n_documento"           =>$data[1],
            "Apellido_Paterno"      =>$data[2],
            "Apellido_Materno"      =>$data[3],
            "Nombres"               =>$data[4],
            "Cargo"                 =>$data[7],
            "Sexo"                  =>$data[9],
            "Empresa"               =>$data[10],
            "Fecha_cumpleaños"      =>$this->formatoFechaExcel($data[11]),
            "Fecha_Caducación"      =>$this->formatoFechaExcel($data[12]),
            "Email"                 =>$data[13],
        ))  : false );
        $validado = (!$data[12] ? array_push($array,array(
            "tipos_documentos"      =>$data[0],
            "n_documento"           =>$data[1],
            "Apellido_Paterno"      =>$data[2],
            "Apellido_Materno"      =>$data[3],
            "Nombres"               =>$data[4],
            "Cargo"                 =>$data[7],
            "Sexo"                  =>$data[9],
            "Empresa"               =>$data[10],
            "Fecha_cumpleaños"      =>$this->formatoFechaExcel($data[11]),
            "Fecha_Caducación"      =>$this->formatoFechaExcel($data[12]),
            "Email"                 =>$data[13],
        ))  : false );
        $validado = (!$data[13] ? array_push($array,array(
            "tipos_documentos"      =>$data[0],
            "n_documento"           =>$data[1],
            "Apellido_Paterno"      =>$data[2],
            "Apellido_Materno"      =>$data[3],
            "Nombres"               =>$data[4],
            "Cargo"                 =>$data[7],
            "Sexo"                  =>$data[9],
            "Empresa"               =>$data[10],
            "Fecha_cumpleaños"      =>$this->formatoFechaExcel($data[11]),
            "Fecha_Caducación"      =>$this->formatoFechaExcel($data[12]),
            "Email"                 =>$data[13],
        ))  : false );

        return $array;
    }
}
