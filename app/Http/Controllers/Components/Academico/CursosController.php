<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Cursos;
use App\Models\LogActividades;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CursosController extends Controller
{
    //
    public function lista() {
        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE TIPOS DE DOCUMENTOS', null, null, null, 'INGRESO A LA LISTA DE TIPOS DE DOCUMENTOS');
        return view('components.academico.cursos.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = Cursos::all();
        return DataTables::of($data)
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
                $data = Cursos::firstOrNew(['id' => $request->id]);
                $data->descripcion      = $request->descripcion;

                if ((int) $request->id == 0) {
                    $data->fecha_registro       = date('Y-m-d H:i:s');
                    $data->created_at           = date('Y-m-d H:i:s');
                    $data->created_id           = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO DE UN TIPO DE DOCUMENTO', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO TIPO DE DOCUMENTO');
                }else{
                    $data_old=Cursos::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN TIPO DE DOCUMENTO', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN TIPO DE DOCUMENTO');
                }
                

                    
                
            $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
        } catch (Exception $ex) {
            $respuesta = array("titulo"=>"Error","mensaje"=>"Hubo un problema al registrar. Por favor intente de nuevo, si persiste comunicarse con su area de TI","tipo"=>"error","ex"=>$ex);
        }
        return response()->json($respuesta,200);
    }
    function editar($id) {
        $data = Cursos::find($id);
        LogActividades::guardar(Auth()->user()->id, 6, 'FORMULARIO DE TIPO DE DOCUMENTO', $data->getTable(), $data, NULL, 'SELECCIONO UN TIPO DE DOCUMENTO PARA MODIFICARLO');
        return response()->json($data,200);
    }
    function eliminar($id) {
        $data = Cursos::find($id);
        $data->deleted_id   = Auth()->user()->id;
        $data->save();
        $data->delete();
        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UN TIPO DE DOCUMENTO', $data->getTable(), $data, NULL, 'ELIMINO UN TIPO DE DOCUMENTO DE LA LISTA DE GESTION DE TIPOS DE DOCUMENTOS');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }
}
