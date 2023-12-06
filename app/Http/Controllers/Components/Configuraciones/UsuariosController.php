<?php

namespace App\Http\Controllers\Components\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\Accesos;
use App\Models\Empresas;
use App\Models\LogActividades;
use App\Models\Menus;
use App\Models\Personas;
use App\Models\Roles;
use App\Models\TipoDocumentos;
use App\Models\User;
use App\Models\UsuariosAccesos;
use App\Models\UsuariosRoles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UsuariosController extends Controller
{
    //
    public function lista() {

        LogActividades::guardar(Auth()->user()->id, 1, 'GESTION DE USUARIOS', null, null, null, 'INGRESO A LA LISTA DE USUARIOS');

        // return $empresas;exit;
        return view('components.configuraciones.usuario.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = User::where('estado',1)->get();
        return DataTables::of($data)
        ->addColumn('empresa', function ($data) {
            return ($data->empresa ? $data->empresa->razon_social:null);
        })
        ->addColumn('accion', function ($data) { return
            '<div class="btn-list">
                <button type="button" class="cabiar-clave protip text-info btn btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Cambiar contraseña" >
                    <i class="fa fa-key fs-14"></i>
                </button>
                <button type="button" class="asignar-accesos text-dark protip btn btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Asignar Accesos" >
                    <i class="fe fe-shield fs-14"></i>
                </button>
                <button type="button" class="editar protip btn text-warning btn-sm" data-id="'.$data->persona->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar" >
                    <i class="fe fe-edit fs-14"></i>
                </button>
                <button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->persona->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>

            </div>';
        })->rawColumns(['accion'])->make(true);
    }
    public function guardar(Request $request) {
        // return $request->roles;exit;
        try {
                // $data = User::firstOrNew(['id' => $request->id]);
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
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN PERSONA', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO PERSONA  DE LA LISTA DE USUARIOS');
                }else{
                    $data_old=Personas::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN PERSONA', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN PERSONA DE LA LISTA DE USUARIOS');
                }

                $usuario = User::firstOrNew(['persona_id' => $data->id]);
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
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN USUARIO', $data->getTable(), NULL, $usuario, 'SE A CREADO UN USUARIO DE LA LISTA DE USUARIOS');

                }else{
                    $usuario_old=User::where('persona_id',$data->id);
                    $usuario->updated_at   = date('Y-m-d H:i:s');
                    $usuario->updated_id   = Auth()->user()->id;
                    $usuario->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN USUARIO', $data->getTable(), $usuario_old, $usuario, 'SE A MODIFICADO UN USUARIO DE LA LISTA DE USUARIOS');
                }

                UsuariosRoles::where('usuario_id', $usuario->id)
                ->update(
                    [
                        'estado'    => 0,
                        'deleted_id' => Auth()->user()->id,
                        'updated_id' => Auth()->user()->id,
                        'deleted_at' => date('Y-m-d H:i:s')
                    ],
                );

                foreach ($request->roles as $key => $value) {
                    UsuariosRoles::where('usuario_id',$usuario->id)->where('rol_id',$value)->restore();

                    $usuario_rol = new UsuariosRoles();
                    $usuario_rol->usuario_id    = $usuario->id;
                    $usuario_rol->rol_id        = $value;
                    $usuario_rol->estado        = 1;
                    $usuario_rol->created_at    = date('Y-m-d H:i:s');
                    $usuario_rol->created_id    = Auth()->user()->id;
                    $usuario_rol->save();


                    LogActividades::guardar(Auth()->user()->id, 3, 'SE ASIGNO UN ROL AL USUARIO', $data->getTable(), NULL, $usuario_rol, 'SE ASIGNO ROL A UN USUARIO');
                }


            $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
        } catch (Exception $ex) {
            $respuesta = array("titulo"=>"Error","mensaje"=>"Hubo un problema al registrar. Por favor intente de nuevo, si persiste comunicarse con su area de TI","tipo"=>"error","ex"=>$ex);
        }
        return response()->json($respuesta,200);
    }
    function editar($id) {
        $persona = Personas::find($id);
        $usuario = User::where('persona_id',$persona->id)->first();
        $usuario_rol = UsuariosRoles::where('usuario_id',$usuario->id)->get();
        LogActividades::guardar(Auth()->user()->id, 6, 'FORMULARIO DE USUARIO', $persona->getTable(), $persona, NULL, 'SELECCIONO UN USUARIO PARA MODIFICARLO');
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
        $persona->estado = 0;
        $persona->save();

        $usuario = User::where('persona_id',$persona->id)->first();
        $usuario->deleted_id   = Auth()->user()->id;
        $usuario->estado = 0;
        $usuario->save();

        // $usuario_rol = UsuariosRoles::where('usuario_id',$usuario->id)->get();
        // $usuario_rol->deleted_id   = Auth()->user()->id;
        // $usuario_rol->save();
        // $usuario_rol->delete();

        UsuariosRoles::where('usuario_id', $usuario->id)
        ->update(
            [
                'estado' => 0,
                'deleted_id' => Auth()->user()->id,
                'updated_id' => Auth()->user()->id,
                'deleted_at' => date('Y-m-d H:i:s')
            ],
        );
        UsuariosRoles::where('usuario_id',$usuario->id)->delete();
        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UN PERSONAL', $persona->getTable(), $persona, NULL, 'ELIMINO UN PERSONAL DE LA LISTA DE GESTION DE USUARIOS');

        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UN USUARIO', $usuario->getTable(), $persona, NULL, 'ELIMINO UN USUARIO DE LA LISTA DE GESTION DE USUARIOS');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }

    public function asignarAccesos(Request $request) {

        $usuario = User::find($request->id);
        $menu_padres = Menus::where('padre_id',0)->get();
        LogActividades::guardar(Auth()->user()->id, 1, 'GESTION DE USUARIOS', null, null, null, 'INGRESO A LA LISTA DE USUARIOS');

        // return $empresas;exit;
        return view('components.configuraciones.usuario.asignar-accesos', get_defined_vars());
    }
    public function buscarSubMenu($id) {
        $data = Menus::where('padre_id',$id)->get();
        $success = false;
        if (sizeof($data)>0) {
            $success = true;
        }
        return response()->json(["data"=>$data,"success"=>$success],200);
    }
    public function buscarAccesos($id, $usuario_id) {
        // $menu
        $accesos = Accesos::where('menu_id',$id)->get();
        $usuario_accesos = UsuariosAccesos::where('usuario_id', $usuario_id)->where('menu_id',$id)->get();
        $success = false;


        if (sizeof($accesos)>0) {
            $success = true;
            foreach ($accesos as $key => $item) {
                $item->checked = false;
                foreach ($usuario_accesos as $key => $value) {
                    if ($item->id == $value->acceso_id) {
                        $item->checked = true;
                    }
                }
            }
        }
        // return [$id, $usuario_id];exit;
        return response()->json(["success"=>$success, "data"=>$accesos, "accesos"=>$usuario_accesos],200);
    }
    public function guardarAccesos(Request $request) {

        if ($request->marcado =='true') {
            UsuariosAccesos::where('usuario_id', $request->usuario_id)
            ->where('menu_id', $request->menu_id)
            ->where('acceso_id',$request->acceso_id)
            ->restore();

            $data = UsuariosAccesos::firstOrNew(['usuario_id' => $request->usuario_id,'menu_id' => $request->menu_id,'acceso_id' => $request->acceso_id]);
                $data->usuario_id   = $request->usuario_id;
                $data->acceso_id    = $request->acceso_id;
                $data->menu_id    = $request->menu_id;
                if (UsuariosAccesos::where('usuario_id', $request->usuario_id)
                ->where('menu_id', $request->menu_id)
                ->where('acceso_id',$request->acceso_id)
                ->first()) {
                    $data->deleted_id = null;
                    $data->updated_id = Auth()->user()->id;
                }else{
                    $data->created_at = date('Y-m-d H:i:s');
                    $data->created_id = Auth()->user()->id;

                }
            $data->save();

        }else{
            UsuariosAccesos::where('usuario_id', $request->usuario_id)
            ->where('menu_id', $request->menu_id)
            ->where('acceso_id',$request->acceso_id)
            ->update([
                'deleted_at' =>date('Y-m-d H:i:s'),
                'deleted_id' =>Auth()->user()->id
            ]);
        }


        return response()->json(["data"=>$request],200);
    }
    public function formulario(Request $request){
        $id = $request->id;
        $tipo = $request->tipo;
        $persona = array();
        $usuario = array();
        $roles_id = array();
        if ((int)$id>0) {
            $persona = Personas::find($request->id);
            $usuario = User::where('persona_id',$persona->id)->where('estado',1)->first();
            $usuario_roles = UsuariosRoles::where('usuario_id',$usuario->id)->where('estado',1)->get();
            foreach ($usuario_roles as $key => $value) {
                array_push($roles_id,$value->rol_id);
            }
        }
        // return  $persona;
        $tipos_documentos = TipoDocumentos::where('estado',1)->get();
        $empresas = Empresas::where('estado',1)->get();
        $roles = Roles::where('estado',1)->get();
        return view('components.configuraciones.usuario.formulario', get_defined_vars());
    }
    public function buscarUsuario(Request $request){
        $data = array();
        $mensaje = "";
        switch ($request->tipo) {
            case "documento":
                $data = User::where('nro_documento',$request->valor)->first();
                $mensaje = "número de documento";
            break;

            case "email":
                $data = User::where('email',$request->valor)->first();
                $mensaje = "correo electronico";
            break;
        }

        if ($data || ($data->id == $request->id) ) {
            return response()->json(["titulo"=>"Warning", "mensaje"=>"EL ".$mensaje." se encuentra en uso","tipo"=>"warning"],200);
        }
        return response()->json(["tipo"=>"success"],200);
    }
    public function cambiarContrasena(Request $request){
        if ($request->contrasena == $request->repetir_contrasena) {

            $data = User::find($request->id);
            $data->password = Hash::make($request->contrasena);
            $data->save();
            return response()->json(["titulo"=>"Éxito", "mensaje"=>"Su Contraseña fue cambiada con éxito","tipo"=>"success"],200);
        }
        return response()->json(["titulo"=>"Error", "mensaje"=>"Sus contraseñas no coinciden.","tipo"=>"error"],200);
    }
}
