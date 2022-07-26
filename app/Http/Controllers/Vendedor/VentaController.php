<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Auth;


class VentaController extends Controller
{

    public function __construct(){
        $this->middleware('vendedorlogged');
    }

    public function index()
    {
        
        $ventas=Pedido::where('id_planta',Auth::guard('vendedores')->user()->id_planta)->orderby('created_at','desc')->paginate(10);
        
        return view('ventas.ventas.ventas',['ventas'=>$ventas]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productos = DB::table('productosobras')
        ->join('detallepedidos','detallepedidos.id_producto','=','productosobras.id')
        ->join('pedidos','pedidos.id','=','detallepedidos.id_pedido')
        ->select('detallepedidos.id','productosobras.categoria','productosobras.producto','productosobras.descripcion','detallepedidos.precio','productosobras.transporte','detallepedidos.cantidad',
        DB::raw('(select foto from productofotos where id_producto=productosobras.id_producto and orden=0) as portada'))
        ->where('pedidos.id',$id)
        ->get();
        
        $transportes = DB::table('transporteobras')
        ->join('detallepedidos','detallepedidos.id_transporte','=','transporteobras.id')
        ->join('pedidos','pedidos.id','=','detallepedidos.id_pedido')
        ->select('detallepedidos.id','transporteobras.transporte as producto','transporteobras.descripcion','detallepedidos.precio','transporteobras.transporte','detallepedidos.cantidad',
        DB::raw('(select foto from productofotos where id_producto=transporteobras.id_transporte and orden=0) as portada')
        ,DB::raw('\'Transporte\' as categoria'))
        ->where('pedidos.id',$id)
        ->get();

        $pedido = DB::table('pedidos')  
        ->where('pedidos.id',$id)
        ->first();


        return view('ventas.ventas.venta',['pedido'=>$pedido,'productos'=>$productos,'transportes'=>$transportes]);
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
    public function update(Request $request, $id)
    {
        //
    }

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

    function GuardarPedido(Request $request,$id){
        $pedido=Pedido::find($id);
        if($pedido->confirmacion!=0){
            $pedido->fechaentrega=$request->fechaentrega;
        }
        $pedido->comentario=$request->comentario;
        if($pedido->save()){
            return redirect('ventas/'.$id)->with('success','Datos guardados correctamente.');
        }else{
            return redirect('ventas/'.$id)->with('error','Error al guardar.');
        }
    }

    function RechazarPedido(Request $request,$id){
        $pedido=Pedido::find($id);
        $pedido->confirmacion=0;
        $pedido->fechaentrega=$pedido->created_at;
        $pedido->comentario=$request->comentario;
        if($pedido->save()){
            Historial('pedidos',$pedido->id,Auth::guard('vendedores')->user()->id,'Rechazó el pedido','Monto: '.$pedido->total);
            return redirect('ventas/'.$id)->with('success','Datos guardados correctamente.');
        }else{
            return redirect('ventas/'.$id)->with('error','Error al guardar.');
        }
    }
    function AceptarPedido(Request $request,$id){
        $pedido=Pedido::find($id);
        $pedido->confirmacion=2;
        $pedido->fechaentrega=$request->fechaentrega;
        $pedido->comentario=$request->comentario;
        if($pedido->save()){
            Historial('pedidos',$pedido->id,Auth::guard('vendedores')->user()->id,'Aceptó el pedido','Monto: '.$pedido->total);
            return redirect('ventas/'.$id)->with('success','Datos guardados correctamente.');
        }else{
            return redirect('ventas/'.$id)->with('error','Error al guardar.');
        }
    }
}
