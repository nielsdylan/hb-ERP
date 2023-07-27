<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Alumnos;
use App\Models\LogActividades;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AlumnosController extends Controller
{
    //
    public function lista()
    {
        // $moneda = Alum::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $nivel = Nivel::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $tipo_habitacion = TipoHabitacion::where('empresa_id',Auth()->user()->empresa_id)->get();
        // $estado = HabitacionEstado::where('empresa_id',Auth()->user()->empresa_id)->get();
        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE HABITACIONES', null, null, null, 'INGRESO A LA LISTA DE TIPO DE HABITACIONES');
        return view('components.alumnos.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = Alumnos::all();
        return DataTables::of($data)
        // ->addColumn('fecha', function ($data) { 
        //     return date("d/m/Y", strtotime($data->fecha_registro));
        // })
        // ->addColumn('estado', function ($data) { 
        //     return '<span class="badge '.$data->estado->color.'">'.$data->estado->descripcion.'</span>';
        // })
        // ->addColumn('nivel', function ($data) { 
        //     return $data->nivel->descripcion;
        // })
        // ->addColumn('tipo_habitacion', function ($data) { 
        //     return $data->tipoHabitacion->descripcion;
        // })
        // ->addColumn('total', function ($data) { 
        //     return $data->moneda->simbolo.''.$data->precio;
        // })
        ->addColumn('accion', function ($data) { return
            '<div class="btn-list">
                <button type="button" class="btn btn-sm editar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar">
                    <i class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn btn-sm eliminar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fa fa-trash"></i>
                </button>
                
            </div>';
        })->rawColumns(['accion','estado'])->make(true);
    }
    function guardar(Request $request) {
        try {
            $data = Alumnos::firstOrNew(['id' => $request->id]);
                $data->nombre                   = $request->nombre;
                $data->descripcion              = $request->descripcion;
                $data->precio                   = $request->precio;
                $data->nivel_id                 = $request->nivel_id;
                $data->habitacion_estado_id     = $request->habitacion_estado_id;
                $data->tipo_habitacion_id     = $request->tipo_habitacion_id;
                $data->moneda_id     = $request->moneda_id;
                $data->empresa_id               = Auth()->user()->empresa_id;

                if ((int) $request->id == 0) {
                    $data->fecha_registro       = date('Y-m-d H:i:s');
                    $data->created_at           = date('Y-m-d H:i:s');
                    $data->created_id           = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 3, 'INGRESO UNA NUEVA HABITACION', $data->getTable(), NULL, $data, 'SE A CREADO UN NUEVO REGISTRO ');
                }else{
                    $data_old=Alumnos::find($request->id);
                    $data->updated_at   = date('Y-m-d H:i:s');
                    $data->updated_id   = Auth()->user()->id;
                    $data->save();
                    LogActividades::guardar(Auth()->user()->id, 4, 'MODIFICO UNA HABITACION', $data->getTable(), $data_old, $data, 'SE A MODIFICADO UN REGISTRO');
                }
            
            $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se guardo con éxito","tipo"=>"success");
        } catch (Exception $ex) {
            $respuesta = array("titulo"=>"Error","mensaje"=>"Hubo un problema al registrar. Por favor intente de nuevo, si persiste comunicarse con su area de TI","tipo"=>"error","ex"=>$ex);
        }
        return response()->json($respuesta,200);
    }
    function editar($id) {
        $data = Alumnos::find($id);
        LogActividades::guardar(Auth()->user()->id, 6, 'SELECCIONO UN TIPO DE HABITACION', $data->getTable(), $data, NULL, 'SELECCIONO UN REGISTRO PARA MODIFICARLO');
        return response()->json($data,200);
    }
    function eliminar($id) {
        $data = Alumnos::find($id);
        $data->deleted_id   = Auth()->user()->id;
        $data->save();
        $data->delete();
        LogActividades::guardar(Auth()->user()->id, 5, 'ELIMINO UNA HABITACION', $data->getTable(), $data, NULL, 'ELIMINO UN REGISTRO');
        $respuesta = array("titulo"=>"Éxito","mensaje"=>"Se elimino con éxito","tipo"=>"success");
        return response()->json($respuesta,200);
    }
}
