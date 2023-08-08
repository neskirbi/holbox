<?php

namespace App\Http\Controllers\Android\RecitrackRecoleccion\Recolectores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recoleccion;
use App\Models\Negocio;
use App\Models\Planta;
use App\Models\Multa;
use App\Models\Pago;
use App\Models\Residuo;
use App\Models\Contenedor;
use App\Models\Configuracion;

class RecoleccionController extends Controller
{
   function CargarRecoleccion(Request $request){
       $recolecciones=PostmanAndroid($request);
       $correctos=array();
       
       foreach($recolecciones as $recoleccion){

            if(Recoleccion::find($recoleccion['id'])){
                $correctos[]=$recoleccion['id'];
            }else{

                $negocio=Negocio::find($recoleccion['id_negocio']);
                $planta=Planta::find($negocio->id_planta);
                $configuracion=Configuracion::where('id_planta',$negocio->id_planta)->first();

                $folio=$configuracion->folio;
                $configuracion->folio = $configuracion->folio+1;
                $configuracion->save();

                $subtotal=0;
                $iva=0;
                $total=0;
                $residuo=Residuo::where('opcion',$recoleccion['residuo'])->first();
                if($residuo){
                    $contenedor=Contenedor::where('opcion',$recoleccion['contenedor'])->first();
                    if($contenedor){
                        $subtotal=$recoleccion['cantidad']*$contenedor->cantidad*$residuo->precio;
                       
                        
                        if($configuracion){
                            $iva=$configuracion->iva;
                            $total=$subtotal*(($iva/100)+1);
                        }
                        
                        
                    }

                    
                }
                


                $recol=new Recoleccion();

                $recol->id=$recoleccion['id'];
                $recol->id_planta=$negocio->id_planta;
                $recol->id_recolector=$recoleccion['id_recolector'];
                $recol->id_negocio=$recoleccion['id_negocio'];
                $recol->negocio=$recoleccion['negocio'] == null ? '' : $recoleccion['negocio'];
                $recol->contenedor=$recoleccion['contenedor'];
                $recol->residuo=$recoleccion['residuo'];
                $recol->cantidad=$recoleccion['cantidad'];
                $recol->created_at=$recoleccion['created_at'];
                $recol->updated_at=$recoleccion['updated_at'];
                $recol->subtotal=$subtotal;
                $recol->iva=$iva;
                $recol->total=$total;
                $recol->folio=$folio;

                $recol->transportista=$planta->planta;
                $recol->domiciliot=$planta->direccion;
                $recol->ramir=$planta->plantaauto;
                $recol->telefonot=$configuracion->telefono;
                $recol->sctt=$configuracion->sct;

                //$recol->nombret=$configuracion->nombre_repre;
                //$recol->firmat=$configuracion->firma_repre;
                //$recol->ruta=$configuracion->ruta;

                $recol->empresar=$planta->planta;
                $recol->ramirr=$planta->plantaauto;
                $recol->domicilior=$planta->direccion;
                $recol->telefonor=$configuracion->telefono;
                //$recol->nombrer=$configuracion->nombre_repre;
                //$recol->firmar=$configuracion->firma_repre;
                //$recol->cargor=$configuracion->cargo_repre;
                $recol->fehcallegada=date('Y-m-d H:i:s');

                
                $recol->save();
                $correctos[]=$recoleccion['id'];
            }
           
       }
       return $correctos;
   }
}
