<?php

namespace App\Http\Controllers\Components\Academico;

use App\Helpers\ConfiguracionComponents;
use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use App\Models\Asistencia;
use App\Models\Aulas;
use App\Models\AulasDescripcion;
use App\Models\Cursos;
use App\Models\LogActividades;
use App\Models\UsuariosAccesos;
use App\Models\UsuariosRoles;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AulasController extends Controller
{
    //
    public function lista()
    {
        $aulas = Aulas::orderBy('id', 'desc')->paginate(12);
        $array_accesos = array();
        $usuario_accesos = UsuariosAccesos::where('usuario_id',Auth()->user()->id)->where('estado',1)->get();
        foreach ($usuario_accesos as $key => $value) {
            array_push($array_accesos,$value->acceso_id);
        }
        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE ALUMNOS', null, null, null, 'INGRESO A LA LISTA DE ALUMNOS');
        return view('components.academico.aulas.lista', get_defined_vars());
    }
    public function formulario(Request $request)
    {
        $id = $request->id;
        $tipo = $request->tipo;

        $asignatura = Asignatura::where('estado',1)->get();
        $cursos = array();
        $aula = Aulas::find($id);
        if ($aula) {
            $cursos = Cursos::where('estado',1)->get();
        }
        $docentes = UsuariosRoles::where('rol_id',3)->where('estado',1)->get();

        LogActividades::guardar(Auth()->user()->id, 2, 'FORMULARIO DE AULA', null, null, null, 'INGRESO AL FORMULARIO DE AULA');
        return view('components.academico.aulas.formulario', get_defined_vars());
    }
    public function guardar(Request $request) {
        // try {
                $data = Aulas::firstOrNew(['id' => $request->id]);

                $data->codigo  = $request->codigo;
                $data->descripcion  = $request->descripcion;
                $data->capacidad    = $request->capacidad;
                $data->fecha        =  date("Y-m-d", strtotime($request->fecha)) ;
                $data->hora_inicio  = $request->hora_inicio;
                $data->hora_final   = $request->hora_final;
                $data->asignatura_id = $request->asignatura_id;
                $data->curso_id     = $request->curso_id;
                $data->docente_id   = $request->docente_id;
                $data->abierto  = ($request->abierto?$request->abierto:0);

                if ((int) $request->id == 0) {
                    $data->fecha_registro       = date('Y-m-d H:i:s');
                    $data->created_at           = date('Y-m-d H:i:s');
                    $data->created_id           = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO DE AULA', $data->getTable(), NULL, $data, 'SE A CREADO UNA NUEVA AULA');
                }else{
                    $data_old=Aulas::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UN AULA', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN AULA');
                }




            $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
        // } catch (Exception $ex) {
        //     $respuesta = array("titulo"=>"Error","mensaje"=>"Hubo un problema al registrar. Por favor intente de nuevo, si persiste comunicarse con su area de TI","tipo"=>"error","ex"=>$ex);
        // }
        return response()->json($respuesta,200);
    }
    function eliminar($id) {
        $data = Aulas::find($id);
        $data->deleted_id   = Auth()->user()->id;
        $data->estado   = 0;
        $data->save();
        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINACIOND E AULA', $data->getTable(), $data, NULL, 'ELIMINO UNA AULA DE LA GESTIONDE  AULAS');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }

    public function agregarAlumnos(Request $request) {
        $id = $request->id;
        $aula = Aulas::find($request->id);
        $alumnos = UsuariosRoles::where('rol_id',2)->where('estado',1)->get();
        // return $alumnos[0]->usuario;exit;
        // return $alumnos;exit;
        LogActividades::guardar(Auth()->user()->id, 2, 'FORMULARIO DE AGREGAR PARTICIPANTES', null, null, null, 'INGRESO AL FORMULARIO DE AGREGAR PARTICIPANTES');
        return view('components.academico.aulas.agregar-alumnos', get_defined_vars());
    }
    public function guardarAlumnos(Request $request) {

        $aula = Aulas::find($request->aula_id);
        // foreach ($request->usuarios as $key => $value) {

            $alumnos = Asistencia::where('aula_id',$request->aula_id)->where('estado',1)->get();

            if ((int) sizeof($alumnos) < (int)$aula->capacidad) {

                $data = Asistencia::firstOrNew(['alumno_id' => (int) $request->usuarios,'aula_id'=>$request->aula_id]);
                $data->reserva          = true;
                $data->aula_id          = $request->aula_id;
                $data->alumno_id        = (int) $request->usuarios;
                $data->estado           = 1;
                $data->deleted_id        = null;
                $data->fecha_registro   = date('Y-m-d H:i:s');
                $data->created_at       = date('Y-m-d H:i:s');
                $data->created_id       = Auth()->user()->id;
                $data->save();
                LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN ALUMNO', $data->getTable(), NULL, $data, 'SE AGREGO UN ALUMNO AL AULA');
                $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
            }else{
                $respuesta = array("titulo"=>"Alerta","mensaje"=>"Solo se le permite el registro a ".$aula->capacidad." alumnos","tipo"=>"warning");
                // break;
            }


        // }




        return response()->json($respuesta,200);
    }

    public function listardarAlumnos(Request $request) {
        $data = Asistencia::where('aula_id', $request->aula_id)->where('estado',1)->get();
        return DataTables::of($data)
        ->addColumn('documento', function ($data) {
            $valor = ($data->usuario->persona->path_dni ? true : false );

            $span = '<span class="badge rounded-pill bg-'.($valor==false?'danger':'success').' badge-sm me-1 mb-1 mt-1 protip" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="'.($valor==false?'Falta la imagen de su documento de identidad':'Completo').'">'.($valor==false?'Incompleto':'Completo').'</span>';

            return $span;
        })
        ->addColumn('numero_documento', function ($data) {
            return $data->usuario->persona->nro_documento;
        })
        ->addColumn('apellidos_nombres', function ($data) {
            return $data->usuario->persona->apellido_paterno.' '.$data->usuario->persona->apellido_materno.' '.$data->usuario->persona->nombres;
        })
        ->addColumn('fecha_registro', function ($data) {
            return date("d/m/Y", strtotime($data->fecha_registro));
        })
        ->addColumn('reservacion', function ($data) {
            return '<span class="badge rounded-pill bg-'.($data->reserva==1?'warning':'success').' badge-sm me-1 mb-1 mt-1 protip" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="'.($data->reserva==1?'Reservado':'Confirmado').'">'.($data->reserva==1?'Reservado':'Confirmado').'</span>';

            // return '<span class="badge bg-'.($data->reserva==1?'warning':'success').'-transparent rounded-pill text-'.($data->reserva==1?'warning':'success').' p-2 px-3">'.($data->reserva==1?'Reservado':'Confirmado').'</span>';
        })
        ->addColumn('accion', function ($data) { return
            '<div class="btn-list">
                '.($data->reserva==1?'<button type="button" class="confirmar protip btn text-success btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Confirmar" >
                    <i class="fe fe-check-circle fs-14 text-success"></i>
                </button>':'success').'

                <button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14 text-danger"></i>
                </button>

            </div>';
        })->rawColumns(['documento', 'reservacion','accion'])->make(true);
    }
    public function eliminarAlumno($id) {
        $data = Asistencia::find($id);
        $data->deleted_id   = Auth()->user()->id;
        $data->ingreso   = 0;
        $data->estado   = 0;
        $data->save();
        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINACION DE ALUMNO', $data->getTable(), $data, NULL, 'ELIMINO UN ALUMNO');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }
    public function confirmarAlumno($id) {
        $data = Asistencia::find($id);
        $data->reserva   = 0;
        $data->save();
        LogActividades::guardar(Auth()->user()->id, 4, 'LISTA DE ALUMNOS', $data->getTable(), $data, NULL, 'SE CONFIRMO LA PARTICIPACION DE UN ALUMNO AL CURSO');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se confirmo con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }
    public function asistencia(Request $request)
    {
        $id = $request->id;
        $tipo = $request->tipo;
        $cursos = Cursos::where('estado',1)->get();
        $aula = Aulas::find($id);
        $docentes = UsuariosRoles::where('rol_id',3)->where('estado',1)->get();

        LogActividades::guardar(Auth()->user()->id, 2, 'FORMULARIO DE ASISTENCIA', null, null, null, 'INGRESO AL FORMULARIO DE ASISTENCIA');
        return view('components.academico.aulas.asistencia', get_defined_vars());
    }

    public function listarAsistencia(Request $request) {
        $data = Asistencia::where('aula_id', $request->aula_id)->where('estado',1)->where('reserva',0)->get();
        return DataTables::of($data)
        ->addColumn('numero_documento', function ($data) {
            return $data->usuario->persona->nro_documento;
        })
        ->addColumn('apellidos_nombres', function ($data) {
            return $data->usuario->persona->apellido_paterno.' '.$data->usuario->persona->apellido_materno.' '.$data->usuario->persona->nombres;
        })
        ->addColumn('fecha_registro', function ($data) {
            return date("d/m/Y", strtotime($data->fecha_registro));
        })
        ->addColumn('asistencia', function ($data) {
            return '<span class="badge rounded-pill bg-'.($data->ingreso==1?'success':'danger').' badge-sm me-1 mb-1 mt-1 protip" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="'.($data->ingreso==1?'Asitio':'Ausente').'">'.($data->ingreso==1?'Asistio':'Ausente').'</span>';

            // return '<span class="badge bg-'.($data->reserva==1?'warning':'success').'-transparent rounded-pill text-'.($data->reserva==1?'warning':'success').' p-2 px-3">'.($data->reserva==1?'Reservado':'Confirmado').'</span>';
        })
        ->addColumn('accion', function ($data) {
            $button = '<button type="button" class="btn text-danger btn-sm abandono protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Abandono del curso"> <i class="fe fe-user-x fs-14 text-danger"></i></button>';
            if ($data->ingreso==0) {
                $button = '<button type="button" class="btn text-success btn-sm ingreso protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Se confirme el ingreso al curso.">
                    <i class="fe fe-user-check fs-14 text-success"></i>
                </button>';
            }
            return
            '<div class="btn-list">'.$button.'</div>';
        })->rawColumns(['asistencia','accion'])->make(true);
    }

    public function buscarCodigoAula(Request $request){

        $data = Aulas::where('codigo', $request->codigo)->first();

        if($data && ((int)$request->id!==$data->id)){
            return response()->json(["tipo"=>true],200); // si encontro una concidencia
        }
        return response()->json(["tipo"=>false],200); // que esta disponible
    }
    public function ingresoConfirmar($id){
        $data = Asistencia::find($id);
        $data->ingreso = 1;
        $data->save();
        return response()->json(["titulo"=>"Éxito","mensaje"=>"Se confirmo su ingreso al aula","tipo"=>"success"],200);
    }
    public function abandonoConfirmar($id){
        $data = Asistencia::find($id);
        $data->ingreso = 0;
        $data->save();
        return response()->json(["titulo"=>"Éxito","mensaje"=>"Se confirmo el abandono del aula","tipo"=>"success"],200);
    }
    public function portafolio($id){
        $aula = Aulas::find($id);
        $alumnos = UsuariosRoles::where('rol_id',2)->where('estado',1)->get();
        return view('components.academico.aulas.portafolio', get_defined_vars());
    }
    public function descargarAsistencia($id){
        $data = Asistencia::where('aula_id', $id)->where('estado',1)->where('ingreso',1)->get();
        $aula = Aulas::find($id);

        $html = '<html lang="en">'.
            '<head>'.
            '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.
            '</head>'.
            '<body>';
                foreach ($data as $key => $value) {
                    // $html.='<div style="margin: 25px !important;"><img src="'.public_path().'/'.$value->usuario->persona->path_dni.'" width="100%" ></div>';
                    if ($value->usuario->persona->path_dni) {
                        $html.='<div style="margin: 25px !important;"><img src="'.asset('').'/'.$value->usuario->persona->path_dni.'" width="100%" ></div>';
                    }

                }
            '</body>'.
        '</html>';

        $pdf = PDF::loadHTML($html);
        $pdf->stream();
        return $pdf->download($aula->codigo.'-asistencia.pdf');
    }
    public function reporteAsistencia($id){
        $aula = Aulas::find($id);
        $data = Asistencia::where('aula_id', $id)->where('estado',1)->get();
        $alumnos = array();

        foreach ($data as $key => $value) {
            array_push($alumnos,array(
                "documento"=>$value->usuario->persona->nro_documento,
                "nombres"=>$value->usuario->persona->nombres,
                "apellido_paterno"=>$value->usuario->persona->apellido_paterno,
                "apellido_materno"=>$value->usuario->persona->apellido_materno,
                "asistencia"=>($value->ingreso==1?true:false),
                "comentarios"=>'-',
            ));
        }
        $cabecera = array(
            "organisacion"=>'HB GROUP PERU S.R.L.',
            "curso"=>$aula->curso->nombre,
            "fecha"=>$aula->fecha,
            "instructor"=>$aula->usuario->persona->apellido_paterno.' '.$aula->usuario->persona->apellido_materno.' '.$aula->usuario->persona->nombres,
            "lugar_dictado"=>'www.hbgroup.pe',
            "id_sistema_apn"=>$aula->codigo,
            "modalidad"=>'virtual',
            "horario"=>$aula->hora_inicio.' - '.$aula->hora_final,
            "registro_instructor"=>'-',
            "firma_instructor"=>'-',
        );
        $valores = array("cabecera"=>json_encode($cabecera),"alumnos"=>json_encode($alumnos),"nombre"=>'niels');
        $pdf = PDF::loadView('components/academico/aulas/report/asistencia_reporte', $valores);
        return $pdf->stream('historia_clinica.pdf');
        // return response()->json(["cabecera"=>$cabecera,"alumnos"=>$alumnos],200);
    }

}
