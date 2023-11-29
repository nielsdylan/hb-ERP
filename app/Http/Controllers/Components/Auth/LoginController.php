<?php

namespace App\Http\Controllers\Components\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\Config\Exception\ValidationException;

class LoginController extends Controller
{
    //
    public function viewLogin() {
        return view('components.auth.login');
    }
    public function login(Request $request) {

        // $credenciales = request()->only('email','password');
        // $credenciales = request()->validate();
        $usuario = User::where('nro_documento',$request->email)->first();
        if (!$usuario) {
            $usuario = User::where('email',$request->email)->first();
            if (!$usuario) {
                return redirect('login')->with('status','Credenciales incorrectas');
            }

        }

        // $remember = request()->filled('remember');
        // if (Auth::attempt($request->only('email','password'),$remember)) {
        //     request()->session()->regenerate();
        //     return redirect()->intended('hb/dashboard');
        // }

        if (Hash::check($request->password, $usuario->password)) {
            Auth::login($usuario);
            request()->session()->regenerate();
            return redirect()->intended('hb/dashboard');
        }
        return redirect('login')->with('status','Credenciales incorrectas');
    }
    function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // return redirect()->route('login');
        return redirect('login')->with('status','Usted a cerrado sesión');
    }
}
