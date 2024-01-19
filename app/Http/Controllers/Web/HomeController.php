<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Certificado;
use App\Models\Cuestionario;
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
}
