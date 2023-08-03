<?php

namespace App\Http\Controllers\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\Empresas;
use App\Models\LogActividades;
use App\Models\Personas;
use App\Models\Roles;
use App\Models\TipoDocumentos;
use App\Models\User;
use App\Models\UsuariosRoles;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UsuariosController extends Controller
{
    //
    public function lista() {
        $tipos_documentos = TipoDocumentos::all();
        $empresas = Empresas::all();
        $roles = Roles::all();
        LogActividades::guardar(Auth()->user()->id, 1, 'GESTION DE USUARIOS', null, null, null, 'INGRESO A LA LISTA DE USUARIOS');
        return view('components.configuraciones.usuario.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = User::all();
        return DataTables::of($data)
        ->addColumn('empresa', function ($data) { 
            return $data->empresa->razon_social;
        })
        ->addColumn('accion', function ($data) { return
            '<div class="btn-list">
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

        try {
                $data = User::firstOrNew(['id' => $request->id]);
                $data->descripcion      = $request->descripcion;
                $data->simbolo      = $request->simbolo;

                if ((int) $request->id == 0) {
                    $data->fecha_registro       = date('Y-m-d H:i:s');
                    $data->created_at           = date('Y-m-d H:i:s');
                    $data->created_id           = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO DE UN USUARIO', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO USUARIO');
                }else{
                    $data_old=User::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN USUARIO', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN USUARIO');
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
        $persona->save();
        $persona->delete();

        $usuario = User::where('persona_id',$persona->id)->first();
        $usuario->deleted_id   = Auth()->user()->id;
        $usuario->save();
        $usuario->delete();

        // $usuario_rol = UsuariosRoles::where('usuario_id',$usuario->id)->get();
        // $usuario_rol->deleted_id   = Auth()->user()->id;
        // $usuario_rol->save();
        // $usuario_rol->delete();

        UsuariosRoles::where('usuario_id', $usuario->id)
        ->update(
            [
                'deleted_id' => Auth()->user()->id,
                'updated_id' => Auth()->user()->id,
                'deleted_at' => date('Y-m-d H:i:s')
            ],
        );

        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UN USUARIO', $persona->getTable(), $persona, NULL, 'ELIMINO UN USUARIO DE LA LISTA DE GESTION DE USUARIOS');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }
}
