<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Aulas;
use App\Models\Cuestionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MisCursosController extends Controller
{
    //
    public function lista() {

        $aulas = Asistencia::where('alumno_id',Auth::user()->id)->paginate(12);

        return view('components.mis-cursos.lista', get_defined_vars());
    }
    public function curso($codigo) {
        $aula = Aulas::where('codigo',$codigo)->first();
        return view('components.mis-cursos.curso', get_defined_vars());
    }
    public function cuestionario($id){
        $cuestionario = Cuestionario::find($id);
        // return $cuestionario;
        return view('components.mis-cursos.cuestionario', get_defined_vars());
    }
    public function guardarCuestionario(Request $reques) {
        return ;response()->json(["data"=>$reques->all()],200);
    }
}
