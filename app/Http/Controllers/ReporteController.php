<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listacertificado;
use DB;

class ReporteController extends Controller{
	public function index1(){
		return view('reporte.index');
	}
	public function index(Request $request){
        $fecdes=$request->fecdes;
        $fechas=$request->fechas;
        $tip=$request->tip;

        $certificado=[];
        if ($tip==1) {
$certificado=DB::table('dbo.v_certificadoall')->whereBetween('fecingreso', [$fecdes,$fechas])->get();
        }else if($tip==2){
            $esta=$request->esta;
                $certificado=DB::table('dbo.v_certificadoall')->where('esta',$esta)->whereBetween('fecingreso', [$fecdes,$fechas])->get();
        }else if($tip==3){
            $tipo=$request->tipo;
                $certificado=DB::table('dbo.v_certificadoall')->where('tipo',$tipo)->whereBetween('fecingreso', [$fecdes,$fechas])->get();
        }else if($tip==4){
            $tipo=$request->tipo;
            $esta=$request->esta;
                $certificado=DB::table('dbo.v_certificadoall')->where('esta',$esta)->where('tipo',$tipo)->whereBetween('fecingreso', [$fecdes,$fechas])->get();
        }
        return ['certificado'=>$certificado]; 
    }
    public function mostrareporte(Request $request){
        $fecdes=$request->txtfecdes;
        $fechas=$request->txtfechas;
        $esta=$request->cboesta;
        $tipo=$request->cbotipo;
        $certificado=[];
        $fec=date('Y-m-d');
        $cadena="";
  if ($fecdes!="" && $fechas!="") {
        if($tipo==0 && $esta==0){
            $cadena="tipo y estado cero";
            $certificado=DB::table('dbo.v_certificadoall')->whereBetween('fecingreso', [$fecdes,$fechas])->get();
        }
        if($esta!=0 && $tipo==0){
            $cadena="tipo 0 y esta no";
            $certificado=DB::table('dbo.v_certificadoall')->where('esta','=',$esta)->whereBetween('fecingreso', [$fecdes,$fechas])->get();
        }
        if($tipo!=0 && $esta==0){
            $cadena="tipo 0 y estado no";
            $certificado=DB::table('dbo.v_certificadoall')->where('tipo',$tipo)->whereBetween('fecingreso', [$fecdes,$fechas])->get();
        }
        if($tipo!=0 && $esta!=0){
            $cadena="tipo y estado no 0";
            $certificado=DB::table('dbo.v_certificadoall')->where('esta',$esta)->where('tipo',$tipo)->whereBetween('fecingreso', [$fecdes,$fechas])->get();
        }
  }else{
    return redirect('/reporte');
  }

        $vista = view('reporte.pdf',compact('fec','certificado','fecdes','fechas','cadena'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOption('isPhpEnabled', true);
        $pdf->loadHTML($vista);
        return $pdf->stream('certificados.pdf');
    }
}