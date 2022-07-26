<?php
use App\Mail\Notificaciones;
use App\Models\Token;
use App\Models\Historial;
use App\Models\Cita;
use App\Models\Planta;
use Kreait\Firebase\Factory;

function Version(){
    return 174;
}

function GetId(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->id;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->id;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->id;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return Auth::guard('vendedores')->user()->id;
    }  
}

function GetIdPlanta(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->id_planta;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->id_planta;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->id_planta;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return Auth::guard('vendedores')->user()->id_planta;
    }  
}

function GetNombre(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->director;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->administrador;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->nombre;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return Auth::guard('vendedores')->user()->nombre;
    }  
}


function GetCargo(){
    
    if(Auth::guard('directores')->check()){
        return "Director";
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->cargo;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->cargo;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return 'Vendedor';
    }  
}

function GetMail(){
    
    if(Auth::guard('directores')->check()){
        return Auth::guard('directores')->user()->mail;
    }  
    
    if(Auth::guard('administradores')->check()){
        return Auth::guard('administradores')->user()->mail;
    }  
    
    if(Auth::guard('finanzas')->check()){
        return Auth::guard('finanzas')->user()->mail;
    }  

    
    if(Auth::guard('vendedores')->check()){
        return Auth::guard('vendedores')->user()->mail;
    }  
}

function EnviarMensaje($numeros,$mensaje){

    $instasentClient = new Instasent\SmsClient("8b7953a5fe24c0c838830616ae4dc24db98a8945");
    $response = $instasentClient->sendUnicodeSms('Recitrack', $numeros, $mensaje);
    return $response['response_code'];
}

function RevisarSesiones($sesiones){
    $abiertas=0;
    foreach($sesiones as $sesion){
        if(Auth::guard($sesion)->check()){
            $abiertas++;
        }
    }
    if($abiertas>0){
        return false;
    }
    return redirect('home')->with('warning','Sesión finalizada.');
}

function GetUuid(){
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); 
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); 
    return str_replace("-","",vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4)));
}


function GetDateTimeNow(){
    return date('Y-m-d H:i:s');
}


function CrearRuta($ruta){
    $ruta=public_path().'/'.$ruta;
    if(!is_dir($ruta))
        mkdir($ruta, 0777,true);
        return $ruta;
}

function GuardarArchivos($file,$ruta,$nombre){
    $ruta=public_path().$ruta;
    if(!is_dir($ruta))
        mkdir($ruta, 0777,true);

    if(file_exists($ruta.'/'.$nombre))             
        unlink($ruta.'/'.$nombre);

    if($file->move($ruta, $nombre)){
        return true;
    }else{
        return false;
    }

}

function MesesEspanol($fecha){
    $fecha=explode("/",$fecha);
    $mes=$fecha[1];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    
    $fecha[1]=$meses[$mes-1];
    return implode("/",$fecha);
}

function MesEspanol($mes){
    
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    
    $mes=$meses[$mes-1];
    return $mes;
}

function FechaFormateada($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' '.$mes.' '.$anio;
}

function FechaFormateadaTiempo($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' '.$mes.' '.$anio.' '.date(' H:i',strtotime($fecha));
}

