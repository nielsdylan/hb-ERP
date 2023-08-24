<?php

namespace App\Http\Controllers\Components\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\LogActividades;
use Illuminate\Http\Request;

class ConfiguracionesController extends Controller
{
    //
    public function dashboard() {
        LogActividades::guardar(Auth()->user()->id, 1, 'DASHBOARD DE CONFIGURACIONES', null, null, null, 'INGRESO AL DASHBOARD DE CONFIGURACIONES PARA VER LOS INDICADORES');
        return view('components.configuraciones.dashboard', get_defined_vars());
    }
}
