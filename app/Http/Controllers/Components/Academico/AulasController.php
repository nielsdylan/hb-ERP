<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Aulas;
use App\Models\Cursos;
use App\Models\LogActividades;
use Exception;
use Illuminate\Http\Request;

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
        LogActividades::guardar(Auth()->user()->id, 2, 'FORMULARIO DE AULA', null, null, null, 'INGRESO AL FORMULARIO DE AULA');
        return view('components.academico.aulas.formulario', get_defined_vars());
    }
    public function guardar(Request $request) {
        // try {
                $data = Aulas::firstOrNew(['id' => $request->id]);
                $data->nombre      = $request->nombre;
                $data->descripcion      = $request->descripcion;
                $data->capacidad      = $request->capacidad;
                $data->fecha      =  date("Y-m-d", strtotime($request->fechae)) ;
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
    public function agregarParticipantes(Request $request) {
        $id = $request->id;
        LogActividades::guardar(Auth()->user()->id, 2, 'FORMULARIO DE AGREGAR PARTICIPANTES', null, null, null, 'INGRESO AL FORMULARIO DE AGREGAR PARTICIPANTES');
        return view('components.academico.aulas.agregar-participantes', get_defined_vars());
    }
}
