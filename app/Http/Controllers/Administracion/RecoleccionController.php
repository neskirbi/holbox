<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recoleccion;
use Redirect;


class RecoleccionController extends Controller
{
    

    public function __construct(){
        $this->middleware('administradorlogged');
    }

    function index(){
       $recolecciones=Recoleccion::select('recolecciones.id','negocios.negocio','recolecciones.cantidad','negocios.tiponegocio','recolecciones.created_at',
        DB::RAW("(select contenedor from contenedores where opcion=recolecciones.contenedor) as contenedor"),
        DB::RAW("(select residuo from residuos where opcion=recolecciones.residuo) as residuo"),
        DB::RAW("(select plantaauto from plantas where id=recolecciones.id_planta) as plantaauto"))
        ->join('negocios','negocios.id','=','recolecciones.id_negocio')
        ->where('recolecciones.id_planta',GetIdPlanta())
        ->orderby('created_at','desc')
        ->get();
        return view('administracion.recolecciones.recolecciones',['recolecciones'=>$recolecciones]);
    }


    function show($id){
        $recoleccion = Recoleccion::find($id);
        return view('administracion.recolecciones.show',['recoleccion'=>$recoleccion]);

    }
}
