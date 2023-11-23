<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function inicio(){
        return view('web.inicio', get_defined_vars());
    }
    public function nosotros(){
        return view('web.nosotros', get_defined_vars());
    }
    public function servicios(){
        return view('web.servicios', get_defined_vars());
    }
    public function contacto(){
        return view('web.contacto', get_defined_vars());
    }
    public function certificado(){
        return view('web.certificado', get_defined_vars());
    }
    public function calendario(){
        return view('web.calendario', get_defined_vars());
    }
}
