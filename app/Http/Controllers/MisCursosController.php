<?php

namespace App\Http\Controllers;

use App\Models\Aulas;
use Illuminate\Http\Request;

class MisCursosController extends Controller
{
    //
    public function lista() {

        $aulas = Aulas::orderBy('id', 'desc')->paginate(12);
        // return $aulas;
        return view('components.mis-cursos.lista', get_defined_vars());
    }
    public function curso($codigo) {
        $aula = Aulas::where('codigo',$codigo)->first();
        return view('components.mis-cursos.curso', get_defined_vars());
    }
}
