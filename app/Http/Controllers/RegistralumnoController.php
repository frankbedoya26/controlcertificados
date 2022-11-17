<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registralumno;
use Validator;
use DB;

class RegistralumnoController extends Controller{
	public function index1(){
		return view('registralumno.index');
	}
	public function index(Request $request){
        $buscar=$request->bus;
        $alumno=DB::table('certificados.alumcacip')->where(function($query) use ($buscar){
            $query->where('dni','like','%'.$buscar.'%');
            $query->orWhere('ape','like','%'.$buscar.'%');
            $query->orWhere('nom','like','%'.$buscar.'%');
            $query->orWhere('codigo','like','%'.$buscar.'%');
        })->get();
        return ['alumno'=>$alumno]; 	
    }
    public function store(Request $request){
        $dni=$request->dni;
        $ape=$request->ape;
        $nom=$request->nom;
        $cod=$request->cod;

        $carr=$request->carr;
        $tipo=$request->tipo;
        $dir=$request->dir;
        $tel=$request->tel;
        $corr=$request->corr;
        $msj='';
        $alumno = new Registralumno();
        $alumno->dni=$dni;
        $alumno->nom=$nom;
        $alumno->ape=$ape;
        $alumno->codigo=$cod;
        $alumno->carrera=$carr;
        $alumno->telefo=$tel;
        $alumno->tipo=$tipo;
        $alumno->correo=$corr;
        $alumno->direccon=$dir;
        $alumno->save();
        $msj='si';
        return response()->json(['msj'=>$msj]);
    }
    public function update(Request $request, $id){
        $dni=$request->dni;
        $ape=$request->ape;
        $nom=$request->nom;
        $cod=$request->cod;

        $carr=$request->carr;
        $tipo=$request->tipo;
        $dir=$request->dir;
        $tel=$request->tel;
        $corr=$request->corr;
        $msj='';

        $alumno = Registralumno::findOrFail($id);
        $alumno->nom=$nom;
        $alumno->ape=$ape;
        $alumno->carrera=$carr;
        $alumno->telefo=$tel;
        $alumno->tipo=$tipo;
        $alumno->correo=$corr;
        $alumno->direccon=$dir;
        $alumno->save();
        $msj='si';
        return response()->json(['msj'=>$msj]);
    }
}
