<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Certificado;
use App\Models\LogActividades;
use App\Models\TipoDocumentos;
use App\Models\UsuariosAccesos;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\Xls as SharedXls;
use Yajra\DataTables\Facades\DataTables;

class CertificadoController extends Controller
{
    //
    public function lista()
    {
        // $moneda = Alum::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $nivel = Nivel::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $tipo_habitacion = TipoHabitacion::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $tipos_documentos = TipoDocumentos::all();
        // $empresas = Empresas::all();
        // $array_accesos = array();
        // $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->get();
        // foreach ($usuario_accesos as $key => $value) {
        //     array_push($array_accesos,$value->acceso_id);
        // }

        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE CERTIFICADOS', null, null, null, 'INGRESO A LA LISTA DE CERTIFICADOS');
        return view('components.academico.certificado.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = Certificado::where('estado',1)->get();
        return DataTables::of($data)
        ->addColumn('vigencia', function ($data) {
            Certificado::vigencia($data->id);
            return Certificado::vigencia($data->id);
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
        $tipos_documentos = TipoDocumentos::all();
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
            $data->delete();
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
        // https://www.youtube.com/watch?v=FSkobxzqY3g
        $path = storage_path().'/app/'.$request->file('certificado')->store('tmp');

        $reader = new Xlsx();
        $spreadsheet = $reader->load($path);
        $sheet = $spreadsheet->getActiveSheet();

        $workShetInfo = $reader->listWorksheetInfo($path);
        dd($workShetInfo);
    }
}
