<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Fiscal\FiscalController;
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\CentroController;
use App\Http\Controllers\Admin\PartidoController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=> 'administrador','namespace' => 'Admin', 'middleware'=>['auth','referrer']], function (){
    Route::get('admin',[AdminController::class,'index'])->name('menuAdmin');

    Route::get('usuario',[UsuarioController::class,'index'])->name('usuarios');
    Route::get('usuario/crear',[UsuarioController::class,'create'])->name('usuarios.crear');
    Route::post('usuario',[UsuarioController::class,'store'])->name('usuarios.guardar');
    Route::get('usuario/{id}/editar',[UsuarioController::class,'edit'])->name('usuarios.editar');
    Route::put('usuario/{id}',[UsuarioController::class,'update'])->name('usuarios.actualizar');
    Route::get('usuario/{id}/eliminar',[UsuarioController::class,'destroy'])->name('usuarios.eliminar');

    Route::get('centro',[CentroController::class,'index'])->name('centros');
    Route::get('centro/crear',[CentroController::class,'create'])->name('centros.crear');
    Route::post('centro',[CentroController::class,'store'])->name('centros.guardar');
    Route::get('centro/{id}/editar',[CentroController::class,'edit'])->name('centros.editar');
    Route::put('centro/{id}',[CentroController::class,'update'])->name('centros.actualizar');
    Route::get('centro/{id}/eliminar',[CentroController::class,'destroy'])->name('centros.eliminar');

    Route::get('partido',[PartidoController::class,'index'])->name('partidos');
    Route::get('partido/crear',[PartidoController::class,'create'])->name('partidos.crear');
    Route::post('partido',[PartidoController::class,'store'])->name('partidos.guardar');
    Route::get('partido/{id}/editar',[PartidoController::class,'edit'])->name('partidos.editar');
    Route::put('partido/{id}',[PartidoController::class,'update'])->name('partidos.actualizar');
    Route::get('partido/{id}/eliminar',[PartidoController::class,'destroy'])->name('partidos.eliminar');

});

Route::group(['prefix'=> 'fiscal','namespace' => 'Fiscal', 'middleware'=>['auth','referrer']], function (){
    Route::get('fiscal',[FiscalController::class,'index'])->name('menuFiscal');

    Route::get('mesa',[FiscalController::class,'mesa'])->name('mesa');
    Route::post('mesa',[FiscalController::class,'aperturar'])->name('mesa.aperturar');
    Route::get('cerrar',[FiscalController::class,'fotos'])->name('mesa.fotos');
    Route::post('cerrar',[FiscalController::class,'cerrar'])->name('mesa.cerrar');
    Route::get('impugnar',[FiscalController::class,'impugnar'])->name('mesa.impugnar');
    Route::post('impugnar',[FiscalController::class,'storeImpugnar'])->name('mesa.guardarImpugnacion');
    Route::get('presidente',[FiscalController::class,'presidente'])->name('presidente');
    Route::post('presidente',[FiscalController::class,'store'])->name('presidente.guardar');
    Route::get('diputado',[FiscalController::class,'diputado'])->name('diputado');
    Route::post('diputado',[FiscalController::class,'store'])->name('diputado.guardar');
    Route::get('alcalde',[FiscalController::class,'alcalde'])->name('alcalde');
    Route::post('alcalde',[FiscalController::class,'store'])->name('alcalde.guardar');
});

Route::group(['prefix'=> 'supervisor','namespace' => 'Supervisor', 'middleware'=>['auth','referrer']], function (){
    Route::get('supervisor',[SupervisorController::class,'index'])->name('menuSuper');


});


