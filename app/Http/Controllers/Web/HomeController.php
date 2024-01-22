<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Certificado;
use App\Models\Cuestionario;
use App\Models\CuestionarioPregunta;
use App\Models\CuestionarioRespuesta;
use App\Models\Formulario;
use App\Models\FormularioPregunta;
use App\Models\FormularioRespuesta;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    //
    public function inicio(){
        return view('web.inicio', get_defined_vars());
    }
    public function nosotros(){
        return view('web.nosotros', get_defined_vars());
    }
    public function servicios(){
        return view('web.servicios', get_defined_vars());
    }
    public function contacto(){
        return view('web.contacto', get_defined_vars());
    }
    public function certificado(){
        return view('web.certificado', get_defined_vars());
    }
    public function calendario(){
        return view('web.calendario', get_defined_vars());
    }
    public function buscarCertificado(Request $request){
        $data = Certificado::where('numero_documento', 'like', '%'.$request->dni.'%')->where('estado',1)->get();
        $dataArray = array();
        foreach ($data as $key => $value) {
            $value->vigencia = $value->vigencia($value->id);
            if ($value->vigencia['color'] !='danger') {
                array_push($dataArray, $value);
            }

        }
        if (sizeof($dataArray)>0) {
            return response()->json(["tipo"=>true,"data"=>$dataArray],200);
        }else{
            return response()->json(["tipo"=>false,"data"=>$dataArray],200);
        }

    }
    public function exportarCertificadoPDF($id){
        $instructor = (object)array(
            "name"=>"HELARD JOHN",
            "last_name"=>"BEJARANO OTAZU",
            "description"=>"Gerente General",
            "img_firm"=>"1638456633.png",
            "cip"=>0,
        );

        $certificado = Certificado::where('id',$id)->where('estado',1)->first();

        setlocale(LC_TIME, "spanish"); // cambiamos el idioma de la fecha
        $fecha_oficial = $certificado->fecha_curso;
        $fecha = str_replace("/", "-", $fecha_oficial);
        $newDate = date("d-m-Y", strtotime($fecha));
        $mesDesc = strftime("%d de %B del %Y", strtotime($newDate)); //se obtiene el mes
        // $year = strftime("%Y", strtotime($newDate));
        $cip = '---';

        $descripcion = ($certificado->curso?$certificado->curso:'-');
        $json = array(
            'name'=>strtoupper($certificado->nombres),
            'last_name'=>strtoupper($certificado->apellido_paterno).' '.strtoupper($certificado->apellido_materno),
            'document'=>$certificado->numero_documento,
            'description'=>$descripcion,
            'date_1'=>'Realizado el '.$mesDesc.',',
            'date_2'=>'con una duración de '.$certificado->duracion.' horas efectivas.',
            'name_firm'=>'Helard Bejarano Otazu',
            'cargo_firm'=>'Gerente General',
            'business_firm'=>'HB GROUP PERU S.R.L.',
            'cell'=>'951 281 025',
            'telephone'=>'053 474 805',
            'email'=>'info@hbgroup.pe',
            'web'=>'www.hbgroup.pe',
            'name_business'=>'HB GROUP PERU S.R.L',
            // 'number'=>''.$year.' - 00'.$certificado->certificado_id,
            'number'=>$certificado->cod_certificado,
            'cip'=>$cip,
            'img_firm'=>'1638635074.png',
            'business_curso'=>$certificado->empresa,
            'comentario'=>$certificado->comentario,
            'fecha_vencimiento'=>date("d/m/Y", strtotime($certificado->fecha_vencimiento)) ,
        );
        // return $json;
        // $pdf = FacadePdf::loadView('web.docs.certificado', compact('json'));
        $pdf = Pdf::loadView('web.docs.certificado', $json);
        // $pdf->setPaper('A4', 'landscape');
        // return $pdf->stream();

        return $pdf->download(strtoupper($certificado->apellido_paterno).'-'.strtoupper($certificado->apellido_materno).'-'. str_replace(' ', '-', strtoupper($certificado->nombres)).'-'.$certificado->cod_certificado.'.pdf');
        // return $pdf->stream(strtoupper($certificado->apellido_paterno).'-'.strtoupper($certificado->apellido_materno).'-'. str_replace(' ', '-', strtoupper($certificado->nombres)).'-'.$certificado->cod_certificado.'.pdf');
    }
    public function exportarCertificadoPDFVista($id){
        $instructor = (object)array(
            "name"=>"HELARD JOHN",
            "last_name"=>"BEJARANO OTAZU",
            "description"=>"Gerente General",
            "img_firm"=>"1638456633.png",
            "cip"=>0,
        );

        $certificado = Certificado::where('id',$id)->where('estado',1)->first();

        setlocale(LC_TIME, "spanish"); // cambiamos el idioma de la fecha
        $fecha_oficial = $certificado->fecha_curso;
        $fecha = str_replace("/", "-", $fecha_oficial);
        $newDate = date("d-m-Y", strtotime($fecha));
        $mesDesc = strftime("%d de %B del %Y", strtotime($newDate)); //se obtiene el mes
        // $year = strftime("%Y", strtotime($newDate));
        $cip = '---';

        $descripcion = ($certificado->curso?$certificado->curso:'-');
        $json = array(
            'name'=>strtoupper($certificado->nombres),
            'last_name'=>strtoupper($certificado->apellido_paterno).' '.strtoupper($certificado->apellido_materno),
            'document'=>$certificado->numero_documento,
            'description'=>$descripcion,
            'date_1'=>'Realizado el '.$mesDesc.',',
            'date_2'=>'con una duración '.$certificado->duracion.' horas efectivas.',
            'name_firm'=>'Helard Bejarano Otazu',
            'cargo_firm'=>'Gerente General',
            'business_firm'=>'HB GROUP PERU S.R.L.',
            'cell'=>'932 777 533',
            'telephone'=>'053 474 805',
            'email'=>'info@hbgroup.pe',
            'web'=>'www.hbgroup.pe',
            'name_business'=>'HB GROUP PERU S.R.L',
            // 'number'=>''.$year.' - 00'.$certificado->certificado_id,
            'number'=>$certificado->cod_certificado,
            'cip'=>$cip,
            'img_firm'=>'1638635074.png',
            'business_curso'=>$certificado->empresa,
            'comentario'=>$certificado->comentario,
            'fecha_vencimiento'=>date("d/m/Y", strtotime($certificado->fecha_vencimiento)) ,
        );
        return view('web.docs.certificado-vista', get_defined_vars());
    }
    public function cuestionario($codigo) {
        $cuestionario = Cuestionario::where('encuesta',1)->where('id',$codigo)->first();
        if (!$cuestionario) {
            return response()->json(["mensaje"=>"cuestionario no existe"],200);exit;
        }
        $id = $cuestionario->id;
        return view('web.links.cuestionario', get_defined_vars());
        // return response()->json(["data"=>$cuestionario],200);
    }
    public function obtenerCuestionario($id) {
        $cuestionario   = Cuestionario::find($id);
        $cuestionario->preguntas      = CuestionarioPregunta::where('cuestionario_id',$id)->get();
        foreach ($cuestionario->preguntas as $key => $value) {
            $value->respuestas = CuestionarioRespuesta::where('cuestionario_id',$id)->where('pregunta_id',$value->id)->get();
        }
        return response()->json(["cuestionario"=>$cuestionario],200);
    }
    public function guardarCuestionario(Request $request){
        // return response()->json($request->all(),200);
        $cuestionario = Cuestionario::find($request->id);

        $formulario = Formulario::firstOrNew(['numero_documento' => $request->numero_documento,'cuestionario_id' => $request->id]);
        $formulario->codigo         = $request->cuestionario_codigo;
        $formulario->titulo         = $request->cuestionario_nombre;
        $formulario->encuesta       = 1;
        $formulario->numero_documento   = $request->numero_documento;
        $formulario->apellido_paterno   = $request->apellido_paterno;
        $formulario->apellido_materno   = $request->apellido_materno;
        $formulario->nombres            = $request->nombres;
        $formulario->cuestionario_id    = $request->id;
        $formulario->fecha_registro = date('Y-m-d H:i:s');
        $formulario->created_at     = date('Y-m-d H:i:s');
        $formulario->save();

        FormularioPregunta::where('formulario_id',$formulario->id)->delete();
        if (sizeof($request->cuestionario)>0) {
            foreach ($request->cuestionario as $key_pregunta => $value_pregunta) {
                $pregunta = new FormularioPregunta();
                $pregunta->pregunta         = $value_pregunta['pregunta'];
                // $pregunta->puntaje          = $value_pregunta['puntaje'];
                $pregunta->fecha_registro   = date('Y-m-d H:i:s');
                $pregunta->formulario_id    = $formulario->id;
                $pregunta->tipo_pregunta_id = (int) $value_pregunta['tipo_pregunta_id'];
                $pregunta->created_at       = date('Y-m-d H:i:s');
                $pregunta->save();

                FormularioRespuesta::where('formulario_id',$formulario->id)->where('formulario_pregunta_id',$pregunta->id)->delete();
                foreach ($value_pregunta['alternativas'] as $key_alternativas => $value_alternativas) {
                    $respuestas                     = new FormularioRespuesta();
                    $respuestas->descripcion        = $value_alternativas;

                    if ( isset($value_pregunta['respuesta']) && sizeof($value_pregunta['respuesta'])>0) {
                        foreach ($value_pregunta['respuesta'] as $key_respuesta => $value_respuesta) {
                            if ($value_respuesta==$key_alternativas) {
                                $respuestas->seleccion  = 1;
                            }
                        }
                    }

                    $respuestas->fecha_registro         = date('Y-m-d H:i:s');
                    $respuestas->formulario_pregunta_id = $pregunta->id;
                    $respuestas->formulario_id          = $formulario->id;
                    $respuestas->created_at             = date('Y-m-d H:i:s');
                    $respuestas->save();
                }
            }
            return response()->json(array("titulo"=>"Éxito", "mensaje"=>"Se guardo con éxito","tipo"=>"success"),200);
        }else{
            return response()->json(array("titulo"=>"Información", "mensaje"=>"No registro ninguna pregunta para el cuestionario.","tipo"=>"info"),200);
        }

        return response()->json($request->all(),200);
    }
}
