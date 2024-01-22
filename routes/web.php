<?php

use App\Http\Controllers\Components\Academico\AlumnosController;
use App\Http\Controllers\Components\Academico\AsignaturaController;
use App\Http\Controllers\Components\Academico\AulasController;
use App\Http\Controllers\Components\Academico\CertificadoController;
use App\Http\Controllers\Components\Academico\CuestionarioController;
use App\Http\Controllers\Components\Academico\CursosController;
use App\Http\Controllers\Components\Academico\DocentesController;
use App\Http\Controllers\Components\Academico\ExamenController;
use App\Http\Controllers\Components\Academico\PortafolioController;
use App\Http\Controllers\Components\Auth\LoginController;
use App\Http\Controllers\Components\Configuraciones\AccesosController;
use App\Http\Controllers\Components\Configuraciones\AccionesController;
use App\Http\Controllers\Components\Configuraciones\ConfiguracionesController;
use App\Http\Controllers\Components\Configuraciones\LogActividadesController;
use App\Http\Controllers\Components\DashboardController;
use App\Http\Controllers\Components\EmpresasController;
use App\Http\Controllers\Components\Configuraciones\TipoDocumentosController;
use App\Http\Controllers\Components\Configuraciones\TipoMonedasController;
use App\Http\Controllers\Components\Configuraciones\UsuariosController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Redirect;
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

/*
* rutas para la landing de hb group peru
*/
Route::get('/',[HomeController::class,'inicio'])->name('inicio');
Route::get('nosotros',[HomeController::class,'nosotros'])->name('nosotros');
Route::get('servicios',[HomeController::class,'servicios'])->name('servicios');
Route::get('contacto',[HomeController::class,'contacto'])->name('contacto');
Route::get('certificado',[HomeController::class,'certificado'])->name('certificado');
Route::get('calendario',[HomeController::class,'calendario'])->name('calendario');

Route::post('buscar-certificado',[HomeController::class,'buscarCertificado'])->name('buscar-certificado');
Route::get('exportar-certificado-pdf/{id}',[HomeController::class,'exportarCertificadoPDF'])->name('exportar-certificado-pdf');
Route::get('exportar-certificado-pdf-vista/{id}',[HomeController::class,'exportarCertificadoPDFVista'])->name('exportar-certificado-pdf-vista');

Route::name('link.')->prefix('link')->group(function () {
    Route::get('cuestionario/{codigo}',[HomeController::class,'cuestionario'])->name('cuestionario');
    Route::get('obtener-cuestionario/{id}',[HomeController::class,'obtenerCuestionario'])->name('obtener-cuestionario');
    Route::post('guardar-cuestionario',[HomeController::class,'guardarCuestionario'])->name('guardar-cuestionario');
});
/*
* rutas para el erp educativo de hb group peru
*/
Route::middleware(['guest'])->group(function () {
    Route::get('login',[LoginController::class,'viewLogin'])->name('login');
    Route::post('login',[LoginController::class,'login']);
});

