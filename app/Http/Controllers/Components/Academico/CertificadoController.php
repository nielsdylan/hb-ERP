<?php

namespace App\Http\Controllers\Components\Academico;

use App\Exports\ModeloCertificadoExcelModeloExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\HomeController;
use App\Imports\CertificadosImport;
use App\Models\Certificado;
use App\Models\LogActividades;
use App\Models\TipoDocumentos;
use App\Models\UsuariosAccesos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use SebastianBergmann\Type\TrueType;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;

class CertificadoController extends Controller
{
    //
    public function lista()
    {

        $empresas = Certificado::select('empresa')->where('estado',1)->whereNotNull('empresa')->distinct()->orderBy('empresa', 'asc')->get();
        $cursos = Certificado::select('curso')->where('estado',1)->whereNotNull('curso')->distinct()->orderBy('empresa', 'asc')->get();
        $documentos = Certificado::select('numero_documento')->where('estado',1)->whereNotNull('numero_documento')->distinct()->orderBy('empresa', 'asc')->get();
        // $contador = Certificado::select('empresa')->where('estado',1)->distinct()->orderBy('empresa', 'asc')->count();
        // return [$empresas];
        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE CERTIFICADOS', null, null, null, 'INGRESO A LA LISTA DE CERTIFICADOS');
        return view('components.academico.certificado.lista', get_defined_vars());
    }
    public function listar(Request $request)
    {
        $respuesta = Certificado::where('estado',1);

        if ($request->curso !=='-') {
            $respuesta = $respuesta->where('curso','like','%'.$request->curso.'%');
        }

        if ($request->empresa =='vacio') {
            $respuesta = $respuesta->whereNull('empresa');
        }else if($request->empresa !=='-'){
            $respuesta = $respuesta->where('empresa','like','%'.$request->empresa.'%');
        }
        if ($request->documento !=='-') {
            $respuesta = $respuesta->where('numero_documento','like','%'.$request->documento.'%');
        }
        if ($request->fecha_inicio !=='-') {
            $respuesta = $respuesta->where('fecha_curso','>=',$request->fecha_inicio);
        }
        if ($request->fecha_final !=='-') {
            $respuesta = $respuesta->where('fecha_curso','<=',$request->fecha_final);
        }
        $respuesta = $respuesta->get();

        $data = $respuesta;
        return DataTables::of($data)
        ->addColumn('vigencia', function ($data) {
            $resuesta = Certificado::vigencia($data->id);
            return '<span class="badge rounded-pill bg-'.$resuesta['color'].' badge-sm me-1 mb-1 mt-1 protip" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="'.$resuesta['texto'].'">'.$resuesta['texto'].'</span>';
        })
        ->addColumn('apellidos_nombres', function ($data) {
            return $data->apellido_paterno.' '.$data->apellido_materno.' '.$data->nombres;
        })
        ->addColumn('accion', function ($data) {
            $array_accesos = array();
            $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
            foreach ($usuario_accesos as $key => $value) {
                array_push($array_accesos,$value->acceso_id);
            }
            return
            '<div class="btn-list">

                <button type="button" class="ver protip btn text-info btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Ver" >
                    <i class="fe fe-eye fs-14"></i>
                </button>

                <a href="'.route('hb.academicos.certificados.exportar-pdf',['id'=>$data->id]).'" class="btn text-info btn-sm protip" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Exportar certificado">
                    <i class="fa fa-file-pdf-o fs-14"></i>
                </a>

                <button type="button" class="editar protip btn text-warning btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar" >
                    <i class="fe fe-edit fs-14"></i>
                </button>
                <button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>


            </div>';
        })->rawColumns(['accion','vigencia'])->make(true);
    }
    public function formulario(Request $request)
    {
        $id = $request->id;
        $tipo = $request->tipo;
        $tipos_documentos = TipoDocumentos::where('estado',1)->get();
        $data = array();
        if ((int)$id>0) {
            $data = Certificado::find($id);
        }

        // $aula = Aulas::find($id);
        LogActividades::guardar(Auth()->user()->id, 2, 'FORMULARIO DE AULA', null, null, null, 'INGRESO AL FORMULARIO DE AULA');
        return view('components.academico.certificado.formulario', get_defined_vars());
    }
    public function guardar(Request $request)
    {
        $data = Certificado::firstOrNew(['id' => $request->id]);
            $data->fecha_curso              = $request->fecha_curso;
        // $data->codigo_curso             = $request->codigo_curso;
            $data->curso                    = $request->curso;
            $data->tipo_curso               = $request->tipo_curso;
            $data->tipo_documento_id           = $request->tipo_documento_id;
            $data->numero_documento         = $request->numero_documento;
            $data->apellido_paterno         = $request->apellido_paterno;
            $data->apellido_materno         = $request->apellido_materno;
            $data->nombres                  = $request->nombres;
            $data->empresa                  = $request->empresa;
            $data->cargo                    = $request->cargo;
            $data->email                    = $request->email;
            $data->supervisor_responsable   = $request->supervisor_responsable;
            $data->observaciones            = $request->observaciones;
        // $data->acronimos                = $request->acronimos;
        // $data->nombre_curso_oficial     = $request->nombre_curso_oficial;
        // $data->fecha_oficial            = $request->fecha_oficial;
            $data->cod_certificado          = $request->cod_certificado;
        // $data->descripcion_larga        = $request->descripcion_larga;
        // $data->descripcion_corta        = $request->descripcion_corta;
            $data->fecha_vencimiento        = $request->fecha_vencimiento;
            $data->duracion                 = $request->duracion;
            $data->nota                     = $request->nota;
            $data->aprobado                 = 1;
            $data->comentario               = $request->comentario;
            $data->estado                   = 1;

        if ((int) $request->id == 0) {
            $data->created_at           = date('Y-m-d H:i:s');
            $data->created_id           = Auth()->user()->id;
            $data->save();
            LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN CERTIFICADO', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO CERTIFICADO DESDE EL FORMULARIO ');
        }else{
            $data_old=Certificado::find($request->id);
            $data->updated_at   = date('Y-m-d H:i:s');
            $data->updated_id   = Auth()->user()->id;
            $data->save();
            LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN CERTIFICADO', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN CERTIFICADO DESDE EL FORMULARIO ');
        }

        return response()->json(["titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success"],200);
    }
    public function eliminar($id)
    {
        try {
            $data = Certificado::find($id);
            $data->estado = 0;
            $data->save();

            LogActividades::guardar(Auth()->user()->id, 5, 'LISTA DE CERTIFICADOS', $data->getTable(), $data, NULL, 'SE A ELIMINADO UN CERTIFICADO DESDE LA LISTA DE CERTIFICADOS');
            return response()->json(["titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success"],200);
        } catch (\Throwable $th) {
            return response()->json(["titulo"=>"Error","mensaje"=>"Ocurrior un error comuniquese con el area de TI","tipo"=>"error"],200);
        }

    }
    public function buscarCodigo(Request $request) {
        if ((int)$request->id == 0) {
            $certificado = Certificado::where('cod_certificado','=',$request->codigo)->first();
            if ($certificado) {
                return response()->json(array("success"=>true),200);
            }
            return response()->json(array("success"=>false),200);
        }
        return response()->json(array("success"=>false),200);

    }
    public function importarCertificadosExcel(Request $request){

        try {
            $spreadsheet = IOFactory::load(request()->file('certificado'));

            $indiceHoja = 0; // indicamos la primera hoja por defecto

            $hojaActual = $spreadsheet->getSheet($indiceHoja);
            # obtener el numero filas
            $numeroDeFilas = $hojaActual->getHighestRow(); // Numérico

            $arrayExcluidos = array();

            # Iterar filas con ciclo for e índices
            for ($indiceFila = 1; $indiceFila <= $numeroDeFilas; $indiceFila++) {
                if ($indiceFila!=1) {
                    $requeridos = true;
                    $documento = false;
                    if (!$hojaActual->getCellByColumnAndRow(1, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(2, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(4, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }else{
                        $documento = TipoDocumentos::where('codigo',$hojaActual->getCellByColumnAndRow(4, $indiceFila)->getFormattedValue())->first();
                    }
                    if (!$hojaActual->getCellByColumnAndRow(5, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(6, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(7, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(8, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(14, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(15, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(20, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(21, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(22, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }
                    if (!$hojaActual->getCellByColumnAndRow(23, $indiceFila)->getFormattedValue()) {
                        $requeridos = false;
                    }


                    if (!$documento) {
                        $requeridos = false;
                    }

                    if ($requeridos) {

                        // $fecha_curso = Carbon::parse($hojaActual->getCellByColumnAndRow(1, $indiceFila)->getFormattedValue())->format('Y-m-d');



                        // return $this->formatoFechaExcel($hojaActual->getCellByColumnAndRow(1, $indiceFila)->getValue());
                        // return $timestamp;
                        // return $hojaActual->getCellByColumnAndRow(1, $indiceFila)->getValue();
                        // return $hojaActual->getCellByColumnAndRow(1, $indiceFila)->getCalculatedValue();

                        $data = Certificado::firstOrNew(
                            ['cod_certificado' => $hojaActual->getCellByColumnAndRow(21, $indiceFila)->getFormattedValue()],
                            ['estado' => 1]
                        );
                            $data->fecha_curso              = $this->formatoFechaExcel($hojaActual->getCellByColumnAndRow(1, $indiceFila)->getValue()) ;
                        // $data->codigo_curso             = $request->codigo_curso;
                            $data->curso                    = $hojaActual->getCellByColumnAndRow(2, $indiceFila)->getFormattedValue();
                            $data->tipo_curso               = $hojaActual->getCellByColumnAndRow(3, $indiceFila)->getFormattedValue();
                            $data->tipo_documento_id        = $documento->id;
                            $data->numero_documento         = $hojaActual->getCellByColumnAndRow(5, $indiceFila)->getFormattedValue();
                            $data->apellido_paterno         = $hojaActual->getCellByColumnAndRow(6, $indiceFila)->getFormattedValue();
                            $data->apellido_materno         = $hojaActual->getCellByColumnAndRow(7, $indiceFila)->getFormattedValue();
                            $data->nombres                  = $hojaActual->getCellByColumnAndRow(8, $indiceFila)->getFormattedValue();
                            $data->empresa                  = ($hojaActual->getCellByColumnAndRow(9, $indiceFila)->getFormattedValue()?$hojaActual->getCellByColumnAndRow(9, $indiceFila)->getFormattedValue():null);
                            $data->cargo                    = $hojaActual->getCellByColumnAndRow(10, $indiceFila)->getFormattedValue();
                            $data->email                    = $hojaActual->getCellByColumnAndRow(11, $indiceFila)->getFormattedValue();
                            $data->supervisor_responsable   = $hojaActual->getCellByColumnAndRow(12, $indiceFila)->getFormattedValue();
                            $data->observaciones            = $hojaActual->getCellByColumnAndRow(13, $indiceFila)->getFormattedValue();
                        // $data->acronimos                = $request->acronimos;
                        // $data->nombre_curso_oficial     = $request->nombre_curso_oficial;
                        // $data->fecha_oficial            = $request->fecha_oficial;
                            $data->cod_certificado          = $hojaActual->getCellByColumnAndRow(21, $indiceFila)->getFormattedValue();
                        // $data->descripcion_larga        = $request->descripcion_larga;
                        // $data->descripcion_corta        = $request->descripcion_corta;
                            // $data->fecha_vencimiento        = Carbon::parse($hojaActual->getCellByColumnAndRow(23, $indiceFila)->getFormattedValue())->format('Y-m-d');

                            if ((int) $hojaActual->getCellByColumnAndRow(25, $indiceFila)->getFormattedValue() > 0) {
                                $fecha_curso = $this->formatoFechaExcel($hojaActual->getCellByColumnAndRow(1, $indiceFila)->getValue());

                                $data->fecha_vencimiento = date("Y-m-d",strtotime($fecha_curso."+ ".$hojaActual->getCellByColumnAndRow(25, $indiceFila)->getFormattedValue()." year"));
                            }else{
                                $data->fecha_vencimiento = $this->formatoFechaExcel($hojaActual->getCellByColumnAndRow(23, $indiceFila)->getValue());
                            }

                            $data->duracion                 = $hojaActual->getCellByColumnAndRow(22, $indiceFila)->getFormattedValue();
                            $data->nota                     = (float) $hojaActual->getCellByColumnAndRow(20, $indiceFila)->getFormattedValue();
                            $data->aprobado                 = 1;
                            $data->comentario               = $hojaActual->getCellByColumnAndRow(24, $indiceFila)->getFormattedValue();
                            $data->estado                   = 1;

                        if (Certificado::where('cod_certificado', $hojaActual->getCellByColumnAndRow(21, $indiceFila)->getFormattedValue())->first()) {
                            $data->created_at           = date('Y-m-d H:i:s');
                            $data->created_id           = Auth()->user()->id;
                            $data->save();
                            LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN CERTIFICADO', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO CERTIFICADO DESDE LA IMPORTACION DE CERTIFICADOS');
                        }else{
                            $data_old=Certificado::find($request->id);
                            $data->updated_at   = date('Y-m-d H:i:s');
                            $data->updated_id   = Auth()->user()->id;
                            $data->save();
                            LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN CERTIFICADO', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN CERTIFICADO DESDE LA IMPORTACION DE CERTIFICADOS');
                        }

                    }else{
                        array_push($arrayExcluidos,array(
                            "FECHA_DE_CURSO"            =>$hojaActual->getCellByColumnAndRow(1, $indiceFila)->getFormattedValue(),
                            "CURSO"                     =>$hojaActual->getCellByColumnAndRow(2, $indiceFila)->getFormattedValue(),
                            "TIPO_DE_CURSO"             =>$hojaActual->getCellByColumnAndRow(3, $indiceFila)->getFormattedValue(),
                            "TIPO_DE_DOCUMENTO"         =>$hojaActual->getCellByColumnAndRow(4, $indiceFila)->getFormattedValue(),
                            "N_DE_DOCUMENTO"           =>$hojaActual->getCellByColumnAndRow(5, $indiceFila)->getFormattedValue(),
                            "APELLIDO_PATERNO"          =>$hojaActual->getCellByColumnAndRow(6, $indiceFila)->getFormattedValue(),
                            "APELLIDO_MATERNO"          =>$hojaActual->getCellByColumnAndRow(7, $indiceFila)->getFormattedValue(),
                            "NOMBRES"                   =>$hojaActual->getCellByColumnAndRow(8, $indiceFila)->getFormattedValue(),
                            "EMPRESA"                   =>$hojaActual->getCellByColumnAndRow(9, $indiceFila)->getFormattedValue(),
                            "CARGO"                     =>$hojaActual->getCellByColumnAndRow(10, $indiceFila)->getFormattedValue(),
                            "CORREO_ELECTRONICO"        =>$hojaActual->getCellByColumnAndRow(11, $indiceFila)->getFormattedValue(),
                            "SUPERVISOR_RESPONSABLE"    =>$hojaActual->getCellByColumnAndRow(12, $indiceFila)->getFormattedValue(),
                            "OBSERVACIONES"             =>$hojaActual->getCellByColumnAndRow(13, $indiceFila)->getFormattedValue(),
                            "CODIGO_DEL_CURSO"   =>$hojaActual->getCellByColumnAndRow(14, $indiceFila)->getFormattedValue(),
                            "COD"                       =>$hojaActual->getCellByColumnAndRow(15, $indiceFila)->getFormattedValue(),
                            "LETRA"                     =>$hojaActual->getCellByColumnAndRow(16, $indiceFila)->getFormattedValue(),
                            "AAAA"                      =>$hojaActual->getCellByColumnAndRow(17, $indiceFila)->getFormattedValue(),
                            "MM"                        =>$hojaActual->getCellByColumnAndRow(18, $indiceFila)->getFormattedValue(),
                            "DD"                        =>$hojaActual->getCellByColumnAndRow(19, $indiceFila)->getFormattedValue(),
                            "NOTA"                      =>$hojaActual->getCellByColumnAndRow(20, $indiceFila)->getFormattedValue(),
                            "CODIGO_CERTIFICADO"        =>$hojaActual->getCellByColumnAndRow(21, $indiceFila)->getFormattedValue(),
                            "DURACION"                  =>$hojaActual->getCellByColumnAndRow(22, $indiceFila)->getFormattedValue(),
                            "FECHA_VENCIMIENTO"         =>$hojaActual->getCellByColumnAndRow(23, $indiceFila)->getFormattedValue(),
                            "COMENTARIO"                =>$hojaActual->getCellByColumnAndRow(24, $indiceFila)->getFormattedValue(),
                        ));
                    }
                }
            }
            if (sizeof($arrayExcluidos)>0) {
                return response()->json(["titulo"=>"Alerta", "mensaje"=>"Se encontro que ".sizeof($arrayExcluidos)." registros no tienen los campos requeridos.","tipo"=>"warning","data"=>$arrayExcluidos],200);
            }
            return response()->json(["titulo"=>"Éxito", "mensaje"=>"Se importo con exito la lista de certificados","tipo"=>"success"],200);
        } catch (\Throwable $th) {
            return response()->json(["titulo"=>"Error", "mensaje"=>"Ocurrio un error comuniquese con su soporte de TI.","tipo"=>"error"],200);
        }



    }
    public function certificadoModeloExcel(){
        LogActividades::guardar(Auth()->user()->id, 7, 'LISTA DE CERTIFICADOS',NULL, NULL, NULL, 'SE DESCARGO UN MODELO DE EXCEL QUE ES PARA LA IMPORTACIÓN DE CERTIFICADOS DE LA LSITA DE CERTIFICADOS');
        return Excel::download(new ModeloCertificadoExcelModeloExport, 'modeloCertificado.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    public function exportarPDF($id, $masivo=1){

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
        LogActividades::guardar(Auth()->user()->id, 7, 'LISTADO DE CERTIFICADOS', $certificado->getTable(), $certificado, NULL, 'SE PROCEDIO A DESCARGAR CERTIFICADO');
        // return $json;
        // $pdf = FacadePdf::loadView('web.docs.certificado', compact('json'));
        $pdf = Pdf::loadView('web.docs.certificado', $json);
        // $pdf->setPaper('A4', 'landscape');
        // return $pdf->stream();

        if ($masivo==1) {
            return $pdf->download(strtoupper($certificado->apellido_paterno).'-'.strtoupper($certificado->apellido_materno).'-'. str_replace(' ', '-', strtoupper($certificado->nombres)).'-'.$certificado->cod_certificado.'.pdf');
        }else{
            // return array("pdf"=>$pdf,"nombre"=>strtoupper($certificado->apellido_paterno).'-'.strtoupper($certificado->apellido_materno).'-'. str_replace(' ', '-', strtoupper($certificado->nombres)).'-'.$certificado->cod_certificado.'.pdf');
            // return $pdf->stream(strtoupper($certificado->apellido_paterno).'-'.strtoupper($certificado->apellido_materno).'-'. str_replace(' ', '-', strtoupper($certificado->nombres)).'-'.$certificado->cod_certificado.'.pdf');
            echo ($pdf->download(strtoupper($certificado->apellido_paterno).'-'.strtoupper($certificado->apellido_materno).'-'. str_replace(' ', '-', strtoupper($certificado->nombres)).'-'.$certificado->cod_certificado.'.pdf'));
        }


    }
    public function alumnosCertidicadoMasivo(Request $request){

        $respuesta = Certificado::where('estado',1);

        if ($request->curso !=='-') {
            $respuesta = $respuesta->where('curso','like','%'.$request->curso.'%');
        }
        if ($request->empresa =='vacio') {
            $respuesta = $respuesta->whereNull('empresa');
        }else if($request->empresa !=='-'){
            $respuesta = $respuesta->where('empresa','like','%'.$request->empresa.'%');
        }
        if ($request->documento !=='-') {
            $respuesta = $respuesta->where('numero_documento','like','%'.$request->documento.'%');
        }
        if ($request->fecha_inicio !=='-') {
            $respuesta = $respuesta->where('fecha_curso','>=',$request->fecha_inicio);
        }
        if ($request->fecha_final !=='-') {
            $respuesta = $respuesta->where('fecha_curso','<=',$request->fecha_final);
        }
        $respuesta = $respuesta->get();

        $controlador = new HomeController();

        $array = array();
        // LogActividades::guardar(Auth()->user()->id, 7, 'LISTADO DE CERTIFICADOS', $respuesta->getTable(), $request->all(), NULL, 'SE PROCEDIO A DESCARGAR CERTIFICADOs MASIVOS');
        foreach ($respuesta as $key => $value) {
            echo "<SCRIPT>window.open('".route('exportar-certificado-pdf',['id'=>$value->id])."');</SCRIPT>";
        }
        // return ;
        echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
    }
    public function ver($id){
        $data = Certificado::find($id);
        LogActividades::guardar(Auth()->user()->id, 6, 'LISTADO DE CERTIFICADOS', $data->getTable(), $data, NULL, 'SE PROCEDIO A VER LA INFORMACION DE UN REGISTRO');
        return response()->json(["data"=>$data,"ejemplo"=>$data->documentos],200);
    }
    public function formatoFechaExcel($numero){
        return gmdate("Y-m-d", (((int)$numero - 25569) * 86400));
    }

}