function FechaFormateadaContratos($fecha){
       
    $dias=['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $anio=date('Y',strtotime($fecha));
    $mes=$meses[date('m',strtotime($fecha))-1];
    $dia=date('d',strtotime($fecha));
    $diasemana=$dias[date('w',strtotime($fecha))];
    
    return $diasemana.' '.$dia.' de '.$mes.' del '.$anio;
}


/**
 * 
 * Revisa el monto por planta , revisa el gasto de reciclaje y el gasto 
 * de pedidos y calcula si puede agregar el gasto nuevo son pasarse del monto de saldo disponible
 * y revisa si el cliente puede generar gastos sin saldo
 */
function PuedeGastar($id_obra,$monto){

    
  
    /**
     * Si puede pospago regresas true, para que revisas si le alcansa o no jejejejej
     */
    //return GastoPedidos($cliente->id_cliente,$cliente->id_planta);
    if(PuedePospago($id_obra)){
        return true;
    }

    $pago = PagoPorObra($id_obra);
    $reciclaje = GastoReciclajeObra($id_obra);
    $pedidos = GastoPedidosObra($id_obra);
    
    if(($pago-$reciclaje-$monto-$pedidos)<-2){
        return false;
    }else{
        return true;
    }
    
    
    
}


function PagoPorObra($id_obra){
    $pago = DB::table('pagos')
        ->where('pagos.id_obra',$id_obra)       
        ->where('pagos.status',2)
        ->select(DB::raw('SUM(pagos.monto) as monto'))
        ->first();
    return $pago->monto;

}

function GastoReciclajeObra($id_obra){
    $citas = DB::table('obras')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('obras.id',$id_obra) 
        ->where('citas.confirmacion','!=',2)
        ->select( DB::raw('SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) as monto'))
        ->first();
    

    $gasto=$citas->monto;
    /**
     * Ya viene con descuento al agregar la obra
     */
    
    return $gasto;
    

}


function GastoPedidosObra($id_obra){
    $pedidos = DB::table('obras')
        ->leftjoin('pedidos','pedidos.id_obra','=','obras.id')
        ->where('obras.id',$id_obra)
        ->where('pedidos.confirmacion','!=',0)
        ->select( DB::raw('SUM((pedidos.total)) as monto'))
        ->first();
    

    return $pedidos->monto;    
    

}





function TieneLimite($id_obra,$cantidad){

    $citas = DB::table('obras')
    ->where('obras.id',$id_obra)
    ->select('obras.limite', DB::raw("(select sum(cantidad) from citas where id_obra='".$id_obra."' and month(created_at)=month(now())  and confirmacion!=2) as cantidad"))
    ->first();

    
    //return $cantidad."<<<>>>".$citas->cantidad."<<<>>>".$citas->limite;


    if($citas->limite==0){
        return false;
    }
    
    if(($citas->cantidad+$cantidad)<=$citas->limite)
    {
        return false;
    }

    if(($citas->cantidad+$cantidad)>=$citas->limite)
    {
        return true;
    }

    
}

function TieneLimite2($id_obra){

    $citas = DB::table('obras')
    ->where('obras.id',$id_obra)
    ->select('obras.limite', DB::raw("(select sum(cantidad) from citas where id_obra='".$id_obra."' and month(created_at)=month(now())  and confirmacion!=2) as cantidad"))
    ->first();

    
    return "Acumulado: ".$citas->cantidad." Limite".$citas->limite;


    
}

/**
 * Valida si tiene transporte disponible en sus pedidos
 */

function TieneTransporte($id_obra){
    $transporte=DB::table('obras')
        ->where('id',$id_obra)
        ->where('transporte',1)
        ->get();
    
    if(count($transporte)){
        $pedido=DB::table('pedidos')
            ->join('detallepedidos','detallepedidos.id_pedido','=','pedidos.id')
            ->select('detallepedidos.id','detallepedidos.disponible')
            ->where('detallepedidos.id_obra',$id_obra)
            ->where('detallepedidos.disponible',1)  
            ->where('pedidos.confirmacion',2)
            ->first();

        if($pedido){
            /**
             * No es el id del pedido, se esta usando el id del detalle
             */
            DB::table('detallepedidos')
            ->where('id', $pedido->id)
            ->update([
                'disponible' => 0
            ]);     
            return true;
        }else{
            return false;
        }
        
    }

    return true;
} 

/**
 * Pagos por cliente, no importa que planta 
 */
function Pago($id_cliente){
    $pago = DB::table('clientes')
        ->join('pagos','pagos.id_cliente','=','clientes.id')
        ->where('clientes.id',$id_cliente)        
        ->where('pagos.status',2)
        ->select(DB::raw('SUM(pagos.monto) as monto'))
        ->first();
    return $pago->monto;

}

/**
 * Pago por cliente en cada planta 
 */
function PagoPorPlanta($id_cliente,$id_planta){
    $pago = DB::table('clientes')
        ->join('pagos','pagos.id_cliente','=','clientes.id')
        ->where('clientes.id',$id_cliente) 
        ->where('pagos.id_planta',$id_planta)       
        ->where('pagos.status',2)
        ->select(DB::raw('SUM(pagos.monto) as monto'))
        ->first();
    return $pago->monto;

}




/**
 * Citas a reciclaje por cliente , no importa que planta 
 */
function Reciclaje($id_cliente){
    $citas = DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)     
        ->where('citas.confirmacion','!=',2)
        ->select( DB::raw('SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) as monto'))
        ->first();
    

    return $citas->monto;

}

