<?php

namespace App\Http\Controllers\Vendedor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Obra;
use App\Models\ProductoObra;
use App\Models\TransporteObra;
use App\Models\TipoObra;
use App\Models\CategoriaMaterial;
use App\Models\Planta;

class ObraController extends Controller
{
    public function index()
    {

        $obras = DB::table('generadores')
        ->join('obras', 'obras.id_generador', '=', 'generadores.id')
        ->where('obras.id_planta',Auth::guard('vendedores')->user()->id_planta)
        ->select('obras.id','obras.obra','obras.tipoobra','obras.nautorizacion','generadores.razonsocial','obras.verificado','obras.nautorizacion','obras.vigenciaplan','obras.declaratoria','obras.planmanejo','obras.created_at','obras.aplicaplan')
        ->orderby('obras.created_at','desc')
        ->paginate(10);
        

       
        $tipoobras=array();
        return view('ventas.obras.obras',['obras'=>$obras,'tipoobras'=>$tipoobras]);
    }

    public function show($id){
        $obra=DB::table('generadores')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)
        ->where('obras.id',$id)
        ->select('generadores.razonsocial','obras.id','obras.id_planta','obras.id_generador','obras.obra','obras.tipoobra','obras.subtipoobra','obras.cantidadobra','obras.calle','obras.numeroext','obras.numeroint','obras.colonia','obras.municipio','obras.entidad','obras.cp','obras.latitud','obras.longitud','obras.fechainicio','obras.fechafin','obras.superficie','obras.superunidades','obras.aplicaplan','obras.nautorizacion','obras.vigenciaplan','obras.declaratoria','obras.planmanejo','obras.telefono','obras.celular','obras.correo','obras.correo2','obras.verificado')
        ->first();
        
        $tag=DB::table('tipoobras')->where('tipoobra',$obra->tipoobra)->first();

        $materiales=DB::table('obras')
        ->join('materialesobra','materialesobra.id_obra','=','obras.id')
        ->where('obras.id',$id)
        ->where('materialesobra.cantidad','!=',0)
        ->select('materialesobra.id_material','materialesobra.categoriamaterial','materialesobra.material','materialesobra.cantidad','materialesobra.unidades','materialesobra.precio')
        ->orderby('materialesobra.categoriamaterial','asc')
        ->orderby('materialesobra.material','asc')
        ->get();
        
        $productosobras=ProductoObra::where('id_obra',$id)
            ->orderby('categoria','asc')
            ->orderby('producto','asc')
            ->get();

        $productos=DB::table('productos')
            ->select('id as id_producto','categoria','producto','descripcion','precio',
            DB::raw('(select foto from productofotos where id_producto=productos.id and orden=0) as portada'))
            ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)
            ->orderby('categoria','asc')
            ->orderby('producto','asc')
            ->get();
        
        
        //Verifica si la obra ya tiene cada producto y si no se lo agrega  (ojo no quita uno existente)
        $poductosobra=array();
        foreach($productos as $producto){
            $noesta=true;
            foreach($productosobras as $productosobra){
                if($productosobra->id_producto==$producto->id_producto){
                    $productosobra->portada=$producto->portada;
                    $noesta=false;
                    break;
                }
            }
            if($noesta){
                $poductosobra[]=$producto;
            }else{
                $poductosobra[]=$productosobra;
            }
        }
        //return $poductosobra;


        
        $transportesobras=TransporteObra::where('id_obra',$id)
            ->orderby('transporte','asc')
            ->get();

        $transportes=DB::table('transportes')
            ->select('id as id_transporte','transporte','descripcion','precio',DB::raw("0 as cantidad"),
            DB::raw('(select foto from productofotos where id_producto=transportes.id and orden=0) as portada'))
            ->where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)
            ->orderby('transporte','asc')
            ->get();
        //Verifica si la obra ya tiene cada transporte y si no se lo agrega  (ojo no quita uno existente)
        $transportesobra=array();
        foreach($transportes as $transporte){
            $noesta=true;
            foreach($transportesobras as $transporteobra){
                if($transporteobra->id_transporte==$transporte->id_transporte){
                    $transporteobra->portada=$transporte->portada;
                    $noesta=false;
                    break;
                }
            }
            if($noesta){
                $transportesobra[]=$transporte;
            }else{
                $transportesobra[]=$transporteobra;
            }
        }
        //return $transportesobra;

        $tipoobras=TipoObra::select('tipoobra','tag')->distinct()->get();
        $subtipoobras=TipoObra::all();
         
        $categorias=CategoriaMaterial::where('id_planta','=',Auth::guard('vendedores')->user()->id_planta)->orderby('categoriamaterial','asc')->get();
        $planta=Planta::find($obra->id_planta);        
        $plantas=Planta::all();

        if(!$obra){
            return redirect('obras')->with('error', 'No existen datos.');
        }
        return view('ventas.obras.obra',['obra'=>$obra,'materiales'=>$materiales,'poductosobra'=>$poductosobra,'transportesobra'=>$transportesobra,'tipoobras'=>$tipoobras,'subtipoobras'=>$subtipoobras,
        'categorias'=>$categorias,'materiales'=>$materiales,'planta'=>$planta,'plantas'=>$plantas,'tag'=>(isset($tag->tag) ? $tag->tag : 'Cantidad')]);
    }
}
