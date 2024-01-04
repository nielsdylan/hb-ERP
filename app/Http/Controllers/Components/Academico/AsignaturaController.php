<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use App\Models\LogActividades;
use App\Models\UsuariosAccesos;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AsignaturaController extends Controller
{
    //
    public function lista() {
        $array_accesos = array();
        $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
        foreach ($usuario_accesos as $key => $value) {
            array_push($array_accesos,$value->acceso_id);
        }

        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE ASIGNATURAS', null, null, null, 'INGRESO A LA LISTA DE ASIGNATURAS');
        return view('components.academico.asignaturas.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = Asignatura::where('estado',1)->get();
        return DataTables::of($data)
        ->addColumn('accion', function ($data) {
            $array_accesos = array();
            $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
            foreach ($usuario_accesos as $key => $value) {
                array_push($array_accesos,$value->acceso_id);
            }

            return
            '<div class="btn-list">
                '.(in_array(14,$array_accesos)?'<button type="button" class="editar protip btn text-warning btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar" >
                    <i class="fe fe-edit fs-14"></i>
                </button>':'').'
                '.(in_array(15,$array_accesos)?'<button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>':'').'

            </div>';
        })->rawColumns(['accion'])->make(true);
    }
    public function formulario(Request $request){
        $tipo = $request->tipo;
        $id = $request->id;

        $data = array();
        if ( (int)$id > 0 ) {
            $data = Asignatura::find($id);
        }
        return view('components.academico.asignaturas.formulario', get_defined_vars());
    }
    public function guardar(Request $request) {

        try {
                $data = Asignatura::firstOrNew(['id' => $request->id]);
                $data->codigo   = ($request->codigo?$request->codigo:'-');
                $data->nombre   = $request->nombre;

                if ((int) $request->id == 0) {
                    $data->fecha_registro       = date('Y-m-d H:i:s');
                    $data->created_at           = date('Y-m-d H:i:s');
                    $data->created_id           = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO DE ASIGNATURAS', $data->getTable(), NULL, $data, 'SE REGISTRO UNA ASIGNATURA');
                }else{
                    $data_old=Asignatura::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'SE MODIFICO UNA ASIGNATURA', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN TIPO DE DOCUMENTO');
                }
            $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
        } catch (Exception $ex) {
            $respuesta = array("titulo"=>"Error","mensaje"=>"Hubo un problema al registrar. Por favor intente de nuevo, si persiste comunicarse con su area de TI","tipo"=>"error","ex"=>$ex);
        }
        return response()->json($respuesta,200);
    }
    function editar($id) {
        $data = Asignatura::find($id);
        LogActividades::guardar(Auth()->user()->id, 6, 'FORMULARIO DE ASIGNATURA', $data->getTable(), $data, NULL, 'SELECCIONO UNA ASIGNATURA');
        return response()->json($data,200);
    }
    function eliminar($id) {
        $data = Asignatura::find($id);
        $data->deleted_id   = Auth()->user()->id;
        $data->estado   = 0;
        $data->save();
        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UNA ASIGNATURA', $data->getTable(), $data, NULL, 'ELIMINO UNA ASIGNATURA');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }
}
