<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <table>
        <thead>
        <tr>
            <th style="width:25px;">fecha de reporte</th>
            <th style="width:100px;">planta</th>
            <th style="width:150px;">Dirección</th>
            <th style="">codigo cliente igual al de SAP</th>
            <th style="">estatus</th>
            <th style="">activo</th>
            <th style="">referencia</th>
            <th style="width:40px;">cliente</th>
            <th style="">vendedor</th>
            <th style="width:500px;">razon social</th>
            <th style="width:500px;">domcilio fiscal</th>
            <th style="width:500px;">Nombre de la obra</th>
            <th style="">fecha inicio</th>
            <th style="">fecha fin</th>
            <th style="width:500px;">domicilio obra</th>
            <th style="">contacto</th>
            <th style="width:25px;">teléfono</th>
            <th style="width:25px;">contacto</th>
            <th style="width:25px;">correo electronico</th>
            <th style="">firmado si no</th>
            <th style="">contraprestacion o importe contratado</th>
            <th style="">descripcion tipo de agregado</th>
            <th style="width:25px;">metros cubicos contratados</th>
            <th style="width:25px;">metros cubicos recibidos</th>
            <th style="width:25px;">remanente metros cubicos</th>
            <th style="width:25px;">anticipo</th>
            <th style="width:25px;">credito</th>
            <th style="width:25px;">consumo</th>
            <th style="width:25px;">ramanente</th>
            <th style="">transporte del cliente</th>
            <th style="">transporte de CSMX</th>
            <th style="">costo estimado</th>
            <th style="">Folio de manifiesto</th>
            <th style="">Transporte</th>
            <th style="">pagare</th>
            <th style="">fecha</th>
            <th style="">Factura</th>
            <th style="">fecha factura</th>
            <th style="">dias de credito</th>
            <th style="">Subtotal</th>
            <th style="">IVA</th>
            <th style="">Total</th>
            <th style="">documentacion legal completa</th>
            <th style="">lista de precios por tipo de residuo a recibir</th>
        </tr>
        </thead>
        <tbody>
            @foreach($obras as $obra)
            <tr>
                <td>{{date('Y-m-d')}}</td>
                <td>{{$obra->planta}}</td>
                <td>{{$obra->dirplanta}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$obra->cliente}}</td>
                <td></td>
                <td>{{$obra->razonsocial}}</td>
                <td>{{$obra->domiciliogen}}</td>
                <td>{{$obra->obra}}</td>
                <td>{{$obra->fechainicio}}</td>
                <td>{{$obra->fechafin}}</td>
                <td>{{$obra->domicilioobr}}</td>
                <td></td>
                <td>{{$obra->celular}}</td>
                <td>{{$obra->correo}}</td>
                <td>{{$obra->correo2}}</td>
                <td></td>
                <td>
                    @if($obra->transporte == 1)
                        ${{$obra->capacidad<= 0 ? 0 : number_format($obra->preciomat+ceil( $obra->cantidadobra/$obra->capacidad)*($obra->preciotrans),2)}}
                        @else
                        ${{number_format($obra->preciomat,2)}}
                    @endif
                </td>
                <td></td>
                <td>{{number_format($obra->cantidadobra,2)}}{{$obra->superunidades}}</td>                
                <td>{{number_format($obra->entregado,2)}}{{$obra->superunidades}}</td>
                <td>{{number_format($obra->cantidadobra-$obra->entregado,2)}}{{$obra->superunidades}}</td>                
                <td>${{number_format($obra->monto,2)}}</td>
                <td>{{$obra->puedepospago == 1 ? 'X' : ''}}</td>
                <td>${{number_format($obra->consumo,2)}}</td>
                <td>${{number_format($obra->monto-$obra->consumo,2)}}</td>
                
                <td>{{$obra->transporte == 1 ? '' : 'X'}}</td>
                <td>{{$obra->transporte == 1 ? 'X' : ''}}</td>
                <td></td>
                <td></td>
                <td>
                    @if($obra->transporte == 1)
                        ${{$obra->capacidad<= 0 ? 0 : number_format(ceil( $obra->cantidadobra/$obra->capacidad)*($obra->preciotrans),2)}}
                        @else
                        ${{0}}
                    @endif
                </td>
                <td>

                    @if($obra->transporte == 1)
                        ${{$obra->capacidad<= 0 ? 0 : number_format($obra->preciomat+ceil( $obra->cantidadobra/$obra->capacidad)*($obra->preciotrans),2)}}
                        @else
                        ${{number_format($obra->preciomat,2)}}
                    @endif
                    
                </td>
              
            </tr>
            @endforeach
           
        </tbody>
        
    </table>
</body>
</html>
