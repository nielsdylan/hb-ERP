<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Cuestionario;
use App\Models\CuestionarioPregunta;
use App\Models\CuestionarioRespuesta;
use App\Models\Formulario;
use App\Models\FormularioPregunta;
use App\Models\FormularioRespuesta;
use App\Models\LogActividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class CuestionarioController extends Controller
{
    //
    public function lista()
    {
        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE EXAMENES', null, null, null, 'INGRESO A LA LISTA DE EXAMENES');
        return view('components.academico.cuestionario.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = Cuestionario::where('estado',1)->get();
        return DataTables::of($data)
        ->addColumn('accion', function ($data) {
            return
            '<div class="btn-list">
                <button type="button" class="btn btn-sm link protip ver-resultados" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Ver resultados de la encuesta">
                    <i class="fe fe-clipboard fs-14"></i>
                </button>
                <button type="button" class="btn text-info btn-sm link protip generar-link" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Generar link">
                    <i class="fe fe-link fs-14"></i>
                </button>
                <button type="button" class="editar protip btn text-warning btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar" >
                    <i class="fe fe-edit fs-14"></i>
                </button>
                <button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>
            </div>';
        })->rawColumns(['accion'])->make(true);
    }
    public function formulario($id=0)
    {
        $tipo = 'Nuevo Cuestionario';
        $data = array();

        if ( (int) $id > 0 ) {
            $tipo = 'Editar Cuestionario';
            $data = Cuestionario::find($id);
        }
        // return $tipo;
        LogActividades::guardar(Auth()->user()->id, 1, $tipo, null, null, null, 'INGRESO AL FORMULARIO DE CUESTIONARIO');
        return view('components.academico.cuestionario.formulario', get_defined_vars());
    }
    public function guardar(Request $request){

        // return response()->json($request,200);

        $cuestionario = Cuestionario::firstOrNew(['id' => $request->id]);
        $cuestionario->codigo = $request->codigo;
        $cuestionario->titulo = $request->nombre;
        $cuestionario->encuesta = ($request->encuesta?$request->encuesta:0);
        if ((int)$request->id>0) {
            $cuestionario->updated_at   = date('Y-m-d H:i:s');
            $cuestionario->updated_id   = Auth()->user()->id;
        }else{
            $cuestionario->fecha_registro   = date('Y-m-d H:i:s');
            $cuestionario->created_at   = date('Y-m-d H:i:s');
            $cuestionario->created_id   = Auth()->user()->id;
        }
        $cuestionario->save();

        CuestionarioPregunta::where('cuestionario_id',$request->id)->delete();
        if (sizeof($request->cuestionario)>0) {
            foreach ($request->cuestionario as $key_pregunta => $value_pregunta) {
                $pregunta = new CuestionarioPregunta();
                $pregunta->pregunta         = $value_pregunta['pregunta'];
                $pregunta->puntaje          = $value_pregunta['puntaje'];
                $pregunta->fecha_registro   = date('Y-m-d H:i:s');
                $pregunta->cuestionario_id  = $cuestionario->id;
                $pregunta->tipo_pregunta_id = (int) $value_pregunta['tipo_pregunta_id'];
                $pregunta->created_at       = date('Y-m-d H:i:s');
                $pregunta->created_id       = Auth()->user()->id;
                $pregunta->save();

                CuestionarioRespuesta::where('cuestionario_id',$request->id)->where('pregunta_id',$pregunta->id)->delete();
                foreach ($value_pregunta['alternativas'] as $key_alternativas => $value_alternativas) {
                    $respuestas                     = new CuestionarioRespuesta();
                    $respuestas->descripcion        = $value_alternativas;

                    if ( isset($value_pregunta['respuesta']) && sizeof($value_pregunta['respuesta'])>0) {
                        foreach ($value_pregunta['respuesta'] as $key_respuesta => $value_respuesta) {
                            if ($value_respuesta==$key_alternativas) {
                                $respuestas->verdadero  = 1;
                            }
                        }
                    }

                    $respuestas->fecha_registro     = date('Y-m-d H:i:s');
                    $respuestas->pregunta_id        = $pregunta->id;
                    $respuestas->cuestionario_id    = $cuestionario->id;
                    $respuestas->created_at         = date('Y-m-d H:i:s');
                    $respuestas->created_id         = Auth()->user()->id;
                    $respuestas->save();
                }
            }
            return response()->json(array("titulo"=>"Éxito", "mensaje"=>"Se guardo con éxito","tipo"=>"success"),200);
        }else{
            return response()->json(array("titulo"=>"Información", "mensaje"=>"No registro ninguna pregunta para el cuestionario.","tipo"=>"info"),200);
        }

    }
    public function eliminar($id){
        $cuestionario = Cuestionario::find($id);
        $cuestionario->deleted_at   = date('Y-m-d H:i:s');
        $cuestionario->deleted_id   = Auth()->user()->id;
        $cuestionario->save();

        $preguntas = CuestionarioPregunta::where('cuestionario_id', $id)
        ->update(
            [
                'deleted_at' => date('Y-m-d H:i:s'),
                'deleted_id' => Auth()->user()->id
            ]
        );
        $respuestas = CuestionarioRespuesta::where('cuestionario_id', $id)
        ->update(
            [
                'deleted_at' => date('Y-m-d H:i:s'),
                'deleted_id' => Auth()->user()->id
            ]
        );
        return response()->json(["tipo"=>true],200);
    }
    public function obtenerCuestionario($id) {
        $cuestionario   = Cuestionario::find($id);
        $cuestionario->preguntas      = CuestionarioPregunta::where('cuestionario_id',$id)->get();
        foreach ($cuestionario->preguntas as $key => $value) {
            $value->respuestas = CuestionarioRespuesta::where('cuestionario_id',$id)->where('pregunta_id',$value->id)->get();
        }
        return response()->json(["cuestionario"=>$cuestionario],200);
    }
    public function link($id) {

        $data = Hash::make($id)."";
        $data = route('link.cuestionario',["codigo"=>$id]);
        return response()->json(["data"=>$data],200);
    }
    public function resultados($id){
        $cuestionario = Cuestionario::find($id);
        return view('components.academico.cuestionario.resultados', get_defined_vars());
    }
    public function resultadosListar(Request $request){
        $data = Formulario::where('estado',1)->where('cuestionario_id',$request->id)->get();
        return DataTables::of($data)
        ->addColumn('apellidos_nombres', function ($data) {
            return $data->apellido_paterno.' '.$data->apellido_materno.' '.$data->nombres;
        })
        ->addColumn('accion', function ($data) {
            return
            '<div class="btn-list">
                <button type="button" class="btn text-info btn-sm link protip ver" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Ver respuestas.">
                    <i class="fe fe-eye fs-14"></i>
                </button>
            </div>';
        })->rawColumns(['accion'])->make(true);
    }
    public function resultadosVer($id){
        $formulario   = Formulario::find($id);
        $formulario->preguntas      = FormularioPregunta::where('formulario_id',$id)->get();
        foreach ($formulario->preguntas as $key => $value) {
            $value->respuestas = FormularioRespuesta::where('formulario_id',$id)->where('formulario_pregunta_id',$value->id)->get();
        }
        return response()->json(["cuestionario"=>$formulario],200);
    }
}
