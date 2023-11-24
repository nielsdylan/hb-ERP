<?php

namespace App\Http\Controllers\Components\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\Accesos;
use App\Models\LogActividades;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AccesosController extends Controller
{
    //
    public function lista() {
        LogActividades::guardar(Auth()->user()->id, 1, 'GESTION DE ACCESOS', null, null, null, 'INGRESO A LA LISTA DE ACCESOS');

        // return $empresas;exit;
        return view('components.configuraciones.accesos.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = Accesos::where('estado',1)->get();
        return DataTables::of($data)
        // ->addColumn('empresa', function ($data) { 
        //     return ($data->empresa ? $data->empresa->razon_social:null);
        // })
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
        // return $request->roles;exit;
        try {
                // $data = User::firstOrNew(['id' => $request->id]);
                $data = Accesos::firstOrNew(['id' => $request->id]);
                $data->descripcion        = $request->descripcion;

                if ((int) $request->id == 0) {
                    $data->fecha_registro       = date('Y-m-d H:i:s');
                    $data->created_at           = date('Y-m-d H:i:s');
                    $data->created_id           = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN NUEVO ACCESO', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO ACCESO ');
                }else{
                    $data_old=Accesos::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN ACCESO', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN ACCESO');
                }

                
                                
            $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
        } catch (Exception $ex) {
            $respuesta = array("titulo"=>"Error","mensaje"=>"Hubo un problema al registrar. Por favor intente de nuevo, si persiste comunicarse con su area de TI","tipo"=>"error","ex"=>$ex);
        }
        return response()->json($respuesta,200);
    }
    function editar($id) {
        $data = Accesos::find($id);
        LogActividades::guardar(Auth()->user()->id, 6, 'FORMULARIO DE ACCESO', $data->getTable(), $data, NULL, 'SELECCIONO UN ACCESO PARA MODIFICARLO');
        return response()->json([
            "success"=>true,
            "data"=>$data,

        ],200);
    }
    function eliminar($id) {
        $data = Accesos::find($id);
        $data->deleted_id   = Auth()->user()->id;
        $data->save();
        $data->delete();


        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UN ACCESO', $data->getTable(), $data, NULL, 'ELIMINO UN ACCESO DE LA LISTA DE GESTION DE ACCESO');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }
}
