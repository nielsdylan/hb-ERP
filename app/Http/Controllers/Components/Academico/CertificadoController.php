<?php

namespace App\Http\Controllers\Components\Academico;

use App\Exports\ModeloCertificadoExcelModeloExport;
use App\Http\Controllers\Controller;
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

class CertificadoController extends Controller
{
    //
    public function lista()
    {

        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE CERTIFICADOS', null, null, null, 'INGRESO A LA LISTA DE CERTIFICADOS');
        return view('components.academico.certificado.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = Certificado::where('estado',1)->get();
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
                        $documento = TipoDocumentos::where('descripcion',$hojaActual->getCellByColumnAndRow(4, $indiceFila)->getFormattedValue())->first();
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
                    // return  $hojaActual->getCellByColumnAndRow(20, $indiceFila)->getFormattedValue();
                    if ($requeridos) {


                        $data = Certificado::firstOrNew(
                            ['cod_certificado' => $hojaActual->getCellByColumnAndRow(21, $indiceFila)->getFormattedValue()],
                            ['estado' => 1]
                        );
                            $data->fecha_curso              = Carbon::parse($hojaActual->getCellByColumnAndRow(1, $indiceFila)->getFormattedValue())->format('Y-m-d') ;
                        // $data->codigo_curso             = $request->codigo_curso;
                            $data->curso                    = $hojaActual->getCellByColumnAndRow(2, $indiceFila)->getFormattedValue();
                            $data->tipo_curso               = $hojaActual->getCellByColumnAndRow(3, $indiceFila)->getFormattedValue();
                            $data->tipo_documento_id        = $documento->id;
                            $data->numero_documento         = $hojaActual->getCellByColumnAndRow(5, $indiceFila)->getFormattedValue();
                            $data->apellido_paterno         = $hojaActual->getCellByColumnAndRow(6, $indiceFila)->getFormattedValue();
                            $data->apellido_materno         = $hojaActual->getCellByColumnAndRow(7, $indiceFila)->getFormattedValue();
                            $data->nombres                  = $hojaActual->getCellByColumnAndRow(8, $indiceFila)->getFormattedValue();
                            $data->empresa                  = $hojaActual->getCellByColumnAndRow(9, $indiceFila)->getFormattedValue();
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
                            $data->fecha_vencimiento        = Carbon::parse($hojaActual->getCellByColumnAndRow(23, $indiceFila)->getFormattedValue())->format('Y-m-d');
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
        return Excel::download(new ModeloCertificadoExcelModeloExport, 'modeloCertificado.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
