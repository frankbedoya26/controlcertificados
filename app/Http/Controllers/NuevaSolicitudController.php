<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NuevaSolicitud;
use DB;

class NuevaSolicitudController extends Controller{
	public function index1(){
		return view('nuevasolicitud.index');
	}
	public function index(Request $request){
        $buscar=$request->bus;
        $tipo=$request->tipo;
        $alumno=[];
        if ($tipo=="Cacip") {
            $alumno=DB::table('dbo.v_alumcacip')->where(function($query) use ($buscar){
                $query->where('Alumno','=',$buscar);
                $query->orWhere('NombreCompleto','like','%'.$buscar.'%');
                $query->orWhere('Dni','=',$buscar);
            })->get();
        }
        if ($tipo=="Posgrado" || $tipo=="Pregrado") {
            $alumno=DB::table('dbo.v_alumnoprograma')->where(function($query) use ($buscar){
                $query->where('Alumno','=',$buscar);
                $query->orWhere('NombreCompleto','like','%'.$buscar.'%');
                $query->orWhere('Dni','=',$buscar);
            })->get();
        }
        return ['alumno'=>$alumno]; 
    }
    public function store(Request $request){
        $idalumn=$request->idalumn;
        $numreb=$request->numreb;
        $fecpag=$request->fecpag;
        $monto=$request->monto;
        $costo=$request->costo;
        $cant=$request->cant;
        $esta=$request->esta;
        $tipo=$request->tipo;
        $msj='';

        $solicitud = new NuevaSolicitud();
        $solicitud->fecingreso=date('Y-m-d');
        if ($tipo=="Pregrado" || $tipo=="Posgrado") {
            $solicitud->fk_idalumpp=$idalumn;
        }else if ($tipo=="Cacip") {
            $solicitud->fk_idalumcac=$idalumn;
            $solicitud->aniocacip=date('Y');
        }
        $solicitud->numreb=$numreb;
        $solicitud->fecpago=$fecpag;
        $solicitud->monto=$monto;
        $solicitud->costosem=$costo;
        $solicitud->cantsem=$cant;
        $solicitud->esta=$esta;
        $solicitud->tip=$tipo;
        $solicitud->save();
        $msj='si';
        return response()->json(['msj'=>$msj]);
    }
    public function getsemestre($cod,$tipo){
        $cant="";
        if ($tipo=="Pregrado" || $tipo=="pregrado") {
            $cant=DB::table('Rendimiento')->where('Alumno',$cod)->where('Promedio','>=',11)->distinct('Semestre')->count('Semestre');
        }
        return response()->json(["cant"=>$cant,"tipo"=>$tipo]);
    }
}