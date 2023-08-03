<?php

use App\Http\Controllers\Components\Academico\AlumnosController;
use App\Http\Controllers\Components\Academico\CursosController;
use App\Http\Controllers\Components\Academico\DocentesController;
use App\Http\Controllers\Components\Auth\LoginController;
use App\Http\Controllers\Components\DashboardController;
use App\Http\Controllers\Components\EmpresasController;
use App\Http\Controllers\Components\Configuraciones\TipoDocumentosController;
use App\Http\Controllers\Components\Configuraciones\TipoMonedasController;
use App\Http\Controllers\Components\Configuraciones\UsuariosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('login',[LoginController::class,'viewLogin'])->name('login');
    Route::post('login',[LoginController::class,'login']);
});

Route::middleware(['auth'])->name('hb.')->prefix('hb')->group(function () {
    Route::get('logout',[LoginController::class,'logout'])->name('logout');
    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard')->middleware('auth');

    Route::name('academicos.')->prefix('academicos')->group(function () {

        Route::name('alumnos.')->prefix('alumnos')->group(function () {

            Route::get('lista', [AlumnosController::class, 'lista'])->name('lista');
            Route::post('listar', [AlumnosController::class, 'listar'])->name('listar');
            // Route::post('formulario', [AlumnosController::class, 'formulario'])->name('formulario');
            Route::post('guardar', [AlumnosController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [AlumnosController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [AlumnosController::class, 'eliminar'])->name('eliminar');

            Route::post('buscar', [AlumnosController::class, 'buscar'])->name('buscar');
            Route::get('modelo-importar-alumnos-excel', [AlumnosController::class, 'modeloImportarAlumnosExport'])->name('modelo-importar-alumnos-excel');
            Route::post('importar-alumnos-excel', [AlumnosController::class, 'importarAlumnosExport'])->name('importar-alumnos-excel');
        });

        Route::name('docentes.')->prefix('docentes')->group(function () {

            Route::get('lista', [DocentesController::class, 'lista'])->name('lista');
            Route::post('listar', [DocentesController::class, 'listar'])->name('listar');
            // Route::post('formulario', [DocentesController::class, 'formulario'])->name('formulario');
            Route::post('guardar', [DocentesController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [DocentesController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [DocentesController::class, 'eliminar'])->name('eliminar');

            Route::post('buscar', [DocentesController::class, 'buscar'])->name('buscar');
            // Route::get('modelo-importar-alumnos-excel', [DocentesController::class, 'modeloImportarAlumnosExport'])->name('modelo-importar-alumnos-excel');
            // Route::post('importar-alumnos-excel', [DocentesController::class, 'importarAlumnosExport'])->name('importar-alumnos-excel');
        });

        Route::name('cursos.')->prefix('cursos')->group(function () {

            Route::get('lista', [CursosController::class, 'lista'])->name('lista');
            Route::post('listar', [CursosController::class, 'listar'])->name('listar');
            // Route::post('formulario', [AlumnosController::class, 'formulario'])->name('formulario');
            Route::post('guardar', [CursosController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [CursosController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [CursosController::class, 'eliminar'])->name('eliminar');

            Route::post('buscar', [CursosController::class, 'buscar'])->name('buscar');
            Route::get('modelo-importar-alumnos-excel', [CursosController::class, 'modeloImportarAlumnosExport'])->name('modelo-importar-alumnos-excel');
            Route::post('importar-alumnos-excel', [CursosController::class, 'importarAlumnosExport'])->name('importar-alumnos-excel');
        });
    });
    Route::name('empresas.')->prefix('empresas')->group(function () {

        Route::get('lista', [EmpresasController::class, 'lista'])->name('lista');
        Route::post('listar', [EmpresasController::class, 'listar'])->name('listar');
        Route::post('formulario', [EmpresasController::class, 'formulario'])->name('formulario');
        Route::post('guardar', [EmpresasController::class, 'guardar'])->name('guardar');
        Route::get('editar/{id}', [EmpresasController::class, 'editar'])->name('editar');
        Route::put('eliminar/{id}', [EmpresasController::class, 'eliminar'])->name('eliminar');

        Route::post('buscar', [EmpresasController::class, 'buscar'])->name('buscar');
    });
    Route::name('configuraciones.')->prefix('configuraciones')->group(function () {
        Route::name('tipo-documentos.')->prefix('tipo-documentos')->group(function () {

            Route::get('lista', [TipoDocumentosController::class, 'lista'])->name('lista');
            Route::post('listar', [TipoDocumentosController::class, 'listar'])->name('listar');
            Route::post('guardar', [TipoDocumentosController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [TipoDocumentosController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [TipoDocumentosController::class, 'eliminar'])->name('eliminar');

        });
        Route::name('tipo-monedas.')->prefix('tipo-monedas')->group(function () {

            Route::get('lista', [TipoMonedasController::class, 'lista'])->name('lista');
            Route::post('listar', [TipoMonedasController::class, 'listar'])->name('listar');
            Route::post('guardar', [TipoMonedasController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [TipoMonedasController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [TipoMonedasController::class, 'eliminar'])->name('eliminar');

        });
        Route::name('usuarios.')->prefix('usuarios')->group(function () {

            Route::get('lista', [UsuariosController::class, 'lista'])->name('lista');
            Route::post('listar', [UsuariosController::class, 'listar'])->name('listar');
            Route::post('guardar', [UsuariosController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [UsuariosController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [UsuariosController::class, 'eliminar'])->name('eliminar');

        });
    });
});