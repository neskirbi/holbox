<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\Cliente;
use Redirect;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    function PagoCliente(Request $request){
        if(is_null($request->monto)){
            return Redirect::back()->with('error', 'El campo monto no puede ser nulo.');
        }
        if(is_null($request->obra)){
            return Redirect::back()->with('error', 'El campo generador no puede ser nulo.');
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

        $configuracion=DB::table('configuraciones')
        ->where('id_planta','=',$request->planta)
        ->first();

        
        $pago=new Pago();
        $id = $pago->id = GetUuid();
        $pago->id_cliente = Auth::guard('clientes')->user()->id;        
        $pago->id_obra = $request->obra;
        $pago->id_planta = $request->planta;
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
            Notificar('¡Se ha registrado un nuevo pago!','Nuevo Pago Registrado.','Por favor verificar el estatus del pago para la validación.','',['ventas@csmx.mx'],'<a href="https://reci-track.mx/" class="btn btn-default  btn-outline-secondary">Ir a Recitrack</a>');
            return Redirect::back()->with('success', 'Se generó el pago.')->with('transferencia', $id);
        }else{
            return Redirect::back()->with('error', 'Error al generar el pago.');
        }

       

    }
}
