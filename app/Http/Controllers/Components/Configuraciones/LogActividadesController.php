<?php

namespace App\Http\Controllers\Components\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\LogActividades;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogActividadesController extends Controller
{
    //
    public function lista() {
        LogActividades::guardar(Auth()->user()->id, 1, 'GESTION DE ACTIVIADES', null, null, null, 'INGRESO A LA LISTA DE ACTIVIDADES DEL SISTEMA');

        // return $empresas;exit;
        return view('components.configuraciones.log_activiades.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = LogActividades::where('estado',1)->get();
        return DataTables::of($data)
        ->addColumn('usuario', function ($data) { 
            return $data->usuario->nombre_corto;
        })
        ->addColumn('tipo_actividad', function ($data) { 
            return $data->tipoActividades->descripcion;
        })
        ->addColumn('accion', function ($data) { return
            '<div class="btn-list">
                <button type="button" class="ver protip btn text-info btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Ver actividades" >
                    <i class="fe fe-eye fs-14"></i>
                </button>                
            </div>';
        })->rawColumns(['accion'])->make(true);
    }
    public function ver(Request $request) {
        LogActividades::guardar(Auth()->user()->id, 1, 'GESTION DE VER', null, null, null, 'INGRESO A VER ACTIVIDADES DEL SISTEMA');
        $actividad = LogActividades::find($request->id);
        // return $actividad;exit;
        return view('components.configuraciones.log_activiades.ver', get_defined_vars());
    }
}
