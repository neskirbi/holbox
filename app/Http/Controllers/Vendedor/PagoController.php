<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\Cliente;
use Redirect;

class PagoController extends Controller
{
    public function index()
    {
        $pago=DB::table('pagos')
        ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)
        ->where('status','=',2)
        ->select(DB::raw('sum(monto) as montot'))
        ->first();

        $pagos_fecha=DB::table('pagos')
        ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)
        ->where('status','=',2)
        ->select(DB::raw('date(created_at) as created_at'),DB::raw('sum(monto) as montot'))
        ->groupby('created_at')
        ->get();

        /**
         * Aqui se cal=cula mas iva por que no tiene iva contamplado
         */
        $citas=DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->select(DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as consumo'))
        ->where('obras.id_planta','=',Auth::guard('vendedores')->user()->id_planta)
        ->where('citas.confirmacion',1)
        ->first();

        /**
         * Aqui solo se calcula la suma de la columna total, porque ya viene el iva
         */
        $pedidos = DB::table('pedidos')  
        ->where('id_planta',Auth::guard('vendedores')->user()->id_planta)
        ->where('confirmacion','=',2)
        ->select( DB::raw('SUM((total)) as monto'))
        ->first();

        $consumo=$citas->consumo+$pedidos->monto;
        

        $clientegastos=DB::table('obras')
        ->leftjoin('citas',function($join){
            $join->on('citas.id_obra','=','obras.id');
            $join->on('citas.confirmacion','=',DB::raw('1'));
        })
        ->select(
        DB::raw("obras.obra as nombre"),
        DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as reciclaje'),
        DB::raw("(select sum(total) from pedidos where id_obra =obras.id  and confirmacion=2) as pedidos"),
        DB::raw("(SELECT sum(monto) from pagos where status=2 and id_obra=obras.id  ) as pagos"))
        ->groupby('obras.id','obras.obra')
        ->orderby('nombre', 'asc')
        ->where('obras.id_planta','=',Auth::guard('vendedores')->user()->id_planta)
        ->get();

       

        $pagos=DB::table('pagos')
        ->join('obras','obras.id','=','pagos.id_obra')
        ->select('obras.obra','pagos.id','pagos.monto','pagos.descripcion','pagos.detalle','pagos.created_at',DB::raw('time(pagos.created_at) as hora'),'pagos.status','pagos.referencia')
        ->orderby('created_at','desc')
        ->where('pagos.id_planta','=',Auth::guard('vendedores')->user()->id_planta)
        ->get();
        return view('ventas.pagos.pagos',['pago'=>$pago,'pagos'=>$pagos,'consumo'=>$consumo,'pagos_fecha'=>$pagos_fecha,'clientegastos'=>$clientegastos]);
    }

    public function VerificarPago($id)
    {
        $pago=Pago::find($id);
        if($pago){
            $pago->id_administrador=Auth::guard('vendedores')->user()->id;
            $pago->status=2;
            if($pago->save()){                
                Historial('pagos',$pago->id,Auth::guard('vendedores')->user()->id,'Autorización de Pago','Pago autorizado Monto: '.$pago->monto);
                return Redirect::back()->with('success', 'Pago verificado.');
            }else{
                return Redirect::back()->with('warning', 'Error al verificar el pago.');
            }
        }else{
            return Redirect::back()->with('warning', 'Error al buscar el pago.');
        }

        
    }

    public function CancelarPago(Request $request, $id)
    {        
        $pago=Pago::find($id);
        if($pago){
            $pago->id_administrador=Auth::guard('vendedores')->user()->id;
            $pago->status=0;
            $pago->detalle=$request->detalle;
            if($pago->save()){
                Historial('pagos',$pago->id,Auth::guard('vendedores')->user()->id,'Cancelación de Pago',$request->detalle.'  Monto: '.$pago->monto);
                return Redirect::back()->with('error', 'Pago cancelado.');
            }else{
                return Redirect::back()->with('warning', 'Error al cancelar el pago.');
            }
        }else{
            return Redirect::back()->with('warning', 'Error al buscar el pago.');
        }

        
    }

}
