<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Administrador;
use App\Models\Planta;
use App\Models\Configuracion;


class GeneralController extends Controller
{
    function Manifiesto($id){

        $recoleccion=Cliente::select('clientes.firma','generadores.razonsocial','generadores.fisicaomoral','generadores.telefono','generadores.calle','generadores.entidad',
        'generadores.numeroext','generadores.numeroint','generadores.colonia','generadores.municipio','generadores.cp',
        'recolecciones.id','recolecciones.folio','negocios.nautorizacion',
        'negocios.telefono as negotelefono','negocios.calle as negocalle','negocios.numeroext as negonumeroext',
        'negocios.nautorizacion','negocios.numeroint as negonumeroint','negocios.colonia as negocolonia','negocios.municipio as negomunicipio',
        'negocios.cp as negocp','negocios.negocio','recolecciones.cantidad','negocios.tiponegocio','recolecciones.created_at',
        DB::RAW("(select contenedor from contenedores where opcion=recolecciones.contenedor) as contenedor"),
        DB::RAW("(select (cantidad*recolecciones.cantidad) from contenedores where opcion=recolecciones.contenedor) as total"),
        DB::RAW("(select residuo from residuos where opcion=recolecciones.residuo) as residuo"))
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('negocios','negocios.id_generador','=','generadores.id')
        ->join('recolecciones','recolecciones.id_negocio','=','negocios.id')
        ->where('recolecciones.id',$id)
        ->orderby('created_at','desc')
        ->first();
        

        $planta=Planta::where('id',GetIdPlanta())->first();
        $configuracion=Configuracion::where('id_planta',GetIdPlanta())->first();

        $administrador=Administrador::where('id_planta',GetIdPlanta())->where('principal',1)->orderby('created_at','asc')->first();
        return view('formatos.recolecciones.manifiesto',['recoleccion'=>$recoleccion,'configuracion'=>$configuracion,'planta'=>$planta,'administrador'=>$administrador]);
        $pdf = \PDF::loadView('formatos.recolecciones.manifiesto',['recoleccion'=>$recoleccion,'configuracion'=>$configuracion,'planta'=>$planta,'administrador'=>$administrador]);
        
        return $pdf ->setPaper('A4', 'portrait')->download('manifiesto'.'.pdf');
    }
}
