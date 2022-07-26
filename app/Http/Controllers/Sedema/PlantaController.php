<?php

namespace App\Http\Controllers\Sedema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Planta;
use Redirect;


class PlantaController extends Controller
{
    function show($id_planta){
        /**
         * Datos de los pagos 
         */
        $planta=Planta::find($id_planta);
        $pago=DB::table('pagos')
        ->where('id_planta',$id_planta)
        ->where('status','=',2)
        ->select(DB::raw('sum(monto) as montot'))
        ->first();

        $citas=DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->select(DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as consumo'))
        ->where('id_planta',$id_planta)
        ->where('citas.confirmacion',1)
        ->first();

        /**
         * Aqui solo se calcula la suma de la columna total, porque ya viene el iva
         */
        $pedidos = DB::table('pedidos') 
        ->where('id_planta',$id_planta) 
        ->where('confirmacion','=',2)
        ->select( DB::raw('SUM((total)) as monto'))
        ->first();

        $consumo=$citas->consumo+$pedidos->monto;

        /**
         * Datos para las graficas de depositos por mes
         */

        


        /**
         * Datos de las citas para sedema 
         */


        $citas = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->count();

        $pendientes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->where('citas.confirmacion',0)
        ->count();

        $confirmadas = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->where('citas.confirmacion',1)
        ->count();

        $faltas = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->where('citas.confirmacion',2)
        ->count();

        
        /**
         * Datos para la grafica de citasa
         */

        

        /**
         * Datos para la grafica de contratos
         * 
         */
        $obras=DB::table('obras')
        ->select('id','id_planta','contrato')
        ->where('obras.id_planta',$id_planta)
        ->where('obras.contrato','=',1)
        ->get();
        $firmados=0;
        foreach($obras as $obra){
            $transporte=DB::select(DB::raw("select (precio*cantidad) as transporte from transporteobras where id_obra='".$obra->id."' and cantidad>0 "));
            $material=DB::select(DB::raw("select sum(cantidad*precio) as material from materialesobra where id_obra='".$obra->id."'"));
            if(isset($transporte[0]))
            $firmados+=$transporte[0]->transporte;

            if(isset($material[0]))
            $firmados+=$material[0]->material;

        }
        
        
        $obras=DB::table('obras')
        ->select('id','id_planta','contrato')
        ->where('obras.id_planta',$id_planta)
        ->where('obras.contrato','=',0)
        ->get();
        $sinfirmar=0;
        foreach($obras as $obra){
            $transporte=DB::select(DB::raw("select (precio*cantidad) as transporte from transporteobras where id_obra='".$obra->id."' and cantidad>0 "));
            $material=DB::select(DB::raw("select sum(cantidad*precio) as material from materialesobra where id_obra='".$obra->id."'"));
            if(isset($transporte[0]))
            $sinfirmar+=$transporte[0]->transporte;

            if(isset($material[0]))
            $sinfirmar+=$material[0]->material;

        }




       
        return view('sedema.dashboard.dashboard',['planta'=>$planta,'pago'=>$pago->montot,'consumo'=>$consumo,'citas'=>$citas,
        'pendientes'=>$pendientes,'confirmadas'=>$confirmadas,'faltas'=>$faltas,
        'firmados'=>number_format($firmados,2),'sinfirmar'=>number_format($sinfirmar,2)]);
    }

    function PagosSedemaPlanta(Request $request){
        //return $request;
        $id_planta=$request->id_planta;
        $year = $request->year;
        $pagosmesp = DB::table('pagos')
        ->where('id_planta',$id_planta)
        ->whereraw('YEAR(pagos.created_at) = \''.$year.'\'')
        ->where('status',2)
        ->select(DB::raw('YEAR(pagos.created_at) year, MONTH(pagos.created_at) month'), DB::raw('SUM(pagos.monto) as monto'))
        ->groupby('year','month')
        ->get();

        $citasmesp = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->where('obras.verificado',1)
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'), 
        DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as monto'))
        ->groupby('year','month')
        ->get();

        $pedidosmesp = DB::table('pedidos') 
        ->where('id_planta',$id_planta) 
        ->whereraw('YEAR(pedidos.created_at) = \''.$year.'\'')
        ->where('confirmacion','=',2)
        ->select(DB::raw('YEAR(pedidos.created_at) year, MONTH(pedidos.created_at) month'),DB::raw('SUM((total)) as monto'))
        ->groupby('year','month')
        ->get();
        return view('sedema.dashboard.frames.graficapagos',['pagosmesp'=>$pagosmesp,'citasmesp'=>$citasmesp,
        'pedidosmesp'=>$pedidosmesp,'id_planta'=>$id_planta,'year'=>$year]);
    }

    function CitasSedemaPlanta(Request $request){
        /**
     * Datos de las citas para sedema 
     */

        $id_planta=$request->id_planta;
        $year = $request->year;
       

        
        /**
         * Datos para la grafica de citasa
         */

        $citasmes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->where('obras.verificado',1)
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'),DB::raw("count(citas.id) as citas"))
        ->groupby('year','month')
        ->get();

        $citasmesconfi = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->where('citas.confirmacion',1)
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'),DB::raw("count(citas.id) as citas"))
        ->groupby('year','month')
        ->get();
        
        $faltasmes = DB::table('obras')
        ->join('citas','citas.id_obra','=','obras.id')
        ->where('obras.id_planta',$id_planta)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        ->where('citas.confirmacion',2)
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'),DB::raw("count(citas.id) as citas"))
        ->groupby('year','month')
        ->get();

        return view('sedema.dashboard.frames.graficacitas',['id_planta'=>$id_planta,'year'=>$year,
        'citasmes'=>$citasmes,'citasmesconfi'=>$citasmesconfi,
        'faltasmes'=>$faltasmes]);

    }
}
