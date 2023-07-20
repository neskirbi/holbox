<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manifiesto</title>
    <style>
    .bordes{
        border: 2px solid #000;
    }
    
    .probable100{
        width:100%;
    }
    
    td{
        font-size:9px;
    }
    </style>
</head>
<body>
<center>
    <table style="border-collapse: collapse; width:100%;">
        <tr>
            <td class="bordes"><center><img style="width:15px; padding:10px;" src="{{public_path('images/formatos/manifiesto/generador.png')}}" alt="Generador"></center></td>
            <td class="bordes">
                <p><b>Folio: {{$recoleccion->folio}}</b></p>
                NÚM. DE REGISTRO (Resolutivo de Impacto Ambiental, Plan de Manejo): <b>{{$recoleccion->nautorizacion}}</b>
               <br><br>
                RAZÓN SOCIAL DE LA PERSONA:  <b>{{$recoleccion->razonsocial}}</b>
                <br><br>                
                <table class="probable100">
                    
                    <tr>
                        <td>DOMICILIO:</td>
                        <td>&nbsp;&nbsp;<b>{{$recoleccion->calle}} Col. {{$recoleccion->colonia}}</b></td>
                        <td>COLONIA:</td>
                        <td>&nbsp;&nbsp;<b>{{$recoleccion->colonia}}</b></td>
                    </tr>

                    <tr>
                        <td>C.P:</td>
                        <td>&nbsp;&nbsp;<b>{{$recoleccion->cp}}</b></td>
                        <td>ENTIDAD:</td>
                        <td>&nbsp;&nbsp;<b>{{$recoleccion->entidad}}</b></td>
                    </tr>
                    <tr>
                        <td>TELÉFONO:</td>
                        <td>&nbsp;&nbsp;<b>{{$recoleccion->telefono}}</b></td>
                        <td></td>
                        <td></td>
                    </tr>

                    
                </table>
                
                
             
               
                <br> 5.DESCRIPCIÓN RESIDUO
                <table border="1" style="border-collapse: collapse;" class="probable100">                   

                    <tr>
                        <td>RESIDUO</td>
                        <td>CANTIDAD CONTENEDOR </td>
                        <td>TOTAL</td>
                        <td>FECHA</td>
                        
                    </tr>
                              
                    <tr>
                        <td><b>{{$recoleccion->residuo}}</b></td>
                        <td>{{$recoleccion->cantidad.' '.$recoleccion->contenedor}}</td>
                        <td><b>{{$recoleccion->total}} Kg</b></td>
                        <td><b>{{FechaFormateada($recoleccion->created_at)}}</b></td>
                        
                    </tr>
                    
                    
                </table>

               
                
                INSTRUCCIONES ESPECIOALES E INFORMACION ADICIONAL PARA EL MANEJO SEGURO:<br><br>
                
              <hr>

                DECLARACIÓN DEL GENERADOR:<br>
                DECLARO QUE EL CONTENIDO DE ESTE LOTE ESTA TOTAL Y CORRECTAMENTE DESCRITO MEDIANTE EL NOMBRE DEL RESIDUO, 
                BIEN EMPACADO, MARCADO Y ROTULADO, Y QUE SE HAN PREVISTO LAS CONDICIONES DE SEGURIDAD PARA SU TRANSPORTE 
                POR VIA TERRESTRE DE ACUERDO A LA LEGISLACIÓN VIGENTE.<br><br><br>

                NOMBRE Y FIRMA DEL RESPONSABLE: <b>{{GetNombre()}} {{GetApellidos()}}</b> <img src="{{$recoleccion->firma}}" width="70px" alt="">
                <br> 
                
                
               
                <br>
            </td>
        </tr>
        <tr>
            <td class="bordes"><center><img style="width:15px; padding:10px;" src="{{public_path('images/formatos/manifiesto/transporte.png')}}" alt="Transporte"></center></td>
            <td class="bordes">
                7.-NOMBRE DE LA EMPRESA TRANSPORTISTA:
                <br><b>{{$recoleccion->razonvehiculo}}</b>
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>
                            DOMICILIO FISCAL:
                            <br><b>{{$recoleccion->direccionvehiculo}}</b>
                        </td>
                        <td>
                            TELÉFONO:
                            <br><b>{{$recoleccion->telefonovehiculo}}</b>
                        </td>
                    </tr>
                   
                </table>
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>
                            AUTORIZACIÓN RAMIR: <b>{{$recoleccion->ramir}}</b>
                            <br>Folio Fiscal de la factura asociada al transporte de RCM
                        </td>
                        <td>
                            NO. DE REGISTRO S.C.T. <b>{{$recoleccion->regsct}}</b>
                        </td>
                    </tr>
                   
                </table>
                <br>
                <hr>
                8.- RECIBÍ LOS RESIDUOS DESCRITOS EN EL MANIFIESTO PARA SU TRANSPORTE.
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>NOMBRE:</td>
                        <td><b>{{$recoleccion->nombrecompleto}}</b></td>
                        <td>FIRMA: <img src="{{$recoleccion->firmachof}}" width="70px" alt=""></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>CARGO:</td>
                        <td></td>
                        <td>FECHA DE EMBARQUE:</td>
                        <td><b>{{FechaFormateada($recoleccion->fechacita)}}</b></td>
                    </tr>
                </table>
                <hr>
                9.- DISTANCIA RECORRIDA DESDE LA EMPRESA GENERADORA HASTA SU ENTREGA (Km). {{$recoleccion->distancia}} Km
                <br>
                <hr>
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>10.-TIPO DE VEHÍCULO</td>
                        <td><b>{{$recoleccion->vehiculo}}</b></td>
                        <td>MARCA Y MODELO</td>
                        <td><b>{{$recoleccion->marcaymodelo}}</b></td>
                        <td>No. DE MATRÍCULA:</td>
                        <td><b>{{$recoleccion->matricula}}</b></td>
                    </tr>
                   
                </table>
                <hr>
               
                <table style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>11.-TIPO DE COMBUSTIBLE</td>
                        <td>{{$recoleccion->combustible}}</td>
                    </tr>
                   
                </table>
                <hr>
                <table style="border-collapse: collapse;" class="probable100">          

                    <tr>
                        <td>12.- DESCRIPCIÓN DEL RESIDUO RECIBIDO (Nombre del residuo, Conforme a la Tabla 1 de la presente Norma Ambiental)</td>
                        <td>CANTIDAD TOTAL DE RESIDUO TRANSPORTADO</td>
                        
                    </tr>
                              
                    <tr>
                        <td><b>{{$recoleccion->residuo}}</b></td>
                        <td><b>{{$recoleccion->contenedor.' '.$recoleccion->cantidad}}</b></td>
                        
                    </tr>
                    
                    
                </table>
                <hr>

                <table  style="border-collapse: collapse;" class="probable100">          

                    <tr>
                        <td>13.- ESPECIFIQUE LAS CONDICIONES<br> CONFORME A LAS CUALES TRANSPORTA<br> LOS RESIDUOS (Marque con una X)</td>
                        <td style="text-align:center;">GRANEL:<br
                        >@if($recoleccion->condicionesmaterial=='Granel')
                        <b>x</b>
                        @else&nbsp;
                        @endif</td>
                        <td style="text-align:center;">ENCOSTALADO:<br>
                        @if($recoleccion->condicionesmaterial=='Encostalado')
                        <b>x</b>
                        @else&nbsp;
                        @endif</td>
                        
                    </tr>
                              
                   
                    
                    
                </table>
                <hr>
                14.- INDIQUE EL NOMBRE Y DOMICILIO DEL SITIO DE DISPOSICIÓN (CENTRO DE ACOPIO, TRANSFERENCIA, PLANTA DE RECICLAJE O SITIO
                <br>
                <b>{{$recoleccion->planta.'   '.$recoleccion->direccionplanta}}</b>
                <hr>
                15.- DECLARACIÓN DEL PRESTADOR DE SERVICIO DE TRANSPORTE: DECLARO QUE EL CONTENIDO DE ESTE MANIFIESTO ESTA TOTAL Y CORRECTAMENTE DESCRITO MEDIANTE EL NOMBRE DEL RESIDUO, BIEN CLASIFICADO, Y MARCADO, Y QUE SE HAN PREVISTO LAS CONDICIONES DE SEGURIDAD PARA SU TRANSPORTE POR VÍA TERRESTRE DE ACUERDO A LA LEGISLACIÓN VIGENTE.
                NOMBRE Y FIRMA DEL RESPONSABLE.
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td class="bordes"><center><img style="width:15px; padding:20px;" src="{{public_path('images/formatos/manifiesto/destino.png')}}" alt="Destino"></center></td>
            <td class="bordes">
                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>17.- RAZÓN SOCIAL DE LA PERSONA FÍSICA O MORAL DESTINATARIA <br>(CENTRO DE ACOPIO, CENTRO DE TRANSFERENCIA, <br>PLANTA DE RECICLAJE O SITIO DE DISPOSICIÓN FINAL):</td>
                        <td><b>{{$recoleccion->planta}}</b></td>
                        
                    </tr>
                </table>
                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>18.- NÚMERO DE AUTORIZACIÓN <br>(Centro de Acopio)</td>
                        <td><b>{{$recoleccion->plantaauto}}</b></td>                        
                    </tr>
                </table>
                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>DOMICILIO DEL ESTABLECIMIENTO:</td>
                    <td><b>{{$recoleccion->direccionplanta}}</b></td>   
                    </tr>           
                    <tr>
                        <td><b>TELÉFONO</b></td>          
                        <td><b>55-7599-8226</b></td>
                    </tr>
                </table>
                
                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>RECIBÍ LOS RESIDUOS DESCRITOS EN EL MANIFIESTO</td>
                        <td>SI</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$recoleccion->confirmacion==1 ? 'x' : ''}}</td>
                        <td>NO</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$recoleccion->confirmacion==2 ? 'x' : ''}}</td>
                    </tr>
                </table>
                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td colspan="2">NOMBRE: {{$recoleccion->recibio}}</td>
                    </tr>
                    <tr>
                        <td>CARGO:{{$recoleccion->cargo}}</td>
                        <td>FIRMA  <img src="{{$recoleccion->firmarecibio}}" width="70px" alt=""></td>
                    </tr>
                    
                </table>
                
                OBSERVACIONES: <br>
                <b>{{$recoleccion->observacion}}</b>

                <table border="1" style="border-collapse: collapse;" class="probable100">
                    <tr>
                        <td>Folio Fiscal de la factura asociada al acopio de RCD <br><br></td>
                        <td>DÍa</td>
                        <td>MES</td>
                        <td>AÑO</td>
                    </tr>

                    <tr>
                        <td>FECHA DE RECEPCIÓN DEL EMBARQUE AL CENTRO DE ACOPIO</td>
                        <?php $fecha=explode("/",MesesEspanol(date('d/m/Y',strtotime($recoleccion->fechacita))));?>
                        <td><b>{{$fecha[0]}}</b></td>
                        <td><b>{{$fecha[1]}}</b></td>
                        <td><b>{{$fecha[2]}}</b></td>
                    </tr>

                    <tr>
                        <td>FECHA DE SALIDA DEL CENTRO DE ACOPIO</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Folio Fiscal de la factura asociada a la disposición final  RCD <br><br></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>

            
        </tr>      

    </table>
</center>
    
    
</body> 
</script> 
</html>