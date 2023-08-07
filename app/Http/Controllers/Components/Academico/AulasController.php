<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Aulas;
use App\Models\AulasDescripcion;
use App\Models\Cursos;
use App\Models\LogActividades;
use App\Models\UsuariosRoles;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AulasController extends Controller
{
    //
    public function lista()
    {
        $aulas = Aulas::paginate(12);
        
        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE ALUMNOS', null, null, null, 'INGRESO A LA LISTA DE ALUMNOS');
        return view('components.academico.aulas.lista', get_defined_vars());
    }
    public function formulario(Request $request)
    {
        $id = $request->id;
        $tipo = $request->tipo;
        $cursos = Cursos::all();
        $aula = Aulas::find($id);
        LogActividades::guardar(Auth()->user()->id, 2, 'FORMULARIO DE AULA', null, null, null, 'INGRESO AL FORMULARIO DE AULA');
        return view('components.academico.aulas.formulario', get_defined_vars());
    }
    public function guardar(Request $request) {
        // try {
                $data = Aulas::firstOrNew(['id' => $request->id]);
                $data->nombre      = $request->nombre;
                $data->descripcion      = $request->descripcion;
                $data->capacidad      = $request->capacidad;
                $data->fecha      =  date("Y-m-d", strtotime($request->fecha)) ;
                $data->hora_inicio      = $request->hora_inicio;
                $data->hora_final      = $request->hora_final;
                $data->curso_id      = $request->curso_id;

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
        $data->save();
        $data->delete();
        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINACIOND E AULA', $data->getTable(), $data, NULL, 'ELIMINO UNA AULA DE LA GESTIONDE  AULAS');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }

    public function agregarAlumnos(Request $request) {
        $id = $request->id;
        $alumnos = UsuariosRoles::where('rol_id',2)->get();
        LogActividades::guardar(Auth()->user()->id, 2, 'FORMULARIO DE AGREGAR PARTICIPANTES', null, null, null, 'INGRESO AL FORMULARIO DE AGREGAR PARTICIPANTES');
        return view('components.academico.aulas.agregar-alumnos', get_defined_vars());
    }
    public function guardarAlumnos(Request $request) {
        $alumnos = AulasDescripcion::where('aula_id',$request->aula_id)->get();
        $array_id = array();
        foreach ($alumnos as $key => $value) {
            array_push($array_id,$value->aula_id);
        }
        AulasDescripcion::where('aula_id',$request->aula_id)->whereNotIn('aula_id', $array_id)->delete();
        foreach ($request->usuarios as $key => $value) {
            // return $value;exit;
            // AulasDescripcion::where('alumno_id', (int) $value)->where('aula_id',$request->aula_id)->restore();

            $data = AulasDescripcion::firstOrNew(['alumno_id' => (int) $value,'aula_id'=>$request->aula_id]);
            $data->reserva          = true;
            $data->aula_id          = $request->aula_id;
            $data->alumno_id        = (int) $value;
            $data->fecha_registro   = date('Y-m-d H:i:s');
            $data->created_at       = date('Y-m-d H:i:s');
            $data->created_id       = Auth()->user()->id;
            $data->save();
            LogActividades::guardar(Auth()->user()->id, 3, 'REGISTRO UN ALUMNO', $data->getTable(), NULL, $data, 'SE AGREGO UN ALUMNO AL AULA');
        }

        
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }

    public function listardarAlumnos() {
        $data = AulasDescripcion::all();
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
        ->addColumn('reservacion', function ($data) { 
            return '<span class="badge bg-'.($data->reserva==1?'warning':'success').'-transparent rounded-pill text-'.($data->reserva==1?'warning':'success').' p-2 px-3">'.($data->reserva==1?'Reservado':'Confirmado').'</span>';
        })
        ->addColumn('accion', function ($data) { return
            '<div class="btn-list">
                '.($data->reserva==1?'<button type="button" class="confirmar protip btn text-success btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Confirmar" >
                    <i class="fe fe-check-circle fs-14"></i>
                </button>':'success').'
                
                <button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>
                
            </div>';
        })->rawColumns(['reservacion','accion'])->make(true);
    }
    public function eliminarAlumno($id) {
        $data = AulasDescripcion::find($id);
        $data->deleted_id   = Auth()->user()->id;
        $data->save();
        $data->delete();
        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINACION DE ALUMNO', $data->getTable(), $data, NULL, 'ELIMINO UN ALUMNO');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }
    public function confirmarAlumno($id) {
        $data = AulasDescripcion::find($id);
        $data->reserva   = 0;
        $data->save();
        LogActividades::guardar(Auth()->user()->id, 4, 'LISTA DE ALUMNOS', $data->getTable(), $data, NULL, 'SE CONFIRMO LA PARTICIPACION DE UN ALUMNO AL CURSO');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se confirmo con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }
}
