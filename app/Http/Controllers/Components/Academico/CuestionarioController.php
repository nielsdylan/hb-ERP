<?php

namespace App\Http\Controllers\Components\Academico;

use App\Http\Controllers\Controller;
use App\Models\Cuestionario;
use App\Models\LogActividades;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CuestionarioController extends Controller
{
    //
    public function lista()
    {
        LogActividades::guardar(Auth()->user()->id, 1, 'LISTADO DE EXAMENES', null, null, null, 'INGRESO A LA LISTA DE EXAMENES');
        return view('components.academico.cuestionario.lista', get_defined_vars());
    }
    public function listar()
    {
        $data = Cuestionario::where('estado',1)->get();
        return DataTables::of($data)
        ->addColumn('accion', function ($data) {
            return
            '<div class="btn-list">
                <button type="button" class="editar protip btn text-warning btn-sm" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Editar" >
                    <i class="fe fe-edit fs-14"></i>
                </button>
                <button type="button" class="btn text-danger btn-sm eliminar protip" data-id="'.$data->id.'" data-pt-scheme="dark" data-pt-size="small" data-pt-position="top" data-pt-title="Eliminar">
                    <i class="fe fe-trash-2 fs-14"></i>
                </button>
            </div>';
        })->rawColumns(['accion'])->make(true);
    }
    public function formulario($id=0)
    {
        $tipo = 'Nuevo Cuestionario';
        $data = array();

        if ( (int) $id > 0 ) {
            $tipo = 'Editar Cuestionario';
            $data = Cuestionario::find($id);
        }
        // return $tipo;
        LogActividades::guardar(Auth()->user()->id, 1, $tipo, null, null, null, 'INGRESO AL FORMULARIO DE CUESTIONARIO');
        return view('components.academico.cuestionario.formulario', get_defined_vars());
    }
}
