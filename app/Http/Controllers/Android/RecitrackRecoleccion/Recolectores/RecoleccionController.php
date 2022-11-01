<?php

namespace App\Http\Controllers\Android\RecitrackRecoleccion\Recolectores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recoleccion;
use App\Models\Negocio;
use App\Models\Planta;
use App\Models\Multa;
use App\Models\Pago;

class RecoleccionController extends Controller
{
   function CargarRecoleccion(Request $request){
       $recolecciones=PostmanAndroid($request);
       $correctos=array();
       //return $recolecciones[0]['created_at'];
       foreach($recolecciones as $recoleccion){
           //return Recoleccion::where('fechavisita',date('Y-m-d',strtotime($recoleccion['created_at'])))->first();
            if(Recoleccion::where('id_negocio',$recoleccion['id'])->whereraw("date(created_at) = '".date('Y-m-d',strtotime($recoleccion['created_at']))."'")->first()){
                $correctos[]=$recoleccion['id'];
            }else{
                $recol=new Recoleccion();
                //$recol->id=GetUuid();
                $recol->id=$recoleccion['id'];
                $recol->id_recolector=$recoleccion['id_recolector'];
                $recol->id_negocio=$recoleccion['id_negocio'];
                $recol->negocio=$recoleccion['negocio'] == null ? '' : $recoleccion['negocio'];
                $recol->contenedor=$recoleccion['contenedor'];
                $recol->residuo=$recoleccion['residuo'];
                $recol->cantidad=$recoleccion['cantidad'];
                $recol->save();
                $correctos[]=$recoleccion['id'];
            }
           
       }
       return $correctos;
   }
}
