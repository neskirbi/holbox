<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\Cliente;
use App\Models\Negocio;
use App\Models\Planta;
use Redirect;

class PagoController extends Controller
{
    public function index()
    {
        $pago=DB::table('pagos')
        ->where('id_planta','=',GetIdPlanta())
        ->where('status','=',2)
        ->select(DB::raw('sum(monto) as montot'))
        ->first();

        $pagos_fecha=DB::table('pagos')
        ->where('id_planta','=',GetIdPlanta())
        ->where('status','=',2)
        ->select(DB::raw('date(created_at) as created_at'),DB::raw('sum(monto) as montot'))
        ->groupby('created_at')
        ->get();

        /**
         * Aqui se calcula mas iva por que no tiene iva contemplado
         */
        $citas=DB::table('citas')
        ->join('obras','obras.id','=','citas.id_obra')
        ->select(DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as consumo'))
        ->where('obras.id_planta','=',GetIdPlanta())
        ->where('citas.confirmacion',1)        
        ->where('obras.esalcaldia','=',0)
        ->first();

        /**
         * Aqui solo se calcula la suma de la columna total, porque ya viene el iva
         */
        $pedidos = DB::table('pedidos')  
        ->where('id_planta',GetIdPlanta())
        ->where('confirmacion','=',2)
        ->select( DB::raw('SUM((total)) as monto'))
        ->first();

        $consumo=$citas->consumo+$pedidos->monto;
        

        $clientegastos=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','clientes.id')
        ->join('obras','obras.id_generador','generadores.id')
        ->leftjoin('citas',function($join){
            $join->on('citas.id_obra','=','obras.id');
            $join->on('citas.confirmacion','=',DB::raw('1'));
        })
        ->select('obras.id',
        DB::raw("(select obra from obras as ob where ob.id=obras.id) as nombre"),
        DB::raw('sum((citas.cantidad*citas.precio)+(citas.cantidad*citas.precio*(citas.iva/100))) as reciclaje'),
        DB::raw("(select sum(total) from pedidos where id_obra = obras.id and confirmacion=2) as pedidos"),
        DB::raw("(SELECT sum(monto) from pagos where status=2 and id_obra=obras.id  ) as pagos"))
        ->groupby('obras.id')
        ->orderby('nombre', 'asc')
        ->where('obras.id_planta','=',GetIdPlanta())        
        ->where('obras.esalcaldia','=',0)
        ->get();

       
/*
        $pagos=DB::table('pagos')
        ->join('clientes','clientes.id','=','pagos.id_cliente')
        ->select('clientes.nombres','clientes.apellidos','pagos.id','pagos.monto','pagos.descripcion','pagos.detalle','pagos.created_at',DB::raw('time(pagos.created_at) as hora'),'pagos.status','pagos.referencia')
        ->orderby('created_at','desc')
        ->where('pagos.id_planta','=',GetIdPlanta())
        ->get();
*/

        $pagos=DB::table('pagos')
        ->join('obras','obras.id','=','pagos.id_obra')
        ->select('obras.obra','pagos.id','pagos.monto','pagos.descripcion','pagos.detalle','pagos.created_at',DB::raw('time(pagos.created_at) as hora'),'pagos.status','pagos.referencia')
        ->orderby('created_at','desc')
        ->where('pagos.id_planta','=',GetIdPlanta())
        ->get();

        $negocios=Negocio::where('id_planta','=',GetIdPlanta())->get();
        return view('administracion.pagos.pagos',['negocios'=>$negocios,'pago'=>$pago,'pagos'=>$pagos,'consumo'=>$consumo,'pagos_fecha'=>$pagos_fecha,'clientegastos'=>$clientegastos]);
    }

    public function VerificarPago($id)
    {
        $pago=Pago::find($id);
        if($pago){
            $pago->id_administrador=GetId();
            $pago->status=2;
            if($pago->save()){                
                Historial('pagos',$pago->id,GetId(),'Autorización de Pago','Pago autorizado Monto: '.$pago->monto);
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
            $pago->id_administrador=GetId();
            $pago->status=0;
            $pago->detalle=$request->detalle;
            if($pago->save()){
                Historial('pagos',$pago->id,GetId(),'Cancelación de Pago',$request->detalle.'  Monto: '.$pago->monto);
                return Redirect::back()->with('error', 'Pago cancelado.');
            }else{
                return Redirect::back()->with('warning', 'Error al cancelar el pago.');
            }
        }else{
            return Redirect::back()->with('warning', 'Error al buscar el pago.');
        }

        
    }

    function CargarPagos(Request $request){

        //return $request;
        if(is_null($request->monto)){
            return Redirect::back()->with('error', 'El campo monto no puede ser nulo.');
        }
        if(is_null($request->negocio)){
            return Redirect::back()->with('error', 'El campo negocio no puede ser nulo.');
        }
        if(is_null($request->nombre)){
            return Redirect::back()->with('error', 'El campo nombre no puede ser nulo.');
        }
        if(is_null($request->direccion)){
            return Redirect::back()->with('error', 'El campo direccion no puede ser nulo.');
        }
        if(is_null($request->cp)){
            return Redirect::back()->with('error', 'El campo cp no puede ser nulo.');
        }
        if(is_null($request->municipio)){
            return Redirect::back()->with('error', 'El campo municipio no puede ser nulo.');
        }
        if(is_null($request->entidad)){
            return Redirect::back()->with('error', 'El campo entidad no puede ser nulo.');
        }
        $request->monto = str_replace(",","",$request->monto); 

        

        
        $negocio=Negocio::where('id',$request->negocio)->first();

        $planta=Planta::where('id','=',$negocio->id_planta)->first();
        
        $configuracion=DB::table('configuraciones')
        ->where('id_planta','=',$planta->id)
        ->first();

        $cliente=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->select('clientes.id')
        ->where('generadores.id','=',$negocio->id_generador)
        ->first();

        
        $pago=new Pago();
        $id = $pago->id = GetUuid();
        $pago->id_cliente = $cliente->id;        
        $pago->id_obra = '';      
        $pago->id_negocio = $request->negocio;
        $pago->id_planta = $negocio->id_planta;
        $pago->monto = $request->monto;
        $pago->nombre = $request->nombre;
        $pago->direccion = $request->direccion;
        $pago->cp = $request->cp;
        $pago->municipio = $request->municipio;
        $pago->entidad = $request->entidad;
        $pago->descripcion = 'Transferencia';

        $number1 = Pago::count();
        $length = 4;
        $number1 = substr(str_repeat(0, $length).$number1, - $length);

        $number2 = rand(1,9999);
        $length = 4;
        $number2 = substr(str_repeat(0, $length).$number2, - $length);


        $pago->referencia= $configuracion->referencia.'-'.$number1.'-'.$number2;
        if($pago->save()){
            
            return Redirect::back()->with('success', 'Se generó el pago.')->with('transferencia', $id);
        }else{
            return Redirect::back()->with('error', 'Error al generar el pago.');
        }

       
    }

}