Route::middleware(['auth'])->name('hb.')->prefix('hb')->group(function () {
    Route::get('logout',[LoginController::class,'logout'])->name('logout');
    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

    Route::name('academicos.')->prefix('academicos')->group(function () {

        Route::name('alumnos.')->prefix('alumnos')->group(function () {

            Route::get('lista', [AlumnosController::class, 'lista'])->name('lista');
            Route::post('listar', [AlumnosController::class, 'listar'])->name('listar');
            Route::post('guardar', [AlumnosController::class, 'guardar'])->name('guardar');
            Route::post('formulario', [AlumnosController::class, 'formulario'])->name('formulario');
            Route::get('editar/{id}', [AlumnosController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [AlumnosController::class, 'eliminar'])->name('eliminar');

            Route::post('buscar', [AlumnosController::class, 'buscar'])->name('buscar');
            Route::get('modelo-importar-alumnos-excel', [AlumnosController::class, 'modeloImportarAlumnosExport'])->name('modelo-importar-alumnos-excel');
            Route::post('importar-alumnos-excel', [AlumnosController::class, 'importarAlumnosExport'])->name('importar-alumnos-excel');
        });

        Route::name('docentes.')->prefix('docentes')->group(function () {

            Route::get('lista', [DocentesController::class, 'lista'])->name('lista');
            Route::post('listar', [DocentesController::class, 'listar'])->name('listar');
            Route::post('formulario', [DocentesController::class, 'formulario'])->name('formulario');
            Route::post('guardar', [DocentesController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [DocentesController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [DocentesController::class, 'eliminar'])->name('eliminar');

            Route::post('buscar', [DocentesController::class, 'buscar'])->name('buscar');
            // Route::get('modelo-importar-alumnos-excel', [DocentesController::class, 'modeloImportarAlumnosExport'])->name('modelo-importar-alumnos-excel');
            // Route::post('importar-alumnos-excel', [DocentesController::class, 'importarAlumnosExport'])->name('importar-alumnos-excel');
        });

        Route::name('asignaturas.')->prefix('asignaturas')->group(function () {

            Route::get('lista', [AsignaturaController::class, 'lista'])->name('lista');
            Route::post('listar', [AsignaturaController::class, 'listar'])->name('listar');
            Route::post('formulario', [AsignaturaController::class, 'formulario'])->name('formulario');
            Route::post('guardar', [AsignaturaController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [AsignaturaController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [AsignaturaController::class, 'eliminar'])->name('eliminar');

            Route::post('buscar', [AsignaturaController::class, 'buscar'])->name('buscar');
        });

        Route::name('cursos.')->prefix('cursos')->group(function () {

            Route::get('lista', [CursosController::class, 'lista'])->name('lista');
            Route::post('listar', [CursosController::class, 'listar'])->name('listar');
            Route::post('formulario', [CursosController::class, 'formulario'])->name('formulario');
            Route::post('guardar', [CursosController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [CursosController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [CursosController::class, 'eliminar'])->name('eliminar');

            Route::post('buscar', [CursosController::class, 'buscar'])->name('buscar');
            Route::get('modelo-importar-alumnos-excel', [CursosController::class, 'modeloImportarAlumnosExport'])->name('modelo-importar-alumnos-excel');
            Route::post('importar-alumnos-excel', [CursosController::class, 'importarAlumnosExport'])->name('importar-alumnos-excel');

            Route::get('listar-cursos/{asignatura_id}', [CursosController::class, 'listarCursos'])->name('listar-cursos');
        });

        Route::name('aulas.')->prefix('aulas')->group(function () {

            Route::get('lista', [AulasController::class, 'lista'])->name('lista');
            // Route::post('listar', [AulasController::class, 'listar'])->name('listar');
            Route::post('formulario', [AulasController::class, 'formulario'])->name('formulario');

            Route::post('guardar', [AulasController::class, 'guardar'])->name('guardar');
            Route::put('eliminar/{id}', [AulasController::class, 'eliminar'])->name('eliminar');

            Route::get('portafolio/{id}', [AulasController::class, 'portafolio'])->name('portafolio');
            Route::post('agregar-alumnos', [AulasController::class, 'agregarAlumnos'])->name('agregar-alumnos');
            Route::post('guardar-alumnos', [AulasController::class, 'guardarAlumnos'])->name('guardar-alumnos');
            Route::post('listar-alumnos', [AulasController::class, 'listardarAlumnos'])->name('listar-alumnos');
            Route::put('eliminar-alumno/{id}', [AulasController::class, 'eliminarAlumno'])->name('eliminar-alumno');
            Route::get('confirmar-alumno/{id}', [AulasController::class, 'confirmarAlumno'])->name('confirmar-alumno');

            Route::post('listar-asistencia', [AulasController::class, 'listarAsistencia'])->name('listar-asistencia');
            Route::post('buscar-codigo-aula', [AulasController::class, 'buscarCodigoAula'])->name('buscar-codigo-aula');
            // Route::get('modelo-importar-alumnos-excel', [CursosController::class, 'modeloImportarAlumnosExport'])->name('modelo-importar-alumnos-excel');
            // Route::post('importar-alumnos-excel', [CursosController::class, 'importarAlumnosExport'])->name('importar-alumnos-excel');
            Route::post('asistencia', [AulasController::class, 'asistencia'])->name('asistencia');
            Route::get('ingreso-confirmar/{id}', [AulasController::class, 'ingresoConfirmar'])->name('ingreso-confirmar');
            Route::get('abandono-confirmar/{id}', [AulasController::class, 'abandonoConfirmar'])->name('abandono-confirmar');

            Route::get('descargar-asistencia/{id}', [AulasController::class, 'descargarAsistencia'])->name('descargar-asistencia');
            Route::get('reporte-asistencia/{id}', [AulasController::class, 'reporteAsistencia'])->name('reporte-asistencia');
        });
        Route::name('cuestionario.')->prefix('cuestionario')->group(function () {
            Route::get('lista',[CuestionarioController::class,'lista'])->name('lista');
            Route::post('listar',[CuestionarioController::class,'listar'])->name('listar');
            Route::get('formulario',[CuestionarioController::class,'formulario'])->name('formulario');
            Route::get('formulario/{id}',[CuestionarioController::class,'formulario'])->name('formulario-editar');
            Route::post('guardar',[CuestionarioController::class,'guardar'])->name('guardar');
            Route::put('eliminar/{id}',[CuestionarioController::class,'eliminar'])->name('eliminar');
            Route::get('obtener-cuestionario/{id}',[CuestionarioController::class,'obtenerCuestionario'])->name('obtener-cuestionario');
            Route::get('link/{id}',[CuestionarioController::class,'link'])->name('link');

            Route::get('resultados/{id}',[CuestionarioController::class,'resultados'])->name('resultados');
            Route::post('resultados-listar',[CuestionarioController::class,'resultadosListar'])->name('resultados-listar');
            Route::get('resultados-ver/{id}',[CuestionarioController::class,'resultadosVer'])->name('resultados-ver');
        });
        Route::name('certificados.')->prefix('certificados')->group(function () {

            Route::get('lista', [CertificadoController::class, 'lista'])->name('lista');
            Route::post('listar', [CertificadoController::class, 'listar'])->name('listar');
            Route::post('formulario', [CertificadoController::class, 'formulario'])->name('formulario');
            Route::post('guardar', [CertificadoController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [CertificadoController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [CertificadoController::class, 'eliminar'])->name('eliminar');

            Route::post('buscar-codigo', [CertificadoController::class, 'buscarCodigo'])->name('buscar-codigo');
            Route::post('importar-certificados-excel', [CertificadoController::class, 'importarCertificadosExcel'])->name('importar-certificados-excel');
            Route::get('certificado-modelo-excel', [CertificadoController::class, 'certificadoModeloExcel'])->name('certificado-modelo-excel');
            Route::get('exportar-pdf/{id}', [CertificadoController::class, 'exportarPDF'])->name('exportar-pdf');
            Route::get('exportar-pdf/{id}/{masivo}', [CertificadoController::class, 'exportarPDF'])->name('exportar-pdf-masivo');
            Route::get('alumnos-certidicado-masivo', [CertificadoController::class, 'alumnosCertidicadoMasivo'])->name('alumnos-certidicado-masivo');
            Route::get('ver/{id}', [CertificadoController::class, 'ver'])->name('ver');
            // Route::post('importar-alumnos-excel', [AlumnosController::class, 'importarAlumnosExport'])->name('importar-alumnos-excel');
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
        Route::get('dashboard', [ConfiguracionesController::class, 'dashboard'])->name('dashboard');

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
            Route::post('formulario', [UsuariosController::class, 'formulario'])->name('formulario');
            Route::post('guardar', [UsuariosController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [UsuariosController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [UsuariosController::class, 'eliminar'])->name('eliminar');

            Route::post('asignar-accesos', [UsuariosController::class, 'asignarAccesos'])->name('asignar-accesos');
            Route::get('buscar-sub-menu/{id}', [UsuariosController::class, 'buscarSubMenu'])->name('buscar-sub-menu');
            Route::get('buscar-accesos/{id}/{usuario_id}', [UsuariosController::class, 'buscarAccesos'])->name('buscar-accesos');
            Route::post('guardar-accesos', [UsuariosController::class, 'guardarAccesos'])->name('guardar-accesos');
            Route::post('buscar-usuario', [UsuariosController::class, 'buscarUsuario'])->name('buscar-usuario');

            Route::post('cambiar-contrasena',[UsuariosController::class,'cambiarContrasena'])->name('cambiar-contrasena');
        });

        Route::name('accesos.')->prefix('accesos')->group(function () {

            Route::get('lista', [AccesosController::class, 'lista'])->name('lista');
            Route::post('listar', [AccesosController::class, 'listar'])->name('listar');
            Route::post('guardar', [AccesosController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [AccesosController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [AccesosController::class, 'eliminar'])->name('eliminar');

        });
        Route::name('log-actividades.')->prefix('log-actividades')->group(function () {

            Route::get('lista', [LogActividadesController::class, 'lista'])->name('lista');
            Route::post('listar', [LogActividadesController::class, 'listar'])->name('listar');
            Route::post('ver', [LogActividadesController::class, 'ver'])->name('ver');
            // Route::post('guardar', [AccesosController::class, 'guardar'])->name('guardar');
            // Route::get('editar/{id}', [AccesosController::class, 'editar'])->name('editar');
            // Route::put('eliminar/{id}', [AccesosController::class, 'eliminar'])->name('eliminar');

        });
    });
});

// --fin----
