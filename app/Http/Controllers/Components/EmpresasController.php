<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use App\Models\Empresas;
use App\Models\LogActividades;
use App\Models\UsuariosAccesos;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmpresasController extends Controller
{
    //
    public function lista() {
        $array_accesos = array();
        $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
        foreach ($usuario_accesos as $key => $value) {
            array_push($array_accesos,$value->acceso_id);
        }
        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE EMPRESAS', null, null, null, 'INGRESO A LA LISTA DE EMPRESAS');
        return view('components.empresas.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = Empresas::where('estado',1)->get();
        return DataTables::of($data)
        ->addColumn('accion', function ($data) { 
            $array_accesos = array();
            $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
            foreach ($usuario_accesos as $key => $value) {
                array_push($array_accesos,$value->acceso_id);
            }
            return
            '<div class="btn-list">
                '.(in_array(24,$array_accesos)?'<button type="button" class="editar protip btn text-warning btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar" >
                    <i class="fe fe-edit fs-14"></i>
                </button>':'').'
                '.(in_array(25,$array_accesos)?'<button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>':'').'
                
            </div>';
        })->rawColumns(['accion'])->make(true);
    }
    public function guardar(Request $request) {

        try {
                $data = Empresas::firstOrNew(['id' => $request->id]);
                $data->tipo_documento_id    = 1;
                $data->ruc                  = $request->ruc;
                $data->razon_social         = $request->razon_social;
                $data->direccion            = $request->direccion;
                $data->email                = $request->email;
                $data->celular              = $request->celular;

                if ((int) $request->id == 0) {
                    $data->fecha_registro       = date('Y-m-d H:i:s');
                    $data->created_at           = date('Y-m-d H:i:s');
                    $data->created_id           = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UNA EMPRESA', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO EMPRESA EN EL FORMULARIO ');
                }else{
                    $data_old=Empresas::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UNA EMPRESA', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UNA EMPRESA');
                }
                

                    
                
            $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
        } catch (Exception $ex) {
            $respuesta = array("titulo"=>"Error","mensaje"=>"Hubo un problema al registrar. Por favor intente de nuevo, si persiste comunicarse con su area de TI","tipo"=>"error","ex"=>$ex);
        }
        return response()->json($respuesta,200);
    }
    function editar($id) {
        $data = Empresas::find($id);
        LogActividades::guardar(Auth()->user()->id, 6, 'FORMULARIO EMPRESA', $data->getTable(), $data, NULL, 'SELECCIONO UNA EMPRESA PARA MODIFICARLO');
        return response()->json($data,200);
    }
    function eliminar($id) {
        $data = Empresas::find($id);
        $data->deleted_id   = Auth()->user()->id;
        $data->save();
        $data->delete();
        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UNA EMPRESA', $data->getTable(), $data, NULL, 'ELIMINO UN REGISTRO DE LA LISTA DE EMPRESAS');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }
    public function buscar(Request $request) {
        if ((int)$request->id == 0) {
            $data = Empresas::where('ruc','=',$request->ruc)->first();
            if ($data) {
                return response()->json(["success"=>true,"data"=>$data],200);
            }
            return response()->json(["success"=>false],200);
        }
        return response()->json(["success"=>false],200);
    }
}
