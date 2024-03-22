<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Aulas;
use App\Models\Cuestionario;
use App\Models\CuestionarioPregunta;
use App\Models\CuestionarioResultado;
use App\Models\CuestionarioUsuario;
use App\Models\Personas;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class MisCursosController extends Controller
{
    //
    public function lista() {

        $aulas = Asistencia::where('alumno_id',Auth::user()->id)->paginate(12);

        return view('components.mis-cursos.lista', get_defined_vars());
    }
    public function curso($codigo) {
        $aula = Aulas::where('codigo',$codigo)->first();
        return view('components.mis-cursos.curso', get_defined_vars());
    }
    public function cuestionario($id, $aula_id){
        $cuestionario = Cuestionario::find($id);
        $aula_id = $aula_id;

        $cuestionario_usuario = CuestionarioUsuario::where('estado',1)
        ->where('usuario_id',Auth::user()->id)
        ->where('cuestionario_id',$id)
        ->where('aula_id',$aula_id)
        ->first();
        $numero_preguntas = CuestionarioPregunta::where('cuestionario_id',$id)->where('estado',1)->count();
        // if($cuestionario_usuario){

        // }

        // return $cuestionario_usuario;
        return view('components.mis-cursos.cuestionario', get_defined_vars());
    }
    public function guardarCuestionario(Request $request) {
        // return $request;
        try {
            $persona = Personas::find(Auth::user()->persona_id);
            $cuestionario = Cuestionario::find($request->cuestionario_id);
            $cuestionario_usuario = CuestionarioUsuario::firstOrNew(['numero_documento' => Auth::user()->nro_documento, 'cuestionario_id'=> $request->cuestionario_id]);
            $cuestionario_usuario->numero_documento = Auth::user()->nro_documento;
            $cuestionario_usuario->apellido_paterno = $persona->apellido_paterno;
            $cuestionario_usuario->apellido_materno = $persona->apellido_materno;
            $cuestionario_usuario->nombres          = $persona->nombres;
            $cuestionario_usuario->cuestionario_id  = $request->cuestionario_id;
            $cuestionario_usuario->usuario_id       = Auth::user()->id;
            $cuestionario_usuario->persona_id       = Auth::user()->persona_id;
            $cuestionario_usuario->aula_id          = $request->aula_id;
            $cuestionario_usuario->fecha_registro   = date('Y-m-d') ;
            $cuestionario_usuario->save();


            CuestionarioResultado::where('estado', 1)
            ->where('cuestionario_usuario_id',$cuestionario_usuario->id)
              ->update(['estado' => 0]);
            CuestionarioResultado::where('cuestionario_usuario_id',$cuestionario_usuario->id)->delete();
            $data = array();
            if (sizeof($request->cuestionario)>0) {
                foreach ($request->cuestionario as $key => $value) {

                    $cuestionario_respuesta_id = 0;
                    $cuestionario_respuesta_text = 0;

                    if (isset($value['respuesta'])) {
                        foreach ($value['respuesta'] as $key_respuesta => $value_respuesta) {

                            $resultados = new CuestionarioResultado();
                            $resultados->seleccion=1;
                            $resultados->descripcion= null;
                            $resultados->tipo_pregunta_id= (int) $value['tipo_pregunta_id'];
                            $resultados->cuestionario_id=$request->cuestionario_id;
                            $resultados->cuestionario_pregunta_id=$key;
                            $resultados->cuestionario_respuesta_id=$value_respuesta;
                            $resultados->cuestionario_usuario_id=$cuestionario_usuario->id;
                            $resultados->save();
                        }
                    }else{

                        $cuestionario_respuesta_id = 0;
                        $cuestionario_respuesta_text = 0;

                        if((int)$value['tipo_pregunta_id'] === 3){
                            foreach ($value['alternativas'] as $key_atr => $value_atr) {
                                $cuestionario_respuesta_id = $key_atr;
                                $cuestionario_respuesta_text = $value_atr;
                            }
                        }
                        $resultados = new CuestionarioResultado();
                        $resultados->seleccion=1;
                        $resultados->descripcion= $cuestionario_respuesta_text;
                        $resultados->tipo_pregunta_id= (int) $value['tipo_pregunta_id'];
                        $resultados->cuestionario_id=$request->cuestionario_id;
                        $resultados->cuestionario_pregunta_id=$key;
                        $resultados->cuestionario_respuesta_id=$cuestionario_respuesta_id;
                        $resultados->cuestionario_usuario_id=$cuestionario_usuario->id;
                        $resultados->save();
                    }
                }
            }
            $resultados = CuestionarioResultado::where('cuestionario_usuario_id', $cuestionario_usuario->id)->where('estado',1)->get();
            // return $resultados;
            $nota = 0;
            $array_preguntas = array();
            foreach ($resultados as $key => $value) {
                $value->cuestionarioPregunta;
                $value->cuestionarioRespuesta;

                if ((int) $value->cuestionarioRespuesta->verdadero == 1 && !array_search($value->cuestionario_pregunta_id, $array_preguntas)) {
                    $nota = (int) $value->cuestionarioPregunta->puntaje + $nota;
                    array_push($array_preguntas,$value->cuestionario_pregunta_id);
                    // return $value->cuestionarioPregunta->puntaje ;
                }
                // return [$value];
            }

            $cuestionario_usuario = CuestionarioUsuario::find($cuestionario_usuario->id);
            $cuestionario_usuario->nota = $nota;
            $cuestionario_usuario->aciertos = sizeof($array_preguntas);
            $cuestionario_usuario->save();

            $numero_preguntas = CuestionarioPregunta::where('cuestionario_id',$cuestionario_usuario->id)->where('estado',1)->count();
            // return [$nota, $array_preguntas, $cuestionario_usuario , $resultados];
            return response()->json([
                "titulo"=>"Éxito.",
                "mensaje"=>"Se envío el cuestionario.",
                "tipo"=>"success",
                "nota"=>$nota,
                "aciertos"=>sizeof($array_preguntas),
                "numero_preguntas"=>$numero_preguntas,
            ],200);
        } catch (\Throwable $th) {
            return response()->json(array("titulo"=>"Warning", "mensaje"=>"Comuniquese con soporte academico","tipo"=>"warning"),200);
        }

        // return response()->json(["data"=>$reques->all()],200);
    }
}
