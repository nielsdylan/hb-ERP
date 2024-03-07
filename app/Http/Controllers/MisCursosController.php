<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Aulas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MisCursosController extends Controller
{
    //
    public function lista() {

        $aulas = Asistencia::where('alumno_id',Auth::user()->id)->get();
        // $aulas = Aulas::orderBy('id', 'desc')->paginate(12);
        // return $aulas;
        return view('components.mis-cursos.lista', get_defined_vars());
    }
    public function curso($codigo) {
        $aula = Aulas::where('codigo',$codigo)->first();
        return view('components.mis-cursos.curso', get_defined_vars());
    }
}
