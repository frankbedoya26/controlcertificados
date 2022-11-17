<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NuevaSolicitudController;

use App\Http\Controllers\RegistralumnoController;

use App\Http\Controllers\ListacertificadoController;
use App\Http\Controllers\ReporteController;

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

Route::get('/',[NuevaSolicitudController::class,'index1']);

Route::get('/listacertificado',[ListacertificadoController::class,'index1']);
Route::resource('listcert',ListacertificadoController::class);
Route::get('/fecha/actual',[ListacertificadoController::class,'getfecha']);

Route::get('/registralumno',[RegistralumnoController::class,'index1']);
Route::resource('regalumn',RegistralumnoController::class);


Route::get('/nuevasolicitud',[NuevaSolicitudController::class,'index1']);
Route::resource('nuevasol',NuevaSolicitudController::class);


Route::get('/semestres/{cod}/{tipo}/alumno',[NuevaSolicitudController::class,'getsemestre']);

Route::get('/reporte',[ReporteController::class,'index1']);
Route::resource('report',ReporteController::class);
Route::post('/reporte/mostrar',[ReporteController::class,'mostrareporte'])->name('mostrareporte');


