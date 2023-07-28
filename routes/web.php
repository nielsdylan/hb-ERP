<?php

use App\Http\Controllers\Components\Academico\AlumnosController;
use App\Http\Controllers\Components\Auth\LoginController;
use App\Http\Controllers\Components\DashboardController;
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
            Route::post('formulario', [AlumnosController::class, 'formulario'])->name('formulario');
            Route::post('guardar', [AlumnosController::class, 'guardar'])->name('guardar');
            Route::get('editar/{id}', [AlumnosController::class, 'editar'])->name('editar');
            Route::put('eliminar/{id}', [AlumnosController::class, 'eliminar'])->name('eliminar');
        });
    });
});