<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listacertificado;
use DB;

class ListacertificadoController extends Controller{
	public function index1(){
		return view('listacertificado.index');
	}
    public function getfecha(){
        $fechaActual = date('Y-m-d');
        return ['fecha'=>$fechaActual]; 
    }
	public function index(Request $request){
        $buscar=$request->bus;
        $tipo=$request->tipo;
        $certificado=[];
        if ($tipo==0) {
            $certificado=DB::table('dbo.v_certificadoall')->where(function($query) use ($buscar){
                    $query->where('Codigo','like','%'.$buscar.'%');
                    $query->orWhere('Nombre','like','%'.$buscar.'%');
                    $query->orWhere('Dni','like','%'.$buscar.'%');
                })->paginate(5);
        }else if($tipo==1){
            $esta=$request->esta;
                $certificado=DB::table('dbo.v_certificadoall')->where('esta',$esta)->where(function($query) use ($buscar){
                    $query->where('Codigo','like','%'.$buscar.'%');
                    $query->orWhere('Nombre','like','%'.$buscar.'%');
                    $query->orWhere('Dni','like','%'.$buscar.'%');
                })->paginate(5);
        }
        return ['pagination'=>[
                'total'=> $certificado->total(),
                'current_page'=> $certificado->currentPage(),
                'per_page'=> $certificado->perPage(),
                'last_page'=> $certificado->lastPage(),
                'from'=> $certificado->firstItem(),
                'to'=> $certificado->lastItem(),
            ],
            'certificado'=>$certificado]; 
    }
    public function update(Request $request, $id){
        $tipo=$request->tipo;

if ($tipo=="fecemi") {
    $fecemi=$request->fecemi;
    $certificado = Listacertificado::findOrFail($id);
    $certificado->fecemisi=$fecemi;
    $certificado->esta="En firmas";
    $certificado->save();
}
if ($tipo=="fecfir") {
    $fecfir=$request->fecfir;
    $certificado = Listacertificado::findOrFail($id);
    $certificado->fecfirma=$fecfir;
    $certificado->esta="Por entregar";
    if ($request->nivel=='Cacip') {
       $numcert=$request->numcert; 
       $certificado->numcercacip=$numcert;
    }
    $certificado->save();
}
if ($tipo=="fecentre") {
    $fecentre=$request->fecentre;
    $certificado = Listacertificado::findOrFail($id);
    $certificado->fecentrega=$fecentre;
    $certificado->esta="Entregado";
    $certificado->save();
}

    }
}