function Compenzado($id_cliente){
    $citas = DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)     
        ->where('citas.confirmacion','!=',2)
        ->where('obras.esalcaldia','=',1)
        ->select( DB::raw('SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) as monto'))
        ->first();
    

    return $citas->monto;

}

/**
 * Citas a reciclaje por cliente y por planta
 */
function GastoReciclaje($id_cliente,$id_planta){
    $citas = DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)
        ->where('obras.id_planta',$id_planta)
        ->where('obras.contrato',1)   
        ->where('citas.confirmacion','!=',2)
        ->select( DB::raw('SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) as monto'))
        ->first();
    

    $gasto=$citas->monto;
    /**
     * Ya viene con descuento al agregar la obra
     */
    
    return $gasto;
    

}


function Pedidos($id_cliente){
    $pedidos = DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('pedidos','pedidos.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)     
        ->where('pedidos.confirmacion','!=',0)
        ->select( DB::raw('SUM((pedidos.total)) as monto'))
        ->first();
    

    return $pedidos->monto;

}

/**
 * Gasto cliente y por planta de pedidos de productos(incluye transporte)
 */
function GastoPedidos($id_cliente,$id_planta){
    $pedidos = DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('pedidos','pedidos.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)
        ->where('obras.id_planta',$id_planta)
        ->where('obras.contrato',1)
        ->where('pedidos.confirmacion','!=',0)
        ->select( DB::raw('SUM((pedidos.total)) as monto'))
        ->first();
    

    return $pedidos->monto;    
    

}

function GastosMesaMes($id_cliente,$year){
    return $gastos=DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('citas','citas.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)        
        ->where('citas.confirmacion','!=',2)
        ->whereraw('YEAR(citas.created_at) = \''.$year.'\'')
        //->select('clientes.id as cli','obras.id as idobra','citas.id as idddd','materialesobra.id as mate', 'materialesobra.precio','materialesobra.cantidad')
        ->select(DB::raw('YEAR(citas.created_at) year, MONTH(citas.created_at) month'), DB::raw('SUM((citas.precio*citas.cantidad)+((citas.precio*citas.cantidad)*citas.iva/100)) as monto'))
        ->groupby('year','month')
        ->get();    

}

function PedidosMesaMes($id_cliente,$year){
    return $gastos=DB::table('clientes')
        ->leftjoin('generadores','generadores.id_cliente','=','clientes.id')
        ->leftjoin('obras','obras.id_generador','=','generadores.id')
        ->leftjoin('pedidos','pedidos.id_obra','=','obras.id')
        ->where('clientes.id',$id_cliente)        
        ->where('pedidos.confirmacion','!=',0)
        ->whereraw('YEAR(pedidos.created_at) = \''.$year.'\'')
        //->select('clientes.id as cli','obras.id as idobra','pedidos.id as idddd','materialesobra.id as mate', 'materialesobra.precio','materialesobra.cantidad')
        ->select(DB::raw('YEAR(pedidos.created_at) year, MONTH(pedidos.created_at) month'), DB::raw('SUM(pedidos.total) as monto'))
        ->groupby('year','month')
        ->get();
    

}

function Descuento($monto,$id_cliente){
    
    $descuento = DB::table('descuentos')
        ->where('id_cliente',$id_cliente)
        ->first();

    if($descuento){
        return ($monto-($monto*(($descuento->porcentaje)/100)));
    }else{
        return $monto;
    }
}

function PuedePosPago($id_obra){
    
    $obra = DB::table('obras')
        ->where('id',$id_obra)
        ->select('puedepospago')
        ->first();

    if($obra)
    {
        return $obra->puedepospago;
    }else{
        return false;
    }
    
}

function CantidadLetras($numero){
    $formatterES = new NumberFormatter("Es", NumberFormatter::SPELLOUT);
    return $formatterES->format($numero);
} 

function SumarDias($fecha,$dias){
    
    return date('Y-m-d',strtotime ( '+'.($dias).' days' , strtotime ($fecha) ));
}

function Notificar($subject,$title,$subtitle,$body,$correos,$links){
    $correo=new Notificaciones($subject,$title,$subtitle,$body,$links);
    Mail::to($correos)->queue($correo);
}

function TokenGen($mail){
    $id=GetUuid();
    $token=Token::where('mail',$mail)->first();
    
   
    if($token){
        $token=Token::find($token->id);
        $token->delete();
    }
    
    $token=new Token();        
    $token->id=$id;
    $token->token=password_hash($id,PASSWORD_DEFAULT);
    $token->mail=$mail;
    if($token->save()){
        return $id;      
    }else{
        return false;
    }


}

function Historial($tabla,$id_referencia,$id_adminsitrador,$movimiento,$detalle){
    $historial=new Historial();
    $historial->id=GetUuid();
    $historial->tabla=$tabla;
    $historial->id_referencia=$id_referencia;
    $historial->id_administrador=$id_adminsitrador;
    $historial->movimiento=$movimiento;
    $historial->detalle=$detalle;
    $historial->save();
}

/**Este metodo regrasa false si esta bien la conexion y si esta mal regresa true */
function VerificarConexion($conectionName){
    // Test database connection
    try {
        DB::connection($conectionName)->getPdo();
    } catch (\Exception $e) {
        return true;
    }
    return false;
}

function TieneObrasAdmin(){
    $plantas=DB::table('plantas')
        ->select('plantas.id')
        ->where('plantas.id',Auth::guard('administradores')->user()->id_planta)
        ->where('plantas.tipo',1)
        ->get();
    return count($plantas);
}


function TieneNegociosAdmin(){
    $plantas=DB::table('plantas')
        ->select('plantas.id')
        ->where('plantas.id',Auth::guard('administradores')->user()->id_planta)
        ->where('plantas.tipo',2)
        ->get();
    return count($plantas);
}
function TieneObras(){

    $obras=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('obras','obras.id_generador','=','generadores.id')
        ->select('obras.id')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->get();
        return count($obras);
   
}

function TieneNegocios(){

    $negocios=DB::table('clientes')
        ->join('generadores','generadores.id_cliente','=','clientes.id')
        ->join('negocios','negocios.id_generador','=','generadores.id')
        ->select('negocios.id')
        ->where('clientes.id',Auth::guard('clientes')->user()->id)
        ->get();
    return count($negocios);
   
}

function Entregado($cita){
    $citan=new Cita();
    $citan->id=$cita->id;
    $file=public_path("key/recitrack-a87ef-firebase-adminsdk-smctc-1f5c9b7255.json");
    if(file_exists($file)){
        $firebase= (new Factory)->withServiceAccount($file); 
        $db=$firebase->createDatabase();
        $reference = $db->getReference("Citas/Confirmadas/".$citan->id);
        
        $reference->set($citan);
        return true;
    }else{
        return false;
    } 
   
}

function GeneraQR($path,$texto){
    
    if(!is_dir(public_path().'/'.$path))
        mkdir(public_path().'/'.$path, 0777,true);
        
$nombre=GetUuid().'.png';


$url= ($path.$nombre);
\QRCode::text($texto)->setOutfile($url)->png(); 
return $url;

}


function PostmanAndroid($request){
    if(isset($request->android)){
        $request=$request->android;
    }else{
        $request=str_replace("\"",'"',json_encode($request->all()));
    }
    return json_decode($request,1);
}

function TipoPlanta(){
    $planta=Planta::where('id',Auth::guard('administradores')->user()->id_planta)->first();
    return $planta->tipo;
}



?>
